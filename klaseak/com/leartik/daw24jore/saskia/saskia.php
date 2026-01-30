<?php
namespace com\leartik\daw24jore\saskia;

class Saskia
{
    private $detaileak;

    public function __construct()
    {
        $this->detaileak = array();
    }

    public function setDetaileak($detaileak)
    {
        $this->detaileak = $detaileak;
    }

    public function getDetaileak()
    {
        return $this->detaileak;
    }

    public function detaileaGehitu($detailea)
    {
        $this->detaileak[] = $detailea;
    }
    
    public function detaileaEzabatu($index) {
        if (isset($this->detaileak[$index])) {
            array_splice($this->detaileak, $index, 1);
        }
    }
}
?>