<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

$templateParams["titolo"] = "MindBazaar - Notifiche";
$templateParams["nome"] = "userNotifications.php";

$templateParams["notificheArticoli"] = $dbh->getArticleNotificationsByUserId($_SESSION["username"]);
$templateParams["notificheOrdini"] = $dbh->getOrderNotificationsByUserId($_SESSION["username"]);

require 'template/base.php';
