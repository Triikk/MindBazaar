<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "MindBazaar - Articoli";
//Home Template
$templateParams["nome"] = "articlesList.php";
$templateParams["articoli"] = $dbh->getArticles();
$templateParams["categorie"] = $dbh->getCategories();
// $templateParams["bestSeller"] = $dbh->getBestSeller();

require 'template/base.php';
