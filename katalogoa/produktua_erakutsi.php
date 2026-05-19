<!DOCTYPE html>
<html lang="eu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($produktua->getIzena()); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/daw24jore_Denda/katalogoa/css/katalogoa.css"> 
</head>
<style>
  
  .image-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 400px;
    position: relative; 
    width: 100%;
    padding: 20px; 
  }
  .product-image {
    width: 90%; 
    max-height: 100%; 
    object-fit: contain; 
  }
  .card-body h2.card-title {
    font-weight: bold !important;
  }

</style>
<body>
  <header class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-main shadow-sm">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
          
          <span class="fw-bold">RUN & GO</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto"> <li class="nav-item"><a class="nav-link" href="../hasiera/index.php">Hasiera</a></li>
            <li class="nav-item"><a class="nav-link" href="../katalogoa/index.php">Katalogoa</a></li>
            <li class="nav-item"><a class="nav-link" href="../saskia/index.php">Saskia</a></li>
            <li class="nav-item"><a class="nav-link" href="../eskaria/index.php">Eskaria</a></li>
            <li class="nav-item"><a class="nav-link" href="../kontaktua/index.php">Kontaktua</a></li>
            <li class="nav-item"><a class="nav-link" href="../mediateka/index.html">Mediateka</a></li>
            <li class="nav-item"><a class="nav-link" href="../albisteak/index.php">Albisteak</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  
  <main class="main">
    <div class="container mt-4"> <a href="index.php" class="btn btn-outline-secondary">← Atzera</a>
    </div>

    <div class="container my-4"> <div class="card shadow border-0">
        <div class="row g-0 align-items-center">
          <?php
            $id = htmlspecialchars($produktua->getId());
            $img_path = "../img/$id.png";
            $baseURL = "https://d2qdv3lgnkkc79.cloudfront.net/";
            $img_path = $baseURL . $id . ".png";
            $prezioa = $produktua->getPrezioa();
            $deskontua = $produktua->getDeskontua();
           
            $prezio_finala = $deskontua > 0 ? $prezioa * (1 - ($deskontua / 100)) : $prezioa;
          
            $is_novedad = method_exists($produktua, 'getNobedadeak') && $produktua->getNobedadeak() == 1;
          ?>
          
          <div class="col-md-6 col-lg-5 image-container">
            <?php if ($deskontua > 0): ?>
              <div class="produktua-etiketa deskontu-etiketa">-<?php echo number_format($deskontua, 0); ?>%</div>
            <?php elseif ($is_novedad): ?>
              <div class="produktua-etiketa nobedade-etiketa">NOBEDADEA</div>
            <?php endif; ?>
            <img src="<?php echo htmlspecialchars($img_path); ?>" class="rounded product-image" alt="<?php echo htmlspecialchars($produktua->getIzena()); ?>">
          </div>
          
          <div class="col-md-6 col-lg-7 p-4"> 
            <div class="card-body">
              <h2 class="card-title mb-3 display-5 fw-bold"><?php echo htmlspecialchars($produktua->getIzena()); ?></h2>
              
              <p class="card-text fs-6"><strong>Deskribapena:</strong> <?php echo htmlspecialchars($produktua->getDeskribapena()); ?></p>
              <p class="card-text fs-6"><strong>Mota:</strong> <?php echo htmlspecialchars($produktua->getMota()); ?></p>
              
              <p class="card-text">
                <strong>Prezioa:</strong>
                <?php if ($deskontua > 0): ?>
                  <del class="text-muted fs-6 me-2"><?php echo number_format($prezioa, 2, ',', '.'); ?> €</del> 
                  <span class="fs-4 fw-bold text-success"><?php echo number_format($prezio_finala, 2, ',', '.'); ?> €</span>
                <?php else: ?>
                  <span class="fs-4 fw-bold text-success"><?php echo number_format($prezioa, 2, ',', '.'); ?> €</span>
                <?php endif; ?>
              </p>
              
              <p class="card-text fs-6"><strong>Deskontua:</strong> <?php echo number_format($deskontua, 0); ?> %</p>
              
              <form action="../saskia/index.php" method="post" class="mt-4">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($produktua->getId()); ?>">
                <input type="hidden" name="prezioa" value="<?php echo number_format($prezio_finala, 2, '.', ''); ?>">

                <div class="d-flex align-items-center gap-2">
                    <div style="width: 80px;">
                        <input type="number" name="kopurua" value="1" min="1" class="form-control text-center">
                    </div>

                    <button type="submit" class="btn btn-orange btn-lg flex-grow-1">
                        🛒 Saskira Gehitu
                    </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="bg-main text-white mt-5 py-4">
    <div class="container text-center">
      <p class="mb-1">&copy; 2024 RUN & GO. Todos los derechos reservados.</p>
      <p class="mb-0"><a href="proteccionDatos.html" class="text-white text-decoration-underline">Política de Privacidad y Protección de datos</a></p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>

    document.addEventListener('DOMContentLoaded', function() {
        const carritoButtons = document.querySelectorAll('.carrito');
        
        carritoButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
              
                alert('Producto con ID ' + productId + ' añadido al carrito');
            });
        });
    });
  </script>
</body>
</html>