<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Produktuak</title>
    </head>
    <body>
        <h1>Administrazio Gunea</h1>
        <p><a href="../index.php">Hasiera</a> &gt;</p>
        <h2>Produktua Ezabatu</h2>
        <form action="" method="POST" onsubmit="return confirm('Ziur zaude produktua hau ezabatu nahi duzula?');">
            <table cellspacing="5" cellpadding="5" border="1">
                <tr>
                    <td align="right">Izena</td>
                    <td><?php echo htmlspecialchars($produktua->getIzena() ?? '', ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td align="right">Deskribapena</td>
                    <td><?php echo htmlspecialchars($produktua->getDeskribapena() ?? '', ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td align="right">Mota</td>
                    <td><?php echo htmlspecialchars($produktua->getMota() ?? '', ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td align="right">Prezioa</td>
                    <td><?php echo htmlspecialchars($produktua->getPrezioa() ?? '', ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td align="right">Deskontua</td>
                    <td><?php echo htmlspecialchars($produktua->getDeskontua() ?? '', ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td align="right">Nobedadeak</td>
                    <td><?php echo htmlspecialchars($produktua->getNobedadeak() ?? '', ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td align="right">KategoriaId</td>
                    <td><?php echo htmlspecialchars($produktua->getKategoriaId() ?? '', ENT_QUOTES); ?></td>
                </tr>
            </table>
            <p>
                <input type="submit" name="ezabatu" value="Ezabatu">
            </p>
        </form>
    </body>
</html>
