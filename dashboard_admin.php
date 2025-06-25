<?php
session_start();
if ($_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit;
}
echo "<h1>Welcome Admin " . $_SESSION['username'] . "</h1>";
?>