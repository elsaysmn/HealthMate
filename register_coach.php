<?php
include("connect.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $coachID = $_POST["coachID"];
    $coachName = $_POST["coachName"];
    $coachEmail = $_POST["coachEmail"];
    $coachPhonenumb = $_POST["coachPhonenumb"];
    $password = $_POST["password"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO coach(CoachID, CoachName, CoachEmail, Coach_phonenumb, password)
            VALUES ('$coachID', '$coachName', '$coachEmail', '$coachPhonenumb', '$hashedPassword')";

   if(mysqli_query($conn, $sql)){
       echo "<p style='color:green;'>Coach registered successfully!</p>";
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
    <title>Register Coach</title>
</head>
<body>
    <section>
        <div class="container">
            <h2>Welcome Coach. Please register!</h2>
            <form action="register_coach.php" method="POST"><br>
            <table>
                <tr>
                    <th> Coach ID :</th>
                    <td><input type="text" name ="coachID" required></td>
                </tr>

                <tr>
                    <th> Coach Name :</th>
                    <td><input type="text" name ="coachName" required></td>
                </tr>

                 <tr>
                    <th> Email : </th>
                    <td><input type="text" name ="coachEmail" required></td>
                </tr>

                 <tr>
                    <th> Phone Number :</th>
                    <td><input type="text" name ="coachPhonenumb"></td>
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
</body>
</html>