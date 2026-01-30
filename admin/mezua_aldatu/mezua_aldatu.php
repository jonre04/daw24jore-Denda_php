<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Mezuak</title>
    </head>
    <body>
        <h1>Administrazio Gunea</h1>
        <p><a href="../index.php">Hasiera</a> &gt; Mezua Editatu</p>
        <h2>Mezua Aldatu</h2>
        
        <?php if ($erroreMezua): ?>
            <p><?php echo $erroreMezua ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <table border="1">
                <tr>
                    <td>ID</td>
                    <td><?php echo $mezua->getId(); ?></td>
                </tr>
                <tr>
                    <td><label for="izena">Izena:</label></td>
                    <td>
                        <input type="text" id="izena" name="izena" size="50" maxlength="255"
                        value="<?php echo htmlspecialchars($mezua->getIzena()); ?>">
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td>
                        <input type="text" id="email" name="email" size="50"
                        value="<?php echo htmlspecialchars($mezua->getEmail()); ?>">
                    </td>
                </tr>
                <tr>
                    <td><label for="mezuaTestua">MezuaTestua:</label></td>
                    <td>
                        <textarea id="mezuaTestua" name="mezuaTestua" rows="5" cols="50"><?php echo htmlspecialchars($mezua->getMezuaTestua()); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Egoera:</td>
                    <td>
                        <input type="checkbox" id="erantzunDa" name="erantzunDa" 
                        <?php echo $mezua->getErantzunDa() ? 'checked' : ''; ?>>
                        <label for="erantzunDa">Erantzun da</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="gorde" value="Gorde">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>