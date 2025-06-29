<?php
include("connect.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $AdminID = $_POST["AdminID"];
    $AdminName = $_POST["AdminName"];
    $Admin_phonenumb = $_POST["Admin_phonenumb"];
    $password = $_POST["password"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO admin(AdminID, AdminName, Admin_phonenumb, password)
        VALUES ('$AdminID', '$AdminName', '$Admin_phonenumb', '$hashedPassword')";

   if(mysqli_query($conn, $sql)){
       echo "<p style='color:green;'>Admin registered successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="registerAdmin.css">
    <title>Register Admin</title>
</head>
<body>
    <section>
        <div class="container">
            <h2>Welcome Admin. Please register!</h2>
            <form action="registerAdmin.php" method="POST"><br>
            <table>
                <tr>
                    <th> Admin ID :</th>
                    <td><input type="text" name ="AdminID" required></td>
                </tr>

                <tr>
                    <th> Admin Name :</th>
                    <td><input type="text" name ="AdminName" required></td>
                </tr>

                 <tr>
                    <th> Phone Number :</th>
                    <td><input type="text" name ="Admin_phonenumb"></td>
                </tr>

                  <tr>
                    <th> Password :</th>
                    <td><input type="password" name ="password"></td>
                </tr>

                  <tr>
          <td colspan="2">
            <input type="submit" value="Submit" name="submit">
          </td>

         <a href ="login.php" class ="login-btn">Log In</a>
        </tr>
      </table>
    </form>


</section>
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