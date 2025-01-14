<section>
    <div class="text-center">
        <h2>I tuoi ordini</h2>
    </div>
    <div class="container mt-5">
        <div class="row">
            <?php foreach ($orders as $order): ?>
                <a name="ord-<?php echo ($order["id"]) ?>"></a>
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-center">
                                Ordine n.<?php echo ($order["id"]) ?> del <?php echo date('d-m-Y', strtotime($order["tempo_ordinazione"])); ?>
                            </h3>

                            <ul class="list-group list-group-flush">
                                <?php
                                $articoli = $dbh->getArticlesByOrderId($order["id"]);
                                foreach ($articoli as $article): ?>
                                    <li class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-12 col-md-4 text-center mb-3 mb-md-0">
                                                <img src="<?php echo getImagePath($article["nome_categoria"], $article["immagine"]); ?>"
                                                    alt=""
                                                    class="img-fluid singleProduct-image"/>
                                            </div>

                                            <div class="col-12 col-md-8">
                                                <h4><?php echo ($article["nome"]) ?></h4>
                                                <p>Categoria: <?php echo ($article["nome_categoria"]) ?></p>
                                                <p>Quantità: <?php echo ($article["quantita"]) ?></p>
                                                <p>Prezzo: <?php echo ($article["prezzo"]) ?>€</p>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                            <div class="mt-3">
                                <p><strong>Totale:</strong> <?php echo (calculateTotal($articoli)) ?>€</p>
                                <p><strong>Stato:</strong> <?php echo (getOrderState($order["tempo_spedizione"], $order["tempo_consegna"])) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>