<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

//Base Template
$templateParams["titolo"] = "MindBazaar - Ordini";
//Home Template
$templateParams["nome"] = "ordersList.php";
$templateParams["js"] = array("js/orders.js");

require 'template/base.php';
