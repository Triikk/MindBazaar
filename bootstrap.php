<?php
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
?>