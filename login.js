const loginButton = document.getElementById("login-button-desktop");
const loginForm = document.querySelector(".login-form");
const containerInBack = document.querySelector(".descr-and-img-container-landingpage")
const signupContainer = document.querySelector(".signup-button-container");
const retourButton = document.getElementById("retour-button");
loginButton.addEventListener("click", displayLoginForm)
retourButton.addEventListener("click", closeLoginForm)

function displayLoginForm () {
    loginForm.style.display = "block";

    retourButton.style.display = "block";
    loginButton.style.display = "none";
    containerInBack.style.opacity = "0.5"
    signupContainer.style.opacity = "0.5"
}

function closeLoginForm () {
    loginButton.style.display = "block";
    retourButton.style.display = "none";
    loginForm.style.display = "none";
    containerInBack.style.opacity = "1"
    signupContainer.style.opacity = "1"

}