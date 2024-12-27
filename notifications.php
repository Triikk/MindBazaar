<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

$templateParams["titolo"] = "MindBazaar - Notifiche";
$templateParams["nome"] = "userNotifications.php";
$templateParams["js"] = array("js/notifications.js");

require 'template/base.php';
