<?php
session_start();

require_once('../../klaseak/com/leartik/daw24jore/eskariak/eskaria.php');
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
    header("Location: ../index.php");
    exit;
}

if (!isset($_REQUEST['id'])) {
    echo "<p>Ez da eskariaren IDa zehaztu.</p>";
    exit;
}

$id = intval($_REQUEST['id']);
$eskaria = EskariaDB::selectEskaria($id);

if (!$eskaria) {
    echo "<p>Ez da eskaria aurkitu.</p>";
    exit;
}


$detaileak = EskariaDB::selectDetaileakByEskaria($id);
$eskaria->setDetaileak($detaileak);

if (isset($_POST['ezabatu'])) {
    
    if (EskariaDB::deleteEskariaOsotasunean($id)) {
        include('eskaria_ezabatu_da.php');
    } else {
        include('eskaria_ez_da_ezabatu.php');
    }
} else {
    include('eskaria_ezabatu.php');
}
?>