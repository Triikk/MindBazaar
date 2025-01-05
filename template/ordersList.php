<section>
    <div class="text-center">
        <h2>I tuoi ordini</h2>
    </div>
    <div class="container mt-5">
        <div class="row">
            <?php foreach ($orders as $order): ?>
                <a name="ord-<?php echo ($order["id"]) ?>"></a>
                <div class="col-12 mb-4" name=""> <!-- Full width card in each row -->
                    <div class="card">
                        <div class="card-body">
                            <!-- Order General Info -->
                            <h3 class="card-title">Ordine n.<?php echo ($order["id"]) ?> del <?php echo date('d-m-Y', strtotime($order["tempo_ordinazione"])); ?></h3>

                            <!-- Articles List for the Order -->
                            <ul class="list-group list-group-flush">
                                <?php
                                $articoli = $dbh->getArticlesByOrderId($order["id"]);
                                foreach ($articoli as $article): ?>
                                    <li class="list-group-item d-flex align-items-center">
                                        <!-- Article Image -->
                                        <img src="<?php echo getImagePath($article["nome_categoria"], $article["immagine"]); ?>"
                                            alt="<?php echo ($article["nome"]) ?>"
                                            class="img-fluid"
                                            style="width: 250px; height: auto;">

                                        <!-- Horizontal Space Between Image and Text -->
                                        <div class="ms-3"> <!-- 'ms-3' adds a margin start to the text div -->
                                            <h4><?php echo ($article["nome"]) ?></h4>
                                            <p>Categoria: <?php echo ($article["nome_categoria"]) ?></p>
                                            <p>Quantità: <?php echo ($article["quantita"]) ?></p>
                                            <p>Prezzo: <?php echo ($article["prezzo"]) ?>€</p>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                            <!-- Order Total and State -->
                            <p class="mt-3"><strong>Totale: </strong><?php echo (calculateTotal($articoli)) ?>€</p>
                            <p><strong>Stato: </strong><?php echo (getOrderState($order["tempo_spedizione"], $order["tempo_consegna"])) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>



</section>