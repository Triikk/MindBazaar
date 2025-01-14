<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

$templateParams["titolo"] = "MindBazaar - Carrello";
$templateParams["nome"] = "userCart.php";
$templateParams["js"][] = "js/cart.js";

require 'template/base.php';
