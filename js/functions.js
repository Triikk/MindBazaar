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

/**
 * Stabilisce se un ordine è in corso di spedizione o è stato consegnato
 */
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