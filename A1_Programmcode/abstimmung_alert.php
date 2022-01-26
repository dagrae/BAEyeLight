//Zeigt dem remote Nutzer einen alert an, wenn eine Abstimmung gestartet wurde

<?php
$db = new mysqli("localhost:3306", "root", "root", "EyeLight");
$abfrage = $db->query("SELECT * FROM button WHERE wert = '1000'");

while ($ausgabe = $abfrage->fetch_object())
{
    echo '<script>alert("Es wurde eine Abstimmung gestartet. Bitte jetzt abstimmen!")</script>';

    $loesch = mysqli_query($db, "DELETE FROM button WHERE wert = '1000'");
}

?>
