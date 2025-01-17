<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "MindBazaar - Login";
$templateParams["nome"] = "loginForm.php";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    if ($dbh->checkLogin($_POST["username"], $_POST["password"])) {
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["admin"] = $dbh->isAdmin($_POST["username"]);
    } else {
        $userParams["errore"] = "Credenziali non corrette!";
    }
}

if (isset($_SESSION["username"])) {
    header("location: personalArea.php");
}

require 'template/base.php';
