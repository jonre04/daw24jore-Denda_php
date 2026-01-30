<?php
use com\leartik\daw24jore\mezuak\MezuaDB;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Mezua</title>
    <script type="text/javascript" src="api.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mezua.css">
</head>
<body>
<header class="header">
    <div class="logo-container">
        <img src="../img/logoa.png" alt="logoa">
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
      <li><a href="../mediateka/index.html">Mediateka</a></li>
      </ul>
      </nav>
</header>

<main>
    <h1>Mezua</h1>

    <div class="kategoriak-flex">
        
        <p><a href="../hasiera/index.php">Hasiera</a> &gt; </p>

        <?php echo $mezuaEgoera; ?>

        <h2>Mezu berria</h2>

        <div id="mezua" style="background-color:#ccc">
            <form method="POST" action="">
                <p>
                    <input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($id); ?>"> 
                    <label for="izena">Izena:</label><br>
                    <input type="text" id="izena" name="izena" value="<?php echo htmlspecialchars($izena); ?>" size="50" maxlength="255" required>
                </p>

                <p>
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" size="50" maxlength="255" required>
                </p>

                <p>
                    <label for="mezuaTestua">Mezua:</label><br>
                    <textarea id="mezuaTestua" name="mezuaTestua" required><?php echo htmlspecialchars($mezuaTestua); ?></textarea>
                </p>

                <p> 
                    <input type="submit" id="bidali" name="bidali" value="Bidali">
                </p>
            </form>
        </div>

        <div class="historial-mensajes">
            <h3>Mezuak</h3>

            <?php 
            $mezua = MezuaDB::getAllMezuak();

            if ($mezua && count($mezua) > 0) {
                foreach ($mezua as $m) { ?>
                    
                    <div class="tarjeta-mensaje">
                        <span class="info-hora">
                            Data/Ordua: <?php echo htmlspecialchars($m->getDataOrdua()); ?>
                        </span>
                        <div class="contenido-mensaje">
                            <?php echo nl2br(htmlspecialchars($m->getMezuaTestua())); ?>
                        </div>
                    </div>

                <?php }
            } else {
                echo "<p>Ez dago mezurik oraindik. (No hay mensajes todavía).</p>";
            }
            ?>
        </div>

    </div>
</main>

<footer class="footer">
    <div class="container">
        <p>&copy; 2024 RUN & GO. Todos los derechos reservados.</p>
        <p><a href="proteccionDatos.html">Política de Privacidad y Protección de datos</a></p>
    </div>
</footer>
</body>
</html>