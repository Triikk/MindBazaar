<?php

require 'bootstrap.php';

if (!isset($_SESSION["admin"]) || !$_SESSION["admin"]) {
    header("location: index.php");
}

$templateParams["titolo"] = "MindBazaar Admin - Aggiungi Articolo";
$templateParams["nome"] = "addSingleArticle.php";

$templateParams["js"][] = "js/addArticle.js";

require 'template/base.php';
