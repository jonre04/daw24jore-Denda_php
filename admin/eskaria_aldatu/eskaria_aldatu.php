<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Eskaria Aldatu</title>
        <style>
            table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
            .bidalita-box { background-color: #e8f5e9; padding: 15px; border: 1px solid #4caf50; margin-bottom: 15px; }
        </style>
    </head>
    <body>
        <h1>Administrazio Gunea</h1>
        <p><a href="../index.php">Hasiera</a> &gt; Eskariak Kudeatu</p>
        
        <h2>Eskariaren Datuak (#<?php echo $eskaria->getId(); ?>)</h2>

        <?php if(isset($errorea)): ?>
            <p style="color:red;"><?php echo $errorea; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            
            <h3>1. Bidalketa Datuak</h3>
            <table>
                <tr>
                    <th>Eremua</th>
                    <th>Balioa</th>
                </tr>
                <tr>
                    <td><label for="izena">Izena:</label></td>
                    <td><input type="text" name="izena" value="<?php echo htmlspecialchars($eskaria->getBezeroa()->getIzena()); ?>" size="40" readonly style="background-color: #f0f0f0; cursor: not-allowed;"></td>
                </tr>
                <tr>
                    <td><label for="abizenak">Abizenak:</label></td>
                    <td><input type="text" name="abizenak" value="<?php echo htmlspecialchars($eskaria->getBezeroa()->getAbizenak()); ?>" size="40" readonly style="background-color: #f0f0f0; cursor: not-allowed;"></td>
                </tr>
                <tr>
                    <td><label for="helbidea">Helbidea:</label></td>
                    <td><input type="text" name="helbidea" value="<?php echo htmlspecialchars($eskaria->getBezeroa()->getHelbidea()); ?>" size="60" readonly style="background-color: #f0f0f0; cursor: not-allowed;"></td>
                </tr>
                <tr>
                    <td><label for="herria">Herria:</label></td>
                    <td><input type="text" name="herria" value="<?php echo htmlspecialchars($eskaria->getBezeroa()->getHerria()); ?>" readonly style="background-color: #f0f0f0; cursor: not-allowed;"></td>
                </tr>
                <tr>
                    <td><label for="probintzia">Probintzia:</label></td>
                    <td><input type="text" name="probintzia" value="<?php echo htmlspecialchars($eskaria->getBezeroa()->getProbintzia()); ?>" readonly style="background-color: #f0f0f0; cursor: not-allowed;"></td>
                </tr>
                <tr>
                    <td><label for="postaKodea">Posta Kodea:</label></td>
                    <td><input type="text" name="postaKodea" value="<?php echo htmlspecialchars($eskaria->getBezeroa()->getPostaKodea()); ?>" readonly style="background-color: #f0f0f0; cursor: not-allowed;"></td>
                </tr>
                <tr>
                    <td><label for="emaila">Emaila:</label></td>
                    <td><input type="email" name="emaila" value="<?php echo htmlspecialchars($eskaria->getBezeroa()->getEmaila()); ?>" size="40" readonly style="background-color: #f0f0f0; cursor: not-allowed;"></td>
                </tr>
            </table>

            <h3>2. Eskariaren Produktuak</h3>
            <table>
                <thead>
                    <tr>
                        <th>Produktua</th>
                        <th>Prezioa (Unitate)</th>
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
                        <td><?php echo $prod->getPrezioa(); ?>€</td>
                        <td><?php echo $det->getKopurua(); ?></td>
                        <td><?php echo $subtotal; ?>€</td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" align="right"><strong>GUZTIRA:</strong></td>
                        <td><strong><?php echo $totala; ?>€</strong></td>
                    </tr>
                </tbody>
            </table>

            <div class="bidalita-box">
                <h3>Eskariaren Egoera</h3>
                <label style="font-size: 1.2em; cursor: pointer;">
                    <input type="checkbox" name="bidalita" <?php if($eskaria->getBidalita()) echo "checked"; ?>>
                    <strong>Bidalita!!!</strong>
                </label>
            </div>

            <p>
                <input type="submit" name="bidali" value="Bidali"> 
        </form>
    </body>
</html>
