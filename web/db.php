<?php
$servername = 'localhost';
$username = 'nc_ncuser';
$password = '[L.DWI~_TZ?u';
$dbname = 'nc_ncdb';



$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>
