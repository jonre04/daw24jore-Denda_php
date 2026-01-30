<DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Kategoria Berria</title>
    </head>
    <body>
        <h1>Administrazio gunea</h1>
        <p><a href="../index.php">Hasiera</a> &gt;</p>
        <h2>Kategoria berria</h2>
        <p><?php echo $mezua ?></p>
        <form action="" method="post">
        <p>
            <label for="izena">Izena:</label><br>        
            <input type="text" id="izena" name="izena" size="50" maxlength="255" value="<?php echo $izena ?>">
        </p>
        <p>
            <label for="deskribapena">Deskribapena:</label><br>
            <textarea id="deskribapena" name="deskribapena" rows="5" cols="50"><?php echo $deskribapena ?></textarea>
        </p>

        <p>
            <input type="submit" name="gorde" value="Gorde">
        </p>
        </form>
    </body>
</html>