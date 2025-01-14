<?php

require_once '../bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: ../login.php");
} elseif (isset($_POST["submit"])) {
    $versioneArticolo = $dbh->getArticleVersion($_POST["id_prodotto"], $_POST["formato"], $_POST["durata"], $_POST["intensita"]);
    $dbh->addToCart($_SESSION["username"], $_POST["id_prodotto"], $versioneArticolo, $_POST["quantita"]);
    header("location: ../articles.php");
} else {
    header("location: ../articles.php");
}
