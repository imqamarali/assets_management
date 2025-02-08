<?php
$servername=substr(str_replace('mysql:host=','',Yii::$app->db->dsn), 0, strpos(str_replace('mysql:host=','',Yii::$app->db->dsn), ";"));
$dbname=str_replace('=','',strstr(str_replace('mysql:host=','',Yii::$app->db->dsn), '='));
$username=Yii::$app->db->username;
$password=Yii::$app->db->password;

$conn = new mysqli($servername, $username, $password, $dbname);

if ( !isset ( $_SESSION ) ) { session_start(); }
if ( !isset ( $_SESSION['user_array'] ) || empty ( $_SESSION['user_array'] ) ) {
    $url = '';
    $end_url = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "/web/"));
    
    $url = 'https://' . $_SERVER['SERVER_NAME'] . $end_url . '/web';
    
    header('Location: '.$url);
}
?>