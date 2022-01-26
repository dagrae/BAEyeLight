//Dynamischer Content für das ausspielen der live Abstimmung. Inhalte werden städnig aktualisiert und mit den aktuellen Werten ausgespielt.
<?php
$db = new mysqli("localhost:3306", "root", "root", "EyeLight");
$abfrage = $db->query("SELECT * FROM button WHERE wert = '1'");
$abfrage2 = $db->query("SELECT * FROM button WHERE wert = '2'");

echo '
<ul class="list-group list-group-flush" style="padding-bottom: 0px;">
    <li class="list-group-item" style="padding-bottom: 10px;">
        <div class="row align-items-center no-gutters">
            <div class="col me-2">
                <h6 class="mb-0" ><strong>' .
    $abfrage->num_rows .
    ' Stimmen</strong></h6><span class="text-xs">Option Blau</span>
            </div>
            <div class="col-auto"><i class="far fa-thumbs-up fa-2x text-gray-300" style="font-size: 40px;color: var(--bs-red);"></i></div>
        </div>
    </li>
    <li class="list-group-item" style="padding-bottom: 10px;">
        <div class="row align-items-center no-gutters">
            <div class="col me-2">
                <h6 class="mb-0" ><strong>' .
    $abfrage2->num_rows .
    ' Stimmen</strong></h6><span class="text-xs">Option Grün</span>
            </div>
            <div class="col-auto"><i class="far fa-thumbs-down fa-2x text-gray-300" style="font-size: 40px;color: var(--bs-red);"></i></div>
        </div>
    </li>
</ul>

';
?>
