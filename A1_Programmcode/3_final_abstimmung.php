<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>EyeLight - Abstimmungshistorie</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
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

            if (str=="0") {
                document.getElementById("txtHint").innerHTML= document.getElementById("txtHint").innerHTML;
                return;
            }
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("txtHint").innerHTML=this.responseText;
                }
            }
            xmlhttp.open("GET","presets.php?q="+str,true);
            xmlhttp.send();
        }
    </script>
</head>

<body id="page-top">
<div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
        <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="0_final_startseite.php">
                <div class="sidebar-brand-icon rotate-n-15"><i class="la la-eye"></i></div>
                <div class="sidebar-brand-text mx-3"><span>Eyelight</span></div>
            </a>
            <ul class="navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item"><a class="nav-link" href="0_final_startseite.php"><i class="fas fa-tachometer-alt"></i><span>Startseite</span></a></li>
                <li class="nav-item"><a class="nav-link" data-bs-target="#meeting_starten" data-bs-toggle="modal"><i class="la la-group"></i><span>Meeting starten</span></a></li>
                <li class="nav-item"><a class="nav-link" data-bs-target="#meeting_beitreten" data-bs-toggle="modal"><i class="la la-group"></i><span>Meeting beitreten</span></a></li>
                <li class="nav-item"><a class="nav-link" href="5_final_presets.php"><i class="la la-gear"></i><span>Presets</span></a></li>
                <li class="nav-item"><a class="nav-link active" href="3_final_abstimmung.php"><i class="la la-hand-stop-o"></i><span>Abstimmungshistorie</span></a></li>
                <li class="nav-item"><a class="nav-link" href="4_final_meetingshistorie.php"><i class="la la-reorder"></i><span>Meetingshistorie</span></a></li>

            </ul>
        </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper-1" style="padding-top: 2%;">
        <div id="content-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h1 class="text-dark mb-0" style="font-size: 29px;margin-bottom: 0px;">EyeLight - Das visuelle Highlight im Meeting<br></h1>
                        <p style="margin-bottom: 20px;margin-top: 10px;">Eine Historie der zuletzt durchgeführten Abstimmungen. Anhand des Datum und der Zeit können die Abstimmungen einem Meeting zugeordnet werden. Zum löschen der gesamten Historie steht Ihnen der Button "Historie löschen" zur Verfügung.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Abstimmungshistorie</p>
                            </div>
                            <div class="card-body">
                                <div id="dataTable-1" class="table mt-2" role="grid" aria-describedby="dataTable_info">
                                    <table class="table my-0" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th style="width: 25%;">Datum</th>
                                            <th style="width: 25%;">Uhrzeit</th>
                                            <th style="width: 25%;">Stimmen Option Blau</th>
                                            <th style="width: 25%;">Stimmen Option Grün</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php //Fragt per SQL die Datenbank mit den historischen Abstimmungsergenissen ab
                                        $db = new mysqli("localhost:3306", "root", "root", "EyeLight");

                                        $abfrage = $db->query("SELECT * FROM historie_abstimmung ORDER BY id DESC");

                                        while ($ausgabe = $abfrage->fetch_object())
                                        {
                                            echo '  <tr>
                                                        <td>' . $ausgabe->datum . '</td>
                                                        <td>' . $ausgabe->uhrzeit . '</td>
                                                        <td>' . $ausgabe->option1 . ' </td>
                                                        <td>' . $ausgabe->option2 . '</td>
                                                        </tr>
                                            ';
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                        <tr></tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <form>
                                    <div class="text-end form-group mb-3" style="padding-top: 30px;">
                                        <input class="btn btn-primary btn-sm" input type="submit" name="löschen" formaction="abstimmungen_löschen.php" value="Historie löschen" style="background: var(--bs-danger);color: rgb(255, 255, 255);border-color: transparent;">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span><br>Westfälische Hochschule Gelsenkirchen<br></span></div>
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
                                <select class="form-select" name="preset" id="presets" onchange="showPreset(this.value)">// laden der Presets aus der DB
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
</body>

</html>
