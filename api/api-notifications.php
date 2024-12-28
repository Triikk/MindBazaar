<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (isset($_GET["query"]) && $_GET["query"] == "orderNotifications") {
    if (API_checkUserLoggedIn()) {
        $orderNotifications = $dbh->getOrderNotificationsByUserId($_SESSION["username"]);
        echo json_encode($orderNotifications);
    }
} else if (isset($_GET["query"]) && $_GET["query"] == "articleNotifications") {
    if (API_checkUserLoggedIn()) {
        $articleNotifications = $dbh->getArticleNotificationsByUserId($_SESSION["username"]);
        echo json_encode($articleNotifications);
    }
} else {
    echo json_encode(array("error" => "Invalid query"));
}
