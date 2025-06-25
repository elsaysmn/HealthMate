<?php
include("connect.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $UserID = $_POST["UserID"];
    $UserName = $_POST["UserName"];
    $User_phone = $_POST["User_phone"];
    $UserAge = $_POST["UserAge"];
    $UserGender = $_POST["UserGender"];
    $UserHeight = $_POST["UserHeight"];
    $currentweight = $_POST["currentweight"];
    $targetweight = $_POST["targetweight"];
    $password = $_POST["password"];
    $User_healthgoal = $_POST["User_healthgoal"];

    $Plan_StartDate = $_POST['Plan_StartDate'];
    $Plan_EndDate = $_POST['Plan_EndDate'];

    $DietID = $_POST['DietID'];
    $Diet_goaltype = $_POST['Diet_goaltype'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user(UserID, UserName, User_phone, UserAge, UserGender, UserHeight, currentweight, targetweight, password, User_healthgoal)
            VALUES ('$UserID', '$UserName', '$User_phone', '$UserAge', '$UserGender', '$UserHeight','$currentweight', '$targetweight', '$hashedPassword', '$User_healthgoal')";


    if (mysqli_query($conn, $sql)) {
        // Insert into user_plan
        $sql_plan = "INSERT INTO user_plan (UserID, Plan_StartDate, Plan_EndDate)
                     VALUES ('$UserID', '$Plan_StartDate', '$Plan_EndDate')";
        mysqli_query($conn, $sql_plan);

        // Insert into progress_record
        $sql_progress = "INSERT INTO progress_record (UserID, Date, Weight, Notes)
                         VALUES ('$UserID', '$ProgressDate', '$Progress_Weight', '$Progress_Notes')";
        mysqli_query($conn, $sql_progress);


       echo "<p style='color:green;'>User registeration successful!</p>";
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
    <title>Register User</title>
</head>
<body>
    <section>
        <div class="container">
            <h2>Welcome Coach. Please register a user!</h2>
            <form action="register_user.php" method="POST"><br>
            <table>
                <tr>
                    <th colspan="2"> User Info</th></tr>
                <tr>
                    <th> UserID :</th>
                    <td><input type="text" name ="UserID" required></td>
                </tr>

                <tr>
                    <th> Name :</th>
                    <td><input type="text" name ="UserName" required></td>
                </tr>

                 <tr>
                    <th> Phone Number : </th>
                    <td><input type="text" name ="User_phone" required></td>
                </tr>

                 <tr>
                    <th> Age :</th>
                    <td><input type="text" name ="UserAge"></td>
                </tr>

                     <tr>
                    <th> Gender :</th>
                    <td><input type="text" name ="UserGender" required></td>
                </tr>

                <tr>
                    <th> Height in m:</th>
                    <td><input type="text" name ="UserHeight" required></td>
                </tr>

                 <tr>
                    <th> Current Weight : </th>
                    <td><input type="text" name ="currentweight" required></td>
                </tr>

                 <tr>
                    <th> Target Weight :</th>
                    <td><input type="text" name ="targetweight"></td>
                </tr>

                  <tr>
                    <th> Password :</th>
                    <td><input type="password" name ="password"></td>
                </tr>

                <tr>
                    <th> Health Goal :</th>
                    <td><input type="text" name ="User_healthgoal"></td>
                </tr>

                <tr>
                    <th> Coach ID : </th>
                    <td><input type="text" name="CoachID"></td>
                </tr>
 
                <tr><th colspan="2">Plan Info</th></tr>
                    <tr>
                        <th> Plan Start Date: </th>
                        <td><input type="date" name="Plan_StartDate"></td>
                    </tr>

                     <tr>
                        <th> Plan End Date: </th>
                        <td><input type="date" name="Plan_EndDate"></td>
                    </tr>

                <tr><th colspan="2">Diet Plan</th></tr>
                    <tr> 
                        <th> Diet ID : </th>
                        <td><input type="text" name="DietID"></td>
                    </tr>

                    <tr> 
                        <th> Diet Goal Type : </th>
                        <td><input type="text" name="diet_goaltype"></td>
                    </tr>

                  <tr>
          <td colspan="2">
            <input type="submit" value="Register" name="submit">
          </td>

         <a href ="login.php" class ="login-btn">Log In</a>
        </tr>
      </table>
    </form>

     <p><a href="register_user.php?coachID=<?php echo $_SESSION['user_id'];?>">+ Register a New Client</a></p>

</section>
</body>
</html>

