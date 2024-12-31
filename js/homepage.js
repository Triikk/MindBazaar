// function generateBestsellers(bestsellers) {
//     let result = "";
//     let numBS = bestsellers.length;
//     if (numBS === 0) {
//         result += `
//         <h2>No bestsellers found</h2>
//         `;
//     } else if (numBS === 1) {
//         result += `
//         <h2>Best seller:</h2>
//         `;
//     } else {
//         result += `
//         <h2>Best sellers:</h2>
//         `;
//     }
//     result += `
//     <ul>
//     `;

//     for (let i = 0; i < numBS; i++) {
//         let bestseller = bestsellers[i];
//         let bestsellerInfo = `
//         <li>
//         <h3>${bestseller["nome"]}</h3>
//         <a href="product.php?id_prodotto=${bestseller["id"]}&versione=1">
//             <img src="${bestseller["percorso_immagine"]}" alt="" />
//         </a>
//         <p>${bestseller["descrizione"]}</p>
//         </li>
//         `;
//         result += bestsellerInfo;
//     }
//     result += `
//     </ul>
//     `;

//     const BSSection = document.querySelector('main > :nth-child(1)');
//     BSSection.innerHTML = result;
// }

function generateBestsellers(bestsellers) {
    let result = "";
    let numBS = bestsellers.length;

    if (numBS === 0) {
        result += `
        <h2>No bestsellers found</h2>
        `;
        return result;
    }

    result += `
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
    `;

    for (let i = 0; i < numBS; i++) {
        result += `
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="${i}" ${i === 0 ? 'class="active"' : ''}></li>
        `;
    }

    result += `
        </ol>
        <div class="carousel-inner">
    `;

    for (let i = 0; i < numBS; i++) {
        let bestseller = bestsellers[i];
        result += `
            <div class="carousel-item ${i === 0 ? 'active' : ''}">
                <img class="d-block w-100" src="${bestseller["percorso_immagine"]}" alt="${bestseller["nome"]}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>${bestseller["nome"]}</h5>
                    <p>${bestseller["descrizione"]}</p>
                    <a href="product.php?id_prodotto=${bestseller["id"]}&versione=1" class="btn btn-primary">View Product</a>
                </div>
            </div>
        `;
    }

    result += `
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    `;

    const BSSection = document.querySelector('main > :nth-child(1)');
    BSSection.innerHTML = result;
    // return result;
}

async function getBestsellers() {
    const url = 'api/api-homepage.php';

    queryAPI(url, "bestSellers", "numBestSellers=5", "GET", generateBestsellers);
    /*
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
        const bestsellers = generateBestsellers(json);
        const BSSection = document.querySelector('main > :nth-child(1)');
        BSSection.innerHTML = bestsellers;
    } catch (error) {
        console.log(error.message);
    }
    */
}

function generateCategories(categories) {
    let result = "";
    let numC = categories.length;
    if (numC === 0) {
        result += `
        <h2>No categories found</h2>
        `;
    } else if (numC === 1) {
        result += `
        <h2>Category:</h2>
        `;
    } else {
        result += `
        <h2>Categories:</h2>
        `;
    }
    result += `
    <ul>
    `;

    for (let i = 0; i < numC; i++) {
        let category = `
        <li>
        <a href="articles.php?categorie%5B%5D=${categories[i]["nome"]}">${categories[i]["nome"]}</a>
        </li>
        `;
        result += category;
    }
    result += `
    </ul>
    `;

    const CSection = document.querySelector('main > :nth-child(2)');
    CSection.innerHTML = result;
}

async function getCategories() {
    const url = 'api/api-homepage.php';

    queryAPI(url, "categories", "", "GET", generateCategories);
    /*
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
        const categories = generateCategories(json);
        const CSection = document.querySelector('main > :nth-child(2)');
        CSection.innerHTML = categories;
    } catch (error) {
        console.log(error.message);
    }
    */
}

getBestsellers();
getCategories();