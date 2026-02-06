<?php

namespace com\leartik\daw24jore\produktuak;
use PDO;
use Exception;
use PDOException;

class ProduktuaDB
{
    private static function getPDO() {
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

    public static function selectProduktuak()
    {
        try {
            $db = self::getPDO();
            $erregistroak = $db->query('SELECT * FROM produktuak');
            $produktuak = [];

            while ($erregistroa = $erregistroak->fetch()) {
                $produktua = new Produktua();
                $produktua->setId($erregistroa['id']);
                $produktua->setIzena($erregistroa['izena']);
                $produktua->setDeskribapena($erregistroa['deskribapena']);
                $produktua->setMota($erregistroa['mota']);
                $produktua->setPrezioa($erregistroa['prezioa']);
                $produktua->setDeskontua($erregistroa['deskontua']);
                $produktua->setNobedadeak($erregistroa['nobedadeak']);
                $produktua->setKategoriaId($erregistroa['kategoriaId']);
                $produktuak[] = $produktua;
            }

            return $produktuak;

        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public static function selectProduktua($id){
        try {
            $db = self::getPDO();
            $stmt = $db->prepare('SELECT * FROM produktuak WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $produktua = null;

            if ($erregistroa = $stmt->fetch()) {
                $produktua = new Produktua();
                $produktua->setId($erregistroa['id']);
                $produktua->setIzena($erregistroa['izena']);
                $produktua->setDeskribapena($erregistroa['deskribapena']);
                $produktua->setMota($erregistroa['mota']);
                $produktua->setPrezioa($erregistroa['prezioa']);
                $produktua->setDeskontua($erregistroa['deskontua']);
                $produktua->setNobedadeak($erregistroa['nobedadeak']);
                $produktua->setKategoriaId($erregistroa['kategoriaId']);
            }
            return $produktua;

        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    public static function generarEskaintzak($produktuak)
    {
        if (!is_array($produktuak) || empty($produktuak)) {
            return "<p>Ez daude eskaintzak erakusteko.</p>";
        }

        $eskaintzak = array_filter($produktuak, function ($produktua) {
            return is_object($produktua)
                && method_exists($produktua, 'getDeskontua')
                && (float) $produktua->getDeskontua() > 0
                && method_exists($produktua, 'getNobedadeak')
                && (int) $produktua->getNobedadeak() !== 1;
        });

        if (empty($eskaintzak)) {
            return "<p>Ez daude eskaintzak erakusteko.</p>";
        }

        $html = "<div class='produktuak-grid'>";

        foreach ($eskaintzak as $produktua) {
            $deskontua = (float) $produktua->getDeskontua();
            $prezioa   = (float) $produktua->getPrezioa();
            $prezio_berria = $prezioa * (1 - ($deskontua / 100));

            $img_file = self::getImagePath($produktua);

            $html .= "<div class='produktua'>";
            $html .= "<img src='" . htmlspecialchars($img_file, ENT_QUOTES) . "' alt='" . htmlspecialchars($produktua->getIzena(), ENT_QUOTES) . "'>";
            $html .= "<h3><a href='index.php?produktua_id=" . (int) $produktua->getId() . "'>"
                . htmlspecialchars($produktua->getIzena(), ENT_QUOTES) . "</a></h3>";
            $html .= "<p>Prezioa: <del>" . number_format($prezioa, 2) . "€</del> "
                . "<span class='prezio-berria'>" . number_format($prezio_berria, 2) . "€</span></p>";
            $html .= "</div>";
        }

        $html .= "</div>";

        return $html;
    }

    public static function generarNobedadeak($produktuak) {
        $nobedadeak = array_filter($produktuak, function($produktua) {
            return method_exists($produktua, 'getNobedadeak') 
                && $produktua->getNobedadeak() == 1;
        });

        if (empty($nobedadeak)) {
            return "<p>Ez daude nobedadeak erakusteko.</p>";
        }

        $html = "<div class='produktuak-grid'>";
        foreach ($nobedadeak as $produktua) {
            $prezioa = (float)$produktua->getPrezioa();
            $img_file = self::getImagePath($produktua);

            $html .= "<div class='produktua'>";
            $html .= "<img src='" . htmlspecialchars($img_file, ENT_QUOTES) . "' alt='" . htmlspecialchars($produktua->getIzena(), ENT_QUOTES) . "'>";
            $html .= "<h3><a href='index.php?produktua_id=" . $produktua->getId() . "'>" . htmlspecialchars($produktua->getIzena(), ENT_QUOTES) . "</a></h3>";

            if (method_exists($produktua, 'getDeskontua') && (float)$produktua->getDeskontua() > 0) {
                $deskontua = (float)$produktua->getDeskontua();
                $prezio_berria = $prezioa * (1 - ($deskontua / 100));
                $html .= "<p>Prezioa: <del>" . number_format($prezioa, 2) . "€</del> <span class='prezio-berria'>" . number_format($prezio_berria, 2) . "€</span></p>";
            } else {
                $html .= "<p>Prezioa: " . number_format($prezioa, 2) . "€</p>";
            }

            $html .= "</div>";
        }
        $html .= "</div>";
        
        return $html;
    }

    private static function getImagePath($produktua) {
        $img_fs = __DIR__ . "/../img/" . $produktua->getId() . ".png";
        $img_file = "../img/" . $produktua->getId() . ".png";

        if (!file_exists($img_fs)) {
            $img_file = "../img/default.png";
        }
        
        return $img_file;
    }

    public static function selectProduktuakByKategoria($idKategoria) {
        try {
            $db = self::getPDO();
            $stmt = $db->prepare("SELECT * FROM produktuak WHERE kategoriaId = :id");
            $stmt->bindValue(':id', (int)$idKategoria, PDO::PARAM_INT);
            $stmt->execute();

            $produktuak = [];

            while ($erregistroa = $stmt->fetch()) {
                $produktua = new Produktua();
                $produktua->setId($erregistroa['id']);
                $produktua->setIzena($erregistroa['izena']);
                $produktua->setDeskribapena($erregistroa['deskribapena']);
                $produktua->setMota($erregistroa['mota']);
                $produktua->setPrezioa($erregistroa['prezioa']);
                $produktua->setDeskontua($erregistroa['deskontua']);
                $produktua->setNobedadeak($erregistroa['nobedadeak']);
                $produktua->setKategoriaId($erregistroa['kategoriaId']);
                $produktuak[] = $produktua;
            }

            return $produktuak;

        } catch (Exception $e) {
            echo "<p>Errorea DB-an: " . $e->getMessage() . "</p>";
            return [];
        }
    }

    public static function insertProduktua($produktua)
    {
        try {
            $db = self::getPDO();
            $sql = "INSERT INTO produktuak (izena, deskribapena, mota, prezioa, deskontua, nobedadeak, kategoriaId) VALUES "; 
            $sql .= "('" . $produktua->getIzena() . "'";
            $sql .= ",'" . $produktua->getDeskribapena() . "'";
            $sql .= ",'" . $produktua->getMota() . "'";
            $sql .= ",'" . $produktua->getPrezioa() . "'";
            $sql .= ",'" . $produktua->getDeskontua() . "'";
            $sql .= ",'" . $produktua->getNobedadeak() . "'";
            $sql .= ",'" . $produktua->getKategoriaId() . "')";
            return $db->exec($sql);

        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    public static function updateProduktua($produktua) {
        try {
            $db = self::getPDO();
            $sql = "UPDATE produktuak SET izena = :izena, deskribapena = :deskribapena, mota = :mota, prezioa = :prezioa, deskontua = :deskontua, nobedadeak = :nobedadeak, kategoriaId = :kategoriaId WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':izena', $produktua->getIzena());
            $stmt->bindValue(':deskribapena', $produktua->getDeskribapena());
            $stmt->bindValue(':mota', $produktua->getMota());
            $stmt->bindValue(':prezioa', $produktua->getPrezioa());
            $stmt->bindValue(':deskontua', $produktua->getDeskontua());
            $stmt->bindValue(':nobedadeak', $produktua->getNobedadeak());
            $stmt->bindValue(':kategoriaId', $produktua->getKategoriaId());
            $stmt->bindValue(':id', $produktua->getId());
            return $stmt->execute();

        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return false;
        }
    }

    public static function deleteProduktua($id)
    {
        if (\com\leartik\daw24jore\eskariak\EskariaDB::isProduktuaDetailetan($id)) {
            return false;
        }

        try {
            $db = self::getPDO();
            $sql = "DELETE FROM produktuak WHERE id = :id";
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
