<section>
    <?php $id_prodotto = $_POST["id_prodotto"];
    $versione = $_POST["versione"];
    $articolo = $dbh->getArticle($id_prodotto, $versione);
    ?>
    <h2><?php echo $articolo["nome"]; ?></h2>
    <img src="<?php echo getImagePath($articolo["nome_categoria"], $articolo["immagine"]); ?>" alt="<?php echo $articolo["nome"]; ?>">
    <p><?php echo $articolo["descrizione"]; ?></p>
    <p><?php echo "Formato: " . $articolo["formato"]; ?></p>
    <p><?php echo "Intensita: " . $articolo["intensita"]; ?></p>
    <p><?php echo "Durata: " . $articolo["durata"]; ?></p>

    <form action="modifyArticle.php" id="form" method="POST">
        <label for="disponibilita">Disponibilità</label>
        <input type="number" name="disponibilita" value="<?php echo $articolo["disponibilita"]; ?>" min=" 0" required>
        <label for="prezzo">Prezzo</label>
        <input type="number" name="prezzo" value="<?php echo $articolo["prezzo"]; ?>" min=" 0" step="0.01" required>
        <input type="hidden" name="id_prodotto" value="<?php echo $articolo["id_prodotto"]; ?>">
        <input type="hidden" name="versione" value="<?php echo $articolo["versione"]; ?>">
        <button type="submit" id="modify" name="submit">Applica modifiche</button>
    </form>
</section>