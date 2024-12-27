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
        // <img src="${bestsellers[i]["img"]}" alt="" />
        let bestseller = `
        <li>
        <h3>${bestsellers[i]["nome"]}</h3>
        <p>${bestsellers[i]["descrizione"]}</p>
        </li>
        `;
        result += bestseller;
    }
    result += `
    </ul>
    `;
    return result;
}

async function getBestsellers() {
    const url = 'api/api-homepage.php?query=bestSellers';
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
    return result;
}

async function getCategories() {
    const url = 'api/api-homepage.php?query=categories';
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
}

getBestsellers();
getCategories();