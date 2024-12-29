<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

if (isset($_REQUEST["submit"]) && $_REQUEST["submit"] == "checkout") {
    $listaArticoli = json_decode($_REQUEST["orderedArticles"], true);
    $result = $dbh->checkout($_SESSION["username"], $listaArticoli);
    // header("location: ./index.php");
}

//Base Template
$templateParams["titolo"] = "MindBazaar - Ordini";
//Home Template
$templateParams["nome"] = "ordersList.php";
$templateParams["js"][] = "js/orders.js";

require 'template/base.php';
