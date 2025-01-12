let unreadAN = 0;
let unreadON = 0;
let ANready = false;
let ONready = false;
let notFull = "";
let notFullHover = "";
let notEmpty = "";
let notEmptyHover = "";

function updateNotificatificationBadge() {
    if (!ANready || !ONready) {
        return;
    }
    const notificationIcon0 = document.getElementById('notification-icon-0');
    const notificationIcon1 = document.getElementById('notification-icon-1');
    if (unreadAN + unreadON > 0) {
        notificationIcon0["src"] = notFull;
        notificationIcon1["src"] = notFullHover;
    } else {
        notificationIcon0["src"] = notEmpty;
        notificationIcon1["src"] = notEmptyHover;
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
    queryAPI(url, "generateNotifications", "", "POST");
}

function initNotificationImagePath(res) {
    notFull = res["notFull"];
    notFullHover = res["notFullHover"];
    notEmpty = res["notEmpty"];
    notEmptyHover = res["notEmptyHover"];
    console.log(res);
    generateNotifications();
    checkNotifications();
}

document.addEventListener('DOMContentLoaded', () => {
    queryAPI('api/api-functions.php', "getNotificationImagePath", "", "GET", (res) => {initNotificationImagePath(res)});
});