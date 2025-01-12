<section>
<div class="col-12 col-md-8 mb-4 mx-auto">
<div class="card d-flex flex-column position-relative cartArticleCard">
    <div class="card-body">
        <h2 class="card-title">Dettagli dell'ordine</h2>
        <p class="card-subtitle pb-3"><?php echo(count($listaArticoli)) ?> articol<?php
        if (count($listaArticoli) > 1) {
            echo("i");
        } else {
            echo("o");
        } ?> nell'ordine</p>
        <p><b>Totale: <?php echo(calculateTotal($listaArticoli)) ?>€</b></p>
        <form id="checkout-form" action="checkout.php" method="post" onsubmit='checkout()'>
            <input form="checkout-form" type="submit" name="submit" value="checkout" class="btn btn-success btn-lg btn-block w-100" />
            <input form="checkout-form" type="hidden" name="boughtArticles" value='<?php echo(json_encode($listaArticoli, JSON_HEX_APOS | JSON_HEX_QUOT)) ?>' />
        </form>
    </div>
</div>
</div>
</section>
<section>
<div class="col-12 col-md-8 mb-4 mx-auto">
    <?php foreach ($listaArticoli as $articolo): ?>
        <div class="card mb-2 d-flex flex-column position-relative cartArticleCard">
        <div class="card-body">
            <h3 class="card-title"><?php echo($articolo["nome"]) ?></h3>
            <p class="card-subtitle pb-3">Quantità: <?php echo($articolo["quantita"]) ?></p>
            <p class="card-text">Prezzo: <?php echo($articolo["prezzo"]) ?>€</p>
            <p class="card-text">Prezzo parziale: <?php echo($articolo["prezzo"] * $articolo["quantita"]) ?>€</p>
        </div>
        </div>
    <?php endforeach; ?>
</div>
</section>
