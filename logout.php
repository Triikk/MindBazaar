<?php

require_once 'bootstrap.php';

if (isset($_SESSION["username"])) {
    unset($_SESSION["username"]);
    unset($_SESSION["admin"]);
    unset($userParams);
}

header("location: index.php");
