<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Mezuak</title>
        <style>
            input[readonly], textarea[readonly] {
                background-color: #f3f3f3;
                border: 1px solid #ccc;
            }
        </style>
    </head>
    <body>

        <h1>Administrazio Gunea</h1>
        <p><a href="../index.php">Hasiera</a>
        <h2>Mezua Aldatu</h2>

        <?php if (!empty($erroreMezua)): ?>
            <p style="color:red;"><?php echo htmlspecialchars($erroreMezua); ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $mezua->getId(); ?>">

            <table border="1" cellpadding="5">

                <tr>
                    <td>ID</td>
                    <td><?php echo $mezua->getId(); ?></td>
                </tr>

                <tr>
                    <td><label>Izena:</label></td>
                    <td>
                        <input type="text" size="50"
                               value="<?php echo htmlspecialchars($mezua->getIzena()); ?>"
                               readonly>
                    </td>
                </tr>

                <tr>
                    <td><label>Email:</label></td>
                    <td>
                        <input type="text" size="50"
                               value="<?php echo htmlspecialchars($mezua->getEmail()); ?>"
                               readonly>
                    </td>
                </tr>

                <tr>
                    <td><label>Mezua:</label></td>
                    <td>
                        <textarea rows="5" cols="50" readonly><?php
                            echo htmlspecialchars($mezua->getMezuaTestua());
                        ?></textarea>
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
                    <td colspan="2" style="text-align:center;">
                        <input type="submit" name="gorde" value="Gorde">
                    </td>
                </tr>

            </table>
        </form>

    </body>
</html>