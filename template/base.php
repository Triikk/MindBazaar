<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php
    if (isset($templateParams["description"])) { ?>
        <meta name="description" content="<?php echo $templateParams["description"] ?>" />
    <?php } ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="./css/style.css" />

    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DynaPuff:wght@400..700&display=swap" rel="stylesheet" /> -->

    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet" /> -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet" />

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

<body>
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
    <header class="fixed-top">

        <nav class="navbar navbar-expand">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" onclick="toggleNav()">
                        <img src="<?php echo SYMBOLS_DIR . 'menu.png'; ?>" alt="Menu" />
                        <img src="<?php echo SYMBOLS_DIR . 'menuHover.png'; ?>" alt="Menu" />
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <h1 class="m-0">MindBazaar</h1>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" onclick="toggleSearch()">
                        <img src="<?php echo SYMBOLS_DIR . 'search.png'; ?>" alt="Search" />
                        <img src="<?php echo SYMBOLS_DIR . 'searchHover.png'; ?>" alt="Search" />
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">
                        <img src="<?php echo SYMBOLS_DIR . 'shopping-cart.png'; ?>" alt="Cart" />
                        <img src="<?php echo SYMBOLS_DIR . 'shopping-cartHover.png'; ?>" alt="Cart" />
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="notifications.php" id="notification-badge">
                        <img id="notification-icon-0" src="<?php echo SYMBOLS_DIR . 'notificationEmpty.png'; ?>" alt="Notifications" />
                        <img id="notification-icon-1" src="<?php echo SYMBOLS_DIR . 'notificationEmptyHover.png'; ?>" alt="Notifications" />
                    </a>
                </li>
            </ul>
        </nav>

        <div id="mySearchBar" class="searchBar">
            <?php require("search.php") ?>
        </div>
    </header>


    <main class="flex-grow-1">
        <div id="mySidenav" class="sidenav">
            <?php require("lateral.php") ?>
        </div>

        <?php if (isset($templateParams["nome"])) {
            require($templateParams["nome"]);
        }; ?>
    </main>
    <footer id="footer" class="text-white">
        <div class="text-center p-3">
            <p>+39 686730535</p>
            <p>Via dell'Università 50, Cesena</p>
            <p>&copy 2024 MindBazaar Inc.</p>
        </div>
    </footer>
</body>

</html>