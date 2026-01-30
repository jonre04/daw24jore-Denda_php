<?php
session_start();

require('../klaseak/com/leartik/daw24jore/kategoriak/kategoria.php');
require('../klaseak/com/leartik/daw24jore/kategoriak/kategoriaDB.php');
require('../klaseak/com/leartik/daw24jore/produktuak/produktua.php');
require('../klaseak/com/leartik/daw24jore/produktuak/produktuaDB.php');
require('../klaseak/com/leartik/daw24jore/mezuak/mezua.php');
require('../klaseak/com/leartik/daw24jore/mezuak/mezuaDB.php');
require('../klaseak/com/leartik/daw24jore/eskariak/eskaria.php');
require('../klaseak/com/leartik/daw24jore/detaileak/detailea.php');
require('../klaseak/com/leartik/daw24jore/eskariak/eskariaDB.php');
require('../klaseak/com/leartik/daw24jore/bezeroak/bezeroa.php');

use com\leartik\daw24jore\kategoriak\KategoriaDB;
use com\leartik\daw24jore\produktuak\ProduktuaDB;
use com\leartik\daw24jore\mezuak\MezuaDB;
use com\leartik\daw24jore\eskariak\EskariaDB; 

$admin = false;
if (isset($_POST['sartu'])) {
    if ($_POST['erabiltzailea'] == 'admin' && $_POST['pasahitza'] == 'admin') {
        $admin = true;
        $_SESSION['erabiltzailea'] = "admin";
    }
} else if (isset($_SESSION['erabiltzailea']) && $_SESSION['erabiltzailea'] == "admin") {
    $admin = true;
}

if (!$admin) {
    $mezua = isset($_POST['sartu']) ? "Datuak ez dira zuzenak" : "";
    include 'login.php';
    exit;
}

$idKategoria = (isset($_GET['id']) && is_numeric($_GET['id'])) ? intval($_GET['id']) : null;
$kategoria = KategoriaDB::selectKategoriak();
$produktua = $idKategoria ? ProduktuaDB::selectProduktuakByKategoria($idKategoria) : ProduktuaDB::selectProduktuak();
$mezuaDB = MezuaDB::getAllMezuak();
$eskariakGuztiak = EskariaDB::selectEskariak();


include('panela_erakutsi.php');
?>