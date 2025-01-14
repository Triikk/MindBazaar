<section class="container-fluid my-4">
    <div class="card mx-auto p-4">
        <div class="row">
            <div class="col-12">
                <h2>Aggiungi Articolo</h2>
                <form action="#" id="add-article" class="mt-4">
                    <div class="mb-3 row">
                        <label for="id_prodotto" class="col-12 col-md-4 col-form-label">Prodotto:</label>
                        <div class="col-12 col-md-8">
                            <select id="id_prodotto" name="id_prodotto" class="form-select" required>
                            <option value="" disabled selected>Seleziona un prodotto</option>
                                <?php
                                $products = $dbh->getProducts();
                                foreach ($products as $product) {
                                    echo "<option value='" . $product['id'] . "' label='" . htmlspecialchars($product["nome"]) . "'></option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="formato" class="col-12 col-md-4 col-form-label">Formato:</label>
                        <div class="col-12 col-md-8">
                            <select id="formato" name="formato" class="form-select" required>
                            <option value="" disabled selected>Seleziona un formato</option>
                                <?php
                                foreach ($templateParams["formati"] as $format) {
                                    echo "<option value='" . $format['formato'] . "' label='" . $format['formato'] . "'></option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="prezzo" class="col-12 col-md-4 col-form-label">Prezzo:</label>
                        <div class="col-12 col-md-8">
                            <input type="number" id="prezzo" name="prezzo" class="form-control" placeholder="Prezzo"
                                step="0.01" value="0" min="0" required />
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="durata" class="col-12 col-md-4 col-form-label">Durata:</label>
                        <div class="col-12 col-md-8">
                            <input type="text" id="durata" name="durata" class="form-control" placeholder="Durata" required />
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="intensita" class="col-12 col-md-4 col-form-label">Intensità:</label>
                        <div class="col-12 col-md-8">
                            <input type="number" id="intensita"  name="intensita" class="form-control" placeholder="Intensità"
                                value="0" min="0" required />
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="disponibilita" class="col-12 col-md-4 col-form-label">Disponibilità:</label>
                        <div class="col-12 col-md-8">
                            <input type="number" id="disponibilita" name="disponibilita" class="form-control" placeholder="Disponibilità"
                                value="0" min="0" required />
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="versione" class="col-12 col-md-4 col-form-label">Versione:</label>
                        <div class="col-12 col-md-8">
                            <input type="number" id="versione" name="versione" class="form-control" placeholder="Versione"
                                value="0" min="0" required />
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="button" onclick="addArticle()" class="btn clickable btn-secondary btn-lg w-100 w-md-75">
                            Aggiungi articolo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card mx-auto p-4 mt-4">
        <div class="row">
            <div class="col-12 mt-5">
                <h2>Aggiungi Prodotto</h2>
                <form action="#" id="add-product" class="mt-4">
                    <div class="mb-3 row">
                        <label for="nome" class="col-12 col-md-4 col-form-label">Nome:</label>
                        <div class="col-12 col-md-8">
                            <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" required />
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="descrizione" class="col-12 col-md-4 col-form-label">Descrizione:</label>
                        <div class="col-12 col-md-8">
                            <textarea id="descrizione" name="descrizione" class="form-control" placeholder="Descrizione" required rows="3"></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="immagine" class="col-12 col-md-4 col-form-label">Immagine:</label>
                        <div class="col-12 col-md-8">
                            <input type="file" id="immagine" name="immagine" class="form-control" required />
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nome_categoria" class="col-12 col-md-4 col-form-label">Categoria:</label>
                        <div class="col-12 col-md-8">
                            <select id="nome_categoria" name="nome_categoria" class="form-select" required>
                            <option value="" disabled selected>Seleziona una categoria</option>
                                <?php
                                $categories = $dbh->getCategories();
                                foreach ($categories as $category) {
                                    echo "<option value='" . $category['nome'] . "' label='" . $category['nome'] . "'></option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="eta_minima" class="col-12 col-md-4 col-form-label">Età minima:</label>
                        <div class="col-12 col-md-8">
                            <input type="number" id="eta_minima" name="eta_minima" class="form-control" placeholder="Età minima"
                                value="14" min="14" max="99" required />
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="button" onclick="addProduct()" class="btn btn-secondary clickable btn-lg w-100 w-md-75">
                            Aggiungi prodotto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>