<section>
    <?php $articolo = $userParams["articolo"]; ?>
    <h2><?php echo $articolo["nome"]; ?></h2>
    <img src="<?php echo getImagePath($articolo["nome_categoria"], $articolo["immagine"]); ?>" alt="<?php echo $articolo["nome"]; ?>">
    <p><?php echo $articolo["descrizione"]; ?></p>
    <p id="availability"><?php echo "Disponibilità: " . showAvailability($articolo["disponibilita"]); ?></p>
    <p id="price"><?php echo "Prezzo: " . $articolo["prezzo"]; ?></p>

    <form action="template/addToCart.php" id="product-details-selection-form" method="POST" onchange="updateProductDetails()">
        <input type="hidden" name="id_prodotto" value="<?php echo $articolo["id_prodotto"]; ?>">
        <?php foreach ($formatiProdotto as $formato): ?>
            <label for="<?php echo $formato; ?>"><?php echo $formato; ?></label>
            <?php if ($formato == $articolo["formato"]): ?>
                <input type="radio" name="formato" checked="true" value="<?php echo $formato; ?>">
            <?php else: ?>
                <input type="radio" name="formato" value="<?php echo $formato; ?>">
            <?php endif; ?>
        <?php endforeach; ?>

        <?php foreach ($durateProdotto as $durata): ?>
            <label for="<?php echo $durata; ?>"><?php echo $durata; ?></label>
            <?php if ($durata == $articolo["durata"]): ?>
                <input type="radio" name="durata" checked="true" value="<?php echo $durata; ?>">
            <?php else: ?>
                <input type="radio" name="durata" value="<?php echo $durata; ?>">
            <?php endif; ?>
        <?php endforeach; ?>

        <?php foreach ($intensitaProdotto as $intensita): ?>
            <label for="<?php echo $intensita; ?>"><?php echo $intensita; ?></label>
            <?php if ($intensita == $articolo["intensita"]): ?>
                <input type="radio" name="intensita" checked="true" value="<?php echo $intensita; ?>">
            <?php else: ?>
                <input type="radio" name="intensita" value="<?php echo $intensita; ?>">
            <?php endif; ?>
        <?php endforeach; ?>

        <label for="quantita">Quantita:</label>
        <input type="number" id="quantity" name="quantita" min="1" max="<?php echo $articolo["disponibilita"]; ?>" value="1">
        <button type="submit" id="add-to-cart" name="submit">Aggiungi al carrello</button>
    </form>
</section>
<section>
    <?php
    if (isset($_SESSION["username"]) && isset($_SESSION["admin"])) { ?>
        <ul>
            <li>
                <form action='modifyArticle.php' id='modify-article' method='POST' onsubmit="updateProductDetails()">
                    <input type='hidden' name='id_prodotto' value='<?php echo $articolo["id_prodotto"]; ?>'>
                    <input type='hidden' name='versione' value='<?php echo $articolo["versione"]; ?>'>
                    <input type='submit' name='submit' value='Modifica'>
                </form>
                <img src='<?php echo getAdminImagePath("modifyArticle"); ?>' alt='Modifica articolo'>
            </li>
            <li>
                <form action='deleteArticle.php' id='delete-article' method='POST' onsubmit="updateProductDetails()">
                    <input type='hidden' name='id_prodotto' value='<?php echo $articolo["id_prodotto"]; ?>'>
                    <input type='hidden' name='versione' value='<?php echo $articolo["versione"]; ?>'>
                    <input type='submit' name='submit' value='Elimina'>
                </form>
                <img src='<?php echo getAdminImagePath("deleteArticle"); ?>' alt='Elimina articolo'>
            </li>
        </ul>";
    <?php } ?>
</section>