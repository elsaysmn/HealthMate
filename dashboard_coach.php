<?php
session_start();
if ($_SESSION['role'] !== 'Coach') {
    header("Location: login.php");
    exit;
}
$coachName= $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Dashboard</title>
</head>
<body>
    <h1>Welcome, Coach <?php echo htmlspecialcahrs($coachName); ?>!</h1>
    <p><a href="register_user.php?coachID=<?php echo $_SESSION['user_id'];?>">+ Register a New Client</a></p>
</body>
</html>