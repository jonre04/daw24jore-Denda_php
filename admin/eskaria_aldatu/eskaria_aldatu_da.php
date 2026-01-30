<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Eskaria Aldatu Da</title>
        <style>
            .success-box {
                border: 1px solid green;
                background-color: #d4edda;
                color: #155724;
                padding: 15px;
                margin-bottom: 20px;
                border-radius: 5px;
            }
            table { width: 50%; border-collapse: collapse; margin-top: 10px; }
            td, th { border: 1px solid #ddd; padding: 8px; }
            th { text-align: right; background-color: #f2f2f2; width: 30%; }
        </style>
    </head>
    <body>
        <h1>Administrazio gunea</h1>
        <p><a href="../index.php">Hasiera</a> &gt; Eskariak</p>
        
        <h3>Gordetako datuak:</h3>
        <table>
            <tr>
                <th>Eskaria ID:</th>
                <td>#<?php echo $eskaria->getId(); ?></td>
            </tr>
            <tr>
                <th>Bezeroa:</th>
                <td><?php echo htmlspecialchars($bezeroa->getIzena() . " " . $bezeroa->getAbizenak()); ?></td>
            </tr>
            <tr>
                <th>Helbidea:</th>
                <td><?php echo htmlspecialchars($bezeroa->getHelbidea()); ?></td>
            </tr>
            <tr>
                <th>Emaila:</th>
                <td><?php echo htmlspecialchars($bezeroa->getEmaila()); ?></td>
            </tr>
            <tr>
                <th>Egoera (Bidalita):</th>
                <td>
                    <?php 
                    if ($eskaria->getBidalita()) {
                        echo "<span style='color:green; font-weight:bold;'>BAI, BIDALITA</span>";
                    } else {
                        echo "<span style='color:orange; font-weight:bold;'>EZ (Prestatzen)</span>";
                    }
                    ?>
                </td>
            </tr>
        </table>

        <br>
        <p>
            <a href="../index.php">Itzuli Eskarien Zerrendara</a>
        </p>
    </body>
</html>