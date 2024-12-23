<form action="/articles.php" method="get">
    <label for="vendite"><b>Piu venduto</b></label>
    <input type="radio" name="ordinamento" value="vendite">
    <label for="prezzo-desc"><b>Prezzo (decrescente)</b></label>
    <input type="radio" name="ordinamento" value="prezzo-desc">
    <label for="prezzo-asc"><b>Prezzo (crescente)</b></label>
    <input type="radio" name="ordinamento" value="prezzo-asc">
    <label for="prezzo"><b>Prezzo:</b></label>
    <input type="">
    <label for="eta"><b>Età:</b></label>
    <input type="">
    <label for="categorie"><b>Categorie:</b></label>
    <input type="">
    <label for="formati"><b>Prezzo:</b></label>
    <input type="">
    <button type="submit">APPLICA</button>
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
        <?php foreach ($templateParams["articoli"] as $articolo): ?>
            <li>
                <h2><?php echo $articolo["nome"]; ?></h2>
                <p><?php echo $articolo["descrizione"]; ?></p>
                <p><?php echo $articolo["formato"]; ?></p>
            </li>
        <?php endforeach; ?>
        <?php
        var_dump($filterCategories);
        var_dump($filterMinPrice);
        var_dump($filterOrdinamento);
        ?>
    </ul>
</section>