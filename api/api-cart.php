<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (isset($_GET["query"]) && $_GET["query"] == "getCartArticles") {
    $cartArticles = $dbh->getCartArticles($_SESSION["username"]);
    echo json_encode($cartArticles);
} else {
    echo json_encode(array("error" => "Invalid query"));
}
