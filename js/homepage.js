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

    for (let i = 0; i < numBS; i++) {
        // <img src="${bestsellers[i]["img"]}" alt="" />
        let bestseller = `
        <h3>${bestsellers[i]["nome"]}</h3>
        <p>${bestsellers[i]["descrizione"]}</p>
        `;
        result += bestseller;
    }
    return result;
}

async function getBestsellersData() {
    const url = 'api/api-homepage.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        // const contentType = response.headers.get('Content-Type');
        // if (contentType && contentType.includes('application/json')) {
        const json = await response.json();
        //     console.log('JSON Response:', json);
        //     return json;
        // } else {
        //     // Handle unexpected response types
        //     const text = await response.text();
        //     console.error('Unexpected Response:', text);
        //     throw new Error('Invalid response type: Expected JSON');
        // }
        console.log(json);
        const bestsellers = generateBestsellers(json);
        const mainSection = document.querySelector('main section');
        mainSection.innerHTML = bestsellers;
    } catch (error) {
        console.log(error.message);
    }
}

getBestsellersData();