<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

//Base Template
$templateParams["titolo"] = "MindBazaar - Carrello";
//Home Template
$templateParams["nome"] = "userCart.php";
$userParams["articoliInCarrello"] = $dbh->getCartArticles($_SESSION["username"]);

require 'template/base.php';
