<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (isset($_GET["query"]) && $_GET["query"] == "getArticles") {
    $prodotti = $dbh->getProducts();
    echo json_encode($prodotti);
} else {
    echo json_encode(array("error" => "Invalid query"));
}
