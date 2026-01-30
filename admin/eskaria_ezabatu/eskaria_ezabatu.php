<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Eskaria Ezabatu</title>
    <style>
        table { border-collapse: collapse; margin-bottom: 20px; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        
        
        .warning { 
            color: black; 
            font-weight: bold; 
            border-bottom: 2px solid black; 
            padding-bottom: 5px;
        }

      
        .btn-ezabatu {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        
        .btn-ezabatu:hover {
            background-color: black;
        }
    </style>
</head>
<body>
    <h1>Administrazio Gunea</h1>
    <p><a href="../index.php">Hasiera</a></p>
    
    <h2 class="warning">Eskaria Ezabatu (#<?php echo $eskaria->getId(); ?>)</h2>
    
    <form action="" method="POST" onsubmit="return confirm('Ziur zaude eskari hau eta bere produktu guztiak betirako ezabatu nahi dituzula?');">
        <input type="hidden" name="id" value="<?php echo $eskaria->getId(); ?>">
        
        <h3>1. Bezeroaren Datu Guztiak</h3>
        <table>
            <tr>
                <th>Eremua</th>
                <th>Balioa</th>
            </tr>
            <tr>
                <td><strong>Izena eta Abizenak:</strong></td>
                <td><?php echo htmlspecialchars($eskaria->getBezeroa()->getIzena() . " " . $eskaria->getBezeroa()->getAbizenak()); ?></td>
            </tr>
            <tr>
                <td><strong>Emaila:</strong></td>
                <td><?php echo htmlspecialchars($eskaria->getBezeroa()->getEmaila()); ?></td>
            </tr>
            <tr>
                <td><strong>Helbidea:</strong></td>
                <td><?php echo htmlspecialchars($eskaria->getBezeroa()->getHelbidea()); ?></td>
            </tr>
            <tr>
                <td><strong>Herria:</strong></td>
                <td><?php echo htmlspecialchars($eskaria->getBezeroa()->getHerria()); ?></td>
            </tr>
            <tr>
                <td><strong>Posta Kodea:</strong></td>
                <td><?php echo htmlspecialchars($eskaria->getBezeroa()->getPostaKodea()); ?></td>
            </tr>
            <tr>
                <td><strong>Probintzia:</strong></td>
                <td><?php echo htmlspecialchars($eskaria->getBezeroa()->getProbintzia()); ?></td>
            </tr>
        </table>

        <h3>2. Eskariaren Detaileak (Produktuak)</h3>
        <table>
            <thead>
                <tr>
                    <th>Produktua</th>
                    <th>Prezioa (Unit.)</th>
                    <th>Kopurua</th>
                    <th>Guztira</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totala = 0;
                foreach ($eskaria->getDetaileak() as $det): 
                    $prod = $det->getProduktua();
                    $subtotal = $prod->getPrezioa() * $det->getKopurua();
                    $totala += $subtotal;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($prod->getIzena()); ?></td>
                    <td><?php echo number_format($prod->getPrezioa(), 2); ?>€</td>
                    <td><?php echo $det->getKopurua(); ?></td>
                    <td><?php echo number_format($subtotal, 2); ?>€</td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" align="right"><strong>GUZTIRA:</strong></td>
                    <td><strong><?php echo number_format($totala, 2); ?>€</strong></td>
                </tr>
            </tbody>
        </table>

        <p>
            <input type="submit" name="ezabatu" value="Ezabatu" class="btn-ezabatu">
        </p>
    </form>
</body>
</html>