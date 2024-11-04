<?php
session_start();

$passcodes = array(
    "12345",
    "ABCDEF",
    "54321",
    "FEDCBA"
);

if (isset($_POST['password'])) {
    $password = $_POST['password'];

    if (in_array($password, $passcodes)) {
        $_SESSION['loggedIn'] = true;
        header("Location: index.php");
        exit();
    } else {
        echo "<p>Invalid password. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Authentication</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Enter Password</h1>
    <form method="POST" action="">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
