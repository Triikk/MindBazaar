<?php
require_once './bootstrap.php';

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

if (isset($_REQUEST["submit"]) && $_REQUEST["submit"] == "ordina") {
    $listaArticoli = json_decode($_REQUEST["orderedArticles"], true);
} else if (isset($_REQUEST["submit"]) && $_REQUEST["submit"] == "checkout") {
    $articoliAcquistati = json_decode($_REQUEST["boughtArticles"], true);
    $success = $dbh->checkout($_SESSION["username"], $articoliAcquistati);
    if ($success) : ?>
        <form id="redirect" action="orders.php" method="post">
            <input type="hidden" name="ordineEffettuato" value="true">
        </form>
        <script type="text/javascript">
            alert("Ordine effettuato con successo!!!");
            document.getElementById('redirect').submit();
        </script>
    <?php else : ?>
        <form id="redirect" action="cart.php" method="post">
            <input type="hidden" name="ordineEffettuato" value="false">
        </form>
        <script type="text/javascript">
            alert("Qualcosa è andato storto: ordine non effettuato");
            document.getElementById('redirect').submit();
        </script>
    <?php endif; 
}

//Base Template
$templateParams["titolo"] = "MindBazaar - Checkout";
//Home Template
$templateParams["nome"] = "orderCheckout.php";

require 'template/base.php';

?>