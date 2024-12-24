<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "MindBazaar";
//Home Template
$templateParams["nome"] = "homepage.php";
$templateParams["bestSellers"] = $dbh->getBestSellers(1);

$_SESSION["username"] = "alexBan";

require 'template/base.php';
