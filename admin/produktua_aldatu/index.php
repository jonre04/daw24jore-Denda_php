<?php
session_start();

$admin = false;

if (isset($_SESSION['erabiltzailea']) && $_SESSION['erabiltzailea'] == "admin") {
    $admin = true;
}

if ($admin == false) {
    header("Location: ..\index.php");
}
require('../../klaseak/com/leartik/daw24jore/produktuak/produktua.php');
require('../../klaseak/com/leartik/daw24jore/produktuak/produktuaDB.php');
require('../../klaseak/com/leartik/daw24jore/kategoriak/kategoria.php');
require('../../klaseak/com/leartik/daw24jore/kategoriak/kategoriaDB.php');
use com\leartik\daw24jore\produktuak\Produktua;
use com\leartik\daw24jore\produktuak\ProduktuaDB;
use com\leartik\daw24jore\kategoriak\Kategoria;
use com\leartik\daw24jore\kategoriak\KategoriaDB;

if (isset($_SESSION['erabiltzailea']) && $_SESSION['erabiltzailea'] == "admin") {
    $admin = true;
} else {
    $admin = false;
}
if ($admin == true) {

    if (!isset($_GET['id'])) {
        echo "<p>Ez da produktuaren IDa zehaztu.</p>";
        exit;
    }

    $id = intval($_GET['id']);

    $produktua = ProduktuaDB::selectProduktua($id);

    if (!$produktua) {
        echo "<p>Ez da produktua aurkitu.</p>";
        exit;
    }

    if (isset($_POST['gorde'])) {
        $izena = trim($_POST['izena']);
        $deskribapena = trim($_POST['deskribapena']);
        $mota = trim($_POST['mota']);
        $prezioa = floatval($_POST['prezioa']);
        $deskontua = intval($_POST['deskontua']);
        $nobedadeak = isset($_POST['nobedadeak']) ? 1 : 0;
        $kategoriaId = intval($_POST['kategoriaId']);

        if (strlen($izena) > 0 && strlen($deskribapena) > 0) {
            $produktua->setIzena($izena);
            $produktua->setDeskribapena($deskribapena);
            $produktua->setMota($mota);
            $produktua->setPrezioa($prezioa);
            $produktua->setDeskontua($deskontua);
            $produktua->setNobedadeak($nobedadeak);
            $produktua->setKategoriaId($kategoriaId);

            if (ProduktuaDB::updateProduktua($produktua)) {
                include('produktua_aldatu_da.php');
            } else {
                include('produktua_ez_da_aldatu.php');
            }
        } else {
            $mezua = "Eremu guztiak bete behar dira.";
            $kategoriak = KategoriaDB::selectKategoriak();
            include('produktua_aldatu.php');
        }
    } else {
        $mezua = "";
        
        $kategoriak = KategoriaDB::selectKategoriak();
        include('produktua_aldatu.php');
    }
} else {
    header("Location: index.php");
}
?>
