<?php
session_start();

// If user is not logged in, redirect to login.html
if (!isset($_SESSION['user'])) {
    header("Location: ../login.html");
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "portfoliodb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch messages
$sql = "SELECT id, name, message, created_at FROM messages ORDER BY created_at DESC LIMIT 5";

$result = $conn->query($sql);

// Store messages in an array
$messages = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - hacker</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../img/images.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="../views/profile.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>hacker</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../img/h3.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Rey Abollo</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Projects</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="button.php" class="dropdown-item">Certificate</a>
                            <a href="typography.php" class="dropdown-item">Projects</a>
                        </div>
                    </div>
                    <a href="widget.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Contacts</a>
                    <a href="form.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Profile</a>
                    <a href="table.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Settings</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
<div class="nav-item dropdown"> 
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
        <i class="fa fa-envelope me-lg-2"></i>
        <span class="d-none d-lg-inline-flex">Message</span>
    </a>
    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
        <?php foreach ($messages as $msg): ?>
            <a href="all_messages.php?sender=<?= urlencode($msg['name']) ?>" class="dropdown-item">

                <div class="d-flex align-items-center">
                    <img class="rounded-circle" src="../img/h3.jpg" alt="" style="width: 40px; height: 40px;">
                    <div class="ms-2">
                        <h6 class="fw-normal mb-0"><?= htmlspecialchars($msg['name']) ?> sent you a message</h6>
                        <small><?= date('g:i A', strtotime($msg['created_at'])) ?></small>
                    </div>
                </div>
            </a>
            <hr class="dropdown-divider">
        <?php endforeach; ?>
        <a href="all_messages.php" class="dropdown-item text-center">See all messages</a>
    </div>
</div>







                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="../img/h3.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">hacker</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="form.php" class="dropdown-item">My Profile</a>
                            <a href="table.php" class="dropdown-item">Settings</a>
                            <a href="log-out.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <button onclick="location.href='typography.php'" class="w-100 border-0 bg-transparent p-0">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-line fa-3x text-primary"></i>
                                <div class="ms-3 text-start">
                                    <p class="mb-2 text-white">Projects</p>
                                </div>
                            </div>
                        </button>
                    </div>

                                        <!-- Experience Card Button -->
                    <div class="col-sm-6 col-xl-3">
                        <button onclick="location.href='widget.php'" class="w-100 border-0 bg-transparent p-0">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                                <div class="ms-3 text-start">
                                    <p class="mb-2 text-white">Contacts</p>
                                </div>
                            </div>
                        </button>
                    </div>

                    <!-- Skills Card Button -->
                    <div class="col-sm-6 col-xl-3">
                        <button onclick="location.href='table.php'" class="w-100 border-0 bg-transparent p-0">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-area fa-3x text-primary"></i>
                                <div class="ms-3 text-start">
                                    <p class="mb-2 text-white">Activity Log</p>
                                </div>
                            </div>
                        </button>
                    </div>

                    <!-- Profile Card Button -->
                    <div class="col-sm-6 col-xl-3">
                        <button onclick="location.href='form.php'" class="w-100 border-0 bg-transparent p-0">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fas fa-user-circle fa-3x text-primary"></i>
                                <div class="ms-3 text-start">
                                    <p class="mb-2 text-white">Profile</p>
                                </div>
                            </div>
                        </button>
                    </div>

                </div>
            </div>
            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
<div class="col-sm-12 col-xl-6">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0 text-white">Weather Forecast</h6>
            <a href="#" class="text-white-50" onclick="updateWeather()">Refresh</a>
        </div>
        <div class="text-white">
            <h3 class="fw-bold mb-2" id="weather-temp">28°C</h3>
            <p class="mb-1" id="weather-desc">Partly Cloudy</p>
            <p class="mb-1" id="weather-location">Philippines</p>
            <img src="https://openweathermap.org/img/wn/03d@2x.png" alt="Weather Icon" id="weather-icon" style="width: 100px;">
        </div>
    </div>
</div>
<script>
const API_KEY = 'YOUR_OPENWEATHERMAP_API_KEY'; // Replace with your real API key
const CITY = 'Quezon City';

function updateWeather() {
    fetch(`https://api.openweathermap.org/data/2.5/weather?q=${CITY}&appid=${API_KEY}&units=metric`)
        .then(response => response.json())
        .then(data => {
            document.getElementById("weather-temp").textContent = Math.round(data.main.temp) + "°C";
            document.getElementById("weather-desc").textContent = data.weather[0].description;
            document.getElementById("weather-location").textContent = data.name + ", " + data.sys.country;
            document.getElementById("weather-icon").src = "https://openweathermap.org/img/wn/" + data.weather[0].icon + "@2x.png";
        })
        .catch(error => {
            console.error("Weather fetch error:", error);
            alert("Unable to fetch weather data.");
        });
}

updateWeather(); // Load on page load
</script>

                    <div class="col-sm-12 col-xl-6">
    <div class="bg-secondary rounded h-100 p-4 d-flex flex-column align-items-center justify-content-center">
        <h6 class="mb-3 text-white" id="currentDate">Loading date...</h6>
        <canvas id="analogClock" width="200" height="200" style="background: #fff; border-radius: 50%;"></canvas>
    </div>
</div>

<script>
// Show formatted date on top
function updateDate() {
    const dateElement = document.getElementById("currentDate");
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    dateElement.textContent = now.toLocaleDateString(undefined, options);
}

// Draw the analog clock
function drawClock() {
    const canvas = document.getElementById("analogClock");
    const ctx = canvas.getContext("2d");
    const radius = canvas.height / 2;
    ctx.translate(radius, radius);

    function drawFace(ctx, radius) {
        ctx.beginPath();
        ctx.arc(0, 0, radius, 0, 2 * Math.PI);
        ctx.fillStyle = "#fff";
        ctx.fill();
        ctx.strokeStyle = "#333";
        ctx.lineWidth = 4;
        ctx.stroke();

        ctx.beginPath();
        ctx.arc(0, 0, 5, 0, 2 * Math.PI);
        ctx.fillStyle = "#333";
        ctx.fill();
    }

    function drawNumbers(ctx, radius) {
        ctx.font = radius * 0.15 + "px arial";
        ctx.textBaseline = "middle";
        ctx.textAlign = "center";
        for (let num = 1; num <= 12; num++) {
            const angle = num * Math.PI / 6;
            ctx.rotate(angle);
            ctx.translate(0, -radius * 0.85);
            ctx.rotate(-angle);
            ctx.fillText(num.toString(), 0, 0);
            ctx.rotate(angle);
            ctx.translate(0, radius * 0.85);
            ctx.rotate(-angle);
        }
    }

    function drawTime(ctx, radius) {
        const now = new Date();
        let hour = now.getHours();
        let minute = now.getMinutes();
        let second = now.getSeconds();

        hour = hour % 12;
        hour = (hour * Math.PI / 6) + (minute * Math.PI / (6 * 60)) + (second * Math.PI / (360 * 60));
        drawHand(ctx, hour, radius * 0.5, 6);

        minute = (minute * Math.PI / 30) + (second * Math.PI / (30 * 60));
        drawHand(ctx, minute, radius * 0.75, 4);

        second = second * Math.PI / 30;
        drawHand(ctx, second, radius * 0.85, 2, "red");
    }

    function drawHand(ctx, pos, length, width, color = "#000") {
        ctx.beginPath();
        ctx.lineWidth = width;
        ctx.lineCap = "round";
        ctx.strokeStyle = color;
        ctx.moveTo(0, 0);
        ctx.rotate(pos);
        ctx.lineTo(0, -length);
        ctx.stroke();
        ctx.rotate(-pos);
    }

    function renderClock() {
        ctx.clearRect(-radius, -radius, canvas.width, canvas.height);
        drawFace(ctx, radius);
        drawNumbers(ctx, radius);
        drawTime(ctx, radius);
    }

    setInterval(renderClock, 1000);
    renderClock();
}

// Initialize date and clock
updateDate();
drawClock();
</script>
                </div>
            </div>
            <!-- Sales Chart End -->

            <!-- Recent Sales End -->


            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4">
<div class="h-100 bg-secondary rounded p-4">
    <div class="d-flex align-items-center justify-content-between mb-2">
        <h6 class="mb-0">Messages</h6>
        <div>
            <a href="all_messages.php" class="btn btn-sm btn-primary">Show All</a>
            <a href="clear_messages.php" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete all messages?');">Clear All</a>
        </div>
    </div>

    <?php
    $conn = new mysqli("localhost", "root", "", "portfoliodb");
    $result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 3");

    if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
    ?>
        <div class="bg-dark text-white p-2 mb-2 rounded">
            <strong><?= htmlspecialchars($row['name']) ?></strong><br>
            <small class="text-muted"><?= date('M d, Y H:i', strtotime($row['created_at'])) ?></small>
        </div>
    <?php
        endwhile;
    else:
        echo "<p class='text-light'>No messages yet.</p>";
    endif;
    ?>
</div>


                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Calender</h6>
                                <a href="">Show All</a>
                            </div>
                            <div id="calender"></div>
                        </div>
                    </div>
<div class="col-sm-12 col-md-6 col-xl-4">
    <div class="h-100 bg-secondary rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0 text-white">To Do List</h6>
            <a href="#" class="text-white-50" onclick="clearAllTasks()">Clear All</a>
        </div>

        <!-- Input -->
        <div class="d-flex mb-3">
            <input id="todoInput" class="form-control bg-dark border-0 text-white" type="text" placeholder="Enter task">
            <button type="button" class="btn btn-primary ms-2" onclick="addTask()">Add</button>
        </div>

        <!-- Task List -->
        <ul id="todoList" class="list-group list-group-flush">
            <!-- Tasks added dynamically -->
        </ul>
    </div>
</div>
<script>
let tasks = JSON.parse(localStorage.getItem("tasks")) || [];

function saveTasks() {
    localStorage.setItem("tasks", JSON.stringify(tasks));
}

function renderTasks() {
    const list = document.getElementById("todoList");
    list.innerHTML = "";

    tasks.forEach((task, index) => {
        const li = document.createElement("li");
        li.className = "list-group-item bg-dark text-white d-flex justify-content-between align-items-center";
        li.innerHTML = `
            <span>${task}</span>
            <button class="btn btn-sm btn-danger" onclick="removeTask(${index})">×</button>
        `;
        list.appendChild(li);
    });
}

function addTask() {
    const input = document.getElementById("todoInput");
    const task = input.value.trim();
    if (task === "") return;

    tasks.push(task);
    saveTasks();
    renderTasks();
    input.value = "";
}

function removeTask(index) {
    tasks.splice(index, 1);
    saveTasks();
    renderTasks();
}

function clearAllTasks() {
    if (confirm("Clear all tasks?")) {
        tasks = [];
        saveTasks();
        renderTasks();
    }
}

// Initial render on load
renderTasks();
</script>

                </div>
            </div>
            <!-- Widgets End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">hacker</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://pranx.com/hacker/">hacker</a>
                            <br>Distributed By: <a href="https://pranx.com/hacker/" target="_blank">hacker</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>