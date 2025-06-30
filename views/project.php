<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");
$result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Projects Table</title>
  <link rel="stylesheet" href="css/proj.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #1f1c2c, #928dab);
      padding: 30px;
      color: #fff;
      position: relative;
      overflow-x: hidden;
    }

    /* Blooming Flowers */
    .flower {
      position: absolute;
      width: 60px;
      height: 60px;
      background: radial-gradient(circle, pink 40%, deeppink 70%);
      border-radius: 50%;
      animation: bloom 6s ease-in-out infinite;
      opacity: 0;
    }

    .flower:nth-child(1) { top: 80%; left: 10%; animation-delay: 0s; }
    .flower:nth-child(2) { top: 85%; left: 30%; animation-delay: 2s; }
    .flower:nth-child(3) { top: 78%; left: 50%; animation-delay: 4s; }

    @keyframes bloom {
      0% { transform: scale(0.5); opacity: 0; }
      50% { transform: scale(1.3); opacity: 1; }
      100% { transform: scale(0.5); opacity: 0; }
    }

    /* Flying Butterfly */
    .butterfly {
      position: absolute;
      width: 40px;
      height: 40px;
      background: url('https://upload.wikimedia.org/wikipedia/commons/thumb/f/f0/Butterfly_icon.svg/64px-Butterfly_icon.svg.png') no-repeat center/contain;
      animation: fly 12s linear infinite;
    }

    @keyframes fly {
      0%   { transform: translate(-50px, 100px) rotate(0deg); }
      25%  { transform: translate(200px, 80px) rotate(10deg); }
      50%  { transform: translate(400px, 120px) rotate(-5deg); }
      75%  { transform: translate(600px, 60px) rotate(15deg); }
      100% { transform: translate(100vw, 150px) rotate(0deg); }
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 36px;
      font-weight: 600;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
    }

    .back-button {
      display: inline-block;
      margin-bottom: 30px;
      padding: 10px 20px;
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      text-decoration: none;
      border-radius: 12px;
      font-weight: 600;
      transition: 0.3s ease;
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .back-button:hover {
      background: rgba(255, 255, 255, 0.25);
      transform: scale(1.05);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 10px 25px rgba(0,0,0,0.3);
      backdrop-filter: blur(10px);
    }

    th, td {
      padding: 15px;
      text-align: center;
      color: #fff;
    }

    th {
      background-color: rgba(0, 123, 255, 0.6);
      font-size: 18px;
    }

    tr:nth-child(even) {
      background-color: rgba(255, 255, 255, 0.05);
    }

    tr:hover {
      background-color: rgba(255, 255, 255, 0.1);
      transition: 0.3s ease;
    }

    img {
      width: 70px;
      height: 70px;
      object-fit: cover;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.4);
    }

    .btn-view {
      display: inline-block;
      padding: 8px 16px;
      background: linear-gradient(to right, #28a745, #218838);
      color: white;
      border: none;
      border-radius: 25px;
      text-decoration: none;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s ease;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .btn-view:hover {
      transform: scale(1.05);
      background: linear-gradient(to right, #218838, #1e7e34);
    }

    @media screen and (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }

      th {
        position: absolute;
        top: -9999px;
        left: -9999px;
      }

      tr {
        margin-bottom: 20px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        padding: 15px;
      }

      td {
        text-align: left;
        padding-left: 50%;
        position: relative;
      }

      td:before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        font-weight: bold;
        color: #ddd;
      }

      img {
        width: 100%;
        max-width: 120px;
        height: auto;
      }
      
    }
  </style>
</head>
<body>

  <!-- Animated Elements -->
  <div class="flower"></div>
  <div class="flower"></div>
  <div class="flower"></div>
  <div class="butterfly"></div>

  <!-- Content -->
  <a href="profile.php" class="back-button">← Back</a>
  <h1>My Projects</h1>
  <h1 class="project-footer-title">"All Projects are available to buy — just <span>Contact Me"</span></h1>



 <table> 
  <thead>
    <tr>
      <th>ID</th>
      <th>File Preview</th>
      <th>Title</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <?php
        $filePaths = explode(',', $row['file_path']);
        $filePreviews = '';
        
        if (!empty($filePaths[0])) {
          $file = $filePaths[0];
          $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
          $preview = '';

          if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            $preview = "<img src='$file' alt='Image' style='width:50px; height:50px; margin:2px;'>";
          } elseif ($ext === 'pdf') {
            $preview = "<iframe src='$file' width='50' height='50'></iframe>";
          } elseif (in_array($ext, ['docx', 'pptx'])) {
            $embed = "https://view.officeapps.live.com/op/embed.aspx?src=" . urlencode("http://yourdomain.com/$file");
            $preview = "<iframe src='$embed' width='50' height='50' frameborder='0'></iframe>";
          } else {
            $preview = "<span>No preview</span>";
          }

          $filePreviews = $preview;
        }
      ?>
      <tr>
        <td data-label="ID"><?= $row['id'] ?></td>
        <td data-label="File Preview"><?= $filePreviews ?></td>
        <td data-label="Title"><?= htmlspecialchars($row['title']) ?></td>
        <td data-label="Action">
          <button class="btn-view"
            data-title="<?= htmlspecialchars($row['title']) ?>"
            data-description="<?= htmlspecialchars($row['description']) ?>"
            data-files='<?= json_encode($filePaths) ?>'
            onclick="openModal(this)">View</button>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>



<!-- Modal -->
<div id="projectModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); justify-content:center; align-items:center; z-index:1000;">
    <!-- Modal -->

  <!-- Close Button Outside Modal Content -->
  <span class="close" onclick="closeModal()" style="
    position: absolute;
    top: 30px;
    right: 50px;
    font-size: 48px;
    font-weight: bold;
    cursor: pointer;
    color: white;
    z-index: 1100;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
    transition: transform 0.2s ease;
  " onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">&times;</span>

  <div class="modal-content" style="background: grey; padding:20px; border-radius:8px; width:80%; max-width:800px; max-height:90vh; overflow:auto; position:relative;">
    <!-- Close Button -->

    
    <!-- Carousel -->
    <div id="modal-carousel" class="carousel" style="position: relative; width: 100%; max-height: 500px; overflow: hidden; margin-bottom: 20px;">
      <div class="carousel-inner" id="carousel-inner"></div>
      <button class="carousel-control prev" onclick="moveSlide(-1)" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); background-color: rgba(0,0,0,0.5); color: white; border: none; font-size: 24px; padding: 8px 12px; cursor: pointer;">&#10094;</button>
      <button class="carousel-control next" onclick="moveSlide(1)" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background-color: rgba(0,0,0,0.5); color: white; border: none; font-size: 24px; padding: 8px 12px; cursor: pointer;">&#10095;</button>
    </div>

    <!-- Title and Description below the image slider -->
    <h2 id="modal-title" style="text-align:center; margin-top: 20px;"></h2>
    <p id="modal-description" style="text-align:justify; margin: 10px 20px; line-height: 1.6; color: black;"></p>
  </div>
</div>

<!-- JavaScript -->
<script>
  let currentSlide = 0;

  function openModal(button) {
    const title = button.dataset.title;
    const description = button.dataset.description;
    const files = JSON.parse(button.dataset.files);

    const carouselInner = document.getElementById('carousel-inner');
    const modalTitle = document.getElementById('modal-title');
    const modalDesc = document.getElementById('modal-description');

    carouselInner.innerHTML = '';
    modalTitle.textContent = title;
    modalDesc.textContent = description;

    files.forEach((file, index) => {
      const ext = file.split('.').pop().toLowerCase();
      if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
        const img = document.createElement('img');
        img.src = file;
        img.style = "width: 100%; max-height: 400px; object-fit: contain; display: none;";
        if (index === 0) {
          img.classList.add('active');
          img.style.display = 'block';
        }
        carouselInner.appendChild(img);
      }
    });

    currentSlide = 0;
    document.getElementById('projectModal').style.display = 'flex';
  }

  function moveSlide(direction) {
    const images = document.querySelectorAll('#carousel-inner img');
    if (images.length === 0) return;

    images[currentSlide].classList.remove('active');
    images[currentSlide].style.display = 'none';

    currentSlide = (currentSlide + direction + images.length) % images.length;

    images[currentSlide].classList.add('active');
    images[currentSlide].style.display = 'block';
  }

  function closeModal() {
    document.getElementById('projectModal').style.display = 'none';
  }
</script>

</body>
</html>
