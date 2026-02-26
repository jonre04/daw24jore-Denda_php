<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Eskaria Gorde Da</title>
    </head>
    <body>
        <p><a href="index.php">Hasiera</a> &gt;</p>
        <h2>Eskari berria</h2>
        <p>Eskaria ondo gorde da.</p>
        <table cellspacing="5" cellpadding="5" border="1">
            <tr>
                <td align="right">Izena</td>
                <td><?php echo htmlspecialchars($izena); ?></td>
            </tr>
            <tr>
                <td align="right">Abizenak</td>
                <td><?php echo htmlspecialchars($abizenak); ?></td>
            </tr>
            <tr>
                <td align="right">Helbidea</td>
                <td><?php echo htmlspecialchars($helbidea); ?></td>
            </tr>
            <tr>
                <td align="right">Herria</td>
                <td><?php echo htmlspecialchars($herria); ?></td>
            </tr>
            <tr>
                <td align="right">PostaKodea</td>
                <td><?php echo htmlspecialchars($postaKodea); ?></td>
            </tr>
            <tr>
                <td align="right">Probintzia</td>
                <td><?php echo htmlspecialchars($probintzia); ?></td>
            </tr>
            <tr>
                <td align="right">Emaila</td>
                <td><?php echo htmlspecialchars($emaila); ?></td>
            </tr>
        </table>
        <br>
        <table cellspacing="0" cellpadding="5" border="1">
            <thead>
                <tr>
                    <th>Produktua</th>
                    <th>Kopurua</th>
                    <th>Prezioa (Unitatea)</th>
                    <th>Guztira</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $guztiraDenak = 0;
                foreach ($eskaria->getDetaileak() as $detailea): 
                    $prod = $detailea->getProduktua();
                    $azpitotala = $prod->getPrezioa() * $detailea->getKopurua();
                    $guztiraDenak += $azpitotala;
                ?>
                <tr>
                    <td><?php echo $prod->getIzena(); ?></td>
                    <td><?php echo $detailea->getKopurua(); ?></td>
                    <td><?php echo number_format($prod->getPrezioa(), 2); ?> €</td>
                    <td><?php echo number_format($azpitotala, 2); ?> €</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align: right;">GUZTIRA:</th>
                    <th><?php echo number_format($guztiraDenak, 2); ?> €</th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>