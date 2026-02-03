<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Kategoriak - RUN & GO</title>
    <link rel="stylesheet" href="css/katalogoa.css">
</head>
<body>

<?php

$mis_imagenes = [
    "../img/1.png", 
    "../img/26.png", 
    "../img/11.png", 
    "../img/32.png", 
    "../img/17.png", 
    "../img/37.png", 
    "../img/22.png",
    "../img/41.png"
];
$kontagailua = 0; 
?>

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
    <h2>Kategoriak</h2>

    <div class="kategoriak-flex">
    <?php foreach ($kategoriak as $kat): ?>
        <?php
        $nombre_imagen = $mis_imagenes[$kontagailua] ?? "default.png"; 

        $img_fs = __DIR__ . "/../img/" . $nombre_imagen;
        $img_file = "../img/" . $nombre_imagen;

        if (!file_exists($img_fs)) {
            $img_file = "../img/default.png"; 
        }
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

        <?php 
            $kontagailua++; 
        endforeach; 
        ?>
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