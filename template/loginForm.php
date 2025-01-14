<div class="container d-flex justify-content-center align-items-center min-vh-50 py-3">
    <div class="card shadow-sm p-4 w-100 mx-auto login-card">
        <h2 class="text-center mb-3">Login</h2>

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
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required />
            </div>
            <div class="d-grid">
                <button type="submit" name="submit" class="btn btn-primary clickable">Invia</button>
            </div>
        </form>

        <p class="text-center mt-3">
            Non hai un account? <a href="signin.php" class="text-decoration-none">Registrati</a>.
        </p>
    </div>
</div>