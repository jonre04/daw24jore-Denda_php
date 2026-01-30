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

        <?php if ($erantzunDa): ?>
            <h2 style="color: green;">Erantzun Da!!!</h2>
        <?php else: ?>
            <p>Mezua aldatu da.</p>
        <?php endif; ?>

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
                <td align="right">Egoera</td>
                <td><?php echo $erantzunDa ? 'Erantzuna emanda' : 'Erantzun gabe' ?></td>
            </tr>
        </table>
    </body>
</html>