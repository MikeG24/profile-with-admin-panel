<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");
$result = $conn->query("SELECT * FROM certificates ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Certificates</title>
  <style>
    /* [Same styles as before — no changes needed] */
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom right, #1e1e2f, #3a3a5a);
      color: #fff;
      margin: 0;
      padding: 20px;
    }
    a.back-button {
      background: #ff9933;
      padding: 8px 16px;
      border-radius: 8px;
      color: #fff;
      text-decoration: none;
      display: inline-block;
      margin-bottom: 20px;
    }
    h1 {
      text-align: center;
      font-size: 32px;
      margin-bottom: 40px;
    }
    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      max-width: 1200px;
      margin: 0 auto;
    }
    .card {
      background: #2e2e40;
      border-radius: 15px;
      padding: 20px;
      text-align: center;
      transition: transform 0.3s;
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card img,
    .card .pdf-icon {
      max-width: 100%;
      height: 140px;
      object-fit: cover;
      margin-bottom: 15px;
      border-radius: 10px;
    }
    .pdf-icon {
      font-size: 60px;
      color: #ffcc00;
    }
    .card h3 {
      font-size: 18px;
      margin-bottom: 10px;
    }
    .card p {
      font-size: 14px;
      color: #ccc;
      height: 40px;
      overflow: hidden;
    }
    .card button {
      margin-top: 10px;
      padding: 6px 12px;
      border: none;
      background: #00cc66;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }
    .card button:hover {
      background: #00b359;
    }
    .modal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.8);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }
    .modal-content {
      background: #fff;
      color: #000;
      width: 80%;
      max-width: 900px;
      display: flex;
      padding: 20px;
      border-radius: 10px;
      gap: 20px;
    }
    .modal-left {
      flex: 2;
      text-align: center;
    }
    .modal-right {
      flex: 1;
    }
    .modal img,
    .modal iframe {
      width: 100%;
      max-height: 400px;
    }
    .modal .close {
      position: absolute;
      top: 20px;
      right: 30px;
      font-size: 30px;
      color: #fff;
      cursor: pointer;
    }
    .view-link {
      display: inline-block;
      margin-top: 10px;
      padding: 6px 12px;
      background: #007bff;
      color: #fff;
      border-radius: 5px;
      text-decoration: none;
    }
    .view-link:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>

<a href="profile.php" class="back-button">← Back</a>
<h1>My Certificates</h1>

<div class="gallery">
  <?php
  if ($result && $result->num_rows > 0):
    while($row = $result->fetch_assoc()):
      $filePath = '../admin/' . htmlspecialchars($row['file_path']); // FIXED
      $title = htmlspecialchars($row['title']);
      $desc = htmlspecialchars($row['description']);
      $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
      $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif']);
  ?>
    <div class="card">
      <?php if ($isImage): ?>
        <img src="<?= $filePath ?>" alt="<?= $title ?>">
      <?php else: ?>
        <div class="pdf-icon">📄</div>
      <?php endif; ?>
      <h3><?= $title ?></h3>
      <p><?= strlen($desc) > 80 ? substr($desc, 0, 77) . "..." : $desc ?></p>
      <button onclick="openModal('<?= $filePath ?>', '<?= addslashes($title) ?>', `<?= addslashes($desc) ?>`)">View</button>
    </div>
  <?php endwhile; else: ?>
    <p style="text-align: center;">No certificates uploaded.</p>
  <?php endif; ?>
</div>

<!-- Modal -->
<div id="popupModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">×</span>
    <div class="modal-left" id="modalMedia"></div>
    <div class="modal-right">
      <h2 id="modalTitle"></h2>
      <p id="modalDescription"></p>
    </div>
  </div>
</div>

<script>
function openModal(filePath, title, description) {
  const modal = document.getElementById("popupModal");
  const media = document.getElementById("modalMedia");
  const ext = filePath.split('.').pop().toLowerCase();

  let content = '';
  if (["jpg", "jpeg", "png", "gif"].includes(ext)) {
    content = `<img src="${filePath}" alt="${title}">`;
  } else if (ext === "pdf") {
    content = `<iframe src="${filePath}" width="100%" height="400px"></iframe>`;
  }

  media.innerHTML = content;

  document.getElementById("modalTitle").innerText = title;
  document.getElementById("modalDescription").innerText = description;
  modal.style.display = "flex";
}

function closeModal() {
  document.getElementById("popupModal").style.display = "none";
}
</script>

</body>
</html>
