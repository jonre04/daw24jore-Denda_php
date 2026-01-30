<?php
require_once('../klaseak/com/leartik/daw24jore/produktuak/produktua.php');
require_once('../klaseak/com/leartik/daw24jore/detaileak/detailea.php');
require_once('../klaseak/com/leartik/daw24jore/saskia/saskia.php');
require_once('../klaseak/com/leartik/daw24jore/bezeroak/bezeroa.php');
require_once('../klaseak/com/leartik/daw24jore/eskariak/eskaria.php');
require_once('../klaseak/com/leartik/daw24jore/eskariak/eskariaDB.php');
session_start();

use com\leartik\daw24jore\bezeroak\Bezeroak;
use com\leartik\daw24jore\eskariak\Eskaria;
use com\leartik\daw24jore\eskariak\EskariaDB;


if (isset($_POST['bidali'])) {
    $izena = trim($_POST['izena']);
    $abizenak = trim($_POST['abizenak']);
    $helbidea = trim($_POST['helbidea']);
    $herria = trim($_POST['herria']);
    $postaKodea = intval($_POST['postaKodea']);
    $probintzia = trim($_POST['probintzia']);
    $emaila = trim($_POST['emaila']);

    if (
        $izena !== "" &&
        $abizenak !== "" &&
        $helbidea !== "" &&
        $herria !== "" &&
        $postaKodea > 0 &&
        $probintzia !== "" &&
        $emaila !== ""
    ) {

        $bezeroa = new \com\leartik\daw24jore\bezeroak\Bezeroa(); 
        $bezeroa->setIzena($izena);
        $bezeroa->setAbizenak($abizenak);
        $bezeroa->setHelbidea($helbidea);
        $bezeroa->setHerria($herria);
        $bezeroa->setPostaKodea($postaKodea);
        $bezeroa->setProbintzia($probintzia);
        $bezeroa->setEmaila($emaila);

       $eskaria = new Eskaria();
        $eskaria->setBezeroa($bezeroa);
        $eskaria->setData(new \DateTime());

        $eskariaId = EskariaDB::insertEskaria($eskaria);

        if ($eskariaId > 0) {
       
            if (isset($_SESSION['saskia']) && count($_SESSION['saskia']->getDetaileak()) > 0) {
                $saskia = $_SESSION['saskia'];
                $detaileak = $saskia->getDetaileak();
                $errorDetalle = false;

                foreach ($detaileak as $detailea) {
                
                    if (!EskariaDB::insertDetailea($detailea, $eskariaId)) {
                        $errorDetalle = true;
                    }
                }

                if (!$errorDetalle) {
                    unset($_SESSION['saskia']); 
                    include('eskaria_gorde_da.php');
                    exit;
                } else {
                    $mezua = "Eskaria gorde da, baina arazoak egon dira produktu batzuekin.";
                }
            } else {
                $mezua = "Saskia hutsik dago.";
            }
        } else {
            include('eskaria_ez_da_gorde.php');
            exit;
        }
    } else {
        $mezua = "Eremu guztiak bete behar dira.";
    }
   
    include('eskari_berria.php');

} else {
    $izena = $abizenak = $helbidea = $herria = $postaKodea = $probintzia = $emaila = $mezua = "";
    include('eskari_berria.php');
}
?>