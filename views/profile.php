<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");
$user = null;
$user_profile = null;
$socials = null;
$resumes = null;

if (!$conn->connect_error) {
    $result = $conn->query("SELECT * FROM profile ORDER BY id DESC LIMIT 1");
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
        // Get latest user_profile data
    $result2 = $conn->query("SELECT * FROM user_profile ORDER BY id DESC LIMIT 1");
    if ($result2 && $result2->num_rows > 0) {
        $user_profile = $result2->fetch_assoc();
    }
            // Get latest user_profile data
    $result3 = $conn->query("SELECT * FROM socials ORDER BY id DESC");
    if ($result3 && $result3->num_rows > 0) {
        $socials = $result3->fetch_assoc();
    }
                // Get latest user_profile data
    $result4 = $conn->query("SELECT * FROM resumes ORDER BY id DESC");
    if ($result4 && $result4->num_rows > 0) {
        $resumes = $result4->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Portfolio - Hacker</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="../views/css/profile.css">
  <style>
.see-more-wrapper {
  text-align: center;
  margin-top: 20px;
}

.see-more-btn {
  background: linear-gradient(135deg, #4a90e2, #007bff);
  color: white;
  border: none;
  padding: 10px 24px;
  border-radius: 50px;
  font-size: 14px;
  font-weight: bold;
  cursor: pointer;
  box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
  transition: all 0.3s ease;
  text-decoration: none;
  display: inline-block;
}

.see-more-btn:hover {
  background: linear-gradient(135deg, #007bff, #0056b3);
  box-shadow: 0 6px 15px rgba(0, 123, 255, 0.4);
  transform: translateY(-2px);
}

  </style>

</head>
<body>
  <header>
          <a href="../index.html" class="logo-link">
             <div class="logo">Hacker</div>
          </a>

    <div class="header-right">
      <nav>
        <a href="profile.php"><i class="fas fa-home"></i> Home</a>
        <a href="#about"><i class="fas fa-user"></i> About</a>
        <a href="#portfolio"><i class="fas fa-briefcase"></i> Portfolio</a>
        <a href="#service"><i class="fas fa-cogs"></i> Services</a>
        <a href="#contact"><i class="fas fa-envelope"></i> Contact</a>
      </nav>
 <a href="<?= htmlspecialchars($resumes['file_path'] ?? '#') ?>" target="_blank" class="hire-me">Resume</a>
    </div>
  </header>

  <div class="main">
    <div class="hero-text">
      <h1>Port<span>Folio</span></h1>
      <h2>Rey Abollo</h2>
      <h2>I'm a <span>Front-End Developer</span></h2>
      <p>
        Passionate about creating exceptional digital experiences that blend
        innovative design with functional development. Let's bring your vision
        to life.
      </p>
<div class="buttons">
  <a href="cert.php" target="_blank" class="btn btn-primary">View My Certificate</a>
  <a href="project.php" target="_blank" class="btn btn-outline">View My Projects</a>
</div>

    </div>
    <div class="hero-image">
      <img src="../img/h3.jpg" alt="Alexander Chen"/>
<div class="socials">
  <?php if (!empty($socials['facebook'])): ?>
    <a href="<?= htmlspecialchars($socials['facebook']) ?>" target="_blank">
      <i class="fab fa-facebook-f"></i>
    </a>
  <?php endif; ?>

  <?php if (!empty($socials['gmail'])): ?>
    <a href="mailto:<?= htmlspecialchars($socials['gmail']) ?>">
      <i class="fas fa-envelope"></i>
    </a>
  <?php endif; ?>

  <?php if (!empty($socials['github'])): ?>
    <a href="<?= htmlspecialchars($socials['github']) ?>" target="_blank">
      <i class="fab fa-github"></i>
    </a>
  <?php endif; ?>

  <?php if (!empty($socials['linkedin'])): ?>
    <a href="<?= htmlspecialchars($socials['linkedin']) ?>" target="_blank">
      <i class="fab fa-linkedin-in"></i>
    </a>
  <?php endif; ?>

  <?php if (!empty($socials['whatsapp'])): ?>
    <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $socials['whatsapp']) ?>" target="_blank">
      <i class="fab fa-whatsapp"></i>
    </a>
  <?php endif; ?>

  <?php if (!empty($socials['telegram'])): ?>
    <a href="<?= htmlspecialchars($socials['telegram']) ?>" target="_blank">
      <i class="fab fa-telegram-plane"></i>
    </a>
  <?php endif; ?>

  <?php if (!empty($socials['phone'])): ?>
    <a href="tel:<?= htmlspecialchars($socials['phone']) ?>">
      <i class="fas fa-phone"></i>
    </a>
  <?php endif; ?>
</div>

    </div>
  </div>

  <!-- about -->
  <div id="about" class="about-section">
  <div class="about-container">
    <h2><i class="fas fa-user"></i> About Me</h2>

    <div class="about-grid">
        <div class="about-box">
        <h3><i class="fas fa-tools"></i> Skills</h3>
        <div class="skill">
            <span>HTML</span>
            <div class="skill-bar"><div class="skill-fill" style="width: 95%;">Proficient</div></div>
        </div>
        <div class="skill">
            <span>CSS</span>
            <div class="skill-bar"><div class="skill-fill" style="width: 90%;">Proficient</div></div>
        </div>
        <div class="skill"> 
            <span>JavaScript</span>
            <div class="skill-bar"><div class="skill-fill" style="width: 85%;">Intermediate</div></div>
        </div>
        <div class="skill">
            <span>Figma</span>
            <div class="skill-bar"><div class="skill-fill" style="width: 80%;">Intermediate</div></div>
        </div>
        </div>


        <div class="about-box">
        <h3><i class="fas fa-briefcase"></i> Experience</h3>
        <ul>
            <li>Frontend Developer at ABC Corp (2021–2023)</li>
            <li>UI Designer Intern at XYZ Studio (2020)</li>
        </ul>

        <div id="more-experience" class="hidden-experience">
            <ul>
            <li>Freelance Web Developer (2019–2020)</li>
            <li>Volunteer Designer for Local NGO (2018)</li>
            </ul>
        </div>
        <script>
  const toggleBtn = document.getElementById("toggle-experience");
  const moreExp = document.getElementById("more-experience");
  let expanded = false;

  toggleBtn.addEventListener("click", () => {
    expanded = !expanded;
    moreExp.style.display = expanded ? "block" : "none";
    toggleBtn.textContent = expanded ? "View Less" : "View More";
  });
</script>


        <button id="toggle-experience">View More</button>
        </div>


      <div class="about-box">
        <h3><i class="fas fa-bolt"></i> Capabilities</h3>
        <ul>
          <li>Responsive Web Design</li>
          <li>Cross-Browser Compatibility</li>
          <li>Design to Code Conversion</li>
          <li>Client Communication</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- portfolio -->
<div id="portfolio" class="portfolio-section">
  <div class="portfolio-container">

    <div class="portfolio-left">
      <img src="../img/h3.jpg" alt="My Image" style="width: 300px; height: 300px; border-radius: 50%; margin-left: 50px;"   />


      <h2>
        <?= htmlspecialchars($user['name'] ?? 'Your Name') ?>
      </h2>

      <p style="text-align: left;">
        <?= nl2br(htmlspecialchars($user['bio'] ?? 'Your bio goes here.')) ?>
      </p>
    </div>



<!-- Right Column -->
<div class="portfolio-right">
  <div class="education">
    <h3><i class="fas fa-graduation-cap"></i> Education</h3>
    <ul>
      <li>
        <?= htmlspecialchars($user_profile['course'] ?? 'Course') ?> – 
        <?= htmlspecialchars($user_profile['school'] ?? 'School') ?> 
        (<?= htmlspecialchars($user_profile['year_graduated'] ?? 'Year') ?>)
      </li>
    </ul>
  </div>

  <div class="work-experience">
    <h3><i class="fas fa-briefcase"></i> Work Experience</h3>
    <ul>
      <li>
        <?= htmlspecialchars($user_profile['position'] ?? 'Position') ?> – 
        <?= htmlspecialchars($user_profile['company'] ?? 'Company') ?> 
        (<?= htmlspecialchars($user_profile['duration'] ?? 'Duration') ?>)
        <br>
        <small><?= nl2br(htmlspecialchars($user_profile['description'] ?? 'Description')) ?></small>
      </li>
    </ul>
  </div>
  <!-- See More Button -->
<div class="see-more-wrapper">
   <a href="<?= htmlspecialchars($resumes['file_path'] ?? '#') ?>" target="_blank" class="hire-me">See More</a>
</div>


</div>


  </div>
</div>



<!-- Services Section -->
<div id="service" class="services-section">
  <div class="services-container">
    <h2><i class="fas fa-cogs"></i> Services</h2>
    <div class="services-grid">
      <!-- Service Items -->
      <div class="service-box">
        <i class="fab fa-php"></i>
        <h3>PHP</h3>
        <p>Back-end development using PHP for dynamic websites and systems integration.</p>
      </div>
      <div class="service-box">
        <i class="fab fa-html5"></i>
        <h3>HTML</h3>
        <p>Semantic and accessible HTML for building well-structured web pages.</p>
      </div>
      <div class="service-box">
        <i class="fab fa-css3-alt"></i>
        <h3>CSS</h3>
        <p>Styling and animations using CSS3 to create visually appealing interfaces.</p>
      </div>
      <div class="service-box">
        <i class="fab fa-bootstrap"></i>
        <h3>Bootstrap</h3>
        <p>Responsive design using Bootstrap framework for faster development.</p>
      </div>
      <div class="service-box">
        <i class="fab fa-js-square"></i>
        <h3>JavaScript</h3>
        <p>Dynamic behavior and interactivity with modern JavaScript (ES6+).</p>
      </div>
      <div class="service-box">
        <i class="fas fa-code"></i>
        <h3>Front-End Developer</h3>
        <p>End-to-end UI development from design handoff to pixel-perfect execution.</p>
      </div>
      <div class="service-box">
        <i class="fab fa-figma"></i>
        <h3>Figma</h3>
        <p>UI/UX prototyping and design collaboration using Figma tools.</p>
      </div>
      <div class="service-box">
        <i class="fas fa-tools"></i>
        <h3>Troubleshooting</h3>
        <p>Identifying and fixing bugs, performance issues, and layout problems.</p>
      </div>
      <div class="service-box">
        <i class="fas fa-headset"></i>
        <h3>IT Support</h3>
        <p>Providing technical support, system setup, and maintenance services.</p>
      </div>
      <div class="service-box">
        <i class="fab fa-linux"></i>
        <h3>Linux</h3>
        <p>Server management, terminal operations, and scripting with Linux systems.</p>
      </div>
      <div class="service-box">
        <i class="fas fa-database"></i>
        <h3>MySQL</h3>
        <p>Database design, query optimization, and integration using MySQL.</p>
      </div>
      <div class="service-box">
        <i class="fas fa-code"></i>
        <h3>VS Code</h3>
        <p>Development and debugging using Visual Studio Code with extensions and Git integration.</p>
      </div>
    </div>
  </div>
</div>


<!-- contact-->
  <div id="contact" class="contact-section">
  <div class="contact-container">
        <div class="contact-form">
          <h2><i class="fas fa-paper-plane"></i> Contact Me</h2>
          <form method="POST" action="message.php">
            <input type="text" name="name" placeholder="Your Name" required />
            <input type="email" name="email" placeholder="Your Email" required />
            <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
            <button type="submit">Send</button>
          </form>
        </div>

    <div class="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7507.323180462511!2d179.91151090606724!3d-18.582170241024908!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6e1d8f13d1825e37%3A0xddf8b424e73c7b42!2sVUNUKU%20VILLAGE%20SCHOOL!5e1!3m2!1sen!2sph!4v1751291691625!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</div>



<!-- Footer -->
<footer class="footer">
  <div class="footer-container">
    <p>&copy; 2025 hacker. All rights reserved.</p>
    <div class="footer-socials">
  <?php if (!empty($socials['facebook'])): ?>
    <a href="<?= htmlspecialchars($socials['facebook']) ?>" target="_blank">
      <i class="fab fa-facebook-f"></i>
    </a>
  <?php endif; ?>

  <?php if (!empty($socials['gmail'])): ?>
    <a href="mailto:<?= htmlspecialchars($socials['gmail']) ?>">
      <i class="fas fa-envelope"></i>
    </a>
  <?php endif; ?>

  <?php if (!empty($socials['github'])): ?>
    <a href="<?= htmlspecialchars($socials['github']) ?>" target="_blank">
      <i class="fab fa-github"></i>
    </a>
  <?php endif; ?>

  <?php if (!empty($socials['linkedin'])): ?>
    <a href="<?= htmlspecialchars($socials['linkedin']) ?>" target="_blank">
      <i class="fab fa-linkedin-in"></i>
    </a>
  <?php endif; ?>

  <?php if (!empty($socials['whatsapp'])): ?>
    <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $socials['whatsapp']) ?>" target="_blank">
      <i class="fab fa-whatsapp"></i>
    </a>
  <?php endif; ?>

  <?php if (!empty($socials['telegram'])): ?>
    <a href="<?= htmlspecialchars($socials['telegram']) ?>" target="_blank">
      <i class="fab fa-telegram-plane"></i>
    </a>
  <?php endif; ?>

  <?php if (!empty($socials['phone'])): ?>
    <a href="tel:<?= htmlspecialchars($socials['phone']) ?>">
      <i class="fas fa-phone"></i>
    </a>
  <?php endif; ?>
    </div>
  </div>
</footer>

</body>
</html>
