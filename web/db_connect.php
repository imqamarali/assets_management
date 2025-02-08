<?php

 include "../db_configuration.php";
$connn=Yii::$app->getDb();

$servername = 'localhost';
$username = Yii::$app->getDb()->username;;
$password = Yii::$app->getDb()->password;;
$dbname = explode('=',Yii::$app->getDb()->dsn)[2];



$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}  
?>
