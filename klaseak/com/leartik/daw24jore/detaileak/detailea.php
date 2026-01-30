<?php
namespace com\leartik\daw24jore\detaileak;

use com\leartik\daw24jore\produktuak\Produktua;

class Detailea
{
    private Produktua $produktua;
    private $kopurua;

    public function __construct()
    {
    }

    public function setProduktua(Produktua $produktua)
    {
        $this->produktua = $produktua;
    }

    public function getProduktua() 
    {
        return $this->produktua;
    }

    public function setKopurua($kopurua)
    {
        $this->kopurua = $kopurua;
    }

    public function getKopurua()
    {
        return $this->kopurua;
    }

    public function getGuztira()
    {
        return $this->produktua->getPrezioa() * $this->kopurua;
    }
}
?>