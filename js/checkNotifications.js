function updateNotificatificationBadge(ANCount, ONCount, notificationBadge) {
    if (ONCount + ANCount > 0) {
        notificationBadge.innerHTML = `Notifiche (${ONCount}) + (${ANCount})`;
    } else {
        notificationBadge.innerHTML = `Notifiche`;
    }
}

async function checkNotifications() {
    const ANUrl = 'api/api-notifications.php';
    const ONUrl = 'api/api-notifications.php';

    const ANResponse = queryAPI(ANUrl, "unreadANotifications");
    const ONResponse = queryAPI(ONUrl, "unreadONotifications", "", "GET", function(res) {
        if (ANResponse.status === 200 && ONResponse.status === 200) {
            const ANotificationsJSON = JSON.parse(ANResponse.responseText);
            const ONotificationsJSON = JSON.parse(ONResponse.responseText);
            const notificationBadge = document.querySelector('body > header > nav > ul > li:nth-child(5) > a');
            updateNotificatificationBadge(ANotificationsJSON.length, ONotificationsJSON.length, notificationBadge);
        }
    });

    /*
    try {
        const ANResponse = await fetch(ANUrl);
        const ONResponse = await fetch(ONUrl);
        if (!ANResponse.ok || !ONResponse.ok) {
            throw new Error(`Response status: ${ANResponse.status} ${ONResponse.status}`);
        }
        const ANotificationsJSON = await ANResponse.json();
        console.log(ANotificationsJSON);
        const ONotificationsJSON = await ONResponse.json();
        console.log(ONotificationsJSON);
        const notificationBadge = document.querySelector('body > header > nav > ul > li:nth-child(5) > a');
        updateNotificatificationBadge(ANotificationsJSON.length, ONotificationsJSON.length, notificationBadge);
    } catch (error) {
        console.log(error.message);
    }*/
}

async function generateNotifications() {
    const url = 'api/api-notifications.php';

    queryAPI(url, "generateNotifications", "", "POST", (res)=>{console.log(res)});

    /*
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
    } catch (error) {
        console.log(error.message);
    }*/
}

generateNotifications();
checkNotifications();