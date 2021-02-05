<?php
ini_set('error_reporting', 0);    // type of error for displaying
ini_set('display_errors', 0);     // 0 = hide errors; 1 = display errors

$servername = "localhost";
$username = "root";
$password = "toor";
$dbname = "hospital";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
