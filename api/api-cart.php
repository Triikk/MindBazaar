<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');


if (isset($_REQUEST["query"]) && $_REQUEST["query"] == "getCartArticles") {
    if (API_checkUserLoggedIn()) {
        $articoliInCarrello = $dbh->getCartArticles($_SESSION["username"]);
        echo json_encode($articoliInCarrello);
    }
} else if (isset($_REQUEST["query"]) && $_REQUEST["query"] == "removeFromCart") {
    if (API_checkUserLoggedIn()) {
        $dbh->removeFromCart($_SESSION["username"], $_REQUEST["art_id_prod"], $_REQUEST["art_versione"]);
    }
} else if (isset($_REQUEST["query"]) && $_REQUEST["query"] == "modifyArtAmount") {
    if (API_checkUserLoggedIn()) {
        $dbh->modifyCartAmount($_REQUEST["art_id_prod"], $_REQUEST["art_quantita"], $_SESSION["username"], $_REQUEST["art_versione"]);
    }
} else{
    echo json_encode(array("error" => "Invalid query"));
}
