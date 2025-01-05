<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/style.css" />

    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DynaPuff:wght@400..700&display=swap" rel="stylesheet"> -->

    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet"> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">

    <title><?php echo $templateParams["titolo"]; ?></title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin>
    </script>
    <?php
    if (isset($templateParams["js"])):
        foreach ($templateParams["js"] as $script):
    ?>
            <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
</head>

<body class="bg-light">
    <?php
    // echo "_SESSION: " . print_r($_SESSION, true);
    // echo "<br>";
    // echo "_POST: " . print_r($_POST, true);
    // echo "<br>";
    // echo "_GET: " . print_r($_GET, true);
    // echo "<br>";
    // echo "_REQUEST: " . print_r($_REQUEST, true);
    // echo "<br>";
    // echo "templateParams: " . print_r($templateParams, true);
    ?>
    <header>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <?php require("lateral.php")?>
        </div>

        <div id="mySearchBar" class="searchBar">
            <?php require("search.php")?>
            <a href="javascript:void(0)" class="closebtn" onclick="closeSearchBar()">&times;</a>
        </div>

        <nav class="navbar navbar-expand">
            <ul class="navbar-nav">
                <li class="nav-item"><img class="clickable" onclick="openNav()" src="upload/icons/symbols/menu.png" alt="Logo" width="30" height="24" class="d-inline"></li>
                <li class="nav-item"><a class="nav-link" href="index.php">
                        <h1>MindBazaar</h1>
                    </a></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><!--<a class="nav-link" href="searchMenu.php">--> <img class="clickable" onclick="openSearchBar()" src="<?php echo SYMBOLS_DIR . "search.png"; ?>" alt="Logo" width="30" height="24" class="d-inline"> <!-- </a> --></li>
                <li class="nav-item"><a class="nav-link" href="cart.php"> <img src="<?php echo SYMBOLS_DIR . "cart.png"; ?>" alt="Logo" width="30" height="24" class="d-inline"> </a></li>
                <li class="nav-item"><a class="nav-link" href="notifications.php" id="notification-badge"> <img id="notification-icon" src="<?php echo SYMBOLS_DIR . "notificationEmpty.png"; ?>" alt="Logo" width="30" height="24" class="d-inline"> </a></li>
            </ul>
        </nav>
    </header>
    <main class="flex-grow-1">
        <?php if (isset($templateParams["nome"])) {
            require($templateParams["nome"]);
        }; ?>
    </main>
    <footer id="footer" class="bg-dark text-white">
        <div class="text-center p-3">
            <p>+39 686730535</p>
            <p>Via dell'Università 50, Cesena</p>
            <p>&copy 2024 MindBazaar Inc.</p>
        </div>
    </footer>
</body>
</html>