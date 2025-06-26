<?php
session_start();
include('connect.php');

// ✅ Check if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

// Ambil maklumat dari session
$AdminID = $_SESSION['user_id'];
$AdminName = $_SESSION['username'];

// Fetch info admin ikut nama column dalam DB
$sql = "SELECT AdminID, AdminName, Admin_phonenumb FROM admin WHERE AdminID = '$AdminID'";
$result = $conn->query($sql);

if ($result && $result->num_rows === 1) {
    $admin = $result->fetch_assoc();
} else {
    echo "<script>alert('Admin not found.'); window.location.href='login.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | HealthMate</title>
    <link rel="stylesheet" href="admin.css" type="text/css">
</head>
<body>
<div id="wrapper">
    <div id="image-container">
        <header class="navbar">
            <img src="image/HealthMate.png" alt="HealthMate" class="HealthMate">
            <nav class="nav-links">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="bmi.php">BMI Calculator</a></li>
                    <li><a href="logout.php" class="login-btn">Log Out</a></li>
                </ul>
            </nav>
        </header>

        <main style="padding: 25px; font-family: Arial, sans-serif;">

    <!-- Kotak Admin -->
    <div class="data-box">
        <h1>│ Admin</h1>
        <h4>Clients Table</h4>
        <table border="1" width="100%" cellpadding="8" cellspacing="0">
            <thead style="background-color: #f0f0f0;">
                <tr>
                    <th>Nama</th>
                    <th>Age</th>
                    <th>Contact</th>
                    <th>Gender</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Kotak Clients -->
    <div class="data-box">
        <h1>│ Clients Data</h1>
        <h4>Coach1's Clients</h4>
        <table border="1" width="100%" cellpadding="8" cellspacing="0">
            <thead style="background-color: #f0f0f0;">
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Target Weight</th>
                    <th>Contact</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data kosong dulu -->
            </tbody>
        </table>
    </div>

</main>



        <footer>
            <div class="footer-container">
                <div class="social-icons">
                    <a href="https://www.instagram.com/" target="_blank"><img src="image/instagram.png" alt="Instagram"></a>
                    <a href="https://x.com/" target="_blank"><img src="image/twitter.png" alt="Twitter"></a>
                    <a href="https://www.facebook.com/" target="_blank"><img src="image/facebook.png" alt="Facebook"></a>
                    <a href="http://www.youtube.com/" target="_blank"><img src="image/youtube.png" alt="YouTube"></a><br>
                </div>
                <div class="footer-links">
                    <a href="#">Terms & Conditions</a>
                    <a href="#">Privacy Policies</a>
                </div>
            </div>
        </footer>
    </div>
</div>
</body>
</html>
