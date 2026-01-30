<?php

namespace com\leartik\daw24jore\eskariak;

use DateTime;
use com\leartik\daw24jore\bezeroak\Bezeroa;

class Eskaria {

    private $id;
    private DateTime $data;
    private Bezeroa $bezeroa; 
    private $detaileak = []; 
    private $bidalita = false;
    public function __construct() {
        $this->detalleak = [];
        
        $this->data = new DateTime();
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setData(DateTime $data): void {
        $this->data = $data;
    }

    public function getData(): DateTime {
        return $this->data;
    }

    public function setBezeroa(Bezeroa $bezeroa): void {
        $this->bezeroa = $bezeroa;
    }

    public function getBezeroa(): Bezeroa {
        return $this->bezeroa;
    }

    public function setDetaileak($detaileak) {
        $this->detaileak = $detaileak;
    }

    public function getDetaileak() {
        return $this->detaileak;
    }

    public function setBidalita($bidalita) {
        $this->bidalita = $bidalita;
    }
    
    public function getBidalita() {
        return $this->bidalita;
    }
    }
?>