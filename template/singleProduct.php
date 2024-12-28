<?php $articolo = $userParams["articolo"]; ?>
<h2><?php echo $articolo["nome"]; ?></h2>
<p><?php echo $articolo["descrizione"]; ?></p>
<p><?php echo $articolo["formato"]; ?></p>
<p><?php echo "Prezzo: " . $articolo["prezzo"]; ?></p>

<form action="template/addToCart.php" method="POST">
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
    <input type="number" name="quantita" min="1" max="10" value="1">
    <button type="submit" name="submit">Aggiungi al carrello</button>
</form>