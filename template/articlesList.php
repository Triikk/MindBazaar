<form action="/articles.php" method="get">
    <label for="vendite">Piu venduto</label>
    <input type="radio" name="ordinamento" value="vendite">
    <label for="prezzoDesc">Prezzo (decrescente)</label>
    <input type="radio" name="ordinamento" value="prezzoDesc">
    <label for="prezzoAsc">Prezzo (crescente)</label>
    <input type="radio" name="ordinamento" value="prezzoAsc">
    <label for="prezzoMin">Prezzo minimo:</label>
    <input type="range" name="prezzoMin" min="0" max="1000">
    <label for="prezzoMax">Prezzo massimo:</label>
    <input type="range" name="prezzoMax" min="0" max="1000">
    <label for="etaMinima">Età:</label>
    <input type="range" name="etaMinima" min="14" max="99">
    <?php foreach ($templateParams["categorie"] as $categoria): ?>
        <label for="<?php echo $categoria["nome"]; ?>"><?php echo $categoria["nome"]; ?></label>
        <input type="checkbox" name="categorie[]" value="<?php echo $categoria["nome"]; ?>">
    <?php endforeach; ?>
    <?php foreach ($templateParams["formati"] as $formato): ?>
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
        <?php foreach ($templateParams["articoliVisualizzati"] as $articolo): ?>
            <li>
                <a href="/product.php?id_prodotto=<?php echo $articolo["id_prodotto"]; ?>&versione=<?php echo $articolo["versione"]; ?>">
                    <h2><?php echo $articolo["nome"]; ?></h2>
                    <p><?php echo $articolo["descrizione"]; ?></p>
                    <p><?php echo $articolo["formato"]; ?></p>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>