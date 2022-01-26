//Skript für ioBroker, wenn Button für Option 2 gedrückt wird, wird der entsprechende Wert in den Zwischenspeicher geschrieben.
<?php

$db = new mysqli("localhost:3306", "root", "root", "EyeLight");

if ($db->connect_error):
    echo "Fehlerhafte Verbindung";
endif;

$id = "TN_Option2";
$val = "2";

$absenden = $db->prepare("INSERT INTO button (wert, button) VALUES (?, ?)");
$absenden->bind_param("is", $val, $id);

$absenden->execute();

?>
