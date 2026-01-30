<?php
session_start();

$admin = false;

if (isset($_SESSION['erabiltzailea']) && $_SESSION['erabiltzailea'] == "admin") {
    $admin = true;
}

if ($admin == false) {
    header("Location: ..\index.php");
}

require('../../klaseak/com/leartik/daw24jore/mezuak/mezua.php');
require('../../klaseak/com/leartik/daw24jore/mezuak/mezuaDB.php');
use com\leartik\daw24jore\mezuak\mezua;
use com\leartik\daw24jore\mezuak\mezuaDB;

if (isset($_SESSION['erabiltzailea']) && $_SESSION['erabiltzailea'] == "admin") {
    $admin = true;
} else {
    $admin = false;
}

if ($admin == true) {

    if (!isset($_REQUEST['id'])) {
        echo "<p>Ez da mezuaren IDa zehaztu.</p>";
        exit;
    }

    $id = intval($_REQUEST['id']);
    $mezua = mezuaDB::selectmezua($id);

    if (!$mezua) {
        echo "<p>Ez da mezua aurkitu.</p>";
        exit;
    }

    if (isset($_POST['ezabatu'])) {
        if (mezuaDB::deletemezua($id)) {
            include('mezua_ezabatu_da.php');
        } else {
            include('mezua_ez_da_ezabatu.php');
        }
    } else {
        $mezua = "Eremu guztiak bete behar dira.";
        include('mezua_ezabatu.php');
    }

} else {
    header("Location: index.php");
    exit;
}
?>
