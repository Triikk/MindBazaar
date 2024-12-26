<!--bestseller-->
<section>
    <h2>Best seller:</h2>
    <?php $bestSellers = $templateParams["bestSellers"]; ?>
    <?php foreach ($bestSellers as $bestSeller): ?>
        <img src="<?php echo $bestSeller["immagine"]; ?>"" />
        <h3><?php echo $bestSeller["nome"]; ?></h3>
        <p><?php echo $bestSeller["descrizione"]; ?></p>
    <?php endforeach; ?>
</section>
<!--categories-->
<section>
    <h2>Categories:</h2>
    <nav>
        <ul>
        <?php foreach ($templateParams["categorie"] as $categoria): ?>
        <li>
            <a href=" articles.php?categorie%5B%5D=<?php echo $categoria["nome"]; ?>"><?php echo $categoria["nome"]; ?></a>
        </li>
    <?php endforeach; ?>
    </ul>
    </nav>
</section>
<!--about us-->
<section>

</section>