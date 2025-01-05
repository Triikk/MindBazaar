<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "MindBazaar - Articoli";
//Home Template
$templateParams["nome"] = "articlesList.php";

$filterCategories = [];
foreach ($templateParams["categorie"] as $categoria) {
    $filterCategories[] = $categoria["nome"];
}
$filterMinPrice = 0;
$filterMaxPrice = 1000;
$filterFormats = [];
foreach ($userParams["formati"] as $formato) {
    $filterFormats[] = $formato["formato"];
}
$filterOrdinamento = "";
$filterMinAge = 0;
$searchKey = "";

if (isset($_GET["ordinamento"])) {
    echo "ordinamento was set";
    $filterOrdinamento = $_GET["ordinamento"];
}
if (isset($_GET["prezzoMin"])) {
    echo "prezzoMin was set";
    $filterMinPrice = $_GET["prezzoMin"];
}
if (isset($_GET["prezzoMax"])) {
    echo "prezzoMax was set";
    $filterMaxPrice = $_GET["prezzoMax"];
}
if (isset($_GET["etaMinima"])) {
    echo "etaMinima was set";
    $filterMinAge = $_GET["etaMinima"];
}
if (isset($_GET["categorie"])) {
    echo "categorie was set";
    var_dump($_GET["categorie"]);
    $filterCategories = $_GET["categorie"];
}
if (isset($_GET["formati"])) {
    echo "formati was set";
    $filterFormats = $_GET["formati"];
}

$articoliCercati = [];
if (isset($_GET["ricerca"])) {
    echo "riceca was set";
    var_dump($_GET["ricerca"]);
    $searchKey = $_GET["ricerca"];

    $articoliCercati = searchArticles($userParams["articoli"], $searchKey);
} else {
    $articoliCercati = $userParams["articoli"];
}

$userParams["articoliVisualizzati"] = getFilteredArticles($articoliCercati, $filterCategories, $filterMinPrice, $filterMaxPrice, $filterFormats, $filterOrdinamento);

require 'template/base.php';
