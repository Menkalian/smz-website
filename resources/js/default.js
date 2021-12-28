let convenienceAllowed = false
let onConvenienceListeners = []

function requestCookie() {
    new CookiesEuBanner(function () {
        let cookieSettings;
        if (Cookies.get("cookieSettings") === undefined) {
            cookieSettings = Object();
            cookieSettings.essential = document.getElementById("cookies-eu-essential").checked;
            //cookieSettings.convenience = document.getElementById("cookies-eu-convenience").checked;
            cookieSettings.facebook = document.getElementById("cookies-eu-facebook").checked;
            Cookies.set("cookieSettings", JSON.stringify(cookieSettings), "SameSite=Lax");
        } else {
            cookieSettings = JSON.parse(Cookies.get("cookieSettings"));
        }

        if (!cookieSettings.essential) {
            console.log("Hey. I know you can manipulate UI-Inputs and cookies, but his value is not used anyway. So have fun :P.");
        }
        // if (cookieSettings.convenience) {
        //     allowConvenience();
        // }
        if (cookieSettings.facebook) {
            activateFacebookIntegration();
        }

        document.getElementsByClassName("")
    }, true)
}

function colorswitch(id) {
    let element = document.getElementById(id);
    let otherSource = element.getAttribute("x-other");
    let currentSource = element.getAttribute("src");
    element.setAttribute("x-other", currentSource);
    element.setAttribute("src", otherSource);
}

// function allowConvenience() {
//     convenienceAllowed = true
//
//     for (let i = 0 ; i < onConvenienceListeners.length ; i++) {
//         onConvenienceListeners[i]()
//     }
// }

function activateFacebookIntegration() {
    let facebookContainers = document.getElementsByClassName("facebook-container");
    for (let i = 0 ; i < facebookContainers.length ; i++) {
        // Load content from x-embed
        facebookContainers.item(i).innerHTML = facebookContainers.item(i).getAttribute("x-embed");
    }
}

function openSettings() {
    console.log("Opening Settings...");

    // Read cookie settings
    if (Cookies.get("cookieSettings") === undefined) {
        cookieSettings = Object();
        cookieSettings.essential = document.getElementById("cookies-eu-essential").checked;
        cookieSettings.facebook = document.getElementById("cookies-eu-facebook").checked;
        Cookies.set("cookieSettings", JSON.stringify(cookieSettings), "SameSite=Lax");
    } else {
        cookieSettings = JSON.parse(Cookies.get("cookieSettings"));
    }

    // Set the sliders correctly
    document.getElementById("settings-facebook").checked = cookieSettings.facebook;

    document.getElementById("settings-reset").onclick = ev => {
        document.getElementById("settings").style.display = 'none';
        return false;
    }

    document.getElementById("settings-accept").onclick = ev => {
        cookieSettings.facebook = document.getElementById("settings-facebook").checked;
        Cookies.set("cookieSettings", JSON.stringify(cookieSettings), "SameSite=Lax");
        // Reload site
        document.location = document.location;
        return false;
    }

    document.getElementById("settings").style.display='block';
}