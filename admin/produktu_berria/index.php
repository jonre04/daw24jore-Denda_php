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

use com\leartik\daw24jore\produktuak\Produktua;
use com\leartik\daw24jore\produktuak\ProduktuaDB;


if (isset($_SESSION['erabiltzailea']) && $_SESSION['erabiltzailea'] == "admin") {
    $admin = true;
} else {
    $admin = false;
}
if ($admin == true) {
    if (isset($_POST['gorde'])) {

    $izena = trim($_POST['izena']);
    $deskribapena = trim($_POST['deskribapena']);
    $mota = trim($_POST['mota']);
    $prezioa = floatval($_POST['prezioa']);
    $deskontua = floatval($_POST['deskontua']);
    $nobedadeak = isset($_POST['nobedadeak']) ? 1 : 0;
    $kategoriaId = intval($_POST['kategoriaId']);

    if (
        $izena !== "" &&
        $deskribapena !== "" &&
        $mota !== "" &&
        $prezioa >= 0 &&
        $deskontua >= 0 &&
        $kategoriaId > 0
    ) {

        $produktua = new Produktua();
        $produktua->setIzena($izena);
        $produktua->setDeskribapena($deskribapena);
        $produktua->setMota($mota);
        $produktua->setPrezioa($prezioa);
        $produktua->setDeskontua($deskontua);
        $produktua->setKategoriaId($kategoriaId);
        $produktua->setNobedadeak($nobedadeak);

        if (ProduktuaDB::insertProduktua($produktua) > 0) {
            include('produktua_gorde_da.php');
        } else {
            include('produktua_ez_da_gorde.php');
        }

    } else {
        $mezua = "Eremu guztiak bete behar dira.";
        include('produktu_berria.php');
    }
    } else {
        $izena = "";
        $deskribapena = "";
        $mota = "";
        $prezioa = "";
        $deskontua = "";
        $nobedadeak = "";
        $kategoriaId = "";
        $mezua = "";
        include('produktu_berria.php');
    }
} else {
    header("Location: index.php");
} ?>


         