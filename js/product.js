document.addEventListener('DOMContentLoaded', () => {
    const availabilityElement = document.getElementById('availability');
    const quantityElement = document.getElementById('quantity');
    const priceElement = document.getElementById('price');
    const addToCartButton = document.getElementById('add-to-cart');
    const form = document.querySelector('form');

    // Async function to fetch the specific product manifestation
    async function fetchArticleData(selectedFields) {
        id_prodotto = selectedFields["id_prodotto"];
        formato = encodeURIComponent(selectedFields["formato"]);
        durata = encodeURIComponent(selectedFields["durata"]);
        intensita = selectedFields["intensita"];
        const url = `api/api-product.php?query=getArticleInfo&id_prodotto=${id_prodotto}&formato=${formato}&durata=${durata}&intensita=${intensita}`;
        // const url = `api/api-product.php?query=getArticleInfo&id_prodotto=1&formato=marmellata&durata=5%20ore&intensita=2`;
        console.log("URL:", url); // Debug: log the URL
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

    // Function to gather selected input field values
    function getSelectedFields() {
        const formData = new FormData(form);
        const selectedFields = {};
        for (const [name, value] of formData.entries()) {
            selectedFields[name] = value;
        }
        return selectedFields;
    }

    // Async function to update price and availability dynamically
    async function updateProductDetails() {
        const selectedFields = getSelectedFields(); // Collect all selected values
        console.log("Selected fields:", selectedFields); // Debug: log selected fields

        try {
            // Fetch the manifestation data based on selected fields
            const articleData = await fetchArticleData(selectedFields);
            console.log("Article data:", articleData); // Debug: log article data
            // Update the availability and price in the DOM
            availabilityElement.textContent = `Disponibilità: ${showAvailability(articleData["disponibilita"])}`;
            if (articleData["disponibilita"] == "Questo prodotto non è disponibile") {
                priceElement.textContent = "Prezzo: -";
                addToCartButton.setAttribute("disabled", "disabled");
                quantityElement.setAttribute("max", 0);
            } else {
                priceElement.textContent = `Prezzo: €${(articleData["prezzo"] * selectedFields["quantita"]).toFixed(2)}`;
                if (selectedFields["quantita"] > articleData["disponibilita"]) {
                    addToCartButton.setAttribute("disabled", "disabled");
                } else {
                    addToCartButton.removeAttribute("disabled");
                    quantityElement.setAttribute("max", articleData["disponibilita"]);
                }
            }
        } catch (error) {
            console.error("Error fetching article data:", error);
            availabilityElement.textContent = "Disponibilità: Errore";
            priceElement.textContent = "Prezzo: -";
        }
    }

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