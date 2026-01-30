<?php
session_start();

require_once('../../klaseak/com/leartik/daw24jore/eskariak/Eskaria.php');
require_once('../../klaseak/com/leartik/daw24jore/eskariak/eskariaDB.php');
require_once('../../klaseak/com/leartik/daw24jore/bezeroak/bezeroa.php');
require_once('../../klaseak/com/leartik/daw24jore/detaileak/detailea.php');
require_once('../../klaseak/com/leartik/daw24jore/produktuak/produktua.php');
require_once('../../klaseak/com/leartik/daw24jore/produktuak/produktuaDB.php');

use com\leartik\daw24jore\eskariak\EskariaDB;

$admin = false;
if (isset($_SESSION['erabiltzailea']) && $_SESSION['erabiltzailea'] == "admin") {
    $admin = true;
}

if (!$admin) {
    header("Location: ../../index.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "<p>Ez da eskariaren IDa zehaztu.</p>";
    exit;
}

$id = intval($_GET['id']);
$eskaria = EskariaDB::selectEskaria($id);

if (!$eskaria) {
    echo "<p>Ez da eskaria aurkitu.</p>";
    exit;
}

$detaileak = EskariaDB::selectDetaileakByEskaria($id);
$eskaria->setDetaileak($detaileak);


if (isset($_POST['bidali'])) {
    $bezeroa = $eskaria->getBezeroa();

   
    $bidalita = isset($_POST['bidalita']) ? true : false;
    

    $eskaria->setBidalita($bidalita);

    
    if (EskariaDB::updateEskaria($eskaria)) {
        include('eskaria_aldatu_da.php');
    } else {
        $errorea = "Errorea datu-basean gordetzean.";
        include('eskaria_ez_da_aldatu.php'); 
    }
} else {
    include('eskaria_aldatu.php');
}
?>