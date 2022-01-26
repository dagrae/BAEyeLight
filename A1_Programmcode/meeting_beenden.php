//Sobald ein Meeting vorzeitig beendet wird, beendet dieses Skript die LED-Leiste und schreibt die aktualsierte Dauer in die Datenbank
<?php
echo shell_exec("sudo killall python3");
sleep(2);
echo shell_exec("sudo python3 /var/www/html/EyeLight/xclear.py");
$db = new mysqli("localhost:3306", "root", "root", "EyeLight");
$abfrage = $db->query("UPDATE `historie_meeting` SET `ende`= CURTIME() WHERE `id` = (SELECT MAX(`id`) FROM `historie_meeting`)");

$abfrage = $db->query("SELECT * FROM historie_meeting WHERE `id` = (SELECT MAX(`id`) FROM `historie_meeting`)");

while ($ausgabe = mysqli_fetch_array($abfrage, MYSQLI_BOTH))
{
    $start = $ausgabe[start];
    $ende = $ausgabe[ende];
}

$sekunden = strtotime($ende) - strtotime($start);
$minuten = $sekunden / 60;

$abfrage = $db->query("UPDATE `historie_meeting` SET `dauer`= $minuten WHERE `id` = (SELECT MAX(`id`) FROM `historie_meeting`)");


header('Location: http://raspberrypi/EyeLight/0_final_startseite.php');
?>