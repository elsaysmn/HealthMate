<?php
session_start();
include('connect.php');

//Check if coach logs in
if(!isset($_SESSION['CoachID'])) {
    header("Location: coach.php");
    exit();
}
$coachName = $_SESSION['username'];
$CoachID = $_SESSION['CoachID'];
$_SESSION['CoachID'] = $CoachID;

// Fetch client data from database
$sql = "SELECT UserID, UserName, User_phone, UserAge, UserGender, UserHeight, currentweight, targetweight, password, User_healthgoal
        FROM user
        WHERE CoachID = '$CoachID'
        ORDER BY UserName ASC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="coach.css" type="text/css">
    <title>Coach | HealthMate</title>
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
                        <li><a href="bmi.php">BMI Caclculator</a></li>
                        <li><a href="login.php" class="login-btn">Log In</a></li>
                    </ul>
                </nav>
            </header>

            <section class="coach-section">
                <article>
                    <header><h2>| Welcome, <?= htmlspecialchars($coachName) ?></h2>
                    <p><a href="register_user.php" style="text-decoration: underline; color: blue;">Register a Client</a></p>
                </header>

                    <div class="coach-box">
                        <h4>Client's Table</h4>
                        <table>
                            <tr>
                                 <th>Name</th>
                                <th>Age</th>
                                <th>Current Weight</th>
                                <th>Target Weight</th>
                                <th>Health Goal</th>
                                <th>Contact</th>
                                <th>Gender</th>
                                <th>Activity</th>
                            </tr>
                           
                            
                            <?php if ($result->num_rows > 0): ?>
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td>
                                            <a href="view_progress.php?user_id=<?= $row['UserID'] ?>">
                                            <?= htmlspecialchars($row['UserName']) ?></a></td>
                                        <td><?=$row['UserAge'] ?></td>
                                        <td><?=$row['currentweight']?> kg </td>
                                        <td><?=$row['targetweight']?> kg </td>
                                        <td><?=$row['User_healthgoal'] ?> kg </td>
                                        <td><?=$row['User_phone']?></td>
                                        <td><?=$row['UserGender'] ?></td>
                                        <td><?=$row['UserActivity'] ?></td>                      
                                </tr>
                                <?php endwhile; ?>
                                <?php else: ?>
                                     <tr><td colspan="8">No clients found for this coach.</td></tr>
                                <?php endif; ?>
                        </table>
                    </div>
                    </article>
            </section>

           

            <footer>
                <div class="footer-container">
                    <div class="social-icons">
                    <a href="https://www.instagram.com/" target="_blank"><img src="image/instagram.png" alt="Instagram"></a>
                    <a href="https://x.com/" target="_blank"><img src ="image/twitter.png" alt="Twitter"></a>
                    <a href="https://www.facebook.com/" target="_blank"><img src ="image/facebook.png" alt="Facebook"></a>
                    <a href="http://www.youtube.com/" target="_blank"><img src ="image/youtube.png" alt="YouTube"></a><br>
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