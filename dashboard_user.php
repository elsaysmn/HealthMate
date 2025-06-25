<?php
session_start();
if ($_SESSION['role'] !== 'User') {
    header("Location: login.php");
    exit;
}
echo "<h1>Welcome User " . $_SESSION['username'] . "</h1>";
?>