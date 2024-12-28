<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (isset($_GET["query"]) && $_GET["query"] == "getOrders") {
    if (API_checkUserLoggedIn()) {
        $ordini = $dbh->getOrdersByUsername($_SESSION["username"]);
    
        $ordiniConListaArticoli = array();
        $i = 0;
        foreach ($ordini as $ordine) {
            $listaArticoli = $dbh->getArticlesByOrderId($ordine["id"]);
            $ordiniConListaArticoli[$i] = [$ordine, $listaArticoli];
            $i++;
        }
    
        echo json_encode($ordiniConListaArticoli);
    }
} else {
    echo json_encode(array("error" => "Invalid query"));
}
