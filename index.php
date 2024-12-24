<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "MindBazaar";
//Home Template
$templateParams["nome"] = "homepage.php";
$templateParams["bestSellers"] = $dbh->getBestSellers(1);

$_SESSION["username"] = "MATT DESTROYER";

session_destroy();

require 'template/base.php';
