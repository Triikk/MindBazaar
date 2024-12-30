<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (checkUserLoggedIn()) {
    if (isset($_REQUEST["query"])) {
        switch ($_REQUEST["query"]) {
            case "orderNotifications":
                $orderNotifications = $dbh->getOrderNotificationsByUserId($_SESSION["username"]);
                echo jsonResponse(200, $orderNotifications);
                break;
            case "articleNotifications":
                $articleNotifications = $dbh->getArticleNotificationsByUserId($_SESSION["username"]);
                echo jsonResponse(200, $articleNotifications);
                break;
            case "generateNotifications":
                $orderNotifications = $dbh->generateOrderNotifications($_SESSION["username"]);
                echo jsonResponse(200, $orderNotifications);
                break;
            case "unreadANotifications":
                $unreadNotifications = $dbh->getUnreadANotificationsByUsername($_SESSION["username"]);
                echo jsonResponse(200, $unreadNotifications);
                break;
            case "unreadONotifications":
                $unreadNotifications = $dbh->getUnreadONotificationsByUsername($_SESSION["username"]);
                echo jsonResponse(200, $unreadNotifications);
                break;
            case "readNotifications":
                $userNotifications = $dbh->readUserNotifications($_SESSION["username"]);
                echo jsonResponse(200, $userNotifications);
                break;
            default:
                echo jsonResponse(400, array("error" => "Invalid query"));
                break;
        }
    } else {
        echo jsonResponse(400, "`query` field not set");
    }
} else {
    echo jsonResponse(400, "User not logged in");
}
