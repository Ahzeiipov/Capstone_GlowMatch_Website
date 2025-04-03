<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "skincareconsulting";

$con = mysqli_connect($host, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connection successful";
$sql = "SELECT * FROM users";
?>