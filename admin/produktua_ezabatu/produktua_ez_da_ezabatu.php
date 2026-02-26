<DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Albisteak</title>
    </head>
    <body>
        <h1>Administrazio gunea</h1>
        <p><a href="..\index.php">Hasiera</a>&gt;</p>
        <h2>Produktua Ezabatu</h2>
        <p>Produktua ez da ezabatu.</p>
         <table cellspacing="5" cellpadding="5" border="1">
            <tr>
                <td align="right">Izena</td>
                <td><?php echo $izena ?></td>
            </tr>
            <tr>
                <td align="right">Deskribapena</td>
                <td><?php echo $deskribapena ?></td>
            </tr>
            <tr>
                <td align="right">Mota</td>
                <td><?php echo $mota ?></td>
            </tr>
            <tr>
                <td align="right">Prezioa</td>
                <td><?php echo $prezioa ?></td>
            </tr>
            <tr>
                <td align="right">Deskontua</td>
                <td><?php echo $deskontua ?></td>
            </tr>
            <tr>
                <td align="right">Nobedadeak</td>
                <td><?php echo $nobedadeak ?></td>
            </tr>
            <tr>
                <td align="right">KategoriaId</td>
                <td><?php echo $kategoriaId ?></td>
            </tr>
        </table>
    </body>
</html>