<?php

require_once 'bootstrap.php';

if (isset($_SESSION["username"])) {
    // unset($_SESSION["username"]);
    // unset($_SESSION["admin"]);
    unset($userParams);
    session_destroy();
    session_start();
}

header("location: index.php");
