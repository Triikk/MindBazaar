<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "MindBazaar - Registrazione";
$templateParams["nome"] = "signinForm.php";

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $dataNascita = $_POST["dataNascita"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if ($dbh->checkUsername($username)) {
        $templateParams["errore"] = "Username già in uso";
    } else {
        echo $password;
        echo $dataNascita;
        $result = $dbh->registerUser($username, $nome, $cognome, $dataNascita, $password);
        if ($result) {
            header("location: login.php");
            exit;
        } else {
            var_dump($result);
            die("Errore durante la query di registrazione");
            exit;
        }
        exit;
    }
}

require 'template/base.php';
