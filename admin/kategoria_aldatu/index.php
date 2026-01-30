<?php
session_start();

$admin = false;

if (isset($_SESSION['erabiltzailea']) && $_SESSION['erabiltzailea'] == "admin") {
    $admin = true;
}

if ($admin == false) {
    header("Location: ..\index.php");
}
require('../../klaseak/com/leartik/daw24jore/kategoriak/kategoria.php');
require('../../klaseak/com/leartik/daw24jore/kategoriak/kategoriaDB.php');
use com\leartik\daw24jore\kategoriak\kategoria;
use com\leartik\daw24jore\kategoriak\kategoriaDB;
if (isset($_SESSION['erabiltzailea']) && $_SESSION['erabiltzailea'] == "admin") {
    $admin = true;
} else {
    $admin = false;
}
if ($admin == true) {

    if (!isset($_GET['id'])) {
        echo "<p>Ez da kategoriaren IDa zehaztu.</p>";
        exit;
    }

    $id = intval($_GET['id']);

    
    $kategoria = kategoriaDB::selectkategoria($id);

    if (!$kategoria) {
        echo "<p>Ez da kategoria aurkitu.</p>";
        exit;
    }

    if (isset($_POST['gorde'])) {
        $izena = trim($_POST['izena']);
        $deskribapena = trim($_POST['deskribapena']);
       

        if (strlen($izena) > 0 && strlen($deskribapena) > 0) {
        $kategoria->setIzena($izena);
        $kategoria->setDeskribapena($deskribapena);

            if (kategoriaDB::updatekategoria($kategoria)) {
               include('kategoria_aldatu_da.php');
            } else {
                include('kategoria_ez_da_aldatu.php');
                }
        } else {
            $mezua = "Eremu guztiak bete behar dira.";
            include('kategoria_aldatu.php');
        }
    } else {
        $mezua = "";
        include('kategoria_aldatu.php');
    }
} else {
    header("Location: index.php");
} ?>