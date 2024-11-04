<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Gallery</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
$servername = "localhost";
$username = "jamesmallon";
$password = "jamesmallon";
$dbname = "jamesmallon";

$db = mysqli_connect($servername, $username, $password);
$db_selected = mysqli_select_db($db, $dbname);

if (!$db_selected) {
    die("Connection failed: " . mysqli_connect_error());
}

$default_id = isset($_COOKIE['default_id']) ? $_COOKIE['default_id'] : null;

echo "<div class='container'>";

if ($default_id) {
    $default_query = "SELECT student_id, image FROM students WHERE id = '$default_id' LIMIT 1";
} else {
    $default_query = "SELECT student_id, image FROM students LIMIT 1";
}
$result = mysqli_query($db, $default_query);

if ($result){
    while ($row = mysqli_fetch_array($result)) {
        $imagePath = "avatars/" . $row["image"];
        echo "<a href='student.php?id=" . $row["student_id"] . "'>
                <img src='$imagePath' alt='Student Image' class='default-image'>
            </a>";
    }
}

$query = "SELECT id, student_id, image FROM students";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<div class='images-container'>";
    while ($row = mysqli_fetch_array($result)) {
        $imagePath = "avatars/" . $row["image"];
        echo "<a href='student.php?id=" . $row["id"] . "'>
                <img src='$imagePath' alt='Student Image' class='images'>
            </a>";
    }
    echo "</div>";
} else {
    echo "No images found in the database.";
}
echo "</div>";

include 'footer.inc';

mysqli_close($db);
?>

</body>
</html>
