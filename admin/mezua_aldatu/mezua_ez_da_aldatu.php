<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Mezuak</title>
    </head>
    <body>
        <h1>Administrazio gunea</h1>
        <p><a href="../index.php">Hasiera</a> &gt;</p>
        <h2>Mezua Aldatu</h2>
        <p>Mezua ez da aldatu</p>
        <table cellspacing="5" cellpadding="5" border="1">
            <tr>
                <td align="right">Izena</td>
                <td><?php echo htmlspecialchars($izena) ?></td>
            </tr>
            <tr>
                <td align="right">Email</td>
                <td><?php echo htmlspecialchars($email) ?></td>
            </tr>
            <tr>
                <td align="right">MezuaTestua</td>
                <td><?php echo htmlspecialchars($mezuaTestua) ?></td>
            </tr>
            <tr>
                <td align="right">Erantzun Da</td>
                <td><?php echo $erantzunDa ? 'Bai' : 'Ez' ?></td>
            </tr>
        </table>
    </body>
</html>