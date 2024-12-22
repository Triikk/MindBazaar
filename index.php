<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "MindBazaar";
//Home Template
$templateParams["nome"] = "homepage.php";
$templateParams["prodotti"] = $dbh->getProducts();
// $templateParams["bestSeller"] = $dbh->getBestSeller();

require 'template/base.php';
?>