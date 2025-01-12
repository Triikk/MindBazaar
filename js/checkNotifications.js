let unreadAN = 0;
let unreadON = 0;
let ANready = false;
let ONready = false;

function updateNotificatificationBadge() {
    if (!ANready || !ONready) {
        return;
    }
    const notificationIcon = document.getElementById('notification-icon');
    if (unreadAN + unreadON > 0) {
        notificationIcon["src"] = "./upload/icons/symbols/notificationFull.png";
    } else {
        notificationIcon["src"] = "./upload/icons/symbols/notificationEmpty.png";
    }
    ANready = false;
    ONready = false;
}

function checkNotifications() {
    const ANUrl = 'api/api-notifications.php';
    const ONUrl = 'api/api-notifications.php';

    const ANResponse = queryAPI(ANUrl, "unreadANotifications", "", "GET", updateUnreadAN);
    const ONResponse = queryAPI(ONUrl, "unreadONotifications", "", "GET", updateUnreadON);
}

function updateUnreadAN(ANresponse) {
    unreadAN = ANresponse["length"];
    ANready = true;
    updateNotificatificationBadge();
}

function updateUnreadON(ONresponse) {
    unreadAN = ONresponse["length"];
    ONready = true;
    updateNotificatificationBadge();
}

function generateNotifications() {
    const url = 'api/api-notifications.php';
    queryAPI(url, "generateNotifications", "", "POST"/*, (res)=>{console.log(res)}*/);
}

document.addEventListener('DOMContentLoaded', () => {
    generateNotifications();
    checkNotifications();
});