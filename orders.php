<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

//Base Template
$templateParams["titolo"] = "MindBazaar - Ordini";
//Home Template
$templateParams["nome"] = "ordersList.php";
$templateParams["ordini"] = $dbh->getOrdersByUsername($_SESSION["username"]);

$ordiniConListaArticoli = array();
$i = 0;
foreach ($templateParams["ordini"] as $ordine) {
    $listaArticoli = $dbh->getArticlesByOrderId($ordine["id"]);
    $articoliOrdini[$i] = $listaArticoli;
    $tuple = [$ordine, $listaArticoli];
    $ordiniConListaArticoli[$i] = $tuple;
    $i++;
}
$templateParams["ordiniConListaArticoli"] = $ordiniConListaArticoli;



require 'template/base.php';
