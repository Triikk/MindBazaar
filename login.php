<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "MindBazaar - Login";
$templateParams["nome"] = "loginForm.php";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    if ($dbh->checkLogin($_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT))) {
        $_SESSION["username"] = $_POST["username"];
    } else {
        $templateParams["errore"] = "Credenziali non corrette!";
    }
}

if (isset($_SESSION["username"])) {
    header("location: personalArea.php");
}

require 'template/base.php';
