<?php 

namespace com\leartik\daw24jore\mezuak;

use PDO;

class MezuaDB
{
    public static function selectMezuak()
    {
        try {
            $db = new PDO("sqlite:/var/www/html/daw24jore-Denda_php/Denda.db");
            $erregistroak = $db->query('SELECT * FROM mezuak');
            $mezuak = array();

            while ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $mezua = new Mezua();
                $mezua->setId($erregistroa['id']);
                $mezua->setIzena($erregistroa['izena']);
                $mezua->setEmail($erregistroa['email']);
                $mezua->setMezuaTestua($erregistroa['mezuaTestua']);
                $mezua->setDataOrdua($erregistroa['dataOrdua'] ?? $erregistroa['dataOrdua']); 
                $mezuak[] = $mezua;
            }

            return $mezuak;

        } catch (\Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return null;
        }
    }
    public static function getAllMezuak()
    {
        try {
            $db = new PDO("sqlite:/var/www/html/daw24jore-Denda_php/Denda.db");
            $erregistroak = $db->query('SELECT * FROM mezuak');
            $mezuak = array();

            while ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $mezua = new Mezua();
                $mezua->setId($erregistroa['id']);
                $mezua->setIzena($erregistroa['izena']);
                $mezua->setEmail($erregistroa['email']);
                $mezua->setMezuaTestua($erregistroa['mezuaTestua']);
                $mezua->setDataOrdua($erregistroa['dataOrdua'] ?? $erregistroa['dataOrdua']); 
                $mezuak[] = $mezua;
            }

            return $mezuak;

        } catch (\Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return null;
        }
    }
    public static function selectMezua($id) {
        try {
            $db = new PDO("sqlite:/var/www/html/daw24jore-Denda_php/Denda.db");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $db->prepare('SELECT * FROM mezuak WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $mezua = new Mezua();
                $mezua->setId($erregistroa['id']);
                $mezua->setIzena($erregistroa['izena']);
                $mezua->setEmail($erregistroa['email']);
                $mezua->setMezuaTestua($erregistroa['mezuaTestua']);
                $mezua->setErantzunDa($erregistroa['erantzunDa'] == 1);
                return $mezua;
            }
            return null;
        } catch (\Exception $e) { 
            return null; 
        }
    }

    public static function insertMezua($mezua)
    {
        try {
            $db = new PDO("sqlite:/var/www/html/daw24jore-Denda_php/Denda.db");
            $stmt = $db->prepare(
                'INSERT INTO mezuak (izena, email, mezuaTestua, dataOrdua) 
                VALUES (:izena, :email, :mezuaTestua, :dataOrdua)' 
            );
            $stmt->bindValue(':izena', $mezua->getIzena());
            $stmt->bindValue(':email', $mezua->getEmail());
            $stmt->bindValue(':mezuaTestua', $mezua->getMezuaTestua());
            $stmt->bindValue(':dataOrdua', $mezua->getDataOrdua()); 
            
            return $stmt->execute() ? $db->lastInsertId() : 0;

        } catch (\Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    public static function updateMezua($mezua) {
        try {
            $db = new PDO("sqlite:/var/www/html/daw24jore-Denda_php/Denda.db");
            $stmt = $db->prepare(
                'UPDATE mezuak SET izena = :izena, email = :email, 
                 mezuaTestua = :mezuaTestua, erantzunDa = :erantzunDa 
                 WHERE id = :id'
            );
            $stmt->bindValue(':id', $mezua->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':izena', $mezua->getIzena());
            $stmt->bindValue(':email', $mezua->getEmail());
            $stmt->bindValue(':mezuaTestua', $mezua->getMezuaTestua());
            $stmt->bindValue(':erantzunDa', $mezua->getErantzunDa() ? 1 : 0, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\Exception $e) { return false; }
    }

    public static function deleteMezua($id)
    {
        try {
            $db = new PDO("sqlite:/var/www/html/daw24jore-Denda_php/Denda.db");
            $stmt = $db->prepare('DELETE FROM mezuak WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            
            return $stmt->execute();

        } catch (\Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return false;
        }
    }
}
?>