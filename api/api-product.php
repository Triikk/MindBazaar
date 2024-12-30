<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (isset($_REQUEST["query"])) {
    switch ($_REQUEST["query"]) {
        case "getArticleInfo":
            if (isset($_GET["id_prodotto"]) && isset($_GET["formato"]) && isset($_GET["durata"]) && isset($_GET["intensita"])) {
                $formato = $_GET["formato"];
                $durata = $_GET["durata"];
                $intensita = $_GET["intensita"];
                $id_prodotto = $_GET["id_prodotto"];
                $articleInfo = $dbh->getArticleInfo($id_prodotto, $formato, $durata, $intensita);
                if ($articleInfo == false) {
                    // TODO: cambiare "disponibilita" nel valore effettivo ed effettuare la conversione 0 -> "Questo prodotto non è disponibile" lato client
                    echo json_encode(array("id_prodotto" => $id_prodotto, "formato" => $formato, "durata" => $durata, "intensita" => $intensita, "prezzo" => 0, "disponibilita" => "Questo prodotto non è disponibile"));
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
