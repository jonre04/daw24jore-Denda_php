<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Mezua Aldatua</title>
</head>
<body>

    <h1>Administrazio gunea</h1>
    <p><a href="../index.php">Hasiera</a> &gt;</p>
    <h2>Mezua Aldatu</h2>

    <?php if ($mezua->getErantzunDa()): ?>
        <h2 style="color: green;">Erantzun Da!!!</h2>
    <?php else: ?>
        <p>Mezua aldatu da.</p>
    <?php endif; ?>

    <table cellspacing="5" cellpadding="5" border="1">

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

        <tr>
            <td align="right"><strong>Egoera</strong></td>
            <td>
                <?php echo $mezua->getErantzunDa()
                    ? 'Erantzuna emanda'
                    : 'Erantzun gabe'; ?>
            </td>
        </tr>

    </table>

    <p>
        <a href="../index.php">Administrazio gunera itzuli</a>
    </p>

</body>
</html>