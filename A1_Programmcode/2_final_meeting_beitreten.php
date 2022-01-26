<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>EyeLight - Meeting remote</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/line-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Loading-Div.css">
    <link rel="stylesheet" href="assets/css/NZDropdown---Single.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/lights.js"></script>
    <script>// Funktion zum laden der Presets in das Modal
        function showPreset(str) {

            if (str == "0") {
                document.getElementById("txtHint").innerHTML = document.getElementById("txtHint").innerHTML;
                return;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "presets.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
</head>


<body id="page-top">

<div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
        <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
                    href="0_final_startseite.php">
                <div class="sidebar-brand-icon rotate-n-15"><i class="la la-eye"></i></div>
                <div class="sidebar-brand-text mx-3"><span>Eyelight</span></div>
            </a>
            <ul class="navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item"><a class="nav-link" href="0_final_startseite.php"><i
                                class="fas fa-tachometer-alt"></i><span>Startseite</span></a></li>
                <li class="nav-item"><a class="nav-link" data-bs-target="#meeting_starten" data-bs-toggle="modal"><i
                                class="la la-group"></i><span>Meeting starten</span></a></li>
                <li class="nav-item"><a class="nav-link active" data-bs-target="#meeting_beitreten"
                                        data-bs-toggle="modal"><i class="la la-group"></i><span>Meeting beitreten</span></a>
                </li>
                <li class="nav-item"><a class="nav-link" href="5_final_presets.php"><i class="la la-gear"></i><span>Presets</span></a>
                </li>
                <li class="nav-item"><a class="nav-link" href="3_final_abstimmung.php"><i class="la la-hand-stop-o"></i><span>Abstimmungshistorie</span></a>
                </li>
                <li class="nav-item"><a class="nav-link" href="4_final_meetingshistorie.php"><i
                                class="la la-reorder"></i><span>Meetingshistorie</span></a></li>

            </ul>
        </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper-1" style="padding-top: 2%;">
        <div id="content-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h1 class="text-dark mb-0" style="font-size: 29px;margin-bottom: 0px;">EyeLight - Das visuelle
                            Highlight im Meeting<br></h1>
                        <p style="margin-bottom: 20px;margin-top: 10px;">Hier finden Sie alle Steurungsmöglichkeiten
                            während des Meeting als remote Teilnehmer. Sollten Sie eine Wortmeldung äußern wollen können Sie über das Panel "Wortmeldung" einen Lichtimpuls in den Meetingraum und eine Meldung an den leitenden Mitarbeiter schicken. Zur Teilnahme an Abstimmungen sthene Ihnen die Panel "Option Blau" und "Option Grün" zur Verfügung. Ihnen werden die aktuellen Abstimmungsergebnisse bzw. das
                            letzte finale Ergebnis als Übersicht angezeigt. Alle Informationen über das Meeting stehen Ihnen in den Meetingsinformationen zur Verfügung.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card shadow mb-4" style="height:220px;">
                            <div class="card-header py-3">
                                <h6 class="text-primary fw-bold m-0">Verbleibende Zeit</h6>
                            </div>
                            <ul class="list-group list-group-flush" style="padding-bottom: 0px;">
                                <li class="list-group-item">
                                    <div class="row g-0">
                                        <div class="col">
                                            <?php //Lädt die Daten des Meeting aus der Datenbank, schreibt sie in php Variabeln und verarbeitet diese dann weiter
                                            $db = new mysqli("localhost:3306", "root", "root", "EyeLight");
                                            $loesch = mysqli_query($db, "DELETE FROM button WHERE wert = '1000'");
                                            $abfrage = $db->query("SELECT * FROM historie_meeting WHERE `id` = (SELECT MAX(`id`) FROM `historie_meeting`) AND `ende` >= CURTIME()");

                                            while ($ausgabe = mysqli_fetch_array($abfrage, MYSQLI_BOTH))
                                            {
                                                $ende = $ausgabe[ende];
                                            }

                                            $timestamp = time();
                                            $jetzt = date("H:i:s", $timestamp);
                                            $zeit2 = strtotime($ende);
                                            $final = date("H:i:s", $zeit2);

                                            $sekunden = strtotime($final) - strtotime($jetzt);
                                            $minuten = $sekunden / 60;
                                            ?>

                                            <input type="hidden" id="set-time" value="<?php echo $minuten; ?>"/>
                                            <div id="countdown">

                                                <div id='tiles' class="color-full"></div>

                                            </div>
                                            <!-- partial -->
                                            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
                                            <script src="assets/js/script.js"></script>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow mb-4" style="height:220px;">
                            <div class="card-header py-3">
                                <h6 class="text-primary fw-bold m-0">Bedienelemente</h6>
                            </div>
                            <ul class="list-group list-group-flush" style="padding-top: 30px;">
                                <li class="list-group-item" style="padding-bottom: 10px;">
                                    <div class="row">
                                        <div class="col">
                                            <form action="" method="post">
                                                <button class="btn btn-primary" type="submit" name="wort" type="button"
                                                        style="width: 100%;background: var(--bs-yellow);margin-bottom: 15px;color: rgb(255, 255, 255); border-color: transparent;">
                                                    Wortmeldung
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <form action="" method="post">
                                                <button type="submit" name="opt1" class="btn btn-primary" type="button"
                                                        style="width: 100%;background: var(--bs-blue);border-color: transparent;">
                                                    Option Blau
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col">
                                            <form action="" method="post">
                                                <button type="submit" name="opt2" class="btn btn-primary" type="button"
                                                        style="width: 100%;background: var(--bs-success);border-color: transparent;">
                                                    Option Grün
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <?php //Wenn der Nutzer die Steuerungseinheit für die Wortmeldung betätigt, flackert das Licht im Raum und der Moderator erhält zusätzlich einen alert
                                    if (isset($_POST["wort"]))
                                    {
                                        $db = new mysqli("localhost:3306", "root", "root", "EyeLight");

                                        if ($db->connect_error):
                                            echo "Fehlerhafte Verbindung";
                                        endif;

                                        $id = "TN_HO";
                                        $val = "1001";

                                        $absenden = $db->prepare("INSERT INTO button (wert, button) VALUES (?, ?)");
                                        $absenden->bind_param("is", $val, $id);

                                        $absenden->execute();

                                        $url = "http://172.16.163.120:8080/api/8A7EF596DA/lights/1/state";
                                        $request_url = $url;
                                        $data = '{"on":false}';

                                        $curl = curl_init($request_url);
                                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                                        $response = curl_exec($curl);
                                        curl_close($curl);

                                        sleep(1);

                                        $url = "http://172.16.163.120:8080/api/8A7EF596DA/lights/1/state";
                                        $request_url = $url;
                                        $data = '{"on":true}';

                                        $curl = curl_init($request_url);
                                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                                        $response = curl_exec($curl);
                                        curl_close($curl);

                                        sleep(1);

                                        $url = "http://172.16.163.120:8080/api/8A7EF596DA/lights/1/state";
                                        $request_url = $url;
                                        $data = '{"on":false}';

                                        $curl = curl_init($request_url);
                                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                                        $response = curl_exec($curl);
                                        curl_close($curl);

                                        sleep(1);

                                        $url = "http://172.16.163.120:8080/api/8A7EF596DA/lights/1/state";
                                        $request_url = $url;
                                        $data = '{"on":true}';

                                        $curl = curl_init($request_url);
                                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                                        $response = curl_exec($curl);
                                        curl_close($curl);

                                        sleep(1);

                                    }

                                    if (isset($_POST["opt1"])) ///Wenn der Nutzer die Steuerungseinheit für die Option 1 betätigt, wird der entsprechende Wert in den Zwischenspeicher (Tabelle button) geschrieben und ausgewertet
                                    {
                                        $db = new mysqli("localhost:3306", "root", "root", "EyeLight");

                                        if ($db->connect_error):
                                            echo "Fehlerhafte Verbindung";
                                        endif;

                                        $id = "TN_HO";
                                        $val = "1";

                                        $absenden = $db->prepare("INSERT INTO button (wert, button) VALUES (?, ?)");
                                        $absenden->bind_param("is", $val, $id);

                                        $absenden->execute();
                                    }
                                    if (isset($_POST["opt2"]))///Wenn der Nutzer die Steuerungseinheit für die Option 2 betätigt, wird der entsprechende Wert in den Zwischenspeicher (Tabelle button) geschrieben und ausgewertet
                                    {
                                        $db = new mysqli("localhost:3306", "root", "root", "EyeLight");

                                        if ($db->connect_error):
                                            echo "Fehlerhafte Verbindung";
                                        endif;

                                        $id = "TN_HO";
                                        $val = "2";

                                        $absenden = $db->prepare("INSERT INTO button (wert, button) VALUES (?, ?)");
                                        $absenden->bind_param("is", $val, $id);

                                        $absenden->execute();
                                    }

                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="text-primary fw-bold m-0">Aktuelles Abstimmungsergebnis</h6>
                            </div>
                            <div id="reloaded3">//Modal für die live Auswertung der Abstimmungen, reload auf 3 sec. (abstimmung_live.php)
                                <?php include "abstimmung_live.php"; ?>
                            </div>
                        </div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="text-primary fw-bold m-0">Letztes Abstimmungsergebnis</h6>
                            </div>

                            <div id="reloaded4">//Modal für das Ergebnis der letzten Abstimmungen, reload auf 5 sec. (abstimmung_ergebnis.php)
                                <?php include "abstimmung_ergebnis.php"; ?>
                            </div>
                            <script>
                                setInterval(function () {
                                    $.get('abstimmung_ergebnis.php', function (data) {
                                        $('#reloaded4').html(data);
                                    });
                                }, 5000);
                            </script>

                        </div>
                    </div>
                    <script>
                        setInterval(function () {
                            $.get('abstimmung_live.php', function (data) {
                                $('#reloaded3').html(data);
                            });
                        }, 1000);
                    </script>


                    <?php
                    $db = new mysqli("localhost:3306", "root", "root", "EyeLight");

                    $abfrage = $db->query("SELECT * FROM historie_meeting WHERE `id` = (SELECT MAX(`id`) FROM `historie_meeting`)");

                    while ($ausgabe = $abfrage->fetch_object())
                    {
                        echo ' 
          
                        <div class="col">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Meetingsinformationen</h6> //Übernimmt die Werte der oben übergebenen Abfrage (Rahmendaten des Meetings)
                                </div>
                                <ul class="list-group list-group-flush" style="padding-bottom: 0px;">
                                 <li class="list-group-item" style="padding-bottom: 10px;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <h6 class="mb-0"><strong>' . $ausgabe->name . '</strong></h6><span class="text-xs">Name des Meetings</span>
                                            </div>
                                            <div class="col-auto"><i class="far fa fa-list-ul fa-2x text-gray-300" style="font-size: 50px;color: var(--bs-red);"></i></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item" style="padding-bottom: 10px;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <h6 class="mb-0"><strong>' . $ausgabe->start . '</strong></h6><span class="text-xs">Startzeit</span>
                                            </div>
                                            <div class="col-auto"><i class="far fa-clock fa-2x text-gray-300" style="font-size: 50px;color: var(--bs-red);"></i></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item" style="padding-bottom: 10px;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <h6 class="mb-0"><strong>' . $ausgabe->ende . '</strong></h6><span class="text-xs">Endzeit</span>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-clock fa-2x text-gray-300" style="font-size: 50px;color: var(--bs-red);"></i></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item" style="padding-bottom: 10px;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <h6 class="mb-0"><strong>' . $ausgabe->dauer . ' Minuten</strong></h6><span class="text-xs">Dauer</span>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-circle-o-notch fa-2x text-gray-300" style="font-size: 50px;color: var(--bs-red);"></i></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item" style="padding-bottom: 10px;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <h6 class="mb-0"><strong>' . $ausgabe->teilnehmer . '</strong></h6><span class="text-xs">Anzahl Teilnehmer vor Ort</span>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300" style="font-size: 50px;color: var(--bs-red);"></i></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item" style="padding-bottom: 10px;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <form action="0_final_startseite.php" method="post">
                                                <button class="btn btn-primary" type="submit" name="ende" type="button" style="width: 100%;background: var(--bs-danger);color: rgb(255, 255, 255);border-color: transparent;">Meeting verlassen</button>
                                            </form>
                                            </div>    
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

      ';
                    }
                    ?>


                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span><br>Westfälische Hochschule Gelsenkirchen<br></span>
                </div>
            </div>
        </footer>
    </div>
</div>
<div class="modal fade" role="dialog" tabindex="-1" id="meeting_starten">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="font-size: 20px;">Neues Meeting starten<br></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <form style="width: 100%;" method="post" action="1_final_meeting_starten.php">
                    <div class="row" style="margin: 0px;">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label class="form-label" for="last_name"><strong>Preset auswählen</strong></label>
                                <select class="form-select" name="preset" id="presets" onchange="showPreset(this.value)"> // laden der Presets aus der DB
                                    <?php
                                    $db = new mysqli("localhost:3306", "root", "root", "EyeLight");
                                    $abfrage = $db->query("SELECT * FROM presets");

                                    echo '    
                                    <option value="0">Bitte wählen</option>';

                                    while ($row = $abfrage->fetch_assoc())
                                    {

                                        unset($id, $name);
                                        $id = $row['id'];
                                        $name = $row['presets'];
                                        echo '<option value="' . $id . '">' . $name . '</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="txtHint">
                        <div class="row" style="margin: 0px;">
                            <div class="col">
                                <div class="form-group mb-3"><label class="form-label">
                                        <strong>Name des Meetings</strong><br></label>
                                    <input class="form-control"type="text" placeholder="z.B. Päsentation, Monday-Morning Sprint, ..." name="name">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0px;">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="last_name"><strong>Anzahl Teilnehmer vor Ort</strong></label>
                                    <select class="form-select" name="teilnehmer_meet">
                                        <option value="1">1 Teilnehmer</option>
                                        <option value="2">2 Teilnehmer</option>
                                        <option value="3">3 Teilnehmer</option>
                                        <option value="4">4 Teilnehmer</option>
                                        <option value="0" selected="">Bitte auswählen</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0px;">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label class="form-label"><strong>Zeit einstellen</strong></label>
                                    <div class="container" style="padding-right: 0;padding-left: 0;">
                                        <div class="row" style="margin-left: 0;margin-right: 0;">
                                            <div class="col-md-4" style="padding-left: 0px;padding-right: 0px;">
                                                <input class="form-control" type="number" name="std_meet" min="0" max="59" step="1"  style="padding-right: 5px;" placeholder="0">
                                            </div>
                                            <div class="col-md-2" style="padding-top: 8px;">
                                                <strong><p>Std.</p></strong>
                                            </div>
                                            <div class="col-md-4" style="padding-right: 0px;padding-left: 5px;">
                                                <input class="form-control" type="number" name="min_meet" min="0" max="59" step="1" placeholder="0">
                                            </div>
                                            <div class="col-md-2" style="padding-top: 8px;">
                                                <strong><p>Min.</p></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0px;">
                            <div class="col-12">
                                <div>
                                    <label class="form-label"><strong>Beleuchtung einstellen</strong></label>
                                    <div class="row" style="margin: 0px;">
                                        <div class="col">
                                            <div class="form-group mb-3"><img src="assets/img/Unbenannt.png" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin: 0px;">
                                        <div class="col">
                                            <div class="form-group mb-3" style="text-align: center;">
                                                <label class="form-label"><strong>Lampe 1</strong>
                                                    <br>
                                                </label>
                                                <input class="form-range form-control" type="range" name="lampe1_meet" value="0" min="0" max="254" step="1" onchange="neuerWertLampe1(this.value)" id="rangeId1">
                                                <!-- <output for="range" id="outputId1"> 0 </output>%-->
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group mb-3" style="text-align: center;">
                                                <label class="form-label"><strong>Lampe 2</strong>
                                                    <br>
                                                </label>
                                                <input class="form-range form-control" type="range" name="lampe2_meet" value="0" min="0" max="254" step="1" on onchange="neuerWertLampe2(this.value)" id="rangeId2">
                                                <!--<output for="range" id="outputId2"> 0 </output>%-->
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group mb-3" style="text-align: center;">
                                                <label class="form-label"><strong>Lampe 3</strong>
                                                    <br>
                                                </label>
                                                <input class="form-range form-control" type="range" name="lampe3_meet" value="0" min="0" max="254" step="1" onchange="neuerWertLampe3(this.value)" id="rangeId3">
                                                <!--  <output for="range" id="outputId3"> 0 </output>%-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <div class="col">
                            <div class="text-end form-group mb-3">
                                <button class="btn btn-primary text-end" type="submit" style="text-align: right;">Meeting starten</button>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" role="dialog" tabindex="-1" id="meeting_beitreten">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="font-size: 20px;">Laufendem Meeting beitreten<br></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php // Abfrage ob Meeting stattfindet (per SQL aus DB)
                $db = new mysqli("localhost:3306", "root", "root", "EyeLight");

                $abfrage = $db->query("SELECT * FROM historie_meeting WHERE `id` = (SELECT MAX(`id`) FROM `historie_meeting`) AND `ende` >= CURTIME()");

                if (mysqli_num_rows($abfrage) == 0) {
                    //results are empty, do something here
                    echo '<p style="font-size: 25px;text-align: center;">Aktuell findet kein Meeting statt!</p>';
                }
                else {

                    while ($ausgabe = $abfrage->fetch_object()) {

                        echo ' 
          
                        <div class="col">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Meetingsinformationen</h6>
                                </div>
                                <ul class="list-group list-group-flush" style="padding-bottom: 0px;">
                                <li class="list-group-item" style="padding-bottom: 10px;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <h6 class="mb-0"><strong>' . $ausgabe->name . '</strong></h6><span class="text-xs">Name des Meetings</span>
                                            </div>
                                            <div class="col-auto"><i class="far fa fa-list-ul fa-2x text-gray-300" style="font-size: 50px;color: var(--bs-red);"></i></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item" style="padding-bottom: 10px;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <h6 class="mb-0"><strong>' . $ausgabe->start . '</strong></h6><span class="text-xs">Startzeit</span>
                                            </div>
                                            <div class="col-auto"><i class="far fa-clock fa-2x text-gray-300" style="font-size: 50px;color: var(--bs-red);"></i></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item" style="padding-bottom: 10px;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <h6 class="mb-0"><strong>' . $ausgabe->ende . '</strong></h6><span class="text-xs">Endzeit</span>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-clock fa-2x text-gray-300" style="font-size: 50px;color: var(--bs-red);"></i></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item" style="padding-bottom: 10px;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <h6 class="mb-0"><strong>' . $ausgabe->dauer . ' Minuten</strong></h6><span class="text-xs">Dauer</span>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-circle-o-notch fa-2x text-gray-300" style="font-size: 50px;color: var(--bs-red);"></i></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item" style="padding-bottom: 10px;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <h6 class="mb-0"><strong>' . $ausgabe->teilnehmer . '</strong></h6><span class="text-xs">Anzahl Teilnehmer vor Ort</span>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300" style="font-size: 50px;color: var(--bs-red);"></i></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
            <div class="modal-footer">
                <div class="col">
                    <div class="text-end form-group mb-3">
                        <a href="2_final_meeting_beitreten.php">
                            <div class="text-dark fw-bold h5 mb-0"><button class="btn btn-primary text-end" type="submit" style="text-align: right;margin: 0;margin-right: -9px;">Meeting beitreten</button></div>
                        </a>
                    </div>
                </div>
          

      ';
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>
<div id="reloaded"> //führt sekündlich das Dokument abstimmung_alert.php aus (Abfrage ob eine Abstimmung stattfindet)
    <?php include "abstimmung_alert.php"; ?>
</div>
<script>
    setInterval(function () {
        $.get('abstimmung_alert.php', function (data) {
            $('#reloaded').html(data);
        });
    }, 1000);
</script>
<script src="assets/js/script.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
