<?php
if (isset($_POST["username"])) {
    unset($_POST["username"]);
}
if (isset($_POST["password"])) {
    unset($_POST["password"]);
}

if (isset($_SESSION["username"])) {
    unset($_SESSION["username"]);
}

header("location: index.php");
