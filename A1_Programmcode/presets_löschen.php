//Löscht die ausgewählten Preset aus der Tabelle presets
<?php

//Datenbank-Verbindung herstellen
$host_name = 'localhost:3306';
$user_name = 'root';
$password = 'root';
$database = 'EyeLight';
$connect = mysqli_connect($host_name, $user_name, $password, $database);
mysqli_query($connect, "SET NAMES 'utf8'");

//Ausgewählte Datensätze löschen:
for($i=1; $i<=100; $i++){
    if(isset($_POST["auswahl$i"])){
        $deleteAnweisung = "DELETE FROM presets WHERE id=$i";
        $result = mysqli_query($connect, $deleteAnweisung);
    }
}



?>
<?php
header('Location: http://raspberrypi/EyeLight/5_final_presets.php');
?>
