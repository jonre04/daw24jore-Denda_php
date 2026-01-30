<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>kategoriak</title>
    </head>
    <body>
        <h1> Administrazio Gunea</h1>
        <p><a href="../index.php">Hasiera</a> &gt;</p>
        <h2>Kategoria Ezabatu</h2>
        <form action="" method="POST" onsubmit="return confirm('Ziur zaude kategoria hau ezabatu nahi duzula?');">
           <table cellspacing="5" cellpadding="5" border="1">
                <tr>
                    <td align="right">Izena</td>
                    <td><?php echo htmlspecialchars($kategoria->getIzena()); ?></td>
                </tr>
                <tr>
                    <td align="right">Deskribapena</td>
                    <td><?php echo nl2br(htmlspecialchars($kategoria->getDeskribapena())); ?></td>
                </tr>
            </table> 
            <p>
                <input type="submit" name="ezabatu" value="Ezabatu">
            </p>
        </form>
    </body>
</html>
