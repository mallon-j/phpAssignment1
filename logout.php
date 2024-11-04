<?php
session_start();
$_SESSION = array();

session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Logged Out Successfully</h1>
    <p>You have been logged out</p>
    <a href="login.php">Log In</a>
</body>
</html>
