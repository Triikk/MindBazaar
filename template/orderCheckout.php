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
    <form id="checkout-form" action="orders.php" method="post">
        <input form="checkout-form" type="submit" name="submit" value="checkout">
        <input form="checkout-form" type="hidden" name="orderedArticles" value='<?php echo(json_encode($listaArticoli)) ?>'>
    </form>
</section>
