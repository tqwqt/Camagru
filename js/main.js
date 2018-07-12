
function signUp() {
    //alert("sign Up");
    document.location.assign('http://localhost:8101/main/register');
   // var form = document.getElementById('form_main');
    // var passRepeatField = document.createElement('input');
    // passRepeatField.type = 'password';
    // passRepeatField.name = 'repeat_password';
    // var placeholder = document.createAttribute("placeholder");
    // placeholder.value = "repeat password";
    // passRepeatField.setAttributeNode(placeholder);
    // form.appendChild(passRepeatField);
    //addText(form, {}, "Repeat password");
   // form.removeChild(document.getElementsByName("btnlogin")[0]);//.style.height = "0px";
    //form.removeChild(document.getElementsByName("btnSignUp")[0]);//.style.height = "0px";
    //form.appendChild(document.createTextNode("Repeat password"));
    //addINput(form, {type:"password",name:"repeat_password",placeholder:"repeat password"});
    //form.appendChild(document.createTextNode("Email"));
    //addINput(form, {type:"email", name:"email", placeholder:"email"});
    //addINput(form, {type:"submit", name:"submitReg", value:"OK", class:"btn"});
   // btnlogin.style.visibility = "hidden";
   // btnlogin.style.type = "hidden";
}
function signIn()
{
    document.location.assign('/main/cabinet');
}
function logOut() {
    document.location.assign('/logout');
}
function addINput(parent,  attributes) {

    var elem = document.createElement('input');
    for (var key in attributes)
    {
        var at = document.createAttribute(key+"");
        at.value = attributes[key];
        elem.setAttributeNode(at);

    }
    parent.appendChild(elem);
}

function addText(parent, attributes, text) {

    var elem = document.createElement('p');
    var textnode = document.createTextNode(text);
    elem.appendChild(textnode);
    for (var key in attributes)
    {
        var at = document.createAttribute(key+"");
        at.value = attributes[key];
        elem.setAttributeNode(at);

    }
    parent.appendChild(elem);
}

function cabinet() {
    document.location.assign('/cabinet');
}

function gallery() {
    document.location.assign('/home');
}