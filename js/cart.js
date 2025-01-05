carrello = [];

function dispToNumber(disp) {
    const numb = parseInt(disp);
    if (isNaN(numb)) {
        return 0;
    }
    return numb;
}

function generateArticle(articolo, index) {
    const maxQuantity = dispToNumber(articolo["disponibilita"]);
    let articleImgPath = "";
    queryAPI("api/api-functions.php", "getImagePath", `category=${articolo["nome_categoria"]}&image=${articolo["immagine"]}`, "GET", (response => articleImgPath = response));
    console.log(articleImgPath);
    return `
        <div class="col-12 col-md-8 mb-4 mx-auto">
            <div class="card d-flex flex-column position-relative">
                <!-- Product Selection Checkbox (Top Right) -->
                <div class="position-absolute top-0 end-0 p-2">
                    <input onchange="checkOrderingAbility()" type="checkbox" form="modify-amount-${index}" name="include" value="false" class="form-check-input">
                </div>

                <div class="card-body d-flex">
                    <!-- Article Image -->
                    <div class="me-3">
                        <img src="${articleImgPath}" alt="${articolo["nome"]}" class="img-fluid" style="height: 200px; object-fit: cover;">
                    </div>

                    <!-- Article Info -->
                    <div class="d-flex flex-column justify-content-between">
                        <h3 class="card-title">${articolo["nome"]}</h3>
                        <p><strong>Prezzo:</strong> ${articolo["prezzo"]}€</p>
                        <p><strong>Formato:</strong> ${articolo["formato"]}, <strong>Intensità:</strong> ${articolo["intensita"]}, <strong>Durata:</strong> ${articolo["durata"]}</p>
                        <p><strong>Disponibilità:</strong> ${articolo["disponibilita"]}</p>

                        <!-- Modify quantity form -->
                        <form id="modify-amount-${index}">
                            <div class="mb-3 d-flex align-items-center">
                                <label for="quantita_articolo_in_carrello-${index}" class="form-label me-2" style="line-height: 2.5;">Quantità</label>
                                <input onchange="updateCart(${index})" form="modify-amount-${index}" type="number" min="0" max="${maxQuantity}" name="quantita_articolo_in_carrello" value="${articolo["quantita"]}" class="form-control form-control-sm" id="quantita_articolo_in_carrello-${index}" style="width: 80px; font-size: 1.2rem; height: auto;">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Footer buttons section -->
                <div class="card-footer d-flex flex-column align-items-center">
                    <!-- Rimuovi (remove) button -->
                    <button onclick="removeArticle(${index})" form="modify-amount-${index}" type="button" class="btn btn-danger btn-lg mb-2" style="width: 120px;">Rimuovi</button>
                </div>
            </div>
        </div>
    `;
}


function generateCart(newCart) {
    carrello = newCart;

    let sezioni = document.querySelectorAll("main section");
    let cartInfo = sezioni[0].children;
    let articoli = sezioni[1];

    cartInfo[0].innerHTML = `Numero articoli presenti: ${carrello.length}`;
    cartInfo[1].innerHTML = `Totale provvisorio: ${calculateTotal(carrello)}€`;

    let elencoArticoli = "";
    elencoArticoli += "<ul>\n";
    for (let i = 0; i < carrello.length; i++) {
        elencoArticoli += generateArticle(carrello[i], i);
    }
    articoli.innerHTML = elencoArticoli + "</ul>\n";
    checkOrderingAbility();
}

function visualizeCart() {
    const url = 'api/api-cart.php';
    queryAPI(url, "getCartArticles", "", "GET", generateCart);
}

function removeArticle(index) {
    let articolo = carrello[index];
    // rimuove articolo dal carrello
    const url = `api/api-cart.php`;
    queryAPI(url, "removeFromCart", `art_id_prod=${articolo["id_prodotto"]}&art_versione=${articolo["versione"]}`, "POST", visualizeCart);
}

function updateCart(index) {
    // legge quantità
    const articolo = carrello[index];
    let nuovaQuantita = document.forms["modify-amount-" + index]["quantita_articolo_in_carrello"].value;
    const max = dispToNumber(articolo["disponibilita"]);
    // se <=0 elimina l'articolo
    if (nuovaQuantita <= 0) {
        removeArticle(index);
    } else {
        // aggiorna la quantità dell'articolo
        if (nuovaQuantita > max) {
            nuovaQuantita = max;
        }
        const url = `api/api-cart.php`;
        queryAPI(url, "modifyArtAmount", `art_id_prod=${articolo["id_prodotto"]}&art_versione=${articolo["versione"]}&art_quantita=${nuovaQuantita}`, "POST", visualizeCart);
    }
    checkOrderingAbility();
}

function createOrder() {
    // legge le checkbox
    let articoliSceltiDalCarrello = [];
    for (let i = 0; i < carrello.length; i++) {
        let form = document.forms["modify-amount-" + i];
        let include = form["include"].checked;
        if (include) {
            articoliSceltiDalCarrello.push(carrello[i]);
        }
    }
    document.forms["createOrder-form"]["orderedArticles"].value = JSON.stringify(articoliSceltiDalCarrello);
}

function atLeastOneArticleSelected() {
    for (let i = 0; i < carrello.length; i++) {
        let form = document.forms["modify-amount-" + i];
        let include = form["include"].checked;
        if (include) {
            return true;
        }
    }
    return false;
}

function checkOrderingAbility() {
    let atLeastOne = atLeastOneArticleSelected();

    if (atLeastOne) {
        document.forms["createOrder-form"]["submit"].disabled = false;
    } else {
        document.forms["createOrder-form"]["submit"].disabled = true;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    visualizeCart();
});