<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>mezuak</title>
    </head>
    <body>
        <h1> Administrazio Gunea</h1>
        <p><a href="../index.php">Hasiera</a> &gt;</p>
        <h2>mezua Ezabatu</h2>
          <form action="" method="POST" onsubmit="return confirm('Ziur zaude mezua hau ezabatu nahi duzula?');">
              <input type="hidden" name="id" value="<?php echo $mezua->getId(); ?>">
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
            <p>
                <input type="submit" name="ezabatu" value="Ezabatu">
            </p>
        </form>
    </body>
</html>
