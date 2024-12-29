<section>
    <?php $id_prodotto = $_POST["id_prodotto"];
    $versione = $_POST["versione"];
    $articolo = $dbh->getArticle($id_prodotto, $versione); ?>
    <h2><?php echo $articolo["nome"]; ?></h2>
    <img src="<?php echo getImagePath($articolo["nome_categoria"], $articolo["immagine"]); ?>" alt="<?php echo $articolo["nome"]; ?>">
    <p><?php echo $articolo["descrizione"]; ?></p>
    <p><?php echo "Formato: " . $articolo["formato"]; ?></p>
    <p><?php echo "Intensita: " . $articolo["intensita"]; ?></p>
    <p><?php echo "Durata: " . $articolo["durata"]; ?></p>
    <p><?php echo "Disponibilità: " . $articolo["disponibilita"]; ?></p>
    <p><?php echo "Prezzo: " . $articolo["prezzo"]; ?></p>

    <form action="template/modify.php" id="form" method="POST">
        <input type="hidden" name="id_prodotto" value="<?php echo $articolo["id_prodotto"]; ?>">

        <button type="submit" id="modify" name="submit">Applica modifiche</button>
    </form>
</section>