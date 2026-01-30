<?php

namespace com\leartik\daw24jore\kategoriak;
use PDO;
use Exception;

class KategoriaDB
{
    public static function selectKategoriak()
    {
        try {
            $db = new PDO("sqlite:C:\\xampp\\htdocs\\daw24jore-Denda_php\\Denda.db");
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
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return null;
        }
    }
    public static function selectKategoria($id)
    {
       try{
            $db = new PDO("sqlite:C:\\xampp\\htdocs\\daw24jore-Denda_php\\Denda.db");
            $erregistroak = $db->query('SELECT * FROM kategoriak where id=' . $id);
            $kategoriak = null;

            if ($erregistroa = $erregistroak->fetch()) {
                $kategoria = new kategoria();
                $kategoria->setId($erregistroa['id']);
                $kategoria->setIzena($erregistroa['izena']);
                $kategoria->setDeskribapena($erregistroa['deskribapena']);
                $kategoriak = $kategoria;
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
            $db = new PDO("sqlite:C:\\xampp\\htdocs\\daw24jore-Denda_php\\Denda.db");
            $sql = "INSERT INTO kategoriak (izena, deskribapena) VALUES "; 
            $sql = $sql . "('" . $kategoria->getIzena() . "'";
            $sql = $sql . ",'" . $kategoria->getDeskribapena() . "')";
            $emaitza = $db->exec($sql);
            return $emaitza;

        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

   public static function updatekategoria($kategoria) {
        try {
            $db = new PDO("sqlite:C:\\xampp\\htdocs\\daw24jore-Denda_php\\Denda.db");
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
            $db = new PDO("sqlite:C:\\xampp\\htdocs\\daw24jore-Denda_php\\Denda.db");
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