<div class="container d-flex justify-content-center align-items-center min-vh-50 py-3">
    <div class="card shadow-sm p-4 w-100 mx-auto register-card">
        <h2 class="text-center mb-3">Registrazione</h2>

        <?php if (isset($userParams["errore"])): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo $userParams["errore"]; ?>
            </div>
        <?php endif; ?>

        <form action="#" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="cognome" class="form-label">Cognome:</label>
                <input type="text" name="cognome" id="cognome" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="dataNascita" class="form-label">Data di nascita:</label>
                <input type="date" name="dataNascita" id="dataNascita" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required />
            </div>
            <div class="d-grid">
                <button type="submit" name="submit" class="btn btn-primary clickable">Invia</button>
            </div>
        </form>

        <p class="text-center mt-3">
            Ti sei già registrato? <a href="login.php" class="text-decoration-none">Login</a>.
        </p>
    </div>
</div>