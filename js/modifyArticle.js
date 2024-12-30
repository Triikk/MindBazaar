async function adjustModifyArticleValues() {
    adjustArticleVersionValue(document.forms["modify-article"]);
}

async function adjustDeleteArticleValues() {
    adjustArticleVersionValue(document.forms["delete-article"])
}

async function adjustArticleVersionValues(form) {
    form["versione"].value;
    const articleFields = getKeyValueFromForm(document.forms["form"]);
    console.log(articleFields);
    const queryString = encodeParams(articleFields);
    const url = `api-articles.php?query=getArticleVersion&${queryString}`;
    console.log(url);
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status} `);
        }
        const json = await response.json();
        console.log(json);
        return json;
    } catch (error) {
        console.log(error.message);
    }
}

function encodeParams(params) {
    return Object.keys(params)
        .map(key => `${encodeURIComponent(key)}=${encodeURIComponent(params[key])}`)
        .join('&');
}