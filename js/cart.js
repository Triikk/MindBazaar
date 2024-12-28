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
            <input type="checkbox" form="modify-amount-${index}" name="include" value="false">
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
    const url = `api/api-cart.php?query=removeFromCart&art_id_prod=${articolo["id_prodotto"]}&art_versione=${articolo["versione"]}`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status} `);
        }
    } catch (error) {
        console.log(error.message);
    }
    // updates page
    visualizeCart();
}

async function updateCart(index) {
    // legge quantità
    // se 0 elimina l'articolo
    let articolo = carrello[index];
    let nuovaQuantita = document.forms["modify-amount-" + index]["quantita_articolo_in_carrello"].value;
    if (nuovaQuantita <= 0) {
        removeArticle(index);
    } else {
        const url = `api/api-cart.php?query=modifyArtAmount&art_id_prod=${articolo["id_prodotto"]}&art_versione=${articolo["versione"]}&art_quantita=${nuovaQuantita}`;
        // aggiorna la quantità dell'articolo
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`Response status: ${response.status} `);
            }
        } catch (error) {
            console.log(error.message);
        }
        // updates page
        visualizeCart();
    }
}

function order() {
    // legge le checkbox
    // redirect al checkout trasmettendo i dati
}

visualizeCart();