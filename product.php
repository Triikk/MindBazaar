<?php
require_once 'bootstrap.php';

if (!(isset($_GET["id_prodotto"]) && isset($_GET["versione"]))) {
    header("location: articles.php");
}

$templateParams["titolo"] = "MindBazaar - Prodotto";
$templateParams["nome"] = "singleProduct.php";

$templateParams["articolo"] = current(array_filter($templateParams["articoli"], function ($articolo) {
    return $articolo["id_prodotto"] == $_GET["id_prodotto"] && $articolo["versione"] == $_GET["versione"];
}));

$articoliProdotto = $dbh->getArticlesByProductId($_GET["id_prodotto"]);
$formatiProdotto = array_unique(array_column($articoliProdotto, 'formato'));
$durateProdotto = array_unique(array_column($articoliProdotto, 'durata'));
$intensitaProdotto = array_unique(array_column($articoliProdotto, 'intensita'));

require 'template/base.php';
