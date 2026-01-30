<?php
session_start();

if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] != "admin") {
    header("Location: ../index.php");
    exit;
}

require('../../klaseak/com/leartik/daw24jore/mezuak/mezua.php');
require('../../klaseak/com/leartik/daw24jore/mezuak/mezuaDB.php');
use com\leartik\daw24jore\mezuak\Mezua;
use com\leartik\daw24jore\mezuak\MezuaDB;

$id = (isset($_GET['id']) && is_numeric($_GET['id'])) ? intval($_GET['id']) : 0;

if ($id === 0) {
    echo "Errorea: IDa ez da jaso. URLan 'id' parametroa falta da. <br>";
    exit;
}

$mezua = MezuaDB::selectMezua($id);

if (!$mezua) {
    echo "Ez da mezua aurkitu datu-basean ID honekin: " . $id . "<br>";
    echo "Ziurtatu MezuaDB.php fitxategian Denda.db-rako bidea zuzena dela.";
    exit;
}

$erroreMezua = "";

if (isset($_POST['gorde'])) {
    $izena = trim($_POST['izena']);
    $email = trim($_POST['email']);
    $mezuaTestua = trim($_POST['mezuaTestua']);
    $erantzunDa = isset($_POST['erantzunDa']);

    if (!empty($izena) && !empty($email) && !empty($mezuaTestua)) {
        $mezua->setIzena($izena);
        $mezua->setEmail($email);
        $mezua->setMezuaTestua($mezuaTestua);
        $mezua->setErantzunDa($erantzunDa);

        if (MezuaDB::updateMezua($mezua)) {
            include('mezua_aldatu_da.php');
            exit;
        } else {
            $erroreMezua = "Ezin izan da eguneratu datu-basean.";
        }
    } else {
        $erroreMezua = "Eremu guztiak bete behar dira.";
    }
}

include('mezua_aldatu.php');
?>