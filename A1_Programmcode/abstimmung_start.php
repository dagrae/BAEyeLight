//Leert den Zwischenspeicher (Tabelle button) und triggert den alert bei remote Teilnehmern
<?php
$db = new mysqli("localhost:3306", "root", "root", "EyeLight");

if ($db->connect_error):
    echo "Fehlerhafte Verbindung";
endif;
$loesch = mysqli_query(
    $db,
    "DELETE FROM button WHERE wert = '1' OR wert = '2'"
);

$id = "TN_HO_ALERT";
$val = "1000";

$absenden = $db->prepare("INSERT INTO button (wert, button) VALUES (?, ?)");
$absenden->bind_param("is", $val, $id);

$absenden->execute();

?>
