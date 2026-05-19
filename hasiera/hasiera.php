<!DOCTYPE html>
<html lang="eu">
  <head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>RUN & GO</title> 
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css"> 
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
    <section class="hero">
        <h2>RUN & GO</h2>
        <h3> ONGI ETORRI!!</h3>
        <p>"Hemen zure helburuak burutzeko hainbat produkto daukagu, Hemen daukagun produktu guztiak errendimendu eta kalitate handikoak dira"</p>
        <p> "Arazoren bat baduzu idatzi hemen. 24 eta 72 ordu bitartean kontaktatuko dizugu"</p>
        <a href="../kontaktua/index.php" class="btn-contact">KONTAKTUA</a>
    </section>
    <main class="main"> 
    <div class="container"> 
    <section class="contenido"> 
    <h2>Eskaintzak</h2>
      <?php
      $eskaintzak = array_filter($produktuak, function($produktua) {
      return method_exists($produktua, 'getDeskontua') 
      && (float)$produktua->getDeskontua() > 0;
      });

      if (!empty($eskaintzak)) {
      echo "<div class='produktuak-grid'>";
      foreach ($eskaintzak as $produktua) {

      $deskontua = (int)$produktua->getDeskontua();
      $prezioa = (float)$produktua->getPrezioa();
      $prezio_berria = $prezioa * (1 - ($deskontua / 100));

      
      $img_file="https://d2qdv3lgnkkc79.cloudfront.net/" 
          .$produktua->getId().".png";

      echo "<div class='produktua'>";
      
  
      echo "<div class='deskontu-etiketa'>" . number_format($deskontua, 0) . "%</div>";
      
      echo "<img src='" . htmlspecialchars($img_file, ENT_QUOTES) . "' alt='" 
      . htmlspecialchars($produktua->getIzena(), ENT_QUOTES) . "'>";
      echo "<h3><a href='index.php?produktua_id=" . $produktua->getId() . "'>"
      . htmlspecialchars($produktua->getIzena(), ENT_QUOTES) . "</a></h3>";
      echo "<p>Prezioa: <del>" . number_format($prezioa, 2) . "€</del> 
      <span class='prezio-berria'>" . number_format($prezio_berria, 2) . "€</span></p>";
      
      echo "</div>";
      }
      echo "</div>";
      } else {
      echo "<p>Ez daude eskaintzak erakusteko.</p>";
      }

      echo "<h2>Nobedadeak</h2>";

      
     
      $nobedadeak = array_filter($produktuak, function($produktua) {

      $isNobedade = method_exists($produktua, 'getNobedadeak') 
      && $produktua->getNobedadeak() == 1;


      $isEskaintza = method_exists($produktua, 'getDeskontua') 
      && (float)$produktua->getDeskontua() > 0;


      return $isNobedade && !$isEskaintza;
      });

      if (!empty($nobedadeak)) {
      echo "<div class='produktuak-grid'>";

      foreach ($nobedadeak as $produktua) {
      $prezioa = (float)$produktua->getPrezioa();

      $img_file="https://d2qdv3lgnkkc79.cloudfront.net/"
          .$produktua->getId().".png";

      echo "<div class='produktua'>";
      
   
      echo "<div class='nobedade-etiketa'>NOBEDADEA</div>";
      
      echo "<img src='" . htmlspecialchars($img_file, ENT_QUOTES) . "' alt='" 
      . htmlspecialchars($produktua->getIzena(), ENT_QUOTES) . "'>";
      echo "<h3><a href='index.php?produktua_id=" . $produktua->getId() . "'>"
      . htmlspecialchars($produktua->getIzena(), ENT_QUOTES) . "</a></h3>";

      
      if (method_exists($produktua, 'getDeskontua') && (float)$produktua->getDeskontua() > 0) {

      $deskontua = (float)$produktua->getDeskontua();
      $prezio_berria = $prezioa * (1 - ($deskontua / 100));
      echo "<p>Prezioa: <del>" . number_format($prezioa, 2) . "€</del> 
      <span class='prezio-berria'>" . number_format($prezio_berria, 2) . "€</span></p>";
      } else {
      echo "<p>Prezioa: " . number_format($prezioa, 2) . "€</p>";
      }
      

      echo "</div>";
      }

      echo "</div>";
      } else {
      echo "<p>Ez daude nobedadeak erakusteko.</p>";
      }
      ?>
  </section>
    </div>
    </main>

    <footer class="footer"> 
    <div class="container"> 
    <p>&copy; @2024 [RUN&GO]. Todos los derechos reservados.</p> 
    <p><a href="protecciónDatos.html">Política de Privacidad y Protección de datos</a></p> 
    </div> 
    </footer>
  </body> 
</html>