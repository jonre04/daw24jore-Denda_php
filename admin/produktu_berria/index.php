<?php
session_start();

if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== "admin") {
    header("Location: ../index.php");
    exit;
}

require('../../klaseak/com/leartik/daw24jore/produktuak/produktua.php');
require('../../klaseak/com/leartik/daw24jore/produktuak/produktuaDB.php');
require('../../klaseak/com/leartik/daw24jore/kategoriak/kategoria.php');
require('../../klaseak/com/leartik/daw24jore/kategoriak/kategoriaDB.php');

use com\leartik\daw24jore\produktuak\Produktua;
use com\leartik\daw24jore\produktuak\ProduktuaDB;
use com\leartik\daw24jore\kategoriak\KategoriaDB;
use com\leartik\daw24jore\kategoriak\Kategoria;

$kategoriak = KategoriaDB::selectKategoriak();
$mezua = "";

if (isset($_POST['gorde'])) {

    $izena = trim($_POST['izena']);
    $deskribapena = trim($_POST['deskribapena']);
    $mota = trim($_POST['mota']);
    $prezioa = floatval($_POST['prezioa']);
    $deskontua = floatval($_POST['deskontua']);
    $nobedadeak = isset($_POST['nobedadeak']) ? 1 : 0;
    $kategoriaId = intval($_POST['kategoriaId']);

    if ($izena !== "" && $deskribapena !== "" && $kategoriaId > 0) {

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
    include('produktu_berria.php');
}
?>
