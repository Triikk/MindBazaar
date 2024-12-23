<?php $articolo = $templateParams["articolo"]; ?>
<h2><?php echo $articolo["nome"]; ?></h2>
<p><?php echo $articolo["descrizione"]; ?></p>
<p><?php echo $articolo["formato"]; ?></p>
<p><?php echo "Prezzo: " . $articolo["prezzo"]; ?></p>

<form action="/product.php" method="GET">
    <?php foreach ($formatiProdotto as $formato): ?>
        <label for="<?php echo $formato; ?>"><?php echo $formato; ?></label>
        <input type="radio" name="formato" value="<?php echo $formato; ?>">
    <?php endforeach; ?>
    <?php foreach ($durateProdotto as $durata): ?>
        <label for="<?php echo $durata; ?>"><?php echo $durata; ?></label>
        <input type="radio" name="durata" value="<?php echo $durata; ?>">
    <?php endforeach; ?>
    <?php foreach ($intensitaProdotto as $intensita): ?>
        <label for="<?php echo $intensita; ?>"><?php echo $intensita; ?></label>
        <input type="radio" name="intensita" value="<?php echo $intensita; ?>">
    <?php endforeach; ?>
    <label for="quantita">Quantita:</label>
    <input type="number" name="quantita" min="1" max="10" value="1">
    <button type="submit">Aggiungi al carrello</button>
</form>