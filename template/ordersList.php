<section>
    <h2> I tuoi ordini</h2>
    <ul>
        <?php foreach ($templateParams["ordiniConListaArticoli"] as $tuplaOrdineLista): ?>
            <?php $ordine = $tuplaOrdineLista[0]; ?>
            <?php $listaArticoli = $tuplaOrdineLista[1]; ?>
            <li>
                <ul>
                    <h3>Ordine n.<?php echo $ordine["id"]; ?> del <?php echo $ordine["tempo_ordinazione"] ?></h3>
                    <?php foreach ($listaArticoli as $articolo): ?>
                        <li>
                            <h4><?php echo $articolo["nome"]; ?> </h4>
                            <p>Categoria: <?php echo $articolo["nome_categoria"];  ?></p>
                            <p>Quantita: <?php echo $articolo["quantita"] ?>, formato: <?php echo $articolo["formato"] ?>, intensità: <?php echo $articolo["intensita"] ?>, durata: <?php echo $articolo["durata"] ?></p>
                            <p>Prezzo: <?php echo $articolo["prezzo"] ?> </p>
                        </li>
                    <?php endforeach; ?>
                    <p>Totale: <?php echo calculateTotal($listaArticoli); ?> </p>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
</section>