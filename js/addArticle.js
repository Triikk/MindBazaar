async function addArticle() {
    const url = `api/api-articles.php`;

    const form = document.forms["add-article"];
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
        xhttp.send(`query=addArticle&id_prodotto=${params["id_prodotto"]}&formato=${params["formato"]}&durata=${params["durata"]}&disponibilita=${params["disponibilita"]}&prezzo=${params["prezzo"]}&intensita=${params["intensita"]}&versione=${params["versione"]}`);
    } catch (error) {
        console.log(error.message);
    }
}