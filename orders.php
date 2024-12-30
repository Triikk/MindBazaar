<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

//Base Template
$templateParams["titolo"] = "MindBazaar - Ordini";
//Home Template
$templateParams["nome"] = "ordersList.php";
//$templateParams["js"][] = "js/orders.js";

$orders = $dbh->getOrdersByUsername($_SESSION["username"]);

require 'template/base.php';
