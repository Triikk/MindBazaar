<div class="container mt-3">
    <!-- Trigger Button -->
    <button class="btn btn-secondary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#filterMenu" aria-expanded="false" aria-controls="filterMenu">
        FILTRI
    </button>

    <!-- Filter Menu -->
    <div class="collapse mt-3 mb-4" id="filterMenu">
        <form action="articles.php" method="GET" class="bg-light p-4 rounded">
            <!-- Sort Options -->
            <div class="mb-3">
                <h5>Ordinamento</h5>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ordinamento" value="vendite" id="vendite">
                    <label class="form-check-label" for="vendite">Piu venduto</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ordinamento" value="prezzoDesc" id="prezzoDesc">
                    <label class="form-check-label" for="prezzoDesc">Prezzo (decrescente)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ordinamento" value="prezzoAsc" id="prezzoAsc">
                    <label class="form-check-label" for="prezzoAsc">Prezzo (crescente)</label>
                </div>
            </div>

            <!-- Price Range Filters -->
            <div class="mb-3">
                <h5>Prezzo</h5>
                <label for="prezzoMin" class="form-label">Prezzo minimo:</label>
                <input type="range" class="form-range" name="prezzoMin" min="0" max="1000" value="<?php echo $filterMinPrice; ?>" id="prezzoMin">
                <label for="prezzoMax" class="form-label">Prezzo massimo:</label>
                <input type="range" class="form-range" name="prezzoMax" min="0" max="1000" value="<?php echo $filterMaxPrice; ?>" id="prezzoMax">
            </div>

            <!-- Age Filter -->
            <div class="mb-3">
                <h5>Età</h5>
                <label for="etaMinima" class="form-label">Età minima:</label>
                <input type="range" class="form-range" name="etaMinima" min="14" max="99" value="<?php echo $filterMinAge; ?>" id="etaMinima">
            </div>

            <!-- Categories -->
            <div class="mb-3">
                <h5>Categorie</h5>
                <?php foreach ($templateParams["categorie"] as $categoria): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="categorie[]" value="<?php echo $categoria["nome"]; ?>" id="<?php echo $categoria["nome"]; ?>">
                        <label class="form-check-label" for="<?php echo $categoria["nome"]; ?>">
                            <?php echo $categoria["nome"]; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Formats -->
            <div class="mb-3">
                <h5>Formati</h5>
                <?php foreach ($userParams["formati"] as $formato): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="formati[]" value="<?php echo $formato["formato"]; ?>" id="<?php echo $formato["formato"]; ?>">
                        <label class="form-check-label" for="<?php echo $formato["formato"]; ?>">
                            <?php echo $formato["formato"]; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-secondary w-100">Applica</button>
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
                            <img src='" . getAdminImagePath("addArticle") . "' class='card-img-top img-fluid' alt=''>
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
                    <div class="card h-100">
                        <img src="<?php echo getImagePath($articolo["nome_categoria"], $articolo["immagine"]); ?>" class="card-img-top img-fluid article-image" alt="">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $articolo["nome"]; ?></h5>
                            <p class="card-text"><?php echo $articolo["descrizione"]; ?></p>
                            <p class="card-text"><small><?php echo $articolo["formato"]; ?></small></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>