<section>
    <h2><?php echo(count($listaArticoli)) ?> articoli nell'ordine:</h2>
    <?php foreach ($listaArticoli as $articolo): ?>
        <h3><?php echo($articolo["nome"]) ?></h3>
        <p>Quantità: <?php echo($articolo["quantita"]) ?></p>
        <p>Prezzo: <?php echo($articolo["prezzo"]) ?>€</p>
        <p>Prezzo parziale: <?php echo($articolo["prezzo"] * $articolo["quantita"]) ?>€</p>
    <?php endforeach; ?>
</section>
<section>
    <h2>Totale: <?php echo(calculateTotal($listaArticoli)) ?>€</h2>
    <form id="checkout-form" action="checkout.php" method="post" onsubmit='checkout()'>
        <input form="checkout-form" type="submit" name="submit" value="checkout">
        <input form="checkout-form" type="hidden" name="boughtArticles" value='<?php echo(json_encode($listaArticoli, JSON_HEX_APOS | JSON_HEX_QUOT)) ?>'>
    </form>
</section>
