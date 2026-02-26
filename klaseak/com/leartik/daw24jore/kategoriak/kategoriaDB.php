<?php

namespace com\leartik\daw24jore\kategoriak;

use PDO;
use PDOException;
use Exception;

class KategoriaDB
{
    public static function getPDO() {
        return new PDO(
            "mysql:host=denda.cpscocg6w3uh.eu-central-1.rds.amazonaws.com;dbname=denda;charset=utf8mb4",
            "admin",
            "Leaartibai25",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }

    public static function selectKategoriak()
    {
        try { 
            $pdo = self::getPDO();
            $erregistroak = $db->query('SELECT * FROM kategoriak');
            $kategoriak = array();


            while ($erregistroa = $erregistroak->fetch()) {
                $kategoria = new Kategoria();
                $kategoria->setId($erregistroa['id']);
                $kategoria->setIzena($erregistroa['izena']);
                $kategoria->setDeskribapena($erregistroa['deskribapena']);
                $kategoriak[] = $kategoria;
            }

            return $kategoriak;
        } catch (Exception $e) {
            return [];
        }
    }

    public static function selectKategoria($id)
    {
        try {
            $pdo = self::getPDO();
            $erregistroak = $db->query('SELECT * FROM kategoriak where id=' . $id);
            $kategoriak = null;

            if ($erregistroa = $erregistroak->fetch()) {
                $kategoria = new Kategoria();
                $kategoria->setId($erregistroa['id']);
                $kategoria->setIzena($erregistroa['izena']);
                $kategoria->setDeskribapena($erregistroa['deskribapena']);
            }

            return $kategoria;

        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    public static function insertKategoria($kategoria)
    {
        try {
            $pdo = self::getPDO();
            $sql = "INSERT INTO kategoriak (izena, deskribapena) VALUES ";
            $sql .= "('" . $kategoria->getIzena() . "'";
            $sql .= ",'" . $kategoria->getDeskribapena() . "')";
            return $db->exec($sql);

        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    public static function updatekategoria($kategoria)
    {
        try {
            $pdo = self::getPDO();
            $sql = "UPDATE kategoriak SET izena = :izena, deskribapena = :deskribapena WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':izena', $kategoria->getIzena());
            $stmt->bindValue(':deskribapena', $kategoria->getDeskribapena());
            $stmt->bindValue(':id', $kategoria->getId());
            return $stmt->execute();

        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return false;
        }
    }

    public static function deletekategoria($id)
    {
        try {
            $pdo = self::getPDO();
            $sql = "DELETE FROM kategoriak WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();

        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return false;
        }
    }
}
?>
