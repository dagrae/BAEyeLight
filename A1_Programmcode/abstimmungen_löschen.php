//Löscht den Inhalt der Tabelle historie_abstimmung
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
    "DELETE FROM historie_abstimmung"
);
?>
<?php
header('Location: http://raspberrypi//EyeLight/3_final_abstimmung.php');
?>

