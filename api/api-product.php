<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (isset($_REQUEST["query"])) {
    switch ($_REQUEST["query"]) {
        case "getArticleInfo":
            if (isset($_REQUEST["id_prodotto"]) && isset($_REQUEST["formato"]) && isset($_REQUEST["durata"]) && isset($_REQUEST["intensita"])) {
                $formato = $_REQUEST["formato"];
                $durata = $_REQUEST["durata"];
                $intensita = $_REQUEST["intensita"];
                $id_prodotto = $_REQUEST["id_prodotto"];
                $articleInfo = $dbh->getArticleInfo($id_prodotto, $formato, $durata, $intensita);
                if ($articleInfo == false) {
                    echo jsonResponse(200, array("id_prodotto" => $id_prodotto, "formato" => $formato, "durata" => $durata, "intensita" => $intensita, "prezzo" => 0, "disponibilita" => "Questo prodotto non è disponibile"));
                    return;
                }
                echo jsonResponse(200, $articleInfo);
            } else {
                echo jsonResponse(400, array("error" => "Missing parameters"));
            }
            break;
        default:
            echo jsonResponse(400, array("error" => "Invalid query"));
            break;
    }
} else {
    echo jsonResponse(400, array("error" => "`query` field not set"));
}
