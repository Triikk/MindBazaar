<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

//Base Template
$templateParams["titolo"] = "MindBazaar - Ordini";
//Home Template
$templateParams["nome"] = "ordersList.php";
$templateParams["ordini"] = $dbh->getOrdersById($_SESSION["username"]);

require 'template/base.php';
