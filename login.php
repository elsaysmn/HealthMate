<?php
session_start();
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST["loginAs"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    switch($role) {
        case "Admin":
            $table = "admin";
            $usernameField = "AdminName";
            $idField = "AdminID";
            break;
        case "Coach":
            $table = "coach";
            $usernameField = "CoachName";
            $idField = "CoachID";
            break;
        case "User":
            $table = "user";
            $usernameField = "UserName";
            $idField = "UserID";
            break;
        default:
            die("Invalid role");
    }

    $sql = "SELECT * FROM $table WHERE $usernameField = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION["role"] = $role;
            $_SESSION["username"] = $user[$usernameField];
            $_SESSION["user_id"] = $user[$idField];

            include("dashboard_{$role}.php");
        } else {
            echo "Login Failed: Wrong password";
            session_unset();
        }
    } else {
        echo "Login Failed: User not found";
        session_unset();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css" type="text/css">
    <title>HealthMate</title>
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
                        <li><a href="login.php" class="login-btn">Log In</a></li>
                    </ul>
                </nav>
            </header>
            <section class="login-section">
                <article>
                    <header><h2>| Log In</h2></header>
                    <div class="login-box">
                        <form id="myForm" action="login.php" method="post">
                            <table>
                                <tr>
                                    <td><label for="loginAs">Login As: </label></td>
                                    <td>
                                        <select name="loginAs" id="loginAs" required>
                                            <option value="Admin">Admin</option>
                                            <option value="Coach">Coach</option>
                                            <option value="User">User</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="username">Username: </label></td>
                                    <td><input type="text" id="username" name="username" required /></td>
                                </tr>
                                <tr>
                                    <td><label for="IdNo">Id No.: </label></td>
                                    <td><input type="text" id="IdNo" name="idNo" required></td>
                                </tr>
                                <tr>
                                    <td><label for="pass">Password: </label></td>
                                    <td><input type="password" id="pass" name="password" required><br>
                                    <input type="checkbox" onclick="togglePass()">Show password</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <input class="btn" type="submit" name="submit" value="Log In">
                                    </td>
                                </tr>
                            </table>
                        </form>
                            <p class="center"><b>Sign Up <a href="register_coach.php">Coach </a></b>
                        <script>
                            function togglePass() {
                                var input = document.getElementById("pass");
                                if (input.type === "password") {
                                    input.type = "text";
                                } else {
                                    input.type = "password";
                                }
                            }
                        </script>
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