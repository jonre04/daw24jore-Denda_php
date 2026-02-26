<?php
require('../klaseak/com/leartik/daw24jore/produktuak/produktua.php');
require('../klaseak/com/leartik/daw24jore/produktuak/produktuaDB.php');
require('../klaseak/com/leartik/daw24jore/kategoriak/kategoria.php');
require('../klaseak/com/leartik/daw24jore/kategoriak/kategoriaDB.php');

use com\leartik\daw24jore\produktuak\ProduktuaDB;
use com\leartik\daw24jore\kategoriak\KategoriaDB;

$testua = isset($_GET['testua']) ? strtolower(trim($_GET['testua'])) : '';

if ($testua === '') {
    $kategoriak = KategoriaDB::selectKategoriak();
    $mis_imagenes = ["../img/1.png", "../img/26.png", "../img/11.png", "../img/32.png", "../img/17.png", "../img/37.png", "../img/22.png", "../img/41.png"];
    
    echo "<h3>Kategoriak</h3><div class='kategoriak-flex'>";
    foreach ($kategoriak as $index => $kat) {
        $img = $mis_imagenes[$index] ?? "../img/default.png";
        echo "<div class='kategoria-txartela'>
                <img src='$img'>
                <dt><a href='index.php?kategoria_id=".$kat->getId()."'>".htmlspecialchars($kat->getIzena())."</a></dt>
                <dd>".htmlspecialchars($kat->getDeskribapena())."</dd>
              </div>";
    }
    echo "</div>";
    exit;
}

$allProduktuak = ProduktuaDB::selectProduktuak();
$filtratuak = array_filter($allProduktuak, function($p) use ($testua) {
    return str_starts_with(strtolower($p->getIzena()), $testua);
});

echo "<h3>Bilaketaren emaitzak</h3>";

if (empty($filtratuak)) {
    echo "<p>Ez da produkturik aurkitu '$testua' hitzarekin.</p>";
} else {
    echo "<div class='produktuak-flex'>";
    foreach ($filtratuak as $prod) {
        $id = $prod->getId();
        $prezioa = number_format($prod->getPrezioa(), 2);
        
        echo "<div class='produktua'>
                <a href='index.php?produktua_id=$id'>
                    <img src='../img/$id.png' alt='".$prod->getIzena()."'>
                    <h4>".htmlspecialchars($prod->getIzena())."</h4>
                </a>
                <p>$prezioa €</p>
                <a href='index.php?produktua_id=$id' class='btn'>Ikusi</a>
              </div>";
    }
    echo "</div>";
}
?>