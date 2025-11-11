<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'absensi';


$host = $_ENV['DB_HOST'] ?? 'localhost';
$user = $_ENV['DB_USERNAME'] ?? 'root';
$pass = $_ENV['DB_PASSWORD'] ?? '';
$dbname = $_ENV['DB_DATABASE'] ?? 'absensi';

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>