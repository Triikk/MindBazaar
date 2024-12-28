<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

//Base Template
$templateParams["titolo"] = "MindBazaar - Informazioni personali";
//Home Template
$templateParams["nome"] = "userPersonalInfo.php";
$userParams["datiUtente"] = $dbh->getUserDataByUsername($_SESSION["username"]);

require 'template/base.php';
