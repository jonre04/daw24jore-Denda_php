<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Mezua ezabatu</title>
    <style>
        table {
            border-collapse: collapse;
        }
        td {
            padding: 6px;
        }
        .arriskua {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Administrazio Gunea</h1>
    <p><a href="../index.php">Hasiera</a>

    <h2 class="arriskua">Mezua Ezabatu</h2>

    <form action="" method="POST"
          onsubmit="return confirm('Ziur zaude mezua hau ezabatu nahi duzula?');">
        <input type="hidden" name="id" value="<?php echo $mezua->getId(); ?>">

        <table border="1">
            <tr>
                <td align="right"><strong>Izena</strong></td>
                <td><?php echo htmlspecialchars($mezua->getIzena()); ?></td>
            </tr>

            <tr>
                <td align="right"><strong>Email</strong></td>
                <td><?php echo htmlspecialchars($mezua->getEmail()); ?></td>
            </tr>

            <tr>
                <td align="right"><strong>Mezua</strong></td>
                <td><?php echo nl2br(htmlspecialchars($mezua->getMezuaTestua())); ?></td>
            </tr>
        </table>

        <p>
            <input type="submit" name="ezabatu" value="Ezabatu">
            <a href="../index.php">Utzi</a>
        </p>

    </form>

</body>
</html>