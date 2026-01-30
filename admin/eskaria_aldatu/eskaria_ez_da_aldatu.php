<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Errorea Eskaria Aldatzean</title>
        <style>
            .error-box {
                border: 1px solid red;
                background-color: #f8d7da;
                color: #721c24;
                padding: 15px;
                margin-bottom: 20px;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <h1>Administrazio gunea</h1>
        <p><a href="../index.php">Hasiera</a> &gt; Eskariak</p>
        
        <div class="error-box">
            <h2>⚠️ Arazoa egon da</h2>
            <p>Eskaria ezin izan da eguneratu.</p>
            
            <?php if (isset($errorea) && !empty($errorea)): ?>
                <p><strong>Errorearen xehetasunak:</strong> <?php echo htmlspecialchars($errorea); ?></p>
            <?php else: ?>
                <p>Baliteke datu-basean arazoren bat egotea edo datuak ez direla aldatu.</p>
            <?php endif; ?>
        </div>

        <p>
            <button onclick="window.history.back()">Itzuli eta saiatu berriro</button>
            &nbsp; edo &nbsp;
            <a href="../index.php">Itzuli zerrendara</a>
        </p>
    </body>
</html>