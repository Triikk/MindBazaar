const API_URL = "api/api-articles.php";

function addArticle() {
    generateXHttpRequestFromForm(API_URL, "addArticle", document.forms["add-article"], true, true);
}

function addProduct() {
    const form = document.forms["add-product"];
    const formData = new FormData();
    formData.append("immagine", form.immagine.files[0]);
    formData.append("nome_categoria", form.nome_categoria.value);
    formData.append("query", "addProduct");
    // prima invio l'immagine, poi invio il resto dei dati
    fetch(API_URL, {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                const productFormData = new FormData(form);
                const params = {};
                for (const pair of productFormData.entries()) {
                    params[pair[0]] = pair[1];
                }
                params["immagine"] = form.immagine.files[0].name;
                generateXHttpRequestFromEntries(API_URL, "addProduct", params, true, true);
            }
            else {
                alert("Errore durante il caricamento del file: " + data.message);
            }
        })
        .catch(error => {
            alert("Errore: " + error.message);
        });
}