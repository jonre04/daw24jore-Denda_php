<?php

namespace com\leartik\daw24jore\eskariak;

use PDO;
use DataTime;
use Exception;
use com\leartik\daw24jore\bezeroak\Bezeroa;
use com\leartik\daw24jore\produktuak\ProduktuaDB;
use com\leartik\daw24jore\detaileak\Detailea;

class EskariaDB
{

    public static function selectEskariak()
    {
        try {
            $db = new PDO("sqlite:\\var\\www\\html\\daw24jore-Denda_php\\Denda.db");
            $erregistroak = $pdo->query('SELECT * FROM eskariak');
            $eskariak = array();

            while ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $eskaria = new Eskaria();
                $bezeroa = new Bezeroa();

                $eskaria->setId($erregistroa['id']);
                $eskaria->setBidalita($erregistroa['bidalita'] == 1);
                  
                if (isset($erregistroa['data'])) {
                    $eskaria->setData(new \DateTime($erregistroa['data']));
                }        
                $bezeroa->setIzena($erregistroa['izena']);
                $bezeroa->setAbizenak($erregistroa['abizenak']);
                $bezeroa->setHelbidea($erregistroa['helbidea']);
                $bezeroa->setHerria($erregistroa['herria']);
                $bezeroa->setPostaKodea($erregistroa['postaKodea']);
                $bezeroa->setProbintzia($erregistroa['probintzia']);
                $bezeroa->setEmaila($erregistroa['emaila']);

                $eskaria->setBezeroa($bezeroa);
                $detaileak = self::selectDetaileakByEskaria($eskaria->getId());
                $eskaria->setDetaileak($detaileak);
                $eskariak[] = $eskaria;
            }
            return $eskariak;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function selectDetaileak()
    {
        try {
            $db = new PDO("sqlite:\\var\\www\\html\\daw24jore-Denda_php\\Denda.db");
            $erregistroak = $pdo->query('SELECT * FROM detaileak');
            $detaileak = array();
            while ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $detailea = new Detailea();
                $produktua = ProduktuaDB::selectProduktua($erregistroa['produktuaId']);
                $detailea->setProduktua($produktua);
                $detailea->setKopurua($erregistroa['kopurua']);
                $detaileak[] = $detailea;
            }
            return $detaileak;
        } catch (Exception $e) {
            return null;
        }
    }


    public static function selectEskaria($id)
    {
        try {
            $db = new PDO("sqlite:\\var\\www\\html\\daw24jore-Denda_php\\Denda.db");
            $erregistroak = $pdo->prepare('SELECT * FROM eskariak WHERE id = :id');
            $erregistroak->execute([':id' => $id]);
            
            if ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $eskaria = new Eskaria();
                $bezeroa = new Bezeroa();
                $eskaria->setId($erregistroa['id']);
                $eskaria->setBidalita($erregistroa['bidalita'] == 1);
                $bezeroa->setIzena($erregistroa['izena']);
                $bezeroa->setAbizenak($erregistroa['abizenak']);
                $bezeroa->setHelbidea($erregistroa['helbidea']);
                $bezeroa->setHerria($erregistroa['herria']);
                $bezeroa->setPostaKodea($erregistroa['postaKodea']);
                $bezeroa->setProbintzia($erregistroa['probintzia']);
                $bezeroa->setEmaila($erregistroa['emaila']);
                $eskaria->setBezeroa($bezeroa);
                return $eskaria;
            }
            return null;
        } catch (Exception $e) {
            return null;
        }
    }

 
    public static function selectDetaileakByEskaria($eskariaId)
    {
        try {
            $db = new PDO("sqlite:\\var\\www\\html\\daw24jore-Denda_php\\Denda.db");
            $erregistroak = $pdo->prepare('SELECT * FROM detaileak WHERE eskariaId = :eskariaId');
            $erregistroak->execute([':eskariaId' => $eskariaId]);
            $detaileak = array();
            while ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $detailea = new Detailea();
                $produktua = ProduktuaDB::selectProduktua($erregistroa['produktuaId']);
                $detailea->setProduktua($produktua);
                $detailea->setKopurua($erregistroa['kopurua']);
                $detaileak[] = $detailea;
            }
            return $detaileak;
        } catch (Exception $e) {
            return [];
        }
    }

    public static function insertEskaria($eskaria)
    {
        try {
            $db = new PDO("sqlite:\\var\\www\\html\\daw24jore-Denda_php\\Denda.db");
            $sql = "INSERT INTO eskariak (data, izena, abizenak, helbidea, herria, postaKodea, probintzia, emaila) 
                    VALUES (:data, :izena, :abizenak, :helbidea, :herria, :postaKodea, :probintzia, :emaila)";
            
            $erregistroak = $pdo->prepare($sql);
            $bezeroa = $eskaria->getBezeroa();

            $erregistroak->execute([
                ':data' => $eskaria->getData()->format('Y-m-d H:i:s'),
                ':izena' => $bezeroa->getIzena(),
                ':abizenak' => $bezeroa->getAbizenak(),
                ':helbidea' => $bezeroa->getHelbidea(),
                ':herria' => $bezeroa->getHerria(),
                ':postaKodea' => $bezeroa->getPostaKodea(),
                ':probintzia' => $bezeroa->getProbintzia(),
                ':emaila' => $bezeroa->getEmaila()
            ]);

            return $pdo->lastInsertId();
        } catch (Exception $e) {
            return 0;
        }
    }


    public static function insertDetailea($detailea, $eskariaId)
    {
        try {
            $db = new PDO("sqlite:\\var\\www\\html\\daw24jore-Denda_php\\Denda.db");
            $sql = "INSERT INTO detaileak (eskariaId, produktuaId, ProduktuaPrezioa, kopurua) 
                    VALUES (:eskariaId, :produktuaId, :prezioa, :kopurua)";
            
            $erregistroak = $pdo->prepare($sql);
            $produktua = $detailea->getProduktua();

            return $erregistroak->execute([
                ':eskariaId' => $eskariaId,
                ':produktuaId' => $produktua->getId(),
                ':prezioa'   => $produktua->getPrezioa(),
                ':kopurua'   => $detailea->getKopurua()
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public static function updateEskaria($eskaria)
    {
        try {
           $db = new PDO("sqlite:\\var\\www\\html\\daw24jore-Denda_php\\Denda.db");
            $bezeroa = $eskaria->getBezeroa();
            $sql = "UPDATE eskariak SET izena = :izena, abizenak = :abizenak, helbidea = :helbidea, 
                    herria = :herria, postaKodea = :postaKodea, probintzia = :probintzia, emaila = :emaila,
                    bidalita = :bidalita 
                    WHERE id = :id";
            $erregistroak = $pdo->prepare($sql);
            return $erregistroak->execute([
                ':izena' => $bezeroa->getIzena(),
                ':abizenak' => $bezeroa->getAbizenak(),
                ':helbidea' => $bezeroa->getHelbidea(),
                ':herria' => $bezeroa->getHerria(),
                ':postaKodea' => $bezeroa->getPostaKodea(),
                ':probintzia' => $bezeroa->getProbintzia(),
                ':emaila' => $bezeroa->getEmaila(),
                ':bidalita' => $eskaria->getBidalita() ? 1 : 0,
                ':id' => $eskaria->getId()
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    public static function updateDetailea($detailea, $id)
    {
        try {
            $db = new PDO("sqlite:\\var\\www\\html\\daw24jore-Denda_php\\Denda.db");
            $sql = "UPDATE detaileak SET produktuaId = :prodId, kopurua = :kopurua WHERE id = :id";
            $erregistroak = $pdo->prepare($sql);
            return $erregistroak->execute([
                ':prodId' => $detailea->getProduktua()->getId(),
                ':kopurua' => $detailea->getKopurua(),
                ':id' => $id
            ]);
        } catch (Exception $e) {
            return false;
        }
    }


    public static function deleteEskaria($id)
    {
        try {
            $pdo = new PDO("sqlite:C:\\xampp\\htdocs\\Denda\\Denda.db");
            $erregistroak = $pdo->prepare("DELETE FROM eskariak WHERE id = :id");
            return $erregistroak->execute([':id' => $id]);
        } catch (Exception $e) {
            return false;
        }
    }

    public static function deleteDetaileakByEskaria($eskariaId)
    {
        try {
            $pdo = new PDO("sqlite:C:\\xampp\\htdocs\\Denda\\Denda.db");
            $erregistroak = $pdo->prepare("DELETE FROM detaileak WHERE eskariaId = :eskariaId");
            return $erregistroak->execute([':eskariaId' => $eskariaId]);
        } catch (Exception $e) {
            return false;
        }
    }

    public static function deleteEskariaOsotasunean($id)
    {
        $pdo = null; 
        try {
            $pdo = new PDO("sqlite:C:\\xampp\\htdocs\\Denda\\Denda.db");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $pdo->beginTransaction();

           
            $st1 = $pdo->prepare("DELETE FROM detaileak WHERE eskariaId = :id");
            $st1->execute([':id' => $id]);

            
            $st2 = $pdo->prepare("DELETE FROM eskariak WHERE id = :id");
            $st2->execute([':id' => $id]);

            $pdo->commit();
            return true;
        } catch (Exception $e) {
            if ($pdo) {
                $pdo->rollBack();
            }
            return false;
        }
    }

    public static function isProduktuaDetailetan($produktuaId)
    {
        try {
            $pdo = new PDO("sqlite:C:\\xampp\\htdocs\\Denda\\Denda.db");
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM detaileak WHERE produktuaId = :id');
            $stmt->execute([':id' => $produktuaId]);
            return $stmt->fetchColumn() > 0;
        } catch (Exception $e) {
            return true;
        }
    }
}