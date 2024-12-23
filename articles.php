<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "MindBazaar - Articoli";
//Home Template
$templateParams["nome"] = "articlesList.php";
$templateParams["articoli"] = $dbh->getArticles();
$templateParams["categorie"] = $dbh->getCategories();
// $templateParams["bestSeller"] = $dbh->getBestSeller();

$filterCategories = [];
$filterMinPrice = 0;
$filterMaxPrice = 1000;
$filterFormats = [];
$filterOrdinamento = "";
$filterMinAge = 0;

if (isset($_GET["ordinamento"])) {
    $filterOrdinamento = $_GET["ordinamento"];
}
if (isset($_GET["prezzoMin"])) {
    $filterMinPrice = $_GET["prezzoMin"];
}
if (isset($_GET["prezzoMax"])) {
    $filterMaxPrice = $_GET["prezzoMax"];
}
if (isset($_GET["etaMinima"])) {
    $filterMinAge = $_GET["etaMinima"];
}
if (isset($_GET["categorie"])) {
    $filterCategories = $_GET["categorie"];
}
if (isset($_GET["formati"])) {
    $filterFormats = $_GET["formati"];
}

$templateParams["articoli"] = getFilteredArticles($templateParams["articoli"], $filterCategories, $filterMinPrice, $filterMaxPrice, $filterFormats, $filterOrdinamento);

require 'template/base.php';
?>