<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once('../klaseak/com/leartik/daw24jore/mezuak/mezua.php');
require_once('../klaseak/com/leartik/daw24jore/mezuak/mezuaDB.php');

use com\leartik\daw24jore\mezuak\Mezua;
use com\leartik\daw24jore\mezuak\MezuaDB;

$izena = "";
$email = "";
$mezuaTestua = "";
$id = "";
$mezuaEgoera = "";


if (isset($_POST['bidali'])) {
    
 
    $izena = isset($_POST['izena']) ? trim($_POST['izena']) : "";
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $mezuaTestua = isset($_POST['mezuaTestua']) ? trim($_POST['mezuaTestua']) : "";


    if (!empty($izena) && !empty($email) && !empty($mezuaTestua)) {
        $mezua = new Mezua();
        $mezua->setIzena($izena);
        $mezua->setEmail($email);
        $mezua->setMezuaTestua($mezuaTestua);
    
     
        $dataOrdua = date('Y-m-d H:i:s');
        $mezua->setDataOrdua($dataOrdua);
    
       
        if (MezuaDB::insertMezua($mezua) > 0) {
            include("mezua_gorde_da.php");
        } else {
            include("mezua_ez_da_gorde.php");
        }
    } else {
        $mezuaEgoera = "<div style='color: orange; margin-bottom: 10px; font-weight: bold;'>
            Errorea: Eremu guztiak bete behar dira.
        </div>";
    } 
}else {
    include('mezu_berria.php');
}
?>