<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "MindBazaar";
//Home Template
$templateParams["nome"] = "homepage.php";

$templateParams["js"] = array("js/homepage.js");

$_SESSION["username"] = "BEG IL SUPREMO";
$_SESSION["admin"] = true;
// unset($_SESSION["username"]);

require 'template/base.php';
