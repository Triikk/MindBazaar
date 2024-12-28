<section>
    <form action="#" id="add-article">
        <?php $products = $dbh->getProducts(); ?>
        <select name='id_prodotto' required>
            <?php
            foreach ($products as $product) {
                echo "<option value='" . $product['id'] . "'>" . $product['nome'] . "</option>";
            }
            ?>
        </select>
        <label for="formato">Formato</label>
        <input type="text" name="formato" placeholder="Formato" required>
        <label for="prezzo">Prezzo</label>
        <input type="number" name="prezzo" placeholder="Prezzo" step="0.01" value="0" min="0" required>
        <label for="durata">Durata</label>
        <input type="text" name="durata" placeholder="Durata" required>
        <label for="intensita">Intensita</label>
        <input type="number" name="intensita" placeholder="Intensita" value="0" min="0" required>
        <label for="disponibilita">Disponibilita</label>
        <input type="number" name="disponibilita" placeholder="Disponibilita" value="0" min="0" required>
        <label for="versione">Versione</label>
        <input type="number" name="versione" placeholder="Versione" value="0" min="0" required>
        <input type="button" onclick="addArticle()" value="Aggiungi articolo">
    </form>

    <form action="#" id="add-product">
        <label for="nome">Nome</label>
        <input type="text" name="nome" placeholder="Nome" required>
        <label for="descrizione">Descrizione</label>
        <input type="text" name="descrizione" placeholder="Descrizione" required>
        <label for="immagine">Immagine</label>
        <input type="text" name="immagine" placeholder="Immagine" required>
        <label for="nome_categoria">Categoria</label>
        <input type="text" name="nome_categoria" placeholder="Categoria" required>
        <label for="eta_minima">Eta minima</label>
        <input type="number" name="eta_minima" placeholder="Eta minima" value="14" min="14" max="99" required>
        <input type="button" onclick="addProduct()" value="Aggiungi prodotto">
</section>