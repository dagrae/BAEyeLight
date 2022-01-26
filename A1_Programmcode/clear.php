//Reset der LED-Leiste
<?php
echo shell_exec("sudo killall python3");
sleep(2);
echo shell_exec("sudo python3 /var/www/html/EyeLight/xclear.py");
header('Location: http://raspberrypi/EyeLight/0_final_startseite.php');
?>