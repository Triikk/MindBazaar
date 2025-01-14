<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

$templateParams["titolo"] = "MindBazaar - Informazioni personali";
$templateParams["nome"] = "userPersonalInfo.php";
$userParams["datiUtente"] = $dbh->getUserDataByUsername($_SESSION["username"]);

require 'template/base.php';
