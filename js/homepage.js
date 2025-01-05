function generateBestsellers(bestsellers) {
    let result = "";
    let numBS = bestsellers.length;
    if (numBS === 0) {
        result += `
        <h2>No bestsellers found</h2>
        `;
    } else if (numBS === 1) {
        result += `
        <h2>Best seller:</h2>
        `;
    } else {
        result += `
        <h2>Best sellers:</h2>
        `;
    }
    result += `
    <ul>
    `;

    for (let i = 0; i < numBS; i++) {
        let bestseller = bestsellers[i];
        let bestsellerInfo = `
        <li>
        <a href="product.php?id_prodotto=${bestseller["id"]}&versione=1">
        <img src="${bestseller["percorso_immagine"]}" alt="" />
        </a>
        <h3>${bestseller["nome"]}</h3>
        <p>${bestseller["descrizione"]}</p>
        </li>
        `;
        result += bestsellerInfo;
    }
    result += `
    </ul>
    `;

    const BSSection = document.getElementById('bestseller-section');
    BSSection.innerHTML = result;
}

function getBestsellers() {
    const url = 'api/api-homepage.php';
    queryAPI(url, "bestSellers", "numBestSellers=1", "GET", generateBestsellers);
}

function generateCategories(categories) {
    let result = "";
    let numCategories = categories.length;

    if (numCategories === 0) {
        result += `
        <h2>No categories found</h2>
        `;
        return result;
    }

    result += `
    <div id="carouselCategories" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
    `;

    for (let i = 0; i < numCategories; i++) {
        result += `
            <li data-bs-target="#carouselCategories" data-bs-slide-to="${i}" ${i === 0 ? 'class="active"' : ''}></li>
        `;
    }

    result += `
        </ol>
        <div class="carousel-inner">
    `;

    // console.log(categories);
    for (let i = 0; i < numCategories; i++) {
        let category = categories[i];
        result += `
        <div class="carousel-item ${i === 0 ? 'active' : ''}">
            <img class="d-block img-fluid category-image" src="upload/categories/${category["immagine"]}">
            <div class="carousel-caption d-none d-md-block">
                <h3>${category["nome"]}</h3>
                <a href="articles.php?categorie%5B%5D=${category["nome"]}" class="btn btn-primary">View Category</a>
            </div>
            </div>
        `;

    }

    result += `
        </div>
        <a class="carousel-control-prev" href="#carouselCategories" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselCategories" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    `;

    const categorySection = document.getElementById('category-section');
    categorySection.innerHTML = result;
}

function getCategories() {
    const url = 'api/api-homepage.php';
    queryAPI(url, "categories", "", "GET", generateCategories);
}

document.addEventListener('DOMContentLoaded', () => {
    getBestsellers();
    getCategories();
});