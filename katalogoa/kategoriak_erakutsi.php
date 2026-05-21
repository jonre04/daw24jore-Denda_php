<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Kategoriak - RUN & GO</title>
    <link rel="stylesheet" href="css/katalogoa.css">
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

<main>
    <h2>Katalogoa</h2>

    <div class="search-container">
        <input type="text" id="bilatzailea" placeholder="Bilatu kategoria edo produktuak..." autocomplete="off">
    </div>

    <div id="emaitzak">
        <h3>Kategoriak</h3>
        <div class="kategoriak-flex">
            <?php 
            $mis_imagenes = [
            "https://d2qdv3lgnkkc79.cloudfront.net/1.png",
            "https://d2qdv3lgnkkc79.cloudfront.net/26.png",
            "https://d2qdv3lgnkkc79.cloudfront.net/11.png",
            "https://d2qdv3lgnkkc79.cloudfront.net/32.png",
            "https://d2qdv3lgnkkc79.cloudfront.net/17.png",
            "https://d2qdv3lgnkkc79.cloudfront.net/37.png",
            "https://d2qdv3lgnkkc79.cloudfront.net/22.png",
            "https://d2qdv3lgnkkc79.cloudfront.net/41.png"
            ];

            $kontagailua = 0; 
            foreach ($kategoriak as $kat): 
                $img_file = $mis_imagenes[$kontagailua]
                ?? "https://d2qdv3lgnkkc79.cloudfront.net/default.png";
            ?>
                <div class="kategoria-txartela">
                    <img src="<?php echo $img_file; ?>" alt="<?php echo htmlspecialchars($kat->getIzena()); ?>">
                    <dl>
                        <dt>
                            <a href="index.php?kategoria_id=<?php echo $kat->getId(); ?>">
                                <?php echo htmlspecialchars($kat->getIzena()); ?>
                            </a>
                        </dt>
                        <dd class="kategoria dd"><?php echo htmlspecialchars($kat->getDeskribapena()); ?></dd>
                    </dl>
                </div>
            <?php $kontagailua++; endforeach; ?>
        </div>
    </div>
</main>

<footer class="footer"> 
    <div class="container"> 
        <p>&copy; 2024 RUN & GO. Todos los derechos reservados.</p> 
        <p><a href="proteccionDatos.html">Política de Privacidad y Protección de datos</a></p> 
    </div> 
</footer>

<script>
document.getElementById('bilatzailea').addEventListener('input', function() {
    let testua = this.value;

    fetch('bilatu.php?testua=' + encodeURIComponent(testua))
        .then(response => response.text())
        .then(data => {
            document.getElementById('emaitzak').innerHTML = data;
        })
        .catch(error => console.error('Errorea:', error));
});
</script>
</body>
</html>