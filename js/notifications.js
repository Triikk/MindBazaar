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
    <h2>Notifiche utente:</h2>
    <ul>
    `;

    for (let i = 0; i < numUN; i++) {
        let Unotification = `
        <li>
        <h3>Notifica ordine n.${UNotifications[i]["id_ordine"]}</h3>
        <p>Data: ${UNotifications[i]["data"]}</p>
        <p>${getOrderNotificationText(UNotifications[i]["tipologia"])}</p>
        </li >
            `;
        result += Unotification;
    }
    result += `
    </ul >
            `;
    return result;
}

async function getUserNotifications() {
    const url = 'api/api-notifications.php?query=orderNotifications';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status} `);
        }
        const json = await response.json();
        console.log(json);
        const UNotifications = generateUserNotifications(json);
        const UNSection = document.querySelector('main > :nth-child(1)');
        UNSection.innerHTML = UNotifications;
    } catch (error) {
        console.log(error.message);
    }

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
        <h3>Articolo: ${ANotifications[i]["nome"]}</h3>
        <p>Formato: ${ANotifications[i]["formato"]}</p>
        <p>Durata: ${ANotifications[i]["durata"]}</p>
        <p>Intensità: ${ANotifications[i]["intensita"]}</p>
        <p>Data: ${ANotifications[i]["data"]}</p>
        <p>${getArticleNotificationText(ANotifications[i]["tipologia"])}</p>
        </li >
            `;
        result += Anotification;
    }
    result += `
    </ul >
            `;
    return result;
}

async function getArticleNotifications() {
    const url = 'api/api-notifications.php?query=articleNotifications';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status} `);
        }
        const json = await response.json();
        console.log(json);
        const ANotifications = generateArticleNotifications(json);
        const ANSection = document.querySelector('main > :nth-child(2)');
        ANSection.innerHTML = ANotifications;
    } catch (error) {
        console.log(error.message);
    }
}

getUserNotifications();
getArticleNotifications();