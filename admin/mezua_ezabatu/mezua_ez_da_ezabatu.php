<DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Nezya</title>
    </head>
    <body>
        <h1>Administrazio gunea</h1>
        <p><a href="../index.php">Hasiera</a> &gt;</p>
        <h2>Mezua Ezabatu</h2>
        <p>Mezua ez da ezabatu</p>
        <table cellspacing="5" cellpadding="5" border="1">
            <tr>
                <td align="right">Izena</td>
                <td><?php echo htmlspecialchars($mezua->getIzena()); ?></td>
            </tr>
            <tr>
                 <td align="right">Email</td>
                <td><?php echo nl2br(htmlspecialchars($mezua->getEmail())); ?></td>
            </tr>
             <tr>
                <td align="right">MezuaTestua</td>
                <td><?php echo nl2br(htmlspecialchars($mezua->getMezuaTestua())); ?></td>
            </tr>
        </table>
    </body>
</html>