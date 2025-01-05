function getOrderNotificationText(type) {
    if (type === 0) {
        return "L'ordine è stato spedito";
    } else if (type === 1) {
        return "L'ordine è stato consegnato";
    } else if (type === 3) {
        return "E' stato aggiunto un nuovo ordine";
    }
}

function getArticleNotificationText(type) {
    if (type === 0) {
        return "Questo articolo non è più disponibile";
    } else if (type === 1) {
        return "Questo articolo è nuovamente disponibile";
    }
}

function generateUserNotifications(UNotifications) {
    let result = "";
    let numUN = UNotifications.length;

    // Add title and button to show the notifications list
    result += `
    <div class="container">
        <button class="btn btn-secondary w-100 w-lg-80 py-3 fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#notificationsList" aria-expanded="false" aria-controls="notificationsList">
            Notifiche ordini
        </button>
    `;

    if (numUN === 0) {
        result += `
        <h3>Non ci sono notifiche</h3>
        </div>
        `;
    } else {
        // Generate the notifications list
        let notificationList = "";
        for (let i = 0; i < numUN; i++) {
            let notification = UNotifications[i];
            notificationList += `
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Notifica ordine n.${notification["id_ordine"]}</h5>
                    <p class="card-text"><strong>Data:</strong> ${notification["data"]}</p>
                    <p class="card-text">${getOrderNotificationText(notification["tipologia"])}</p>
                    <a href="orders.php#ord-${notification["id_ordine"]}" class="btn btn-primary">Vedi ordine</a>
                </div>
            </div>
            `;
        }

        // Add the collapsible section for notifications
        result += `
        <div class="collapse" id="notificationsList">
            <div class="mt-3">
                ${notificationList}
            </div>
        </div>
        </div>
        `;
    }

    // Insert the generated content into the section
    const UNSection = document.getElementById('ordersNotifications-section');
    UNSection.innerHTML = result;
}


function getUserNotifications() {
    const url = 'api/api-notifications.php';
    queryAPI(url, "orderNotifications", "", "GET", generateUserNotifications);
}

function generateArticleNotifications(ANotifications) {
    let result = "";
    let numAN = ANotifications.length;

    // Add title and button to show the notifications list
    result += `
    <div class="container">
        <button class="btn btn-secondary w-100 w-lg-80 py-3 fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#articleNotificationsList" aria-expanded="false" aria-controls="articleNotificationsList">
            Notifiche articoli
        </button>
    `;

    if (numAN === 0) {
        result += `
        <h3>Non ci sono notifiche</h3>
        </div>
        `;
    } else {
        // Generate the notifications list
        let notificationList = "";
        for (let i = 0; i < numAN; i++) {
            let notification = ANotifications[i];
            notificationList += `
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Articolo: ${notification["nome"]}</h5>
                    <p class="card-text"><strong>Formato:</strong> ${notification["formato"]}</p>
                    <p class="card-text"><strong>Durata:</strong> ${notification["durata"]}</p>
                    <p class="card-text"><strong>Intensità:</strong> ${notification["intensita"]}</p>
                    <p class="card-text"><strong>Data:</strong> ${notification["data"]}</p>
                    <p class="card-text">${getArticleNotificationText(notification["tipologia"])}</p>
                    <a href="product.php?id_prodotto=${notification["id_prodotto"]}&versione=${notification["versione"]}" class="btn btn-primary">Vedi articolo</a>
                </div>
            </div>
            `;
        }

        // Add the collapsible section for notifications
        result += `
        <div class="collapse" id="articleNotificationsList">
            <div class="mt-3">
                ${notificationList}
            </div>
        </div>
        </div>
        `;
    }

    // Insert the generated content into the section
    const ANSection = document.getElementById('articlesNotifications-section');
    ANSection.innerHTML = result;
}


function getArticleNotifications() {
    const url = 'api/api-notifications.php';
    queryAPI(url, "articleNotifications", "", "GET", generateArticleNotifications);
}

function readNotifications() {
    const url = 'api/api-notifications.php';
    queryAPI(url, "readNotifications", "", "POST"/*, (res)=>{console.log(res)}*/);
}

document.addEventListener('DOMContentLoaded', () => {
    getUserNotifications();
    getArticleNotifications();
    readNotifications();
});