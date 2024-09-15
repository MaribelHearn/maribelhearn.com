/*global detect deleteCookie getCookie setCookie*/
let cookieValues = {};

function erase() {
    const name = this.id.replace("delete_", "");
    delete cookieValues[name];
    deleteCookie(name);
    document.getElementById(this.id).parentNode.parentNode.remove();
}

function update() {
    const name = this.id.replace("cookie_", "");
    cookieValues[name] = this.value;
}

function init() {
    const cookies = document.cookie.split("; ");

    for (let cookie of cookies) {
        cookie = cookie.split('=');
        const name = cookie[0];
        const value = cookie[1];
        cookieValues[name] = value;
        document.getElementById("cookies").innerHTML += `<tr><td>${name}</td><td><input id='cookie_${name}' class='cookie' type='text' value='${value}'></td><td><input id='delete_${name}' class='delete' type='button' value='Delete'></td></tr>`;
    }

    const inputFields = document.getElementsByClassName("cookie");

    for (const element of inputFields) {
        element.addEventListener("change", update, false);
    }

    const deleteButtons = document.getElementsByClassName("delete");

    for (const element of deleteButtons) {
        element.addEventListener("click", erase, false);
    }
}

function save() {
    for (let name in cookieValues) {
        setCookie(name, cookieValues[name]);
    }

    alert("Cookies saved!");
}

function setToken() {
    const tokenExisted = getCookie("token");
    let cookieString = ";expires=Fri, 31 Dec 9999 23:59:59 UTC;path=/;sameSite=Strict;";

    if (location.protocol == "https:") {
        cookieString += "Secure;";
    }

    const value = document.getElementById("token").value;
    document.cookie = "token=" + JSON.stringify(value) + cookieString;
    alert("Blocking cookie set!");

    if (!tokenExisted) {
        document.getElementById("cookies").innerHTML += `<tr><td>token</td><td><input id='cookie_token' class='cookie' type='text' value='"${value}"'></td><td><input id='delete_token' class='delete' type='button' value='Delete'></td></tr>`;
    }
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

window.addEventListener("DOMContentLoaded", init, false);
document.getElementById("savecookie").addEventListener("click", save, false);
document.getElementById("setcookie").addEventListener("click", setToken, false);
userAgent();
