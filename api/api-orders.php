<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (checkUserLoggedIn()) {
    if (isset($_REQUEST["query"])) {
        switch ($_REQUEST["query"]) {
            case "getOrders":
                $ordini = $dbh->getOrdersByUsername($_SESSION["username"]);
                $ordiniConListaArticoli = array();
                $i = 0;
                foreach ($ordini as $ordine) {
                    $listaArticoli = $dbh->getArticlesByOrderId($ordine["id"]);
                    $ordiniConListaArticoli[$i] = [$ordine, $listaArticoli];
                    $i++;
                }
                echo jsonResponse(200, $ordiniConListaArticoli);
                break;
            case "getOrderArticles":
                if ($dbh->isAdmin($_SESSION["username"])) {
                    $listaArticoli = $dbh->getArticlesByOrderId($_REQUEST["id_ordine"]);
                    echo jsonResponse(200, $listaArticoli);
                } else {
                    echo jsonResponse(400,"You don't have the permission to access this resource");
                }
                break;
            default:
                echo jsonResponse(400, array("error" => "Invalid query"));
                break;
        }
    } else {
        echo jsonResponse(400, "`query` field not set");
    }
} else {
    echo jsonResponse(400, "User not logged in");
}
