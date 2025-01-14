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
function generateRequest(url, content, method = "GET", callback = null, displayError = true) {
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
                if (displayError) {
                    let errorText = `ERRORE: REQUEST FAILED
                    Response status: ${xhttp.status}
                    Response message: "${responseMessage}"`;
                    // console.log(errorText);
                    alert(errorText);
                }
            }
        };
        xhttp.send(content);
    } catch (error) {
        // console.log(error.message);
    }
    return xhttp;
}

function getEntriesFromForm(form) {
    const formData = new FormData(form);
    const params = {};
    for (const pair of formData.entries()) {
        params[pair[0]] = pair[1];
    }
    return params;
}

/**
 * Genera una richiesta HTTP POST da un form
 */
function generateXHttpRequestFromForm(url, query, form) {
    return generateXHttpRequestFromEntries(url, query, getEntriesFromForm(form));
}

/**
 * Genera una richiesta HTTP POST da un insieme di coppie chiave-valore
 */
function generateXHttpRequestFromEntries(url, query, entries) {
    const queryString = new URLSearchParams(entries).toString();
    return generateRequest(url, `query=${query}&${queryString}`, "POST");
}

/**
 * Genera una domanda all'API 
 */
function queryAPI(url, query, data = "", method = "GET", callback = null, displayError = true) {
    // console.log(`URL: ${url}, query: ${query}, data: ${data}, method: ${method}`);
    let content = `query=${query}`;
    if (data !== "") {
        content += `&${data}`;
    }
    return generateRequest(url, content, method, callback, displayError);
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

/* Set the width of the side navigation to 260px */
function openNav() {
    if (toggleSearch.searchState) {
        toggleSearch();
    }
    document.getElementById("mySidenav").style.width = "260px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

/* Set the width of the side navigation to 0 */
function toggleNav() {
    if (typeof toggleNav.navState == 'undefined') {
        toggleNav.navState = true;
        openNav();
    }
    if (toggleNav.navState) {
        closeNav();
        toggleNav.navState = false;
    } else {
        openNav();
        toggleNav.navState = true;
    }
}

function toggleSearch() {
    if (typeof toggleSearch.searchState == 'undefined') {
        toggleSearch.searchState = true;
        openSearchBar();
    }
    if (toggleSearch.searchState) {
        closeSearchBar();
        toggleSearch.searchState = false;
    } else {
        openSearchBar();
        toggleSearch.searchState = true;
    }
}

function setSearchBarTop() {
    const navbarHeight = document.querySelector('.navbar').offsetHeight;
    document.getElementById('mySearchBar').style.top = `${navbarHeight}px`;
}

function openSearchBar() {
    if (toggleNav.navState) {
        toggleNav();
    }
    setSearchBarTop();
    document.getElementById("mySearchBar").style.height = "60px";
}

function closeSearchBar() {
    document.getElementById("mySearchBar").style.height = "0";
}

document.addEventListener('DOMContentLoaded', () => {
    toggleNav.navState = false;
    toggleSearch.searchState = false;
    setSearchBarTop();
});

document.addEventListener('resize', () => {
    setSearchBarTop();
});