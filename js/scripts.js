function showFullImg(id)
{

   // var photoshow = getCookie("photoshow"+id);
    var photo_div = document.getElementById(id);
    var par = photo_div.parentNode;
    var c = par.clientHeight;
    //alert(c);
    if (c === 500)
    {
      //  alert("in 500");
        par.style.height = "100%";
    }
    else if (c !== 500)
    {
        par.style.height = "500px";
    }
    // if (photoshow === "") {
    //
    //     par.style.height = "100%";
    //     //document.cookie = "photoshow" + id + "=full";
    //     setCookie("photoshow"+id, "full", 1);
    // }
    // else {
    //     par.style.height = "500px";
    //     setCookie("photoshow"+id, "", 1);
    // }
}
function checkImgStatus(id) {
    var photoshow = getCookie("photoshow"+id);
    alert("check");
   // var photo_div = document.getElementById(id);
   if (photoshow !== ""){
       setCookie("photoshow"+id, "", 1);
   }
}
function likeImg(id)
{

    // alert("start");
    var photo_div = document.getElementById(id);//ClassName('photo_list');

    // var par = photo_div.parentNode;
    photo_div.src = "../resources/liked.png";
    //console.log(photo_div);
    //photo_div.style.setProperty('overflow', 'visible');
    // alert("end");
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function setMyCookie(cname, cvalue) {

    document.cookie = cname + "=" + cvalue + ";";
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
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