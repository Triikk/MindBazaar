<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (isset($_REQUEST["query"])) {
    // var_dump($_REQUEST);
    foreach ($_REQUEST as $key => $value) {
        $_SESSION[$key] = $value;
    }
    switch ($_REQUEST["query"]) {
        case "getProducts":
            $prodotti = $dbh->getProducts();
            echo jsonResponse(200, $prodotti);
            break;
        case "addArticle":
            if (isset($_REQUEST["id_prodotto"]) && isset($_REQUEST["formato"]) && isset($_REQUEST["durata"]) && isset($_REQUEST["prezzo"]) && isset($_REQUEST["intensita"]) && isset($_REQUEST["disponibilita"]) && isset($_REQUEST["versione"])) {
                $id_prodotto = $_REQUEST["id_prodotto"];
                $formato = $_REQUEST["formato"];
                $durata = $_REQUEST["durata"];
                $prezzo = $_REQUEST["prezzo"];
                $intensita = $_REQUEST["intensita"];
                $disponibilita = $_REQUEST["disponibilita"];
                $versione = $_REQUEST["versione"];
                if ($dbh->isArticlePresent($id_prodotto, $versione)) {
                    echo jsonResponse(400, "Article already present");
                } else {
                    $dbh->addArticle($id_prodotto, $formato, $durata, $intensita, $prezzo, $disponibilita, $versione);
                    echo jsonResponse(200, "Article added successfully");
                }
            } else {
                echo jsonResponse(400, "Missing parameters");
            }
            break;
        default:
            echo jsonResponse(400, "Invalid action");
            break;
    }
} else {
    echo jsonResponse(400, "`query` field not set");
}
