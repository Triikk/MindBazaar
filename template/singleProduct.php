<section class="container-fluid my-4">
    <?php $articolo = $userParams["articolo"]; ?>
    <div class="card mx-auto p-4 articlePageDescContainer">
        <div class="row">
            <div class="col-12 col-md-4 d-flex justify-content-center">
                <img src="<?php echo getImagePath($articolo["nome_categoria"], $articolo["immagine"]); ?>"
                    alt=""
                    class="img-fluid singleProduct-image" />
            </div>
            <div class="col-12 col-md-8">
                <h2><?php echo $articolo["nome"]; ?></h2>
                <p id="availability"><strong>Disponibilità:</strong> <?php echo showAvailability($articolo["disponibilita"]); ?></p>
                <p id="price"><strong>Prezzo:</strong> <?php echo "€" . $articolo["prezzo"]; ?></p>
            </div>
        </div>

        <div class="mt-3">
            <p><?php echo $articolo["descrizione"]; ?></p>
        </div>

        <form action="template/addToCart.php" id="product-details-selection-form" method="POST" onchange="updateProductDetails()">
            <input type="hidden" name="id_prodotto" value="<?php echo $articolo["id_prodotto"]; ?>" />

            <div class="mb-3 row">
                <fieldset>
                    <legend class="col-12 col-md-4 col-form-label">Formato:</legend>
                    <div class="col-12 col-md-8">
                        <div class="d-flex flex-wrap">
                            <?php foreach ($formatiProdotto as $formato): ?>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="formato_<?php echo str_replace(' ', '-', $formato); ?>">
                                        <?php echo $formato; ?>
                                    </label>
                                    <input class="form-check-input" type="radio" name="formato"
                                        id="formato_<?php echo str_replace(' ', '-', $formato); ?>" value="<?php echo $formato; ?>"
                                        <?php if ($formato == $articolo["formato"]) echo "checked"; ?> />
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="mb-3 row">
                <fieldset>
                    <legend class="col-12 col-md-4 col-form-label">Durata:</legend>
                    <div class="col-12 col-md-8">
                        <div class="d-flex flex-wrap">
                            <?php foreach ($durateProdotto as $durata): ?>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="durata_<?php echo str_replace(' ', '-', $durata); ?>">
                                        <?php echo $durata; ?>
                                    </label>
                                    <input class="form-check-input" type="radio" name="durata"
                                        id="durata_<?php echo str_replace(' ', '-', $durata); ?>" value="<?php echo $durata; ?>"
                                        <?php if ($durata == $articolo["durata"]) echo "checked"; ?> />
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="mb-3 row">
                <fieldset>
                    <legend class="col-12 col-md-4 col-form-label">Intensità:</lege>
                    <div class="col-12 col-md-8">
                        <div class="d-flex flex-wrap">
                            <?php foreach ($intensitaProdotto as $intensita): ?>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="intensita_<?php echo $intensita; ?>">
                                        <?php echo $intensita; ?>
                                    </label>
                                    <input class="form-check-input" type="radio" name="intensita"
                                        id="intensita_<?php echo $intensita; ?>" value="<?php echo $intensita; ?>"
                                        <?php if ($intensita == $articolo["intensita"]) echo "checked"; ?> />
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="mb-3 row">
                <label for="quantity" class="col-12 col-md-4 col-form-label">Quantità:</label>
                <div class="col-12 col-md-8">
                    <input type="number" id="quantity" name="quantita" min="1" max="<?php echo $articolo["disponibilita"]; ?>"
                        class="form-control" value="1" aria-label="Quantity Picker" />
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" id="add-to-cart" name="submit" class="btn btn-secondary btn-lg w-100 w-md-75 clickable">
                    Aggiungi al carrello
                </button>
            </div>
        </form>

        <!-- Visible only for admins -->
        <?php if (isset($_SESSION["username"]) && isset($_SESSION["admin"]) && $_SESSION["admin"]): ?>
            <div class="mt-4 adminArticleActions">
                <ul class="list-unstyled row">
                    <li class="col-12 col-md-6 text-center mb-3">
                        <img src='<?php echo getAdminImagePath("modifyArticle"); ?>' class="img-fluid p-1" alt="" />
                        <form action='modifyArticle.php' id='modify-article' method='POST'>
                            <input type='hidden' name='id_prodotto' value='<?php echo $articolo["id_prodotto"]; ?>' />
                            <input type='hidden' name='versione' value='<?php echo $articolo["versione"]; ?>' />
                            <input type='submit' name='submit' class="btn btn-warning" value='Modifica' />
                        </form>
                    </li>
                    <li class="col-12 col-md-6 text-center">
                        <img src='<?php echo getAdminImagePath("deleteArticle"); ?>' class="img-fluid p-1" alt="" />
                        <form action='modifyArticle.php' id='delete-article' method='POST'>
                            <input type='hidden' name='id_prodotto' value='<?php echo $articolo["id_prodotto"]; ?>' />
                            <input type='hidden' name='versione' value='<?php echo $articolo["versione"]; ?>' />
                            <input type='submit' name='submit' class="btn btn-danger" value='Elimina' />
                        </form>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</section>