<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['eguneratu_index']) && isset($_POST['kopuru_berria'])) {
        $index = (int)$_POST['eguneratu_index'];
        $berria = (int)$_POST['kopuru_berria'];
        
        $detaileak = $saskia->getDetaileak();
        if (isset($detaileak[$index]) && $berria > 0) {
            $detaileak[$index]->setKopurua($berria);
        }

        if (isset($_POST['ezabatu_index'])) {
            $index = (int)$_POST['ezabatu_index'];
            $saskia->ezabatuDetailea($index); 
        }

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
?>
<!doctype html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Saskia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/saskia.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

<main class="container mt-4">
    <h2>Saskia</h2>
    <hr>

    <?php if (count($saskia->getDetaileak()) > 0) { ?>
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Produktua</th>
                    <th>Prezioa/unitateko</th>
                    <th style="width: 100px;">Kopurua</th> 
                    <th>Guztira</th>
                    <th>Ekintzak</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $totalGuztira = 0;
            foreach ($saskia->getDetaileak() as $index => $detailea) { 
                $produktua = $detailea->getProduktua();
                $prezioOriginala = $produktua->getPrezioa();
                $deskontua = $produktua->getDeskontua();
                
                $prezioFinala = $deskontua > 0 ? $prezioOriginala * (1 - ($deskontua / 100)) : $prezioOriginala;
                
                $kopurua = $detailea->getKopurua();
                $subtotal = $prezioFinala * $kopurua;
                $totalGuztira += $subtotal;
            ?>
                <tr>
                    <td>
                        <?php
                        echo method_exists($produktua, 'getIzena')
                            ? htmlspecialchars($produktua->getIzena())
                            : htmlspecialchars($produktua->getIzenburua());
                        ?>
                    </td>
                    <td>
                        <?php if ($deskontua > 0): ?>
                            <del class="text-muted small"><?php echo number_format($prezioOriginala, 2, ',', '.'); ?> €</del><br>
                            <span class="text-success fw-bold"><?php echo number_format($prezioFinala, 2, ',', '.'); ?> €</span>
                        <?php else: ?>
                            <span><?php echo number_format($prezioOriginala, 2, ',', '.'); ?> €</span>
                        <?php endif; ?>
                    </td>
                    
                    <td>
                        <form method="post" id="form-update-<?php echo $index; ?>">
                            <input type="hidden" name="eguneratu_index" value="<?php echo $index; ?>">
                            <input type="number" name="kopuru_berria" 
                                   value="<?php echo $kopurua; ?>" 
                                   min="1" 
                                   class="form-control form-control-sm text-center"
                                   onchange="this.form.submit()">
                        </form>
                    </td>

                    <td class="fw-bold">
                        <?php echo number_format($subtotal, 2, ',', '.'); ?> €
                    </td>
                    <td>
                        <form method="post" onsubmit="return confirm('¿Produktua saskitik ezabatu nahi duzu?');">
                            <input type="hidden" name="ezabatu_index" value="<?php echo $index; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">
                                🗑
                            </button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <td colspan="3" class="text-end fw-bold">GUZTIRA:</td>
                    <td colspan="2" class="fw-bold text-primary"><?php echo number_format($totalGuztira, 2, ',', '.'); ?> €</td>
                </tr>
            </tfoot>
        </table>

        <div class="mt-3">
            <a href="../katalogoa/index.php" class="btn btn-secondary">
                Erosten jarraitu
            </a>
            <a href="../eskaria/index.php" class="btn btn-primary">
                Eskaria egin
            </a>
        </div>

    <?php } else { ?>
        <div class="alert alert-warning">
            Saskia hutsik dago.
            <a href="../katalogoa/index.php" class="alert-link">Joan katalogora</a>
        </div>
    <?php } ?>
</main>

<footer class="footer mt-5">
    <div class="container text-center">
        <p>&copy; 2024 RUN & GO. Todos los derechos reservados.</p>
        <p>
            <a href="proteccionDatos.html">
                Política de Privacidad y Protección de datos
            </a>
        </p>
    </div>
</footer>

</body>
</html>