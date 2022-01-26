//Sobald eine neue Wortmeldung im Zwischenspeichern (Tabelle button) auftaucht triggert dieses Skript einen alert beim Moderator
<?php
$db = new mysqli("localhost:3306", "root", "root", "EyeLight");

$abfrage2 = $db->query("SELECT * FROM button WHERE wert = '3'");

while ($ausgabe = $abfrage2->fetch_object()) {
    echo ' <script>alert("Wortmeldung")</script>>';

    $loesch = mysqli_query($db, "DELETE FROM button WHERE wert = '3'");
}

$abfrage2 = $db->query("SELECT * FROM button WHERE wert = '1001'");

while ($ausgabe = $abfrage2->fetch_object()) {
    echo '<script>alert("Wortmeldung Homeoffice")</script>';

    $loesch = mysqli_query($db, "DELETE FROM button WHERE wert = '1001'");
}

?>
