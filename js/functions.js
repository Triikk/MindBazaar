function calculateTotal(articles) {
    let total = 0;
    for (let i = 0; i < articles.length; i++) {
        total += parseFloat(articles[i]["prezzo"] * articles[i]["quantita"]);
    }
    return total.toFixed(2);
}

/**
 * Genera una richiesta HTTP generica
*/
function generateRequest(url, content, method = "GET", callback = null) {
    if (method === "GET") {
        url += `?${content}`;
        content = "";
    }
    const xhttp = new XMLHttpRequest();
    try {
        // console.log(`Sending ${method} request to ${url} with content: ${content}`);
        // console.log(callback);
        xhttp.open(method, url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onload = function () {
            let responseMessage = JSON.parse(xhttp.responseText)["message"];
            if (xhttp.status === 200) {
                if (callback !== null) {
                    // console.log(responseMessage);
                    callback(responseMessage);
                }
            } else {
                let errorText = `ERRORE: REQUEST FAILED
                Response status: ${xhttp.status}
                Response message: "${responseMessage}"`;
                console.log(errorText);
                alert(errorText);
            }
        };
        xhttp.send(content);
    } catch (error) {
        console.log(error.message);
    }
    return xhttp;
}

/**
 * Genera una richiesta HTTP POST da un form
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
 * Genera una domanda all'API 
 */
function queryAPI(url, query, data = "", method = "GET", callback = null) {
    console.log(`URL: ${url}, query: ${query}, data: ${data}, method: ${method}`);
    let content = `query=${query}`;
    if (data !== "") {
        content += `&${data}`;
    }
    return generateRequest(url, content, method, callback);
}

function showAvailability(nItems) {
    if (nItems > 20) {
        return "Disponibile";
    } else if (nItems > 0) {
        return "Ultimi pezzi - " + nItems;
    } else {
        return nItems;
    }
}

function isDefined(value) {
    return typeof value !== 'undefined';
}

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

/* Set the width of the side navigation to 260px */
function openNav() {
    closeSearchBar();
    document.getElementById("mySidenav").style.width = "260px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function openSearchBar() {
    closeNav();
    document.getElementById("mySearchBar").style.height = "60px";
    // document.body.marginTop = "50px";
}

function closeSearchBar() {
    document.getElementById("mySearchBar").style.height = "0";
}