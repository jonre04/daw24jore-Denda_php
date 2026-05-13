<?php 

namespace com\leartik\daw24jore\mezuak;

use PDO;
use PDOException;

class MezuaDB
{
    public static function getPDO() {
        return new PDO(
            "mysql:host=denda-database.c05kmow6kfu0.us-east-1.rds.amazonaws.com;dbname=denda-database;charset=utf8mb4",
            "admin",
            "leaartibai",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }
    
    public static function selectMezuak()
    {
        try {
            $pdo = self::getPDO();
            $erregistroak = $db->query('SELECT * FROM mezuak');
            $mezuak = array();

            while ($erregistroa = $erregistroak->fetch()) {
                $mezua = new Mezua();
                $mezua->setId($erregistroa['id']);
                $mezua->setIzena($erregistroa['izena']);
                $mezua->setEmail($erregistroa['email']);
                $mezua->setMezuaTestua($erregistroa['mezuaTestua']);
                $mezua->setDataOrdua($erregistroa['dataOrdua'] ?? $erregistroa['dataOrdua']);
                $mezuak[] = $mezua;
            }

            return $mezuak;

        } catch (PDOException $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    public static function getAllMezuak()
    {
        
        try {
            $pdo = self::getPDO();
            $erregistroak = $db->query('SELECT * FROM mezuak');
            $mezuak = array();

            while ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $mezua = new Mezua();
                $id = $erregistroa['id'] ?? 0;
                $mezua->setId($erregistroa['id']);
                $mezua->setIzena($erregistroa['izena']);
                $mezua->setEmail($erregistroa['email']);
                $mezua->setMezuaTestua($erregistroa['mezuaTestua']);
                $mezua->setDataOrdua($erregistroa['dataOrdua'] ?? $erregistroa['dataOrdua']);
                $mezua->setErantzunDa($erregistroa['erantzunDa'] == 1);
                $mezuak[] = $mezua;
            }

            return $mezuak;

        } catch (PDOException $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    public static function selectMezua($id)
    {
        try {
            $pdo = self::getPDO();
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

        } catch (PDOException $e) {
            return null;
        }
    }

    public static function insertMezua($mezua)
    {
        try {
            $pdo = self::getPDO();
            $stmt = $db->prepare(
                'INSERT INTO mezuak (izena, email, mezuaTestua, dataOrdua)
                 VALUES (:izena, :email, :mezuaTestua, :dataOrdua)'
            );
            $stmt->bindValue(':izena', $mezua->getIzena());
            $stmt->bindValue(':email', $mezua->getEmail());
            $stmt->bindValue(':mezuaTestua', $mezua->getMezuaTestua());
            $stmt->bindValue(':dataOrdua', $mezua->getDataOrdua());

            return $stmt->execute() ? $db->lastInsertId() : 0;

        } catch (PDOException $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    public static function updateMezua($mezua)
    {
        try {
            $pdo = self::getPDO();
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

        } catch (PDOException $e) {
            return false;
        }
    }

    public static function deleteMezua($id)
    {
        try {
            $pdo = self::getPDO();
            $stmt = $db->prepare('DELETE FROM mezuak WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $result = $stmt->execute();
            return $result;

        } catch (PDOException $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return false;
        }
    }
    public static function eguneratuErantzunDa($id, $erantzunDa)
{
    $pdo = self::getPDO();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE mezuak SET erantzunDa = :erantzunDa WHERE id = :id";
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':erantzunDa', $erantzunDa, PDO::PARAM_INT);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}
}
?>