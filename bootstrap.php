<?php
session_start();
define("UPLOAD_DIR", "./upload/");
define("CATEGORIES_DIR", UPLOAD_DIR . "categories/");
define("PRODUCTS_DIR", UPLOAD_DIR . "products/");
// require_once("utils/functions.php");
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "mindbazaar", 3306);
?>