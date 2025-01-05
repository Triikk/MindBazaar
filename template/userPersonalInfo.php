<section class="container my-4">
    <?php $datiUtente = $userParams["datiUtente"][0]; ?>
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Dati Utente</h2>
            <div class="row mb-3">
                <div class="col-4">
                    <h5>Username:</h5>
                </div>
                <div class="col-8">
                    <p class="card-text"><?php echo $datiUtente["username"]; ?></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <h5>Nome:</h5>
                </div>
                <div class="col-8">
                    <p class="card-text"><?php echo $datiUtente["nome"]; ?></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <h5>Cognome:</h5>
                </div>
                <div class="col-8">
                    <p class="card-text"><?php echo $datiUtente["cognome"]; ?></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <h5>Data di nascita:</h5>
                </div>
                <div class="col-8">
                    <p class="card-text"><?php echo $datiUtente["data_nascita"]; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>