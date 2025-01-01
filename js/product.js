const selectedFields = {};
let availabilityElement = null;
let quantityElement = null;
let priceElement = null;
let addToCartButton = null;

// function to fetch the specific product manifestation
function fetchArticleData(selectedFields) {
    id_prodotto = selectedFields["id_prodotto"];
    formato = encodeURIComponent(selectedFields["formato"]);
    durata = encodeURIComponent(selectedFields["durata"]);
    intensita = selectedFields["intensita"];
    const url = `api/api-product.php`;
    queryAPI(url, "getArticleInfo", `id_prodotto=${id_prodotto}&formato=${formato}&durata=${durata}&intensita=${intensita}`, "GET", updatePage);
}

// Function to gather selected input field values
function getSelectedFields() {
    const formData = new FormData(form);
    for (const [name, value] of formData.entries()) {
        selectedFields[name] = value;
    }
    return selectedFields;
}

// function to update price, availability and version dinamically
function updateProductDetails() {
    const selectedFields = getSelectedFields(); // Collect all selected values
    fetchArticleData(selectedFields);
}

// update price, availability and version in DOM
function updatePage(articleData) {
    console.log(articleData);
    availabilityElement.textContent = `Disponibilità: ${showAvailability(articleData["disponibilita"])}`;
    if (articleData["disponibilita"] == "Questo prodotto non è disponibile") {
        priceElement.textContent = "Prezzo: -";
        addToCartButton.setAttribute("disabled", true);
        quantityElement.setAttribute("max", 0);
    } else {
        priceElement.textContent = `Prezzo: €${(articleData["prezzo"] * selectedFields["quantita"]).toFixed(2)}`;
        if (selectedFields["quantita"] > articleData["disponibilita"]) {
            addToCartButton.setAttribute("disabled", true);
        } else {
            addToCartButton.removeAttribute("disabled");
            quantityElement.setAttribute("max", articleData["disponibilita"]);
        }
    }

    // Update version in the admin form
    let adminForms = [];
    let mod = document.forms["modify-article"];
    if (isDefined(mod)) {
        adminForms.push(mod);
    }
    let del = document.forms["delete-article"];
    if (isDefined(del)) {
        adminForms.push(del);
    }
    console.log(adminForms);
    for (let i = 0; i < adminForms.length; i++) {
        adminForms[i]["versione"].value = articleData["versione"];
        if (!isDefined(articleData["versione"])) {
            adminForms[i]["submit"].disabled = true;
        } else {
            adminForms[i]["submit"].disabled = false;
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    availabilityElement = document.getElementById('availability');
    quantityElement = document.getElementById('quantity');
    priceElement = document.getElementById('price');
    addToCartButton = document.getElementById('add-to-cart');
    const form = document.querySelector('form');
    
    // Attach event listeners to all input fields
    form.addEventListener('change', async () => {
        await updateProductDetails();
    });
    
    form.addEventListener('input', async () => {
        await updateProductDetails();
    });
    
    // Initial update on page load
    updateProductDetails();
});