<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

$templateParams["titolo"] = "MindBazaar - Area Personale";
$templateParams["nome"] = "userPersonalArea.php";

require 'template/base.php';
