function updateNotificatificationBadge(ANCount, ONCount, notificationBadge) {
    if (ONCount + ANCount > 0) {
        notificationBadge.innerHTML = `Notifiche (${ONCount}) + (${ANCount})`;
    } else {
        notificationBadge.innerHTML = `Notifiche`;
    }
}

function checkNotifications() {
    const ANUrl = 'api/api-notifications.php';
    const ONUrl = 'api/api-notifications.php';

    const ANResponse = queryAPI(ANUrl, "unreadANotifications");
    const ONResponse = queryAPI(ONUrl, "unreadONotifications", "", "GET", function(res) {
        if (ANResponse.status === 200 && ONResponse.status === 200) {
            const ANotificationsJSON = JSON.parse(ANResponse.responseText);
            const ONotificationsJSON = JSON.parse(ONResponse.responseText);
            const notificationBadge = document.getElementById('notification-badge');
            // const notificationIcon = document.getElementById('notification-icon');
            // DA IMPLEMENTARE L'AGGIORNAMENTO DELLA ICONA
            updateNotificatificationBadge(ANotificationsJSON.length, ONotificationsJSON.length, notificationBadge);
        }
    });
}

function generateNotifications() {
    const url = 'api/api-notifications.php';
    queryAPI(url, "generateNotifications", "", "POST"/*, (res)=>{console.log(res)}*/);
}

document.addEventListener('DOMContentLoaded', () => {
    generateNotifications();
    checkNotifications();
});