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
    <header>
        <nav>
            <ul>
                <li><a href="lateralMenu.php">ILM</a></li>
                <li><a href="index.php">
                        <h1>Titolo: MindBazaar</h1>
                    </a></li>
                <li><a href="searchMenu.php">ISM</a></li>
                <li><a href="cart.php">ICM</a></li>
                <li><a href="notifications.php">INM</a></li>
            </ul>
        </nav>
        <nav>
            <ul>
                <li><a href="articles.php">ARTICLES</a></li>
                <li><a href="orders.php">ORDERS</a></li>
                <li><a href="personalArea.php">PERSONALAREA</a></li>
                <li><a href="notifications.php">NOTIFICHE</a></li>
                <li><a href="login.php">LOGIN</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php if (isset($templateParams["nome"])) {
            require($templateParams["nome"]);
        }; ?>
    </main>
    <footer>
        <p>Contattaci: +39 686730535</p>
        <p>Indirizzo: Via dell'Università 50, Cesena</p>
        <p>&copy 2024 MindBazaar S.p.A.</p>
    </footer>
</body>

</html>