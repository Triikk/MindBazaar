<!--bestseller-->
<section>
    <h2>Best seller:</h2>
    <img src="<?php $bestSeller["img"]; ?>" alt="<?php $bestSeller["descrizione"]; ?>" />
    <?php
    $bestSeller = $templateParams["bestSeller"];
    ?>
</section>
<!--categories-->
<section>
    <h2>Categories:</h2>
    <nav>
        <ul>
            <?php foreach ($templateParams["categorie"] as $categoria): ?>
                <li>
                    <a href="articles.php?category=<?php echo $categoria["nome"]; ?>">
                        <?php echo $categoria["nome"]; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</section>
<!--about us-->
<section>

</section>