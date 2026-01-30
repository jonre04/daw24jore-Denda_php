<?php
require('../klaseak/com/leartik/daw24jore/kategoriak/Kategoria.php');
require('../klaseak/com/leartik/daw24jore/kategoriak/KategoriaDB.php');
require('../klaseak/com/leartik/daw24jore/produktuak/Produktua.php');
require('../klaseak/com/leartik/daw24jore/produktuak/ProduktuaDB.php');

use com\leartik\daw24jore\kategoriak\KategoriaDB;
use com\leartik\daw24jore\produktuak\ProduktuaDB;

$kategoriak = [];
$produktuak = [];
$kategoria = null;
$produktua = null;

if (isset($_GET['produktua_id']) && is_numeric($_GET['produktua_id'])) {
    $produktua = ProduktuaDB::selectProduktua($_GET['produktua_id']);
    include("produktua_erakutsi.php");
    exit;

} elseif (isset($_GET['kategoria_id']) && is_numeric($_GET['kategoria_id'])) {
    $kategoria = KategoriaDB::selectKategoria($_GET['kategoria_id']);
    $produktuak = ProduktuaDB::selectProduktuakByKategoria($_GET['kategoria_id']);
    include("kategoria_erakutsi.php");
    exit;

} else {
    $kategoriak = KategoriaDB::selectKategoriak();
    $produktuak = ProduktuaDB::selectProduktuak();
    include("kategoriak_erakutsi.php");
    exit;
}
?>
