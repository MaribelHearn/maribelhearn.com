/*global detect*/
function set() {
    let cookieString = ";expires=Fri, 31 Dec 9999 23:59:59 UTC;path=/;sameSite=Strict;";

    if (location.protocol == "https:") {
        cookieString += "Secure;";
    }

    document.cookie = "token=" + JSON.stringify(document.getElementById("token").value) + cookieString;
    alert("Blocking cookie set!");
}

function userAgent() {
    const ua = detect.parse(navigator.userAgent);
    document.getElementById("os").innerHTML = "<img src='" + (location.host == "maribelhearn.com" ? "https://maribelhearn.com/" : "") +
    "admin/icons/" + ua.os.name + ".png' alt='" + ua.os.name + " icon'> " + ua.os.name;
    document.getElementById("browser").innerHTML = "<img src='" + (location.host == "maribelhearn.com" ? "https://maribelhearn.com/" : "") +
    "admin/icons/" + ua.browser.family + ".png' alt='" + ua.browser.name + " icon'> " + ua.browser.name;
}

document.getElementById("setcookie").addEventListener("click", set);
userAgent();
