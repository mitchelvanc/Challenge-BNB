<?php

if (!isset($db_conn)) { 
    return;
}

$database_gegevens = null;
$poolIsChecked = false;
$bathIsChecked = false;

$sql = "Select * FROM homes"; //Selecteer alle huisjes uit de database

if (isset($_GET['filter_submit'])) {
    
    if ($_GET['faciliteiten'] == "ligbad") { // Als ligbad is geselecteerd filter dan de zoekresultaten
        $bathIsChecked = true;

        $sql = "SELECT * FROM `homes` WHERE `bath_present`=1"; // query die zoekt of er een BAD aanwezig is.
    }

    if ($_GET['faciliteiten'] == "zwembad") {
        $poolIsChecked = true;

        $sql = "SELECT * FROM `homes` WHERE `pool_present`=1"; // query die zoekt of er een ZWEMBAD aanwezig is.
    }
}


if (is_object($db_conn->query($sql))) { //deze if-statement controleert of een sql-query correct geschreven is en dus data ophaalt uit de DB
    $database_gegevens = $db_conn->query($sql)->fetchAll(PDO::FETCH_ASSOC); //deze code laten staan
}
