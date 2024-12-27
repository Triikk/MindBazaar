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

require_once("utils/functions.php");
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "MindBazaar", 3306);

$templateParams["prodotti"] = $dbh->getProducts();
$templateParams["articoli"] = $dbh->getArticles();
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["formati"] = $dbh->getFormats();
