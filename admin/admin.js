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
    try {
        const ua = detect.parse(navigator.userAgent);
        const host = (location.host == "maribelhearn.com" ? "https://maribelhearn.com/" : "");
        
        document.getElementById("os").innerHTML = `<img class='admin_icon' src='${host}admin/icons/${ua.os.name}.png' alt='${ua.os.name} icon'> ${ua.os.name}`;
        document.getElementById("browser").innerHTML = `<img class='admin_icon' src='${host}admin/icons/${ua.browser.family}.png' alt='${ua.browser.name} icon'> ${ua.browser.name}`;
    } catch (err) {
        // do nothing
    }
}

document.getElementById("setcookie").addEventListener("click", set);
userAgent();
