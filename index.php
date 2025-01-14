<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "MindBazaar";
//Home Template
$templateParams["nome"] = "homepage.php";

$templateParams["js"][] = "js/homepage.js";

require 'template/base.php';
