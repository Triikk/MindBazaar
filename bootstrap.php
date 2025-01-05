<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

define("UPLOAD_DIR", "./upload/");
define("CATEGORIES_DIR", UPLOAD_DIR . "categories/");
define("PRODUCTS_DIR", UPLOAD_DIR . "products/");
define("DREAMS_DIR", PRODUCTS_DIR . "sogni/");
define("NOTIONS_DIR", PRODUCTS_DIR . "nozioni/");
define("INSPIRATIONS_DIR", PRODUCTS_DIR . "ispirazioni/");
define("EMOTIONS_DIR", PRODUCTS_DIR . "emozioni/");
define("ICONS_DIR", UPLOAD_DIR . "icons/");
define("ADMIN_DIR", ICONS_DIR . "admin/");
define("LOGOS_DIR", ICONS_DIR . "logos/");
define("FORMATS_DIR", ICONS_DIR . "formats/");
define("SYMBOLS_DIR", ICONS_DIR . "symbols/");

require_once("utils/functions.php");
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "MindBazaar", 3306);

$templateParams["prodotti"] = $dbh->getProducts();
$userParams["articoli"] = $dbh->getArticles();
$templateParams["categorie"] = $dbh->getCategories();
$userParams["formati"] = $dbh->getFormats();
$templateParams["js"] = array("js/functions.js", "js/checkNotifications.js");
