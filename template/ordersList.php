<section>
    <h2> I tuoi ordini
        <ul>
            <?php foreach ($templateParams["ordini"] as $ordine): ?>
                <li>
                    <p><?php var_dump($articolo); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
</section>