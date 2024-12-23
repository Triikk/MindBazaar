<form action="/articles.php" method="get">
    <label for="ordinamento"><b>Ordina per:</b></label>
    <input type="radio" name="ordinamento">
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
                <h2><?php echo $articolo["titolo"]; ?></h2>
                <p><?php echo $articolo["testo"]; ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</section>