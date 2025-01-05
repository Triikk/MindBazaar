<form action="articles.php" method="GET">
    <label for="vendite">Piu venduto</label>
    <input type="radio" name="ordinamento" value="vendite">
    <label for="prezzoDesc">Prezzo (decrescente)</label>
    <input type="radio" name="ordinamento" value="prezzoDesc">
    <label for="prezzoAsc">Prezzo (crescente)</label>
    <input type="radio" name="ordinamento" value="prezzoAsc">
    <label for="prezzoMin">Prezzo minimo:</label>
    <input type="range" name="prezzoMin" min="0" max="1000" value="<?php echo $filterMinPrice; ?>">
    <label for="prezzoMax">Prezzo massimo:</label>
    <input type="range" name="prezzoMax" min="0" max="1000" value="<?php echo $filterMaxPrice; ?>">
    <label for="etaMinima">Età:</label>
    <input type="range" name="etaMinima" min="14" max="99" value="<?php echo $filterMinAge; ?>">
    <?php foreach ($templateParams["categorie"] as $categoria): ?>
        <label for="<?php echo $categoria["nome"]; ?>"><?php echo $categoria["nome"]; ?></label>
        <input type="checkbox" name="categorie[]" value="<?php echo $categoria["nome"]; ?>">
    <?php endforeach; ?>
    <?php foreach ($userParams["formati"] as $formato): ?>
        <label for="<?php echo $formato["formato"]; ?>"><?php echo $formato["formato"]; ?></label>
        <input type="checkbox" name="formati[]" value="<?php echo $formato["formato"]; ?>">
    <?php endforeach; ?>
    <button type="submit" value="submit">Applica</button>
</form>
<section class="text-center container">
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
                        <img src="<?php echo getImagePath($articolo["nome_categoria"], $articolo["immagine"]); ?>" class="card-img-top img-fluid product-image" alt="">
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