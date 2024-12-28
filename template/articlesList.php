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
<nav>
    <ul>
        <li>Filtri</li>
        <li>IC1</li>
        <li>IC2</li>
    </ul>
</nav>
<section>
    <ul>
        <?php
        if (isset($_SESSION["username"]) && isset($_SESSION["admin"])) {
            echo "<li>
                <a href='addArticle.php'>
                    <h2>Aggiungi prodotto</h2>
                    <img src='" . getAdminImagePath("addArticle") . "' alt='Aggiungi prodotto'>
                </a>
            </li>";
        } ?>
        <?php foreach ($userParams["articoliVisualizzati"] as $articolo): ?>
            <li>
                <a href="product.php?id_prodotto=<?php echo $articolo["id_prodotto"]; ?>&versione=<?php echo $articolo["versione"]; ?>">
                    <h2><?php echo $articolo["nome"]; ?></h2>
                    <p><?php echo $articolo["descrizione"]; ?></p>
                    <p><?php echo $articolo["formato"]; ?></p>
                    <img src="<?php echo getImagePath($articolo["nome_categoria"], $articolo["immagine"]); ?>" alt="<?php echo $articolo["nome"]; ?>">
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>