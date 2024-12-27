<!--bestseller-->
<section>
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