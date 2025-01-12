<form action="#" method="POST">
    <h2>Registrazione</h2>
    <?php if (isset($userParams["errore"])): ?>
        <p><?php echo $userParams["errore"]; ?></p>
    <?php endif; ?>
    <ul>
        <li>
            <label for="username">Username:</label>
            <input type="text" name="username" />
        </li>
        <li>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" />
        </li>
        <li>
            <label for="cognome">Cognome:</label>
            <input type="text" name="cognome" />
        </li>
        <li>
            <label for="dataNascita">Data di nascita:</label>
            <input type="date" name="dataNascita" />
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
<p>Ti sei già registrato? <a href="login.php">Login</a>.</p>