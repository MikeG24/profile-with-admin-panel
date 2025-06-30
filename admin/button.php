<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
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


            <!-- Button Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Upload Certificate</h6>
                            <form method="POST" action="upload_certificate.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="certTitle" class="form-label text-white">Certificate Title</label>
                                <input type="text" name="title" class="form-control" id="certTitle" placeholder="Enter Certificate title" required>
                            </div>

                            <div class="mb-3">
                                <label for="certDescription" class="form-label text-white">Description</label>
                                <textarea name="description" class="form-control" id="certDescription" rows="3" placeholder="Enter Description" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="certFile" class="form-label text-white">Upload Certificates</label>
                                <!-- ✅ MUST include [] in the name AND multiple -->
                                <input type="file" name="files[]" class="form-control" id="certFile" accept=".jpg,.jpeg,.png,.pdf" multiple required>
                            </div>

                            <button type="submit" class="btn btn-success rounded-pill">
                                <i class="fa fa-plus me-2"></i>Upload Certificates
                            </button>
                            </form>



                        </div>
                    </div>

                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-secondary rounded h-100 p-4">
                                <h6 class="mb-4">Upload Resume</h6>
                                <form id="uploadResumeForm">
                                    <div class="mb-3">
                                        <label for="resumeTitle" class="form-label text-white">Resume Title</label>
                                        <input type="text" class="form-control" id="resumeTitle" placeholder="Enter resume title" required value="Existing Resume Title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="resumeDescription" class="form-label text-white">Description</label>
                                        <textarea class="form-control" id="resumeDescription" rows="3" placeholder="Enter resume description" required>Existing resume description...</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="resumeFile" class="form-label text-white">Upload Resume (PDF or DOCX)</label>
                                        <input type="file" class="form-control" id="resumeFile" accept=".pdf,.doc,.docx">
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-upload me-2"></i>Upload Resume</button>
                                </form>
                            </div>
                        </div>
                        <script>
                        document.getElementById("uploadResumeForm").addEventListener("submit", function(e) {
                            e.preventDefault();

                            const fileInput = document.getElementById("resumeFile");
                            if (fileInput.files.length === 0) {
                                alert("Please select a file to upload.");
                                return;
                            }

                            const formData = new FormData();
                            formData.append("title", document.getElementById("resumeTitle").value);
                            formData.append("description", document.getElementById("resumeDescription").value);
                            formData.append("resume", fileInput.files[0]);

                            fetch("upload_resume.php", {
                                method: "POST",
                                body: formData
                            })
                            .then(response => response.text())
                            .then(data => {
                                if (data === "success") {
                                    alert("Resume uploaded successfully!");
                                    window.location.href = "button.php"; // Optional redirect
                                } else if (data === "no_file_uploaded") {
                                    alert("No file selected. Please choose a resume to upload.");
                                } else if (data === "invalid_file_type") {
                                    alert("Invalid file type. Only PDF, DOC, or DOCX allowed.");
                                } else {
                                    alert("Upload failed: " + data);
                                }
                            })
                            .catch(err => {
                                alert("An error occurred.");
                                console.error(err);
                            });
                        });

                        </script>



<div class="col-sm-12 col-xl-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Uploaded Certificates (CRUD)</h6>
        <div class="table-responsive">
            <table class="table table-dark table-bordered" id="certTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>File</th>
                        <th>Actions</th>
                    </tr>
                </thead>
<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM certificates ORDER BY created_at DESC";
$result = $conn->query($sql);
$count = 1;

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $count++ . "</td>";
        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
        echo "<td><a href='" . htmlspecialchars($row['file_path']) . "' target='_blank'>View File</a></td>";
        echo "<td>
                <a href='delete_cert.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger'>Delete</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No certificates uploaded yet.</td></tr>";
}

$conn->close();
?>

            </table>
        </div>
    </div>
</div>
<script>
let certCounter = 1;
const certTableBody = document.querySelector('#certTable tbody');

// Assume this form exists on the page:
document.getElementById('uploadCertificateForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const title = document.getElementById('certTitle').value;
    const desc = document.getElementById('certDescription').value;
    const fileInput = document.getElementById('certFile');
    const file = fileInput.files[0];

    if (!title || !desc || !file) {
        alert("Please fill all fields.");
        return;
    }

    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${certCounter++}</td>
        <td>${title}</td>
        <td>${desc}</td>
        <td>${file.name}</td>
        <td>
            <button class="btn btn-sm btn-info me-1" onclick="alert('Viewing: ${title}')">View</button>
            <button class="btn btn-sm btn-warning me-1" onclick="editCert(this)">Update</button>
            <button class="btn btn-sm btn-danger" onclick="deleteCert(this)">Delete</button>
        </td>
    `;

    certTableBody.appendChild(newRow);
    this.reset();
});

// Delete function
function deleteCert(btn) {
    const row = btn.closest('tr');
    if (confirm("Are you sure you want to delete this certificate?")) {
        row.remove();
    }
}

// Placeholder update function
function editCert(btn) {
    const row = btn.closest('tr');
    const title = row.cells[1].innerText;
    const desc = row.cells[2].innerText;

    // Fill the form with existing values
    document.getElementById('certTitle').value = title;
    document.getElementById('certDescription').value = desc;

    alert("Update the values in the form and re-submit to overwrite.");
}
</script>

                </div>
            </div>
            <!-- Button End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">hacker</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="#">hacker</a>
                            <br>Distributed By: <a href="#" target="_blank">hacker</a>
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