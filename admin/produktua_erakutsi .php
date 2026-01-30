<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Administrazio Gunea</title>
    </head>
    <body>
        <h1>Administrazio Gunea</h1>
        <p>Produktuak</p>
        <ul>
        <?php for ($i = 0; $i < count($produktua); $i++) { ?>
            <li><?php echo $produktua[$i]->getIzena() ?>
                [<a href="../produktua_aldatu/?id=<?php echo $kategoria[$i]->getId() ?>">Aldatu</a>]
                [<a href="../produktua_ezabatu/?id=<?php echo $kategoria[$i]->getId() ?>">Ezabatu</a>]
            </li>
        <?php } ?>
        </ul>
        <form action="produktu_berria/" method="post">
        <p><input type="submit" value="Produktu Berria"/></p>
        </form>
        <p><a href="irten.php">Irten</a></p>
    </body>
</html>

