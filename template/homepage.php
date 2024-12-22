<section>
    <h2>Best seller:</h2>
    <img src="<?php $bestSeller["img"]; ?>" alt="<?php $bestSeller["descrizione"]; ?>" />
    <?php
        $bestSeller = $templateParams["bestSeller"];
    ?>
</section>
<section>
    <h2>Prodotti</h2>
    <?php foreach($templateParams["prodotti"] as $prodotto): ?>
        <article>
            <div>
                <p><?php echo $prodotto["nome"]; ?></p>
                <p><?php echo $prodotto["descrizione"]; ?></p>
            </div>
        </article>
    <?php endforeach; ?>
</section>
<section>
    
</section>