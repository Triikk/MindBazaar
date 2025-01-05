<?php
require_once '../utils/functions.php';
header('Content-Type: application/json');

if (isset($_REQUEST["query"])) {
    switch ($_REQUEST["query"]) {
        case "getImagePath":
            return jsonResponse(200, getImagePath($_REQUEST["category"], $_REQUEST["image"]));
            break;
        case "getAdminImagePath":
            return jsonResponse(200, getAdminImagePath($_REQUEST["action"]));
            break;
        case "getCategoryPath":
            return jsonResponse(200, getCategoryImagePath($_REQUEST["category"]));
            break;
        default:
            return jsonResponse(400, "Invalid query");
    }
} else {
    echo jsonResponse(400, "`query` field not set");
}
