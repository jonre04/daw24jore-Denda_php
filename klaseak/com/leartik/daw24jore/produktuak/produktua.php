<?php 

namespace com\leartik\daw24jore\produktuak;

class Produktua {
    private $id;
    private $izena;
    private $deskribapena;
    private $mota;
    private $prezioa;
    private $deskontua;
    private $nobedadeak;
    private $kategoriaId;

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

    public function setDeskribapena($deskribapena) {
        $this->deskribapena = $deskribapena;
    }

    public function getDeskribapena() {
        return $this->deskribapena;
    }
   
    public function setMota($mota) {
        $this->mota = $mota;
    }

    public function getMota() {
        return $this->mota;
    }

    public function setPrezioa($prezioa) {
        $this->prezioa = $prezioa;
    }

    public function getPrezioa() {
        return $this->prezioa;
    }

    public function setDeskontua($deskontua) {
        $this->deskontua = $deskontua;
    }

    public function getDeskontua() {
        return $this->deskontua;
    }

    public function setNobedadeak($nobedadeak) {
        $this->nobedadeak = $nobedadeak;
    }

    public function getNobedadeak() {
        return $this->nobedadeak;
    }
     public function setKategoriaId($kategoriaId) {
        $this->kategoriaId = $kategoriaId;
    }
    public function getKategoriaId() {
        return $this->kategoriaId;
    }
}
?>