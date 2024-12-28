function calculateTotal(articles) {
    let total = 0;
    for (let i = 0; i < articles.length; i++) {
        total += parseFloat(articles[i]["prezzo"] * articles[i]["quantita"]);
    }
    return total.toFixed(2);
}


/**
 * Genera una richiesta HTTP POST
 */
function generateXHttpRequestFromForm(url, query, form) {
    const formData = new FormData(form);
    const params = {};
    for (const pair of formData.entries()) {
        params[pair[0]] = pair[1];
    }

    try {
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onload = function () {
            alert(JSON.parse(xhttp.responseText)["message"]);
        };
        const queryString = new URLSearchParams(params).toString();
        xhttp.send(`query=${query}&${queryString}`);
    } catch (error) {
        console.log(error.message);
    }
}