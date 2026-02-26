<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Administrazio Gunea</title>
    <style>
        .eskaria-kutxa { border: 1px solid #ccc; margin-bottom: 10px; padding: 10px; border-radius: 5px; }
        .mezua-erantzunda { color: green; font-weight: bold; }
        .mezua-gabe { color: red; font-weight: bold; }
        .egoera-bidalita { color: green; font-weight: bold; }
        .egoera-bidaltzeke { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Administrazio Gunea</h1>
    <p><a href="irten.php">Irten</a></p>

    <h2>Kategoriak</h2>
    <ul>
        <?php foreach ($kategoria as $kat): ?>
            <li>
                <?php echo htmlspecialchars($kat->getIzena()); ?>
                [<a href="kategoria_aldatu/?id=<?php echo $kat->getId(); ?>">Aldatu</a>]
                [<a href="kategoria_ezabatu/?id=<?php echo $kat->getId(); ?>">Ezabatu</a>]
            </li>
        <?php endforeach; ?>
    </ul>
    <form action="kategoria_berria/" method="post">
        <input type="submit" value="Kategoria Berria"/>
    </form>

    <h2>Produktuak <?php if ($idKategoria) echo "(Kategoria: $idKategoria)"; ?></h2>
    <ul>
        <?php if (!empty($produktua)): ?>
            <?php foreach ($produktua as $p): ?>
                <li>
                    <?php echo htmlspecialchars($p->getIzena()); ?>
                    [<a href="produktua_aldatu/?id=<?php echo $p->getId(); ?>">Aldatu</a>]
                    [<a href="produktua_ezabatu/?id=<?php echo $p->getId(); ?>">Ezabatu</a>]
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Kategoria honek ez du produkturik.</li>
        <?php endif; ?>
    </ul>
    <form action="produktu_berria/" method="post">
        <input type="submit" value="Produktu Berria"/>
    </form>

     <h2>Mezuak</h2>
    <div id="eskarien_lista">
        <?php if (!empty($mezuaDB)): ?>
            <?php foreach ($mezuaDB as $mez): ?>
                 <li>
                    <?php echo $mez->getId(); ?> 
                    <?php echo htmlspecialchars($mez->getDataOrdua()); ?>
                    <strong><?php echo htmlspecialchars($mez->getIzena()); ?></strong>
                    : <?php echo htmlspecialchars($mez->getMezuaTestua()); ?>

                    <?php if ($mez->getErantzunDa()): ?>
                        <span style="color:green; font-weight:bold;">
                            [Mezua erantzun da]
                        </span>
                    <?php else: ?>
                        <span style="color:red; font-weight:bold;">
                            [Mezua erantzun gabe]
                        </span>
                    <?php endif; ?>

                    [<a href="mezua_aldatu/index.php?id=<?php echo $mez->getId(); ?>">Aldatu</a>]
                    [<a href="mezua_ezabatu/index.php?id=<?php echo $mez->getId(); ?>">Ezabatu</a>]
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Ez dago mezurik.</p>
        <?php endif; ?>
    </div>
    <h2>Eskariak</h2>
    <div id="eskarien_lista">
        <?php if (!empty($eskariakGuztiak)): ?>
            <?php foreach ($eskariakGuztiak as $esk): ?>
                <div class="eskaria-kutxa">
                    <strong>Eskaria #<?php echo $esk->getId(); ?></strong> - 
                    
                    <?php if ($esk->getBidalita()): ?>
                        <span class="egoera-bidalita">[BIDALITA]</span>
                    <?php else: ?>
                        <span class="egoera-bidaltzeke">[BIDALTZEKO]</span>
                    <?php endif; ?>

                    <br>
                    Bezeroa: <?php echo htmlspecialchars($esk->getData()->format('y-m-d H:i:s')); ?> 
                    <?php echo htmlspecialchars($esk->getBezeroa()->getIzena()); ?> 
                    <?php echo htmlspecialchars($esk->getBezeroa()->getAbizenak()); ?>
                    [<a href="eskaria_aldatu/index.php?id=<?php echo $esk->getId(); ?>">Aldatu</a>]
                    [<a href="eskaria_ezabatu/index.php?id=<?php echo $esk->getId(); ?>">Ezabatu</a>]

                    <ul>
                        <?php foreach ($esk->getDetaileak() as $det): ?>
                            <li>
                                <?php echo htmlspecialchars($det->getProduktua()->getIzena()); ?> 
                                x<?php echo $det->getKopurua(); ?> 
                                (<?php echo $det->getProduktua()->getPrezioa(); ?>€/u)
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Ez dago eskaririk oraindik.</p>
        <?php endif; ?>
    </div>
</body>
</html>