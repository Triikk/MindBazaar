<section>
    <ul>
        <?php $datiUtente = $userParams["datiUtente"][0]; ?>
        <li>
            <h3>Username: <?php echo $datiUtente["username"] ?></h3>
        </li>
        <li>
            <h3>Nome: <?php echo $datiUtente["nome"] ?></h3>
        </li>
        <li>
            <h3>Cognome: <?php echo $datiUtente["cognome"] ?></h3>
        </li>
        <li>
            <h3>Data di nascita: <?php echo $datiUtente["data_nascita"] ?></h3>
        </li>
    </ul>
</section>