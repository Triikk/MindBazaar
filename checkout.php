<?php
require_once './bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

if (isset($_REQUEST["submit"]) && $_REQUEST["submit"] == "ordina") {
    $listaArticoli = json_decode($_REQUEST["orderedArticles"], true);
}

//Base Template
$templateParams["titolo"] = "MindBazaar - Checkout";
//Home Template
$templateParams["nome"] = "orderCheckout.php";
// $templateParams["js"] = array("js/checkout.js");


require 'template/base.php';
