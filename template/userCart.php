<?php
if (!isset($_SESSION["username"])) {
    header("location: login.php");
}
if (isset($_POST["submit"]) && $_POST["submit"] == "modify-amount") {
    $id_prod_articolo_in_carrello = $_POST["id_prod_articolo_in_carrello"];
    $quantita_articolo_in_carrello = $_POST["quantita_articolo_in_carrello"];
    $username_articolo_in_carrello = $_POST["username_articolo_in_carrello"];
    $versione_articolo_in_carrello = $_POST["versione_articolo_in_carrello"];
    $dbh->modifyCartAmount($id_prod_articolo_in_carrello, $quantita_articolo_in_carrello, $username_articolo_in_carrello, $versione_articolo_in_carrello);
    $templateParams["articoliInCarrello"] = $dbh->getCartArticles($_SESSION["username"]);
}

?>

<section>
    <h2>Numero articoli presenti: <?php echo count($templateParams["articoliInCarrello"]); ?></h2>
</section>
<section>
    <form id="checkout-form" action="checkout.php" method="post">
        <input form="checkout-form" type="submit" name="submit" value="checkout">
    </form>
    <ul>
        <?php $index = 0; ?>
        <?php foreach ($templateParams["articoliInCarrello"] as $articoloInCarrello): ?>
            <li>
                <h3><?php echo $articoloInCarrello["nome"] ?></h3>
                <p>Prezzo: <?php echo $articoloInCarrello["prezzo"] ?>€</p>
                <p>Id_prodotto: <?php echo $articoloInCarrello["id_prodotto"] ?></p>
                <p>Quantità: <?php echo $articoloInCarrello["quantita"] ?></p>
                <p>Disponibilità: <?php echo showAvailability($articoloInCarrello["disponibilita"]) ?></p>
                <form id="modify-amount-<?php echo $index; ?>" action="cart.php" method="post">
                    <input form="modify-amount-<?php echo $index; ?>" type="hidden" name="id_prod_articolo_in_carrello" value="<?php echo $articoloInCarrello["id_prodotto"] ?>">
                    <input form="modify-amount-<?php echo $index; ?>" type="hidden" name="versione_articolo_in_carrello" value="<?php echo $articoloInCarrello["versione_articolo"] ?>">
                    <input form="modify-amount-<?php echo $index; ?>" type="hidden" name="username_articolo_in_carrello" value="<?php echo $articoloInCarrello["username"] ?>">
                    <input form="modify-amount-<?php echo $index; ?>" type="number" name="quantita_articolo_in_carrello" value="<?php echo $articoloInCarrello["quantita"] ?>">
                    <input form="modify-amount-<?php echo $index; ?>" type="submit" name="submit" value="modify-amount">
                </form>
            </li>
            <?php $index++; ?>
        <?php endforeach; ?>
    </ul>
</section>