function calculateTotal(articles) {
    let total = 0;
    for (let i = 0; i < articles.length; i++) {
        total += parseFloat(articles[i]["prezzo"] * articles[i]["quantita"]);
    }
    return total.toFixed(2);
}


/**
 * Genera una richiesta HTTP POST - senza risposta
 */
function generateXHttpRequestFromForm(url, query, form) {
    const formData = new FormData(form);
    const params = {};
    for (const pair of formData.entries()) {
        params[pair[0]] = pair[1];
    }

    const queryString = new URLSearchParams(params).toString();
    generateRequest(url, `query=${query}&${queryString}`, "POST");
}

/**
 * Genera una richiesta HTTP POST - con risposta
 */
function generateRequest(url, content, method = "GET") {    
    try {
        const xhttp = new XMLHttpRequest();
        xhttp.open(method, url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onload = function () {
            if (xhttp.status === 200) {
                return JSON.parse(xhttp.responseText)["message"];
            } else {
                throw new Error(`Response status: ${xhttp.status} `);
            }
        };
        xhttp.send(content);
    } catch (error) {
        console.log(error.message);
    }
}

function queryAPI(url, query, data, method = "GET") {
    return generateRequest(url, `query=${query}&${data}`, method);
}










/**
 * Stabilisce se un ordine è in corso di spedizione o è stato consegnato
 */
/*
function getOrderState(tempo_spedizione, tempo_consegna) {
    const now = new Date();
    const offsetDate = new Date(now.getTime() - now.getTimezoneOffset() * 60000); // Apply timezone offset
    const data = new Date(offsetDate.toISOString().slice(0, 19));
    tempo_spedizione = new Date(tempo_spedizione.replace(' ', 'T'));
    tempo_consegna = new Date(tempo_consegna.replace(' ', 'T'));
    result = "";
    if (data < tempo_spedizione) {
        result = "L'ordine è in fase di preparazione";
    } else if (data < tempo_consegna) {
        result = "L'ordine è in fase di spedizione";
    } else {
        result = "L'ordine è stato consegnato";
    }
    return result;
}
*/

function showAvailability(nItems) {
    if (nItems > 20) {
        return "Disponibile";
    } else if (nItems > 0) {
        return "Ultimi pezzi: " + nItems;
        // } else if ($nItems > 0) {
        //     return "Sta per terminare";
    } else {
        return nItems;
    }
}