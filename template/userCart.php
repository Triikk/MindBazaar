<?php
if (!isset($_SESSION["username"])) {
    header("location: login.php");
}
/*
if (isset($_POST["submit"]) && $_POST["submit"] == "modify-amount") {
    $id_prod_articolo_in_carrello = $_POST["id_prod_articolo_in_carrello"];
    $quantita_articolo_in_carrello = $_POST["quantita_articolo_in_carrello"];
    $versione_articolo_in_carrello = $_POST["versione_articolo_in_carrello"];
    echo "RESULT: " . $dbh->modifyCartAmount($id_prod_articolo_in_carrello, $quantita_articolo_in_carrello, $_SESSION["username"], $versione_articolo_in_carrello);
    $userParams["articoliInCarrello"] = $dbh->getCartArticles($_SESSION["username"]);
}
*/
?>

<?php /*
<section>
    <h2>Numero articoli presenti: <?php echo count($userParams["articoliInCarrello"]); ?></h2>
    <h2>Totale provvisorio: <?php echo calculateTotal($userParams["articoliInCarrello"]); ?>€</h2>
</section>
<section>
    <form id="checkout-form" action="utils/checkout.php" method="post">
        <input form="checkout-form" type="submit" name="submit" value="checkout">
    </form>
    <ul>
        <?php $index = 0; ?>
        <?php foreach ($userParams["articoliInCarrello"] as $articoloInCarrello): ?>
            <li>
                <h3><?php echo $articoloInCarrello["nome"] ?></h3>
                <p>Prezzo: <?php echo $articoloInCarrello["prezzo"] ?>€</p>
                <p>Formato: <?php echo $articoloInCarrello["formato"] ?>, intensità: <?php echo $articoloInCarrello["intensita"] ?>, durata: <?php echo $articoloInCarrello["durata"] ?></p>
                <p>Quantità: <?php echo $articoloInCarrello["quantita"] ?></p>
                <p>Disponibilità: <?php echo showAvailability($articoloInCarrello["disponibilita"]) ?></p>
                <form id="modify-amount-<?php echo $index; ?>" action="cart.php" method="post">
                    <input form="modify-amount-<?php echo $index; ?>" type="hidden" name="id_prod_articolo_in_carrello" value="<?php echo $articoloInCarrello["id_prodotto"] ?>">
                    <input form="modify-amount-<?php echo $index; ?>" type="hidden" name="versione_articolo_in_carrello" value="<?php echo $articoloInCarrello["versione_articolo"] ?>">
                    <input form="modify-amount-<?php echo $index; ?>" type="number" name="quantita_articolo_in_carrello" value="<?php echo $articoloInCarrello["quantita"] ?>">
                    <input form="modify-amount-<?php echo $index; ?>" type="submit" name="submit" value="modify-amount">
                    <input type="checkbox" form="modify-amount-<?php echo $index; ?>" name="include" value="false">
                </form>
            </li>
            <?php $index++; ?>
        <?php endforeach; ?>
    </ul>
    </section>
*/
?>

<section>
    <h2>Numero articoli presenti:</h2>
    <h2>Totale provvisorio: </h2>
    <form id="checkout-form" action="utils/checkout.php" method="post">
        <input form="checkout-form" type="submit" name="submit" value="checkout">
    </form>
</section>
<section>

</section>