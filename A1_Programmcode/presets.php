//Skript für das laden der Presets in das Modal "meeting-starten". Die Parameter des Presets mit der übergebenen ID, werden an die Felder des Formulars übergeben und dann in das Modal geladen. Zusätzlich wird eine Preview der Beleuchtung ausgeführt.
<body>
<form method="get" action="0_final_startseite.php">
<?php
$q = intval($_GET['q']);

$con = mysqli_connect("localhost:3306", "root", "root", "EyeLight");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"test");
$sql="SELECT * FROM presets WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);


while($row = mysqli_fetch_array($result)) {
   $lampe1 =  $row['lampe1'];
    $lampe2 = $row['lampe2'];
    $lampe3 =  $row['lampe3'];
    $url = "http://172.16.163.120:8080/api/8A7EF596DA/lights/1/state";
    $request_url = $url;
    if ($lampe1 > 0)
    {
        $data = '{"on":true, "bri":' . $lampe1 . "}";
    }
    else
    {
        $data = '{"on":false}';
    }

    $curl = curl_init($request_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($curl);
    curl_close($curl);

    $url = "http://172.16.163.120:8080/api/8A7EF596DA/lights/3/state";
    $request_url = $url;
    if ($lampe2 > 0)
    {
        $data = '{"on":true, "bri":' . $lampe2 . "}";
    }
    else
    {
        $data = '{"on":false}';
    }

    $curl = curl_init($request_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($curl);
    curl_close($curl);

    $url = "http://172.16.163.120:8080/api/8A7EF596DA/lights/4/state";
    $request_url = $url;
    if ($lampe3 > 0)
    {
        $data = '{"on":true, "bri":' . $lampe3 . "}";
    }
    else
    {
        $data = '{"on":false}';
    }

    $curl = curl_init($request_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($curl);
    curl_close($curl);



    echo '<div class="row" style="margin: 0px;">
                        <div class="col">
                            <div class="form-group mb-3"><label class="form-label">
                                    <strong>Name des Meetings</strong><br></label>
                                <input class="form-control"type="text" placeholder="z.B. Päsentation, Monday-Morning Sprint, ..." name="name"value="' . $row['presets'] . '">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 0px;">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label class="form-label" for="last_name"><strong>Anzahl Teilnehmer vor Ort</strong></label>
                                <select class="form-select" name="teilnehmer_meet">
                                    <option selected value="' . $row['teilnehmer']    . '"> ' . $row['teilnehmer']    . ' Teilnehmer</option>
                                    <option value="1">1 Teilnehmer</option>
                                    <option value="2">2 Teilnehmer</option>
                                    <option value="3">3 Teilnehmer</option>
                                    <option value="4">4 Teilnehmer</option>
                                    <option value="0">Bitte auswählen</option>
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
                                            <input class="form-control" type="number" name="std_meet" min="0" max="59" step="1"  style="padding-right: 5px;" placeholder="0" value="' . round($row['zeit'] / 60)   . '">
                                        </div>
                                        <div class="col-md-2" style="padding-top: 8px;">
                                            <strong><p>Std.</p></strong>
                                        </div>
                                        <div class="col-md-4" style="padding-right: 0px;padding-left: 5px;">
                                            <input class="form-control" type="number" name="min_meet" min="0" max="59" step="1" placeholder="0" value="' . $row['zeit'] % 60    . '">
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
                                            <input class="form-range form-control" type="range" name="lampe1_meet" min="0" max="254" step="1" onchange="neuerWertLampe1(this.value)" id="rangeId1" value="' . $row['lampe1']    . '">
                                            <!-- <output for="range" id="outputId1"> 0 </output>%-->
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3" style="text-align: center;">
                                            <label class="form-label"><strong>Lampe 2</strong>
                                                <br>
                                            </label>
                                            <input class="form-range form-control" type="range" name="lampe2_meet" min="0" max="254" step="1" onchange="neuerWertLampe2(this.value)" id="rangeId2" value="' . $row['lampe2']    . '">
                                            <!--<output for="range" id="outputId2"> 0 </output>%-->
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3" style="text-align: center;">
                                            <label class="form-label"><strong>Lampe 3</strong>
                                                <br>
                                            </label>
                                            <input class="form-range form-control" type="range" name="lampe3_meet" min="0" max="254" step="1" onchange=" neuerWertLampe3(this.value)" id="rangeId3" value="' . $row['lampe3']    . '">
                                            <!--  <output for="range" id="outputId3"> 0 </output>%-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';




}

mysqli_close($con);
?>

</body>
</html>