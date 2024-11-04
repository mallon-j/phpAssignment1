<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
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

$db = mysqli_connect($servername, $username, $password);
$db_selected = mysqli_select_db($db, $dbname);

if (!$db_selected) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_GET['id'])){
    $id = ($_GET['id']);

    $query = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($db, $query);

    if ($result){
        while ($row = mysqli_fetch_array($result)) {
            $imagePath = "avatars/" . htmlspecialchars($row["image"]);
            echo "<img src='$imagePath' alt='Student Image' class ='default-image'>";
            echo "<p><strong>Student ID:</strong> " . $row['student_id'] . "</p>"; // Student ID
            echo "<p><strong>Address:</strong> " . $row['address'] . "</p>"; // Address
            echo "<p><strong>Mark:</strong> " . $row['mark'] . "</p>"; // Mark
            echo "<form action='set_cookie.php' method='POST'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<button type='submit'>Make Default</button>";
            echo "</form>";

            $id = $row['id'];

            $prev_query = "SELECT id, student_id FROM students WHERE id < $id ORDER BY id DESC LIMIT 1";
            $prev_result = mysqli_query($db, $prev_query);
            $next_query = "SELECT id, student_id FROM students WHERE id > $id ORDER BY id ASC LIMIT 1";
            $next_result = mysqli_query($db, $next_query);

            if ($prev_row = mysqli_fetch_array($prev_result)) {
                echo "<a href='student.php?id=" . $prev_row['id'] . "'>&lt;&lt; Previous Student</a> ";
            }
            
            if ($next_row = mysqli_fetch_array($next_result)) {
                echo "<a href='student.php?id=" . $next_row['id'] . "'>Next Student &gt;&gt;&gt;</a>";
            }

        }

    } else {
        echo "<p>No student found with that ID.</p>";
    }
} else {
    echo "<p>No student ID provided.</p>";
}
include 'footer.inc';

mysqli_close($db);
?>
</body>
</html>