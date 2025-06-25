<?php
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $coachID = $_POST["coachID"];
    $coachName = $_POST["coachName"];
    $coachEmail = $_POST["coachEmail"];
    $coachPhonenumb = $_POST["coachPhonenumb"];
    $password = $_POST["password"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO coach(CoachID, CoachName, CoachEmail, Coach_phonenumb, password)
            VALUES ('$coachID', '$coachName', '$coachEmail', '$coachPhonenumb', '$hashedPassword')";

    if (mysqli_query($conn, $sql)) {
        echo "<p style='color:green;'>Coach registered successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="register_coach.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Coach</title>
</head>
<body>
    <main>
        <section>
            <div class="container">
                <h2>Welcome Coach. Please register!</h2>
                <form action="register_coach.php" method="POST"><br>
                    <table>
                        <tr><th>Coach ID :</th><td><input type="text" name="coachID" required></td></tr>
                        <tr><th>Coach Name :</th><td><input type="text" name="coachName" required></td></tr>
                        <tr><th>Email :</th><td><input type="text" name="coachEmail" required></td></tr>
                        <tr><th>Phone Number :</th><td><input type="text" name="coachPhonenumb"></td></tr>
                        <tr><th>Password :</th><td><input type="password" name="password"></td></tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                <a href="login.php" class="back-btn">Back</a>
                                <input type="submit" value="Register" name="submit">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <div class="social-icons">
            <a href="#"><img src="image/instagram.png" alt="Instagram"></a>
            <a href="#"><img src="image/twitter.png" alt="Twitter"></a>
            <a href="#"><img src="image/facebook.png" alt="Facebook"></a>
            <a href="#"><img src="image/youtube.png" alt="YouTube"></a>
        </div>
        <div class="footer-links">
            <a href="#">Terms & Conditions</a>
            <a href="#">Privacy Policies</a>
        </div>
    </footer>
</body>
</html>
