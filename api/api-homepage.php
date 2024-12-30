<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (isset($_REQUEST["query"])) {
    switch ($_REQUEST["query"]) {
        case "bestSellers":
            $numBestSellers = 2;
            if (isset($_REQUEST["numBestSellers"])) {
                $numBestSellers = $_REQUEST["numBestSellers"];
            }
            $bestSellers = $dbh->getBestSellers($numBestSellers);
            foreach ($bestSellers as $key => $bestSeller) {
                $bestSellers[$key]["percorso_immagine"] = getImagePath($bestSeller["nome_categoria"], $bestSeller["immagine"]);
            }
            echo jsonResponse(200, $bestSellers);
            break;
        case "categories":
            $categories = $dbh->getCategories();
            echo jsonResponse(200, $categories);
            break;
        default:
            echo jsonResponse(400, array("error" => "Invalid query"));
            break;
    }
} else {
    echo jsonResponse(400, "`query` field not set");
}
