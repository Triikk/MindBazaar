<form action="#" method="POST">
    <h2>Login</h2>
    <?php if (isset($userParams["errore"])): ?>
        <p><?php echo $userParams["errore"]; ?></p>
    <?php endif; ?>
    <ul>
        <li>
            <label for="username">Username:</label>
            <input type="text" name="username" />
        </li>
        <li>
            <label for="password">Password:</label>
            <input type="password" name="password" />
        </li>
        <li>
            <input type="submit" name="submit" value="Invia" />
        </li>
    </ul>
</form>
<p>Non hai un account? <a href="signin.php">Registrati</a>.</p>