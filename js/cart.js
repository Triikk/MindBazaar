function calculateTotal(articles) {
    let total = 0;
    for (let i = 0; i < articles.length; i++) {
        total += parseFloat(articles[i]["prezzo"]);
    }
    return total.toFixed(2);
}

function generateCartDetails(cartDetails) {
    let numCArticles = cartDetails.length;
    let result = `
    <h2>Numero articoli presenti: ${numCArticles}</h2>
    <p>Totale: ${calculateTotal(cartDetails)}€</p>
    `;
    return result;
}

function generateCartArticles(cartArticles) {
    let result = "";
    let numCA = cartArticles.length;
    for (let i = 0; i < numCA; i++) {
        let article = cartArticles[i];
        result += `
        <li>
            <h3>${article["nome"]}</h3>
            <p>Categoria: ${article["nome_categoria"]}</p>
            <p>Formato: ${article["formato"]}, Intensità: ${article["intensita"]}, Durata: ${article["durata"]}</p>
            <p>Prezzo: ${article["prezzo"]}€</p>
            <p>Quantità: ${article["quantita"]}</p>
            <p>Disponibilità: ${article["disponibilita"]}</p>
            <form id="modify-amount-${i}">
            <input form="modify-amount-${i}" type="hidden" name="id_prod_articolo_in_carrello" value="${articolo["id_prodotto"]}">
            <input form="modify-amount-${i}" type="hidden" name="versione_articolo_in_carrello" value="${articolo["versione_articolo"]}">
            <input form="modify-amount-${i}" type="hidden" name="username_articolo_in_carrello" value="${articolo["username"]}">
            <input form="modify-amount-${i}" type="number" name="quantita_articolo_in_carrello" value="${articolo["quantita"]}">
            <button form="modify-amount-${i}" type="submit" name="submit" value="modify-amount">
        </li>
        `;
    }
    return result;
}

async function getCartArticles() {
    const url = 'api/api-cart.php?query=getCartArticles';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status} `);
        }
        const json = await response.json();
        console.log(json);
        const cartDetails = generateCartDetails(json);
        const detailsSection = document.querySelector('main > section:nth-of-type(1)');
        detailsSection.innerHTML = cartDetails;
        const cartArticles = generateCartArticles(json);
        const articlesSection = document.querySelector('main > section:nth-of-type(2) > ul');
        articlesSection.innerHTML = cartArticles;
    } catch (error) {
        console.log(error.message);
    }
}

getCartArticles();