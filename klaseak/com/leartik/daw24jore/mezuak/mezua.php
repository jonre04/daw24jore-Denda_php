<?php 

namespace com\leartik\daw24jore\mezuak;

class Mezua {
    private $id;
    private $izena;
    private $email;
    private $mezuaTestua;
    private $erantzunDa;
    private $dataOrdua;

    public function __construct() 
    {
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setIzena($izena) {
        $this->izena = $izena;
    }

    public function getIzena() {
        return $this->izena;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setMezuaTestua($mezuaTestua) {
        $this->mezuaTestua = $mezuaTestua;
    }

    public function getMezuaTestua() {
        return $this->mezuaTestua;
    }
     public function setErantzunDa($erantzunDa) {
        $this->erantzunDa = $erantzunDa;
    }

    public function getErantzunDa() {
        return $this->setErantzunDa;
    }
    public function setDataOrdua($dataOrdua) {
        $this->dataOrdua = $dataOrdua;
    }

    public function getDataOrdua() {
        return $this->dataOrdua;
    }
}
?>