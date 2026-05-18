<?php

$api_url = __DIR__ . "/data/data.json";

$json_data = @file_get_contents($api_url);


if ($json_data === false) {
    die("Error: Ez da fitxategia aurkitu.");
}

$albisteak = json_decode($json_data, true);

if (!is_array($albisteak)) {
    die("Error: JSON formatu okerra.");
}
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>RUN & GO - Albisteak</title>
    <link rel="stylesheet" href="css/albisteak.css">
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
            <li><a href="../kontaktua/index.php">Kontaktua</a></li>
            <li><a href="../mediateka/index.php">Mediateka</a></li>
            <li><a href="../albisteak/index.php">Albisteak</a></li>
            </ul>
        </nav>
    </header>

    <main class="container-main">
        <h2 class="section-title">Albisteak</h2>
        <div class="grid-albisteak">
            <?php foreach ($albisteak as $item): ?>
                <div class="card-albistea" onclick="toggleDetalle(this)">
                    <?php 
                        $titulo = $item['izenburua'] ?? $item['title'] ?? '---';
                        $imagen = $item['irudia'] ?? $item['image'] ?? $item['thumbnail'] ?? '';
                        $laburpena = $item['laburpena'] ?? $item['description'] ?? '';
                        $xehetasunak = $item['xehetasunak'] ?? 'Ez dago xehetasun gehiagorik.';
                    ?>
                    
                    <?php if ($imagen): ?>
                        <div class="card-img-container">
                            <img src="<?php echo htmlspecialchars($imagen); ?>" alt="albistea">
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <h3><?php echo htmlspecialchars($titulo); ?></h3>
                        <p class="laburpena"><?php echo htmlspecialchars($laburpena); ?></p>
                        
                        <div class="xehetasunak" style="display: none;">
                            <hr>
                            <p><?php echo htmlspecialchars($xehetasunak); ?></p>
                        </div>
                        <span class="leer-mas">Klik egin gehiago irakurtzeko...</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="footer"> 
        <div class="container"> 
            <p>&copy; @2024 [RUN&GO]. Todos los derechos reservados.</p> 
            <p><a href="protecciónDatos.html">Política de Privacidad y Protección de datos</a></p> 
        </div> 
    </footer>

    <script>
        function toggleDetalle(elemento) {
            const detalle = elemento.querySelector('.xehetasunak');
            const leerMas = elemento.querySelector('.leer-mas');
            
            if (detalle.style.display === "none") {
                detalle.style.display = "block";
                leerMas.innerText = "Itxi xehetasunak";
            } else {
                detalle.style.display = "none";
                leerMas.innerText = "Klik egin gehiago irakurtzeko...";
            }
        }
    </script>
</body>
</html>