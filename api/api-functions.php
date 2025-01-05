<?php
require_once '../bootstrap.php';
require_once '../utils/functions.php';

header('Content-Type: application/json');

if (isset($_REQUEST["query"])) {
    switch ($_REQUEST["query"]) {
        case "getImagePath":
            echo jsonResponse(200, getImagePath($_REQUEST["category"], $_REQUEST["image"]));
            break;
        case "getAdminImagePath":
            echo jsonResponse(200, getAdminImagePath($_REQUEST["action"]));
            break;
        case "getCategoryImagePath":
            echo jsonResponse(200, getCategoryImagePath($_REQUEST["category"]));
            break;
        default:
            echo jsonResponse(400, "Invalid query");
    }
} else {
    echo jsonResponse(400, "`query` field not set");
}
