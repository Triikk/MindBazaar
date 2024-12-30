<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (isset($_REQUEST["query"])) {
    switch ($_REQUEST["query"]) {
        case "getCartArticles":
            if (checkUserLoggedIn()) {
                $articoliInCarrello = $dbh->getCartArticles($_SESSION["username"]);
                echo jsonResponse(200, $articoliInCarrello);
            }
            break;
        case "removeFromCart":
            if (checkUserLoggedIn()) {
                $dbh->removeFromCart($_SESSION["username"], $_REQUEST["art_id_prod"], $_REQUEST["art_versione"]);
                echo jsonResponse(200, array("message" => "Articolo rimosso dal carrello"));
            }
            break;
        case "modifyArtAmount":
            if (checkUserLoggedIn()) {
                $dbh->modifyCartAmount($_REQUEST["art_id_prod"], $_REQUEST["art_quantita"], $_SESSION["username"], $_REQUEST["art_versione"]);
                echo jsonResponse(200, array("message" => "Quantità nel carrello modificata"));
            }
            break;
        default:
            echo jsonResponse(400, array("error" => "Invalid query"));
            break;
    }
} else {
    echo jsonResponse(400, "`query` field not set");
}
