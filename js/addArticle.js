const API_URL = "api/api-articles.php";

function addArticle() {
    generateXHttpRequestFromForm(API_URL, "addArticle", document.forms["add-article"]);
}

function addProduct() {
    generateXHttpRequestFromForm(API_URL, "addProduct", document.forms["add-product"]);
}