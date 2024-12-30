<?php

require 'bootstrap.php';

if (!isset($_SESSION["admin"]) || !$_SESSION["admin"] || !isset($_POST["id_prodotto"]) || !isset($_POST["versione"])) {
    header("location: index.php");
}

if (isset($_POST["submit"])) {
    $dbh->updateArticle($_POST["id_prodotto"], $_POST["versione"], $_POST["disponibilita"], $_POST["prezzo"]);
}

$templateParams["titolo"] = "MindBazaar Admin - Modifica Articolo";
$templateParams["nome"] = "modifySingleArticle.php";

$templateParams["js"][] = "js/modifyArticle.js";

require 'template/base.php';
