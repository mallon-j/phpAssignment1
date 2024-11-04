<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: login.php');
    exit();
}

$servername = "localhost";
$username = "jamesmallon";
$password = "jamesmallon";
$dbname = "jamesmallon";

$db = mysqli_connect($servername, $username, $password, $dbname);

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

$studentImagesHtml = "";

if (isset($_GET['min']) && isset($_GET['max'])) {
    $min = intval($_GET['min']);
    $max = intval($_GET['max']);

    if ($min > $max) {
        echo "Please enter valid values.";
        exit();
    }
} else {
    $min = 0;
    $max = 100;
}

echo "<div class='container'>";
$query = "SELECT id, image FROM students WHERE mark BETWEEN $min AND $max";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
    $studentImagesHtml .= "<div class = 'images-container'>";
    while ($row = mysqli_fetch_array($result)) {
        $imagePath = "avatars/" . $row["image"];
        $studentImagesHtml .= "<a href='student.php?id=" . $row["id"] . "'>
        <img src='$imagePath' alt='Student Image' class='images'>
        </a>";
    }
    $studentImagesHtml .= "</div>";
} else {
    $studentImagesHtml .= "No images found in the database.";
}
echo '</div>';

echo $studentImagesHtml;
exit();
?>
