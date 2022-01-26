//Löscht den Inhalt der Tabelle historie_meeting
<?php

//Datenbank-Verbindung herstellen
$host_name = 'localhost:3306';
$user_name = 'root';
$password = 'root';
$database = 'EyeLight';
$connect = mysqli_connect($host_name, $user_name, $password, $database);
mysqli_query($connect, "SET NAMES 'utf8'");

$loesch = mysqli_query(
    $connect,
    "DELETE FROM historie_meeting "
);
?>
<?php
header('Location: http://raspberrypi/EyeLight/4_final_meetingshistorie.php');
?>
