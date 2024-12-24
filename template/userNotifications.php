<section>
    <h2>Notifiche Utente:</h2>
    <ul>
        <?php foreach ($templateParams["notificheOrdini"] as $notifica) : ?>
            <li>
                <h3>Notifica ordine n.<?php echo $notifica["id_ordine"] ?></h3>
                <p>Data: <?php echo $notifica["data"] ?></p>
                <p><?php echo getOrderNotificationText($notifica["tipologia"]) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<section>
    <h2>Notifiche Articoli:</h2>
    <ul>
        <?php foreach ($templateParams["notificheArticoli"] as $notifica) : ?>
            <li>
                <h3>Notifica articolo: <?php echo $notifica["nome"] ?></h3>
                <p>Formato: <?php echo $notifica["formato"] ?></p>
                <p>Durata: <?php echo $notifica["durata"] ?></p>
                <p>Intensità: <?php echo $notifica["intensita"] ?></p>
                <p>Data: <?php echo $notifica["data"] ?></p>
                <p><?php echo getArticleNotificationText($notifica["tipologia"]) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</section>