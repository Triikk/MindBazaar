<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

//Base Template
$templateParams["titolo"] = "MindBazaar - Area Personale";
//Home Template
$templateParams["nome"] = "userPersonalArea.php";

require 'template/base.php';
