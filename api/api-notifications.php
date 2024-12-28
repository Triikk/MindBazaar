<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (isset($_GET["query"]) && $_GET["query"] == "orderNotifications") {
    $orderNotifications = $dbh->getOrderNotificationsByUserId($_SESSION["username"]);
    echo json_encode($orderNotifications);
} else if (isset($_GET["query"]) && $_GET["query"] == "articleNotifications") {
    $articleNotifications = $dbh->getArticleNotificationsByUserId($_SESSION["username"]);
    echo json_encode($articleNotifications);
} else if (isset($_GET["query"]) && $_GET["query"] == "generateNotifications") {
    $result = $dbh->generateOrderNotifications($_SESSION["username"]);
    echo json_encode($result);
} else if (isset($_GET["query"]) && $_GET["query"] == "unreadANotifications") {
    $unreadNotifications = $dbh->getUnreadANotificationsByUsername($_SESSION["username"]);
    echo json_encode($unreadNotifications);
} else if (isset($_GET["query"]) && $_GET["query"] == "unreadONotifications") {
    $unreadNotifications = $dbh->getUnreadONotificationsByUsername($_SESSION["username"]);
    echo json_encode($unreadNotifications);
} else if (isset($_GET["query"]) && $_GET["query"] == "readNotifications") {
    $result = $dbh->readUserNotifications($_SESSION["username"]);
    echo json_encode($result);
} else {
    echo json_encode(array("error" => "Invalid query"));
}
