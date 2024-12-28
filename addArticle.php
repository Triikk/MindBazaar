<?php

require 'bootstrap.php';

if (!isset($_SESSION["admin"]) || !$_SESSION["admin"]) {
    header("location: index.php");
}

$templateParams["titolo"] = "MindBazaar Admin - Aggiungi Prodotto";
// $templateParams["nome"] = "addSingleProduct.php";

$templateParams["js"] = array("js/addArticle.js");

require 'template/base.php';
