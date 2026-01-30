<?php
require_once('../klaseak/com/leartik/daw24jore/produktuak/produktua.php');
require_once('../klaseak/com/leartik/daw24jore/produktuak/produktuaDB.php');
require_once('../klaseak/com/leartik/daw24jore/detaileak/detailea.php');
require_once('../klaseak/com/leartik/daw24jore/saskia/saskia.php');

session_start();

use com\leartik\daw24jore\produktuak\Produktua;
use com\leartik\daw24jore\produktuak\ProduktuaDB;
use com\leartik\daw24jore\detaileak\Detailea;
use com\leartik\daw24jore\saskia\Saskia;

if (!isset($_SESSION['saskia'])) {
    $saskia = new Saskia();
    $_SESSION['saskia'] = $saskia;
} else {
    $saskia = $_SESSION['saskia'];
}

if (isset($_POST['ezabatu_index'])) {
    $index = (int) $_POST['ezabatu_index'];
    $saskia->detaileaEzabatu($index);
    $_SESSION['saskia'] = $saskia;
}

if (isset($_POST['id']) && isset($_POST['kopurua'])) {
    $id = (int) $_POST['id'];
    $kopurua = (int) $_POST['kopurua'];

    $produktua = ProduktuaDB::selectProduktua($id);

    if ($produktua) {
        $detailea = new Detailea();
        $detailea->setProduktua($produktua);
        $detailea->setKopurua($kopurua);
        $saskia->detaileaGehitu($detailea);

        $_SESSION['saskia'] = $saskia;
    }
}
include_once('saskia_erakutsi.php');
?>
