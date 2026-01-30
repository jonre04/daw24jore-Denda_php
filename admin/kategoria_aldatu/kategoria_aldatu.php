<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Kategoriak</title>
    </head>
    <body>
        <h1>Administrazio Gunea</h1>
        <p><a href="../index.php">Hasiera</a> &gt;</p>
        <h2>Kategoria Aldatu</h2>
        <p><?php echo $mezua ?></p>
        <form action="" method="POST">
            <p>
                <label for="izena">Izena:</label><br>
                <input type="text" id="izena" name="izena" size="50" maxlength="255"
                value="<?php echo htmlspecialchars($kategoria->getIzena()); ?>">
            </p>
            <p>
                <label for="deskribapena">Deskribapena:</label><br>
                <textarea id="deskribapena" name="deskribapena" rows="5" cols="50"><?php echo htmlspecialchars($kategoria->getDeskribapena()); ?></textarea>
            </p>
            <p>
                <input type="submit" name="gorde" value="Gorde">
            </p>
        </form>
    </body>
</html>
