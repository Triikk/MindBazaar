<?php $datiUtente = $userParams["datiUtente"][0]; ?>
<section class="container my-4">
    <div class="card mx-auto userInfoContainer">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Dati Utente</h2>
            <div class="row mb-3">
                <div class="col-4">
                    <h3>Username:</h3>
                </div>
                <div class="col-8">
                    <p class="card-text"><?php echo $datiUtente["username"]; ?></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <h3>Nome:</h3>
                </div>
                <div class="col-8">
                    <p class="card-text"><?php echo $datiUtente["nome"]; ?></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <h3>Cognome:</h3>
                </div>
                <div class="col-8">
                    <p class="card-text"><?php echo $datiUtente["cognome"]; ?></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <h3>Data di nascita:</h3>
                </div>
                <div class="col-8">
                    <p class="card-text"><?php echo DateTime::createFromFormat("Y-m-d H:i:s", $datiUtente["data_nascita"])->format("Y-m-d"); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>