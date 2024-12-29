<?php

require 'bootstrap.php';

if (!isset($_SESSION["admin"]) || !$_SESSION["admin"] || !isset($_POST["id_prodotto"]) || !isset($_POST["versione"])) {
    header("location: index.php");
}

$templateParams["titolo"] = "MindBazaar Admin - Modifica Articolo";
$templateParams["nome"] = "modifySingleArticle.php";

$templateParams["js"][] = "js/modifyArticle.js";

require 'template/base.php';
