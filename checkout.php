<?php
require_once './bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

if (isset($_REQUEST["submit"]) && $_REQUEST["submit"] == "ordina") {
    $listaArticoli = json_decode($_REQUEST["orderedArticles"], true);
} else if (isset($_REQUEST["submit"]) && $_REQUEST["submit"] == "checkout") {
    $articoliAcquistati = json_decode($_REQUEST["boughtArticles"], true);
    $success = $dbh->checkout($_SESSION["username"], $articoliAcquistati);
    if ($success) {
        // alert ?
        header("location: orders.php");
    } else {
        // alert ?
        header("location: cart.php");
    }
}

//Base Template
$templateParams["titolo"] = "MindBazaar - Checkout";
//Home Template
$templateParams["nome"] = "orderCheckout.php";

require 'template/base.php';
