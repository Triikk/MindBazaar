<?php
require_once '../bootstrap.php';
if (!isset($_SESSION["username"])) {
    header("location: ../login.php");
}
if (isset($_POST["submit"]) && $_POST["submit"] == "checkout") {
    $result = $dbh->checkout($_SESSION["username"]);
    header("location: ../index.php");
}
