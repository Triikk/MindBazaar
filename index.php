<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "MindBazaar";
$templateParams["nome"] = "homepage.php";

$templateParams["js"][] = "js/homepage.js";

require 'template/base.php';
