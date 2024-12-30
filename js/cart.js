carrello = [];

function generateArticle(articolo, index) {
    return `<li>
        <h3>${articolo["nome"]}</h3>
        <p>Prezzo: ${articolo["prezzo"]}€</p>
        <p>Formato: ${articolo["formato"]}, intensità: ${articolo["intensita"]}, durata: ${articolo["durata"]}</p>
        <p>Quantità: ${articolo["quantita"]}</p>
        <p>Disponibilità: ${articolo["disponibilita"]}</p>
        <form id="modify-amount-${index}">
            <input onchange="updateCart(${index})" form="modify-amount-${index}" type="number" name="quantita_articolo_in_carrello" value="${articolo["quantita"]}">
            <input onclick="removeArticle(${index})" form="modify-amount-${index}" type="button" name="remove_from_cart" value="remove">
            <input onchange="checkOrderingAbility()" type="checkbox" form="modify-amount-${index}" name="include" value="false">
        </form>
    </li>
    `
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
}

async function visualizeCart() {
    const url = 'api/api-cart.php?query=getCartArticles';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status} `);
        }
        const json = await response.json();
        generateCart(json);
    } catch (error) {
        console.log(error.message);
    }
}

async function removeArticle(index) {
    let articolo = carrello[index];
    // rimuove articolo dal carrello
    const url = `api/api-cart.php`;
    try {
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "api/api-cart.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onload = function() {
            visualizeCart();
        };
        xhttp.send(`query=removeFromCart&art_id_prod=${articolo["id_prodotto"]}&art_versione=${articolo["versione"]}`);
    } catch (error) {
        console.log(error.message);
    }
}

async function updateCart(index) {
    // legge quantità
    let articolo = carrello[index];
    let nuovaQuantita = document.forms["modify-amount-" + index]["quantita_articolo_in_carrello"].value;
    // se <=0 elimina l'articolo
    if (nuovaQuantita <= 0) {
        removeArticle(index);
    } else {
        const url = `api/api-cart.php`;
        // aggiorna la quantità dell'articolo
        try {
            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "api/api-cart.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onload = function() {
                visualizeCart();
            };
            xhttp.send(`query=modifyArtAmount&art_id_prod=${articolo["id_prodotto"]}&art_versione=${articolo["versione"]}&art_quantita=${nuovaQuantita}`);
        } catch (error) {
            console.log(error.message);
        }
    }
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

visualizeCart();
checkOrderingAbility();