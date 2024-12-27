<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');
if (isset($_GET["query"]) && $_GET["query"] == "bestSellers") {
    $bestSellers = $dbh->getBestSellers(2);
    // for($i = 0; $i < count($articoli); $i++){
    //     $articoli[$i]["imgarticolo"] = UPLOAD_DIR.$articoli[$i]["imgarticolo"];
    // }
    echo json_encode($bestSellers);
} else if (isset($_GET["query"]) && $_GET["query"] == "categories") {
    $categories = $dbh->getCategories();
    echo json_encode($categories);
} else {
    echo json_encode(array("error" => "Invalid query"));
}
