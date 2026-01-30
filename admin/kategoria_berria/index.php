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
    if (isset($_POST['gorde'])) {
        $izena = $_POST['izena'];
        $deskribapena = $_POST['deskribapena'];

        if (strlen($izena) > 0 && strlen($deskribapena) > 0) {
            $kategoria = new kategoria();
            $kategoria->setIzena($izena);
            $kategoria->setDeskribapena($deskribapena);
            
            if (kategoriaDB::insertKategoria($kategoria) > 0) {
                include('kategoria_gorde_da.php');
            } else {
                include('kategoria_ez_da_gorde.php');
                }
        } else {
            $mezua = "Eremu guztiak bete behar dira.";
            include('kategoria_berria.php');
        }
    } else {
        $izena = "";
        $deskribapena = "";
        $mezua = "";
        include('kategoria_berria.php');
    }
} else {
    header("Location: index.php");
} ?>
         