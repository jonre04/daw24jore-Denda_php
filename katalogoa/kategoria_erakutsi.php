<!DOCTYPE html>
<html lang="eu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($kategoria->getIzena()); ?></title>
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

<div class="container mt-4">
      <a href="index.php" class="btn btn-outline-secondary">← Katalogoa</a>
</div>
<h1><?php echo htmlspecialchars($kategoria->getIzena()); ?></h1>
<p><?php echo htmlspecialchars($kategoria->getDeskribapena()); ?></p>

<h2>Kategoria honetako produktuak:</h2>
<div class="produktuak-flex">
  <?php if (!empty($produktuak)): ?>
    <?php foreach ($produktuak as $p): ?>
      <?php
        $id = htmlspecialchars($p->getId());
        $baseURL="https://d2qdv3lgnkkc79.cloudfront.net/";
        $img_path=$baseURL.$id.".png";
        $img_path = $baseURL.$id.".png";
        $prezioa = $p->getPrezioa();
        $deskontua = method_exists($p, 'getDeskontua') ? (float)$p->getDeskontua() : 0;
        $is_novedad = method_exists($p, 'getNobedadeak') && $p->getNobedadeak() == 1;
        $prezio_berria = $prezioa * (1 - ($deskontua / 100));
      ?>
      <div class="produktua">
        <?php if ($deskontua > 0): ?>
          <span class="deskontu-etiketa">-<?php echo number_format($deskontua, 0); ?>%</span>
        <?php elseif ($is_novedad): ?>
          <span class="nobedade-etiketa">NOBEDADEA</span>
        <?php endif; ?>
        <a href="index.php?produktua_id=<?php echo $p->getId(); ?>">
          <img src="<?php echo htmlspecialchars($img_path); ?>" alt="<?php echo htmlspecialchars($p->getIzena()); ?>">
        </a>
        <h3>
          <a href="index.php?produktua_id=<?php echo $p->getId(); ?>">
            <?php echo htmlspecialchars($p->getIzena()); ?>
          </a>
        </h3>
        <p>Prezioa: <?php echo ($deskontua > 0) ? "<del>".number_format($prezioa,2)."€</del> <span class='prezio-berria'>".number_format($prezio_berria,2)."€</span>" : number_format($prezioa,2)."€"; ?></p>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Kategoria honetan ez dago produkturik erakusteko.</p>
  <?php endif; ?>
</div>

<footer class="footer">
  <div class="container">
    <p>&copy; 2024 RUN & GO. Todos los derechos reservados.</p>
    <p><a href="proteccionDatos.html">Política de Privacidad y Protección de datos</a></p>
  </div>
</footer>
</body>
</html>