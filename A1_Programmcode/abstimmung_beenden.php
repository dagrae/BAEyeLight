//Soabld eine Abstimmung beendet wurde schreibt dieses Skript die Ergebnisse in die Datenbank und leert den Zwischenspeicher (Tabelle button)

<?php
$conn = new mysqli("localhost:3306", "root", "root", "EyeLight");
$sql = "SELECT * FROM button WHERE wert = '1' ";
$sql2 = "SELECT * FROM button WHERE wert = '2'";

if ($result = mysqli_query($conn, $sql))
{
    if ($result2 = mysqli_query($conn, $sql2))
    {
        $rowcount = mysqli_num_rows($result);
        $rowcount2 = mysqli_num_rows($result2);
        $absenden = $conn->prepare("INSERT INTO historie_abstimmung (datum, option1, option2) VALUES (NOW(), ?, ? )");
        $absenden->bind_param("ii", $rowcount, $rowcount2);
        $absenden->execute();
        $loesch = mysqli_query($conn, "DELETE FROM button WHERE wert = '1' OR wert = '2'");
    }
}

?>
