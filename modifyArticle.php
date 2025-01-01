<?php

require 'bootstrap.php';

if (!isset($_SESSION["admin"]) || !$_SESSION["admin"] || !isset($_REQUEST["id_prodotto"]) || !isset($_REQUEST["versione"])) {
    header("location: index.php");
}

if (isset($_REQUEST["submit"]) && $_REQUEST["submit"] == "applica") {
    $dbh->updateArticle($_REQUEST["id_prodotto"], $_REQUEST["versione"], $_REQUEST["disponibilita"], $_REQUEST["prezzo"]);
    header("location: product.php?id_prodotto=".$_REQUEST["id_prodotto"]."&versione=".$_REQUEST["versione"]);
}

$templateParams["titolo"] = "MindBazaar Admin - Modifica Articolo";
$templateParams["nome"] = "modifySingleArticle.php";

$templateParams["js"][] = "js/modifyArticle.js";

require 'template/base.php';
