<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Eskari Berria</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/eskaria.css">
    </head>
    <body>
        <header class="header">
            <div class="logo-container">
                <img src="https://jonrev-s3.s3.eu-central-1.amazonaws.com/logoa.png" alt="logoa">
                <h1>RUN & GO</h1>
            </div>
            <nav class="menu">
            <input type="checkbox" id="menu-toggle">
            <label for="menu-toggle" class="menu-icon">&#9776;</label>
            <ul class="menu-list">
            <li><a href="../hasiera/index.php">Index</a></li>
            <li><a href="../katalogoa/index.php">Katalogoa</a></li>
            <li><a href="../saskia/index.php">Saskia</a></li>
            <li><a href="../eskaria/index.php">Eskaria</a></li>
            <li><a href="../kontaktua/index.php">Kontaktua</a></li>
            <li><a href="../mediateka/index.php">Mediateka</a></li>
            </ul>
            </nav>
        </header>

        <main>
            <p><a href="..">Hasiera</a>&gt;</p>
            <h2>Eskari berria</h2>
            <p><?php echo $mezua ?></p>
            <form action="" method="post">
                <p>
                    <label for="izena">Izena:</label><br>
                    <input type="text" id="izena" name="izena" size="50" maxlength="255" 
                        value="<?php echo htmlspecialchars($izena ?? '', ENT_QUOTES); ?>">
                </p>

                <p>
                    <label for="abizenak">Abizenak:</label><br>
                    <input type="text" id="abizenak" name="abizenak" size="50" maxlength="255" 
                        value="<?php echo htmlspecialchars($abizenak ?? '', ENT_QUOTES); ?>">
                </p>

                <p>
                    <label for="helbidea">Helbidea:</label><br>
                    <input type="text" id="helbidea" name="helbidea" size="30" maxlength="100" 
                        value="<?php echo htmlspecialchars($helbidea ?? '', ENT_QUOTES); ?>">
                </p>

                <p>
                    <label for="herria">Herria:</label><br>
                    <input type="text" id="herria" name="herria" size="30" maxlength="100" 
                        value="<?php echo htmlspecialchars($herria ?? '', ENT_QUOTES); ?>">
                </p>

                <p>
                    <label for="postaKodea">PostaKodea (%):</label><br>
                    <input type="number" id="postaKodea" name="postaKodea" size="30" maxlength="20" 
                        value="<?php echo htmlspecialchars($postaKodea ?? '', ENT_QUOTES); ?>">
                </p>

                <p>
                    <label for="probintzia">Probintzia:</label>
                    <input type="text" id="probintzia" name="probintzia" size="30" maxlength="100" 
                        value="<?php echo htmlspecialchars($probintzia ?? '', ENT_QUOTES); ?>">
                </p>
                <p>
                    <label for="emaila">Emaila:</label><br>
                    <input type="email" id="emaila" name="emaila" size="50" maxlength="255" 
                        value="<?php echo htmlspecialchars($emaila ?? '', ENT_QUOTES); ?>">
                </p>
                <p>
                    <input type="submit" name="bidali" value="Bidali">
                </p>
            </form>
        </main>
        <footer class="footer">
            <div class="container">
                <p>&copy; 2024 RUN & GO. Todos los derechos reservados.</p>
                <p><a href="proteccionDatos.html">Política de Privacidad y Protección de datos</a></p>
            </div>
        </footer>
    </body>
</html>