<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/style.css" />

    <title><?php echo $templateParams["titolo"]; ?></title>
</head>

<body>
    <?php
    echo "_SESSION: " . print_r($_SESSION, true);
    echo "<br>";
    echo "_POST: " . print_r($_POST, true);
    echo "<br>";
    echo "_GET: " . print_r($_GET, true);
    echo "<br>";
    echo "_REQUEST: " . print_r($_REQUEST, true);
    echo "<br>";
    // echo "templateParams: " . print_r($templateParams, true);
    ?>

    <header>
        <nav>
            <ul>
                <li><a href="lateralMenu.php">ILM</a></li>
                <li><a href="index.php">
                        <h1>MindBazaar</h1>
                    </a></li>
                <li><a href="searchMenu.php">ISM</a></li>
                <li><a href="cart.php">ICM</a></li>
                <li><a href="notifications.php">Notifiche</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php if (isset($templateParams["nome"])) {
            require($templateParams["nome"]);
        }; ?>
    </main>
    <footer id="footer">
        <p>Contattaci: +39 686730535</p>
        <p>Indirizzo: Via dell'Università 50, Cesena</p>
        <p>&copy 2024 MindBazaar S.p.A.</p>
    </footer>
</body>
<?php
if (isset($templateParams["js"])):
    foreach ($templateParams["js"] as $script):
?>
        <script src="<?php echo $script; ?>"></script>
<?php
    endforeach;
endif;
?>

</html>