<?php
session_start();


if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== "admin") {
    header("Location: ../index.php");
    exit;
}

require('../../klaseak/com/leartik/daw24jore/mezuak/mezua.php');
require('../../klaseak/com/leartik/daw24jore/mezuak/mezuaDB.php');

use com\leartik\daw24jore\mezuak\Mezua;
use com\leartik\daw24jore\mezuak\MezuaDB;

$id = isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])
    ? intval($_REQUEST['id'])
    : 0;

if ($id === 0) {
    echo "<p>Ez da mezuaren IDa zehaztu.</p>";
    exit;
}

$mezua = MezuaDB::selectMezua($id);

if (!$mezua) {
    echo "<p>Ez da mezua aurkitu.</p>";
    exit;
}


if (isset($_POST['ezabatu'])) {

    if (MezuaDB::deleteMezua($id)) {
        include('mezua_ezabatu_da.php');
    } else {
        include('mezua_ez_da_ezabatu.php');
    }
    exit;
}


include('mezua_ezabatu.php');
