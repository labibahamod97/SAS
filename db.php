<?php
$host = 'localhost';
$user = 'root';
$password = ''; // leave empty for default XAMPP
$database = 'healthdesk';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("❌ Database connection failed: " . mysqli_connect_error());
}
?>
