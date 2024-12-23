<section>
    <h2>Numero articoli presenti: <?php echo count($templateParams["articoliInCarrello"]); ?></h2>
    <h2>Totale provvisorio: <?php echo calculateTotal($templateParams["articoliInCarrello"]); ?></h2>
</section>
<section>
    <form action="checkout.php" method="post">
        <button type="submit" name="checkout">"Procedi all'acquisto"</button>
        <ul>
            <?php foreach ($templateParams["articoliInCarrello"] as $articolo): ?>
                <li>
                    <h3><?php echo $articolo["nome"] ?></h3>
                    <p>Prezzo: <?php echo $articolo["prezzo"] ?>€</p>
                    <p>Disponibilità: <?php echo showAvailability($articolo["disponibilita"]) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </form>
</section>