/**
 * Local Storage for Login
 *   
 */

var emailLogin;
var passwordLogin;
window.onload = function () {
    emailLogin = document.getElementById('emailLogin');
    passwordLogin = document.getElementById('passwordLogin');
    getLoginData();
    var loginButton = document.getElementById('loginButton');
    loginButton.onclick = setLoginData;
};
function setLoginData() {
    if (document.getElementById('saveLogin').checked) {
        localStorage.setItem('emailLogin', emailLogin.value);
        localStorage.setItem('passwordLogin', passwordLogin.value);
    } else {
        localStorage.removeItem('emailLogin');
        localStorage.removeItem('passwordLogin');
    }
}
function getLoginData() {
    emailLogin.value = localStorage.getItem('emailLogin');
    passwordLogin.value = localStorage.getItem('passwordLogin');
}
