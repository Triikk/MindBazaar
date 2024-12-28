<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "MindBazaar";
//Home Template
$templateParams["nome"] = "homepage.php";

$templateParams["js"][] = "js/homepage.js";

// $_SESSION["username"] = "BEG IL SUPREMO";
// unset($_SESSION["username"]);

require 'template/base.php';
