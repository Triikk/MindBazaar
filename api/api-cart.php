<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (isset($_GET["query"]) && $_GET["query"] == "getCartArticles") {
    if (API_checkUserLoggedIn()) {
        $articoliInCarrello = $dbh->getCartArticles($_SESSION["username"]);

        echo json_encode($articoliInCarrello);
    }
} else if (isset($_GET["query"]) && $_GET["query"] == "removeFromCart") {
    if (API_checkUserLoggedIn()) {
        $dbh->removeFromCart($_SESSION["username"], $_GET["art_id_prod"], $_GET["art_versione"]);
    }
} else if (isset($_GET["query"]) && $_GET["query"] == "modifyArtAmount") {
    if (API_checkUserLoggedIn()) {
        $dbh->modifyCartAmount($_GET["art_id_prod"], $_GET["art_quantita"], $_SESSION["username"], $_GET["art_versione"]);
    }
} else{
    echo json_encode(array("error" => "Invalid query"));
}
