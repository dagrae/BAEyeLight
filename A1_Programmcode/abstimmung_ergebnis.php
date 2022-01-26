//Dynamischer Content für das Ausspielen des Ergenis der letzten Abstimmung. Inhalte werden städnig aktualisiert und mit den aktuellen Werten ausgespielt.

<?php
$db = new mysqli("localhost:3306", "root", "root", "EyeLight");
$abfrage = $db->query(
    "SELECT * FROM historie_abstimmung WHERE `id` = (SELECT MAX(`id`) FROM `historie_abstimmung`)"
);
while ($ausgabe = $abfrage->fetch_object()) {
    echo ' <ul class="list-group list-group-flush" style="padding-bottom: 0px;">
                                       
                                            <li class="list-group-item" style="padding-bottom: 10px;">
                                                <div class="row align-items-center no-gutters">
                                                    <div class="col me-2">
                                                        <h6 class="mb-0"><strong>' .
        $ausgabe->option1 .
        ' Stimmen</strong></h6><span class="text-xs">Option Blau</span>
                                                    </div>
                                                    <div class="col-auto"><i class="far fa-thumbs-up fa-2x text-gray-300"
                                                                             style="font-size: 40px;color: var(--bs-red);"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item" style="padding-bottom: 10px;">
                                                <div class="row align-items-center no-gutters">
                                                    <div class="col me-2">
                                                        <h6 class="mb-0"><strong>' .
        $ausgabe->option2 .
        ' Stimmen</strong></h6><span class="text-xs">Option Grün</span>
                                                    </div>
                                                    <div class="col-auto"><i class="far fa-thumbs-down fa-2x text-gray-300"
                                                                             style="font-size: 40px;color: var(--bs-red);"></i>
                                                    </div>
                                                </div>
                                            </li>
                                       </ul> 

                                    ';
}
?>

