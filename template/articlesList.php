<div class="container mt-3">
    <!-- Trigger Button -->
    <button class="btn btn-secondary w-100 clickable" type="button" data-bs-toggle="collapse" data-bs-target="#filterMenu" aria-expanded="false" aria-controls="filterMenu">
        FILTRI
    </button>

    <!-- Filter Menu -->
    <div class="collapse mt-3 mb-4" id="filterMenu">
        <form action="articles.php" method="GET" class="bg-light p-4 rounded">
            <!-- Sort Options -->
            <div class="mb-3">
                <h5>Ordinamento</h5>
                <div class="form-check">
                    <label class="form-check-label" for="casuale">Casuale</label>
                    <input class="form-check-input" type="radio" name="ordinamento" value="casuale" id="casuale" />
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="vendite">Piu venduto</label>
                    <input class="form-check-input" type="radio" name="ordinamento" value="vendite" id="vendite" />
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="prezzoDesc">Prezzo (decrescente)</label>
                    <input class="form-check-input" type="radio" name="ordinamento" value="prezzoDesc" id="prezzoDesc" />
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="prezzoAsc">Prezzo (crescente)</label>
                    <input class="form-check-input" type="radio" name="ordinamento" value="prezzoAsc" id="prezzoAsc" />
                </div>
            </div>

            <!-- Price Range Filters -->
            <div class="mb-3">
                <label for="prezzoMin" class="form-label">Prezzo minimo: <span id="prezzoMinValue"><?php echo $filterMinPrice; ?></span></label>
                <input type="range" class="form-range" name="prezzoMin" min="0" max="1000" value="<?php echo $filterMinPrice; ?>" id="prezzoMin" oninput="updateRangeValue('prezzoMin')" />
                <label for="prezzoMax" class="form-label">Prezzo massimo: <span id="prezzoMaxValue"><?php echo $filterMaxPrice; ?></span></label>
                <input type="range" class="form-range" name="prezzoMax" min="0" max="1000" value="<?php echo $filterMaxPrice; ?>" id="prezzoMax" oninput="updateRangeValue('prezzoMax')" />
            </div>

            <!-- Age Filter -->
            <div class="mb-3">
                <label for="etaMinima" class="form-label">Età minima: <span id="etaMinimaValue"><?php echo $filterMinAge; ?></span></label>
                <input type="range" class="form-range" name="etaMinima" min="14" max="99" value="<?php echo $filterMinAge; ?>" id="etaMinima" oninput="updateRangeValue('etaMinima')" />
            </div>

            <!-- Categories -->
            <div class="mb-3">
                <h5>Categorie</h5>
                <?php foreach ($templateParams["categorie"] as $categoria): ?>
                    <div class="form-check">
                        <label class="form-check-label" for="<?php echo $categoria["nome"]; ?>">
                            <?php echo $categoria["nome"]; ?>
                        </label>
                        <input class="form-check-input" type="checkbox" name="categorie[]" value="<?php echo $categoria["nome"]; ?>" id="<?php echo $categoria["nome"]; ?>" />
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Formats -->
            <div class="mb-3">
                <h5>Formati</h5>
                <?php foreach ($templateParams["formati"] as $formato): ?>
                    <div class="form-check">
                        <label class="form-check-label" for="<?php echo $formato["formato"]; ?>">
                            <?php echo $formato["formato"]; ?>
                        </label>
                        <input class="form-check-input" type="checkbox" name="formati[]" value="<?php echo $formato["formato"]; ?>" id="<?php echo $formato["formato"]; ?>" />
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-secondary w-100 clickable">Applica</button>
        </form>
    </div>
</div>
<section class="text-center container pt-2">
    <div class="row g-4">
        <?php
        // Add product button for admin users
        if (isset($_SESSION["username"]) && isset($_SESSION["admin"])) {
            echo "
                <div class='col-12 col-sm-6 col-md-4'>
                    <a href='addArticle.php'>
                        <div class='card h-100'>
                            <img src='" . getAdminImagePath("addArticle") . "' class='card-img-top img-fluid' alt='' />
                            <div class='card-body'>
                                <h5 class='card-title'>Aggiungi prodotto</h5>
                            </div>
                        </div>
                    </a>
                </div>";
        }
        ?>

        <?php foreach ($userParams["articoliVisualizzati"] as $articolo): ?>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="product.php?id_prodotto=<?php echo $articolo["id_prodotto"]; ?>&versione=<?php echo $articolo["versione"]; ?>">
                    <div class="card h-100 d-flex flex-column">
                        <!-- Article Image -->
                        <img src="<?php echo getImagePath($articolo["nome_categoria"], $articolo["immagine"]); ?>" class="card-img-top img-fluid article-image" alt="" />

                        <!-- Card Body -->
                        <div class="card-body flex-grow-1">
                            <h5 class="card-title"><?php echo $articolo["nome"]; ?></h5>
                            <p class="card-text"><?php echo $articolo["descrizione"]; ?></p>
                        </div>

                        <!-- Dedicated Logo Row -->
                        <div class="card-footer">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="card-text mb-0">Formato:</> <?php echo $articolo["formato"]; ?></span>
                                <img src="<?php echo getFormatLogoPath($articolo["formato"]); ?>" class="logo-image"" />
                            </div>
                        </div>
                    </div>
                </a>
            </div>


        <?php endforeach; ?>
    </div>
</section>