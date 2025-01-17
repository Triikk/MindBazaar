<?php
require_once 'bootstrap.php';

if (!(isset($_GET["id_prodotto"]) && isset($_GET["versione"]))) {
    header("location: articles.php");
}

$templateParams["titolo"] = "MindBazaar - Prodotto";
$templateParams["nome"] = "singleProduct.php";
$templateParams["js"][] = "js/product.js";

$userParams["articolo"] = current(array_filter($userParams["articoli"], function ($articolo) {
    return $articolo["id_prodotto"] == $_REQUEST["id_prodotto"] && $articolo["versione"] == $_REQUEST["versione"];
}));

$articoliProdotto = $dbh->getArticlesByProductId($_GET["id_prodotto"]);
$formatiProdotto = array_unique(array_column($articoliProdotto, 'formato'));
$durateProdotto = array_unique(array_column($articoliProdotto, 'durata'));
$intensitaProdotto = array_unique(array_column($articoliProdotto, 'intensita'));

require 'template/base.php';
