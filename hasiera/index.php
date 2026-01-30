<?php
require_once('../klaseak/com/leartik/daw24jore/kategoriak/Kategoria.php');
require_once('../klaseak/com/leartik/daw24jore/kategoriak/KategoriaDB.php');
require_once('../klaseak/com/leartik/daw24jore/produktuak/Produktua.php');
require_once('../klaseak/com/leartik/daw24jore/produktuak/ProduktuaDB.php');

use com\leartik\daw24jore\kategoriak\KategoriaDB;
use com\leartik\daw24jore\produktuak\ProduktuaDB;

$kategoriak = [];
$produktuak = [];
$kategoria = null;
$produktua = null;

if (isset($_GET['produktua_id']) && is_numeric($_GET['produktua_id'])) {
    $produktua = ProduktuaDB::selectProduktua($_GET['produktua_id']);
    include("../katalogoa/produktua_erakutsi.php");   
} elseif (isset($_GET['kategoria_id']) && is_numeric($_GET['kategoria_id'])) {
    $kategoria = KategoriaDB::selectKategoria($_GET['kategoria_id']);
    $produktuak = ProduktuaDB::selectProduktuakByKategoria($_GET['kategoria_id']);
    
    $ofertas_html = ProduktuaDB::generarEskaintzak($produktuak);
    $nobedadeak_html = ProduktuaDB::generarNobedadeak($produktuak);
    
    include("hasiera.php");          
} else {
    $kategoriak = KategoriaDB::selectKategoriak();
    $produktuak = ProduktuaDB::selectProduktuak();
    
    $ofertas_html = ProduktuaDB::generarEskaintzak($produktuak);
    $nobedadeak_html = ProduktuaDB::generarNobedadeak($produktuak);
    
    include("hasiera.php");            
}
?>