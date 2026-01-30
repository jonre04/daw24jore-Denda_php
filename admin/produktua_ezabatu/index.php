<?php
session_start();


if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== "admin") {
    header("Location: ../../index.php");
    exit;
}


require_once('../../klaseak/com/leartik/daw24jore/produktuak/produktua.php');
require_once('../../klaseak/com/leartik/daw24jore/produktuak/produktuaDB.php');
require_once('../../klaseak/com/leartik/daw24jore/eskariak/eskariaDB.php'); 

use com\leartik\daw24jore\produktuak\ProduktuaDB;
use com\leartik\daw24jore\eskariak\EskariaDB;


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Ez da ID balidogarririk jaso.";
    exit;
}

$id = intval($_GET['id']);
$produktua = ProduktuaDB::selectProduktua($id);

if (!$produktua) {
    echo "Produktua ez da existitzen.";
    exit;
}


if (isset($_POST['ezabatu'])) {
    
   
    if (EskariaDB::isProduktuaDetailetan($id)) {
       
        $erroreMezua = "Ezin da produktua ezabatu eskari batean dagoelako.";
        include('produktua_ez_da_ezabatu.php'); 
    } else {
      
        if (ProduktuaDB::deleteProduktua($id)) {
            include('produktua_ezabatu_da.php');
        } else {
            $erroreMezua = "Errorea gertatu da datu basean ezabatzerakoan.";
            include('produktua_ez_da_ezabatu.php');
        }
    }
} else {
    include('produktua_ezabatu.php');
}
?>