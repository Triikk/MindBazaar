const API_URL = "api/api-articles.php";

async function addArticle() {
    generateXHttpRequestFromForm(API_URL, "addArticle", document.forms["add-article"]);
}

async function addProduct() {
    generateXHttpRequestFromForm(API_URL, "addProduct", document.forms["add-product"]);
}