function getOrderNotificationText(type) {
    if (type === 0) {
        return "L'ordine è stato spedito";
    } else if (type === 1) {
        return "L'ordine è stato consegnato";
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
    result += `
    <h2>Notifiche ordini:</h2>
    <ul>
    `;

    for (let i = 0; i < numUN; i++) {
        let notification = UNotifications[i];
        let Unotification = `
        <li>
        <a href="orders.php#ord-${notification["id_ordine"]}">
        <h3>Notifica ordine n.${notification["id_ordine"]}</h3>
        <p>Data: ${notification["data"]}</p>
        <p>${getOrderNotificationText(notification["tipologia"])}</p>
        </a>
        </li >
            `;
        result += Unotification;
    }
    result += `
    </ul >
            `;
    
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
    result += `
    <h2>Notifiche articoli:</h2>
    <ul>
    `;

    for (let i = 0; i < numAN; i++) {
        let Anotification = `
        <li>
        <a href="product.php?id_prodotto=${ANotifications[i]["id_prodotto"]}&versione=${ANotifications[i]["versione"]}">
        <h3>Articolo: ${ANotifications[i]["nome"]}</h3>
        <p>Formato: ${ANotifications[i]["formato"]}</p>
        <p>Durata: ${ANotifications[i]["durata"]}</p>
        <p>Intensità: ${ANotifications[i]["intensita"]}</p>
        <p>Data: ${ANotifications[i]["data"]}</p>
        <p>${getArticleNotificationText(ANotifications[i]["tipologia"])}</p>
        </a>
        </li >
            `;
        result += Anotification;
    }
    result += `
    </ul >
            `;
    
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