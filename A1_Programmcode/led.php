//startet das Python-Skript mit der aus dem Meeting übergebenen Zeit
<?php
$zeit = $_POST['zeit'];
echo shell_exec("sudo python3 /var/www/html/EyeLight/timer.py $zeit ");
?>