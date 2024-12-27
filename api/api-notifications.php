<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (isset($_GET["query"]) && $_GET["query"] == "orderNotifications") {
    $orderNotifications = $dbh->getOrderNotificationsByUserId($_SESSION["username"]);
    echo json_encode($orderNotifications);
} else if (isset($_GET["query"]) && $_GET["query"] == "articleNotifications") {
    $articleNotifications = $dbh->getArticleNotificationsByUserId($_SESSION["username"]);
    echo json_encode($articleNotifications);
} else {
    echo json_encode(array("error" => "Invalid query"));
}
