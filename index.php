<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "MindBazaar";
//Home Template
$templateParams["nome"] = "homepage.php";
$templateParams["articoli"] = $dbh->getArticles();
$templateParams["categorie"] = $dbh->getCategories();
// $templateParams["bestSeller"] = $dbh->getBestSeller();

$_SESSION["username"] = "MATT DESTROYER";

require 'template/base.php';
