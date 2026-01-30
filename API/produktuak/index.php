<?php
header("Content-Type: application/json; charset=UTF-8");

try {

    $db = new PDO("sqlite:C:\\xampp\\htdocs\\Denda\\Denda.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    function get_request_data() {
        $raw = file_get_contents("php://input");
        if ($raw) {
            $input = json_decode($raw, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($input)) {
                return $input;
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            return $_POST;
        }
        return $_GET;
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        if (isset($_GET['id'])) {
            $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

            if ($id === false) {
                http_response_code(400);
                echo json_encode(["error" => "id-a zenbaki oso bat izan behar da"]);
                exit;
            }

            if ($id < 0) {
                http_response_code(400);
                echo json_encode(["error" => "id-a 0 edo handiagoa izan behar da"]);
                exit;
            }

            $balioa = isset($_GET['balioa']) ? $_GET['balioa'] : 'produktuak';

            if ($balioa == 'produktuak') {
                $stmt = $db->prepare("SELECT * FROM produktuak WHERE id = :id");
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                if ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $produktua = [
                        'izena' => $erregistroa['izena'],
                        'deskribapena' => $erregistroa['deskribapena'], 
                        'mota' => $erregistroa['mota'],
                        'prezioa' => $erregistroa['prezioa'], 
                        'deskontua' => $erregistroa['deskontua'],
                        'nobedadeak' => $erregistroa['nobedadeak'], 
                        'kategoriaId' => $erregistroa['kategoriaId'],
                    ];
                    echo json_encode($produktua, JSON_UNESCAPED_UNICODE);
                } else {
                    http_response_code(404);
                    echo json_encode(["error" => "Produkturik ez da aurkitu"]);
                }

            } elseif ($balioa == 'kategoriak') {
                $stmt = $db->prepare("SELECT * FROM kategoriak WHERE id = :id");
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                if ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $kategoria = [
                        'izena' => $erregistroa['izena'],
                        'deskribapena' => $erregistroa['deskribapena']
                    ];
                    echo json_encode($kategoria, JSON_UNESCAPED_UNICODE);
                } else {
                    http_response_code(404);
                    echo json_encode(["error" => "Kategoririk ez da aurkitu"]);
                }

            } else {
                http_response_code(400);
                echo json_encode(["error" => "Balio ezezaguna"]);
            }

        } else {
            http_response_code(404);
            echo json_encode(["error" => "id falta da"]);
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $balioa = isset($_GET['balioa']) ? $_GET['balioa'] : 'produktuak';
        $input = get_request_data();

        if (empty($input)) {
            http_response_code(400);
            echo json_encode(["error" => "Datuak falta dira edo JSON formatu baliogabea da"]);
            exit;
        }

        if ($balioa === "produktuak") {
            $required = ["izena", "deskribapena", "mota", "prezioa", "deskontua", "nobedadeak", "kategoriaId"];
            foreach ($required as $kanpoa) {
                if (!isset($input[$kanpoa])) {
                    http_response_code(400);
                    echo json_encode(["error" => "$kanpoa falta da"]);
                    exit;
                }
            }

            if (!is_numeric($input["prezioa"]) || $input["prezioa"] < 0 ||
                !is_numeric($input["deskontua"]) || $input["deskontua"] < 0 ||
                !is_numeric($input["kategoriaId"]) || $input["kategoriaId"] < 0) {
                http_response_code(400);
                echo json_encode(["error" => "Zenbaki eremu baliogabea"]);
                exit;
            }

            $stmt = $db->prepare("
                INSERT INTO produktuak (izena, deskribapena, mota, prezioa, deskontua, nobedadeak, kategoriaId)
                VALUES (:izena, :deskribapena, :mota, :prezioa, :deskontua, :nobedadeak, :kategoriaId)
            ");
            $stmt->bindValue(":izena", $input["izena"]);
            $stmt->bindValue(":deskribapena", $input["deskribapena"]);
            $stmt->bindValue(":mota", $input["mota"]);
            $stmt->bindValue(":prezioa", $input["prezioa"]);
            $stmt->bindValue(":deskontua", $input["deskontua"]);
            $stmt->bindValue(":nobedadeak", $input["nobedadeak"]);
            $stmt->bindValue(":kategoriaId", $input["kategoriaId"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                http_response_code(201);
                echo json_encode([
                    "mezu" => "Produktua ondo gehitu da",
                    "id" => $db->lastInsertId()
                ], JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Ezin izan da produktua gehitu"]);
            }

        } elseif ($balioa === "kategoriak") {
            $required = ["izena", "deskribapena"];
            foreach ($required as $kanpoa) {
                if (!isset($input[$kanpoa])) {
                    http_response_code(400);
                    echo json_encode(["error" => "$kanpoa falta da"]);
                    exit;
                }
            }

            $stmt = $db->prepare("
                INSERT INTO kategoriak (izena, deskribapena)
                VALUES (:izena, :deskribapena)
            ");
            $stmt->bindValue(":izena", $input["izena"]);
            $stmt->bindValue(":deskribapena", $input["deskribapena"]);

            if ($stmt->execute()) {
                http_response_code(201);
                echo json_encode([
                    "mezu" => "Kategoria ondo gehitu da",
                    "id" => $db->lastInsertId()
                ], JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Ezin izan da kategoria gehitu"]);
            }

        } else {
            http_response_code(400);
            echo json_encode(["error" => "Balio ezezaguna"]);
        }

    } elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
        
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        if (!$id || $id < 0) {
            http_response_code(400);
            echo json_encode(["error" => "ID balioduna behar da URLan"]);
            exit;
        }

        $input = get_request_data();
        $balioa = isset($_GET['balioa']) ? $_GET['balioa'] : 'produktuak';

        if (empty($input)) {
            http_response_code(400);
            echo json_encode(["error" => "Datuak falta dira"]);
            exit;
        }

        if ($balioa === "produktuak") {
            $sql = "UPDATE produktuak SET 
                    izena = :izena, 
                    deskribapena = :deskribapena, 
                    mota = :mota, 
                    prezioa = :prezioa, 
                    deskontua = :deskontua, 
                    nobedadeak = :nobedadeak, 
                    kategoriaId = :kategoriaId 
                    WHERE id = :id";
            
            $stmt = $db->prepare($sql);
            
      
            $stmt->bindValue(":izena", $input["izena"] ?? null);
            $stmt->bindValue(":deskribapena", $input["deskribapena"] ?? null);
            $stmt->bindValue(":mota", $input["mota"] ?? null);
            $stmt->bindValue(":prezioa", $input["prezioa"] ?? 0);
            $stmt->bindValue(":deskontua", $input["deskontua"] ?? 0);
            $stmt->bindValue(":nobedadeak", $input["nobedadeak"] ?? null);
            $stmt->bindValue(":kategoriaId", $input["kategoriaId"] ?? 0);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    echo json_encode(["mezu" => "Produktua eguneratu da"]);
                } else {
                    http_response_code(404);
                    echo json_encode(["error" => "Ez da produkturik aurkitu ID horrekin edo datuak ez dira aldatu"]);
                }
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Errorea eguneratzean"]);
            }

        } elseif ($balioa === "kategoriak") {
            $sql = "UPDATE kategoriak SET 
                    izena = :izena, 
                    deskribapena = :deskribapena 
                    WHERE id = :id";
            
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":izena", $input["izena"] ?? null);
            $stmt->bindValue(":deskribapena", $input["deskribapena"] ?? null);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    echo json_encode(["mezu" => "Kategoria eguneratu da"]);
                } else {
                    http_response_code(404);
                    echo json_encode(["error" => "Ez da kategoriarik aurkitu ID horrekin"]);
                }
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Errorea eguneratzean"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Balio ezezaguna"]);
        }

    } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {

        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        if (!$id || $id < 0) {
            http_response_code(400);
            echo json_encode(["error" => "ID balioduna behar da URLan"]);
            exit;
        }

        $balioa = isset($_GET['balioa']) ? $_GET['balioa'] : 'produktuak';

        if ($balioa === "produktuak") {
            $stmt = $db->prepare("DELETE FROM produktuak WHERE id = :id");
        } elseif ($balioa === "kategoriak") {
            $stmt = $db->prepare("DELETE FROM kategoriak WHERE id = :id");
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Balio ezezaguna"]);
            exit;
        }

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo json_encode(["mezu" => "Erregistroa ezabatu da"]);
            } else {
                http_response_code(404);
                echo json_encode(["error" => "Ez da erregistrorik aurkitu ID horrekin"]);
            }
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Errorea ezabatzean"]);
        }

    } else {
        http_response_code(405);
        echo json_encode(["error" => "Metodoa ez da onartzen"]);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Zerbitzarian errorea gertatu da: " . $e->getMessage()]);
}
?>