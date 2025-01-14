<section class="container my-4">
    <?php
    $id_prodotto = $_REQUEST["id_prodotto"];
    $versione = $_REQUEST["versione"];
    $articolo = $dbh->getArticle($id_prodotto, $versione);
    ?>

    <div class="card mx-auto modifyArticleSection">
        <div class="card-body">
            <h2 class="card-title text-center mb-4"><?php echo $articolo["nome"]; ?></h2>
            <div class="row mb-3">
                <div class="col-12 col-md-4 text-center">
                    <img src="<?php echo getImagePath($articolo["nome_categoria"], $articolo["immagine"]); ?>"
                        alt=""
                        class="img-fluid singleProduct-image" />
                </div>
                <div class="col-12 col-md-8">
                    <p class="card-text"><strong>Descrizione:</strong> <?php echo $articolo["descrizione"]; ?></p>
                    <p class="card-text"><strong>Formato:</strong> <?php echo $articolo["formato"]; ?></p>
                    <p class="card-text"><strong>Intensità:</strong> <?php echo $articolo["intensita"]; ?></p>
                    <p class="card-text"><strong>Durata:</strong> <?php echo $articolo["durata"]; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mx-auto mt-4 modifyArticleSection">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Modifica Articolo</h3>
            <form action="modifyArticle.php" id="form" method="POST">
                <div class="mb-3">
                    <label for="disponibilita" class="form-label">Disponibilità</label>
                    <input type="number" id="disponibilita" name="disponibilita" value="<?php echo $articolo["disponibilita"]; ?>" min="0" class="form-control" required />
                </div>
                <div class="mb-3">
                    <label for="prezzo" class="form-label">Prezzo</label>
                    <input type="number" id="prezzo" name="prezzo" value="<?php echo $articolo["prezzo"]; ?>" min="0" step="0.01" class="form-control" required />
                </div>
                <input type="hidden" name="id_prodotto" value="<?php echo $articolo["id_prodotto"]; ?>" />
                <input type="hidden" name="versione" value="<?php echo $articolo["versione"]; ?>" />
                <div class="text-center">
                    <input type="submit" id="modify" name="submit" value="Applica Modifiche" class="w-100 btn btn-secondary clickable" />
                </div>
            </form>
        </div>
    </div>
</section>