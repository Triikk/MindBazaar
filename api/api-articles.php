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
            echo json_encode($prodotti);
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
                $dbh->addArticle($id_prodotto, $formato, $durata, $intensita, $prezzo, $disponibilita, $versione);
                echo json_encode(array("success" => "Article added successfully"));
            } else {
                echo json_encode(array("error" => "Missing parameters"));
            }
            break;
        default:
            echo json_encode(array("error" => "Invalid action"));
            break;
    }
} else {
    echo json_encode(array("error" => "Query not set"));
}
