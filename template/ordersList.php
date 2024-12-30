<section>
<h2>I tuoi ordini:</h2>
    <ul>
        <?php foreach ($orders as $order): ?>
            <li>
            <a name="ord-<?php echo($order["id"])?>"></a>
            <h3>Ordine n.<?php echo($order["id"])?> del <?php $order["tempo_ordinazione"]?></h3>
            <ul>
                <?php 
                $articoli = $dbh->getArticlesByOrderId($order["id"]);
                foreach ($articoli as $article): ?>
                    <li>
                        <h4><?php echo($article["nome"]) ?></h4>
                        <p>Categoria: <?php echo($article["nome_categoria"])?></p>
                        <p>Quantita: <?php echo($article["quantita"])?></p>
                        <p>Prezzo: <?php echo($article["prezzo"])?>€</p>
                    </li >
                <?php endforeach; ?>
            </ul>
            <p>Totale: <?php echo(calculateTotal($articoli))?>€</p>
            <p>Stato: <?php echo(getOrderState($order["tempo_spedizione"], $order["tempo_consegna"]))?></p>
            </li >
        <?php endforeach; ?>
    </ul>
</section>
