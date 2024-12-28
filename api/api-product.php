<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (isset($_GET["query"]) && $_GET["query"] == "getArticleInfo" && isset($_GET["id_prodotto"]) && isset($_GET["formato"]) && isset($_GET["durata"]) && isset($_GET["intensita"])) {
    $formato = $_GET["formato"];
    $durata = $_GET["durata"];
    $intensita = $_GET["intensita"];
    $id_prodotto = $_GET["id_prodotto"];
    $articleInfo = $dbh->getArticleInfo($id_prodotto, $formato, $durata, $intensita);
    if ($articleInfo == false) {
        echo json_encode(array("id_prodotto" => $id_prodotto, "formato" => $formato, "durata" => $durata, "intensita" => $intensita, "prezzo" => 0, "disponibilita" => "Questo prodotto non è disponibile"));
        return;
    }
    echo json_encode($articleInfo);
} else {
    echo json_encode(array("error" => "Invalid query"));
}
