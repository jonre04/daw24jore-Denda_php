<?php

namespace com\leartik\daw24jore\eskariak;

use PDO;
use DateTime;
use Exception;
use com\leartik\daw24jore\bezeroak\Bezeroa;
use com\leartik\daw24jore\produktuak\ProduktuaDB;
use com\leartik\daw24jore\detaileak\Detailea;

class EskariaDB
{
    private static function getPDO(): PDO
    {
        return new PDO(
            "mysql:host=localhost;dbname=denda;charset=utf8mb4",
            "admin",
            "Leaartibai25",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }

    public static function selectEskariak()
    {
        try {
            $pdo = self::getPDO();
            $stmt = $pdo->query("SELECT * FROM eskariak");
            $eskariak = [];

            while ($row = $stmt->fetch()) {
                $eskaria = new Eskaria();
                $bezeroa = new Bezeroa();

                $eskaria->setId($row['id']);
                $eskaria->setBidalita($row['bidalita'] == 1);

                if (!empty($row['data'])) {
                    $eskaria->setData(new DateTime($row['data']));
                }

                $bezeroa->setIzena($row['izena']);
                $bezeroa->setAbizenak($row['abizenak']);
                $bezeroa->setHelbidea($row['helbidea']);
                $bezeroa->setHerria($row['herria']);
                $bezeroa->setPostaKodea($row['postaKodea']);
                $bezeroa->setProbintzia($row['probintzia']);
                $bezeroa->setEmaila($row['emaila']);

                $eskaria->setBezeroa($bezeroa);
                $eskaria->setDetaileak(self::selectDetaileakByEskaria($eskaria->getId()));

                $eskariak[] = $eskaria;
            }

            return $eskariak;

        } catch (Exception $e) {
            return null;
        }
    }

    public static function selectEskaria($id)
    {
        try {
            $pdo = self::getPDO();
            $stmt = $pdo->prepare("SELECT * FROM eskariak WHERE id = :id");
            $stmt->execute(['id' => $id]);

            if ($row = $stmt->fetch()) {
                $eskaria = new Eskaria();
                $bezeroa = new Bezeroa();

                $eskaria->setId($row['id']);
                $eskaria->setBidalita($row['bidalita'] == 1);

                $bezeroa->setIzena($row['izena']);
                $bezeroa->setAbizenak($row['abizenak']);
                $bezeroa->setHelbidea($row['helbidea']);
                $bezeroa->setHerria($row['herria']);
                $bezeroa->setPostaKodea($row['postaKodea']);
                $bezeroa->setProbintzia($row['probintzia']);
                $bezeroa->setEmaila($row['emaila']);

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
            $pdo = self::getPDO();
            $stmt = $pdo->prepare("SELECT * FROM detaileak WHERE eskariaId = :id");
            $stmt->execute(['id' => $eskariaId]);

            $detaileak = [];

            while ($row = $stmt->fetch()) {
                $detailea = new Detailea();
                $produktua = ProduktuaDB::selectProduktua($row['produktuaId']);

                $detailea->setProduktua($produktua);
                $detailea->setKopurua($row['kopurua']);

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
            $pdo = self::getPDO();
            $sql = "INSERT INTO eskariak 
                    (data, izena, abizenak, helbidea, herria, postaKodea, probintzia, emaila)
                    VALUES (:data, :izena, :abizenak, :helbidea, :herria, :postaKodea, :probintzia, :emaila)";

            $stmt = $pdo->prepare($sql);
            $b = $eskaria->getBezeroa();

            $stmt->execute([
                'data' => $eskaria->getData()->format('Y-m-d H:i:s'),
                'izena' => $b->getIzena(),
                'abizenak' => $b->getAbizenak(),
                'helbidea' => $b->getHelbidea(),
                'herria' => $b->getHerria(),
                'postaKodea' => $b->getPostaKodea(),
                'probintzia' => $b->getProbintzia(),
                'emaila' => $b->getEmaila()
            ]);

            return $pdo->lastInsertId();

        } catch (Exception $e) {
            return 0;
        }
    }

    public static function insertDetailea($detailea, $eskariaId)
    {
        try {
            $pdo = self::getPDO();
            $sql = "INSERT INTO detaileak 
                    (eskariaId, produktuaId, ProduktuaPrezioa, kopurua)
                    VALUES (:eskariaId, :produktuaId, :prezioa, :kopurua)";

            $stmt = $pdo->prepare($sql);
            $p = $detailea->getProduktua();

            return $stmt->execute([
                'eskariaId' => $eskariaId,
                'produktuaId' => $p->getId(),
                'prezioa' => $p->getPrezioa(),
                'kopurua' => $detailea->getKopurua()
            ]);

        } catch (Exception $e) {
            return false;
        }
    }

    public static function updateEskaria($eskaria)
    {
        try {
            $pdo = self::getPDO();
            $b = $eskaria->getBezeroa();

            $sql = "UPDATE eskariak SET
                    izena = :izena,
                    abizenak = :abizenak,
                    helbidea = :helbidea,
                    herria = :herria,
                    postaKodea = :postaKodea,
                    probintzia = :probintzia,
                    emaila = :emaila,
                    bidalita = :bidalita
                    WHERE id = :id";

            $stmt = $pdo->prepare($sql);

            return $stmt->execute([
                'izena' => $b->getIzena(),
                'abizenak' => $b->getAbizenak(),
                'helbidea' => $b->getHelbidea(),
                'herria' => $b->getHerria(),
                'postaKodea' => $b->getPostaKodea(),
                'probintzia' => $b->getProbintzia(),
                'emaila' => $b->getEmaila(),
                'bidalita' => $eskaria->getBidalita() ? 1 : 0,
                'id' => $eskaria->getId()
            ]);

        } catch (Exception $e) {
            return false;
        }
    }

    public static function deleteEskariaOsotasunean($id)
    {
        try {
            $pdo = self::getPDO();
            $pdo->beginTransaction();

            $pdo->prepare("DELETE FROM detaileak WHERE eskariaId = :id")
                ->execute(['id' => $id]);

            $pdo->prepare("DELETE FROM eskariak WHERE id = :id")
                ->execute(['id' => $id]);

            $pdo->commit();
            return true;

        } catch (Exception $e) {
            $pdo->rollBack();
            return false;
        }
    }
}
