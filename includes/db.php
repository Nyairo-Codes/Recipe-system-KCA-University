<!-- includes/db.php -->
<?php
 ini_set("display_errors", 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recipe_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
