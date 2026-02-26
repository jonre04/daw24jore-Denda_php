<?php
session_start();

if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] != "admin") {
    header("Location: ../index.php");
    exit;
}

require('../../klaseak/com/leartik/daw24jore/mezuak/mezua.php');
require('../../klaseak/com/leartik/daw24jore/mezuak/mezuaDB.php');

use com\leartik\daw24jore\mezuak\Mezua;
use com\leartik\daw24jore\mezuak\MezuaDB;


$id = (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) ? intval($_REQUEST['id']) : 0;

if ($id === 0) {
    echo "Errorea: IDa ez da jaso.";
    exit;
}

$mezua = MezuaDB::selectMezua($id);

if (!$mezua) {
    echo "Ez da mezua aurkitu ID honekin: $id";
    exit;
}

$erroreMezua = "";

if (isset($_POST['gorde'])) {

    $erantzunDa = isset($_POST['erantzunDa']) ? 1 : 0;

    $mezua->setErantzunDa($erantzunDa);

    if (MezuaDB::eguneratuErantzunDa($mezua->getId(), $erantzunDa)) {
        include('mezua_aldatu_da.php');
        exit;
    } else {
        $erroreMezua = "Ezin izan da eguneratu datu-basean.";
    }
}

include('mezua_aldatu.php');
?>