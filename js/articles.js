

function generateArticles(articles) {
    let result = "";
    let ordinamento = "vendite";
    let prezzoMin = 0;
    let prezzoMax = 1000;
    const maxPrezzo = 1000;
    const etaMinima = 14;
    const etaMassima = 99;

    result += `
    <section>
    <ul>
    `;
    articles.forEach(element => {
        let product = element;
        let productHTML = `
        <li><a href="product.php?id=${product["id"]}">
        <h2>${product["nome"]}</h2>
        <p>${product["descrizione"]}</p>
        </a></li>
        `;
        // <img src="${product["immagine"]}" alt="${product["nome"]}">
        result += productHTML;
    });
    result += `
    </ul>
    </section>
    `;
    console.log(result);
    return result;
}

async function getArticles() {
    const url = 'api/api-articles.php?query=getArticles';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status} `);
        }
        const json = await response.json();
        console.log(json);
        const articles = generateArticles(json);
        const main = document.querySelector('main');
        main.innerHTML = articles;
    } catch (error) {
        console.error('Error:', error);
    }
}

getArticles();