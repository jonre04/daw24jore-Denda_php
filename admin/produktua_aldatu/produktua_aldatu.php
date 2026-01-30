<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Produktuak</title>
    </head>
    <body>
        <h1>Administrazio Gunea</h1>
        <p><a href="../index.php">Hasiera</a> &gt;</p>
        <h2>Produktua Aldatu</h2>
        <p><?php echo $mezua ?></p>
       <form action="" method="POST">
            <p>
                <label for="izena">Izena:</label><br>
                <input type="text" id="izena" name="izena" size="50" maxlength="255" required value="<?php echo htmlspecialchars($produktua->getIzena() ?? '', ENT_QUOTES); ?>">
            </p>
            <p>
                <label for="deskribapena">Deskribapena:</label><br>
                <textarea id="deskribapena" name="deskribapena" rows="5" cols="50" required><?php echo htmlspecialchars($produktua->getDeskribapena() ?? '', ENT_QUOTES); ?></textarea>
            </p>

            <p>
                <label for="mota">Mota:</label><br>
                <input type="text" id="mota" name="mota" size="50" maxlength="255" required value="<?php echo htmlspecialchars($produktua->getMota() ?? '', ENT_QUOTES); ?>">
            </p>
            <p>
                <label for="prezioa">Prezioa (€):</label><br>
                <input type="number" id="prezioa" name="prezioa" step="0.01" min="0" required value="<?php echo htmlspecialchars($produktua->getPrezioa() ?? '', ENT_QUOTES); ?>">
            </p>
            <p>
                <label for="deskontua">Deskontua (%):</label><br>
                <input type="number" id="deskontua" name="deskontua" min="0" max="100" required value="<?php echo htmlspecialchars($produktua->getDeskontua() ?? '', ENT_QUOTES); ?>">
            </p>
            <p>
                <label for="nobedadeak">
                <input type="checkbox" id="nobedadeak" name="nobedadeak" value="1" <?php if (!empty($produktua) && $produktua->getNobedadeak()) echo 'checked'; ?>> Nobedadeak</label>
            </p>
           <p>
                <label for="kategoriaId">KategoriaId:</label><br>
                <select id="kategoriaId" name="kategoriaId" required>
                    <?php foreach ($kategoriak as $kategoria): ?>
                        <option value="<?= $kategoria->getId() ?>"
                            <?= ($produktua->getKategoriaId() == $kategoria->getId()) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($kategoria->getIzena(), ENT_QUOTES) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>


            <p>
                <input type="submit" name="gorde" value="Gorde">
            </p>
        </form>
    </body>
</html>
