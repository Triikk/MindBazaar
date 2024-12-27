<?php

require_once 'bootstrap.php';

if (isset($_SESSION["username"])) {
    unset($_SESSION["username"]);
    unset($userParams);
}

header("location: index.php");
