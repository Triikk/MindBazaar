<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "MindBazaar - Articoli";
$templateParams["nome"] = "articlesList.php";
$templateParams["js"][] = "js/articles.js";

$filterCategories = [];
foreach ($templateParams["categorie"] as $categoria) {
    $filterCategories[] = $categoria["nome"];
}
$filterMinPrice = 0;
$filterMaxPrice = 1000;
$filterFormats = [];
foreach ($templateParams["formati"] as $formato) {
    $filterFormats[] = $formato["formato"];
}
$filterOrdinamento = "casuale";
$filterMinAge = 0;
$searchKey = "";

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

$articoliCercati = [];
if (isset($_GET["ricerca"])) {
    $searchKey = $_GET["ricerca"];

    $articoliCercati = searchArticles($userParams["articoli"], $searchKey);
} else {
    $articoliCercati = $userParams["articoli"];
}

$userParams["articoliVisualizzati"] = getFilteredArticles($articoliCercati, $filterCategories, $filterMinPrice, $filterMaxPrice, $filterFormats, $filterOrdinamento);

require 'template/base.php';
