<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Produktu Berria</title>
</head>
<body>
    <h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a> &gt;</p>
    
    <?php if ($mezua): ?>
        <p style="color: red;"><?php echo $mezua; ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <p>
            <label for="izena">Izena:</label><br>
            <input type="text" id="izena" name="izena" size="50" value="<?php echo htmlspecialchars($izena, ENT_QUOTES); ?>" required>
        </p>

        <p>
            <label for="deskribapena">Deskribapena:</label><br>
            <textarea id="deskribapena" name="deskribapena" rows="5" cols="50" required><?php echo htmlspecialchars($deskribapena, ENT_QUOTES); ?></textarea>
        </p>

        <p>
            <label for="mota">Mota:</label><br>
            <input type="text" id="mota" name="mota" size="30" value="<?php echo htmlspecialchars($mota, ENT_QUOTES); ?>">
        </p>

        <p>
            <label for="prezioa">Prezioa:</label><br>
            <input type="number" step="0.01" id="prezioa" name="prezioa" value="<?php echo htmlspecialchars($prezioa, ENT_QUOTES); ?>" required>
        </p>

        <p>
            <label for="deskontua">Deskontua (%):</label><br>
            <input type="number" id="deskontua" name="deskontua" min="0" max="100" value="<?php echo htmlspecialchars($deskontua, ENT_QUOTES); ?>">
        </p>

        <p>
            <label for="nobedadeak">Nobedadeak:</label>
            <input type="checkbox" id="nobedadeak" name="nobedadeak" value="1" <?php echo $nobedadeak ? 'checked' : ''; ?>>
        </p>

        <p>
            <label for="kategoriaId">Kategoria:</label><br>
            <select id="kategoriaId" name="kategoriaId" required>
                <option value="">-- Aukeratu bat --</option>
                <?php foreach ($kategoriak as $kat): ?>
                    <option value="<?= $kat->getId() ?>" <?= ($kategoriaId == $kat->getId()) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($kat->getIzena(), ENT_QUOTES) ?>
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