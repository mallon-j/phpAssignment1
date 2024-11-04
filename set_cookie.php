<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: login.php');
    exit();
}
if (isset($_POST['id'])){
    $id = $_POST['id'];

    setcookie('default_id', $id, time() + 3600 * 24);
    echo "Default image set to student: " . $id;
} else {
    echo "No id provided";
}
include 'footer.inc';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Default Image</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
</body>
</html>