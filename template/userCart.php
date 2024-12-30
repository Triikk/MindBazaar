<?php
if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

if (isset($_REQUEST["ordineEffettuato"]) && $_REQUEST["ordineEffettuato"] == "false"): ?>
    <section>
        <h2>Qualcosa è andato storto: ordine non effettuato</h2>
    </section>
<?php endif; ?>

<section id="cart-info">
    <h2>Numero articoli presenti:</h2>
    <h2>Totale provvisorio: </h2>
    <form id="createOrder-form" action="checkout.php" method="post" onsubmit='createOrder()'>
        <input form="createOrder-form" type="submit" name="submit" value="ordina">
        <input form="createOrder-form" type="hidden" name="orderedArticles" value="">
    </form>
</section>
<section id="cart-Articles">
</section>
