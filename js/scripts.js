function showFullImg(id) {
    var photo_div = document.getElementById(id);
    var par = photo_div.parentNode;
    var c = par.clientHeight;

    if (c === 500) {
        var pho = photo_div.firstElementChild;
        if (pho.clientHeight > 500) {
            par.style.height = "100%";
        }
    }
    else if (c !== 500) {
        par.style.height = "500px";
    }

}

function checkImgStatus(id) {
    var photoshow = getCookie("photoshow" + id);
    alert("check");
    // var photo_div = document.getElementById(id);
    if (photoshow !== "") {
        setCookie("photoshow" + id, "", 1);
    }
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function setMyCookie(cname, cvalue) {

    document.cookie = cname + "=" + cvalue + ";";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}