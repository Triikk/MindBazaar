function generateOrders(orders) {
    let result = "";
    let numOrders = orders.length;
    result += `
    <h2>I tuoi ordini:</h2>
    <ul>
    `;
    for (let i = 0; i < numOrders; i++) {
        let orderListTuple = orders[i];
        let order = orderListTuple[0];
        let articleList = orderListTuple[1];
        let orderHTML = `
        <li>
        <h3>Ordine n.${order["id"]} del ${order["tempo_ordinazione"]}</h3>
        <ul>
        `;
        for (let j = 0; j < articleList.length; j++) {
            let article = articleList[j];
            orderHTML += `
            <li>
            <h4>${article["nome"]}</h4>
            <p>Categoria: ${article["nome_categoria"]}</p>
            <p>Quantita: ${article["quantita"]}</p>
            <p>Prezzo: ${article["prezzo"]}€</p>
            </li >
            `;
        }
        orderHTML += `
        </ul>
        <p>Totale: ${calculateTotal(articleList)}€</p>
        </li >
        `;
        result += orderHTML;
    }
    result += `
    </ul >
            `;
    return result;
}

async function getOrders() {
    const url = 'api/api-orders.php?query=getOrders';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status} `);
        }
        // const contentType = response.headers.get('Content-Type');
        // if (contentType && contentType.includes('application/json')) {
        //     const text = await response.text();
        //     console.log(text);
        //     const json = await response.json();
        //     console.log('JSON Response:', json);
        //     return json;
        // } else {
        //     // Handle unexpected response types
        //     const text = await response.text();
        //     console.error('Unexpected Response:', text);
        //     throw new Error('Invalid response type: Expected JSON');
        // }
        const json = await response.json();
        console.log(json);
        const orders = generateOrders(json);
        const section = document.querySelector('main section');
        section.innerHTML = orders;
    } catch (error) {
        console.log(error.message);
    }
}

getOrders();
