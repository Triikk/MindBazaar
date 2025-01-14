<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

$templateParams["titolo"] = "MindBazaar - Ordini";
$templateParams["nome"] = "ordersList.php";

$orders = $dbh->getOrdersByUsername($_SESSION["username"]);

require 'template/base.php';
