// GESTION DE L'ENVOI DU FORMULAIRE //
const main = document.querySelector(".main-signup");
const form = document.querySelector(".signup-form");
const submitButton = document.getElementById("submit-signup");
const firstName = document.querySelector("#name");
const lastName = document.querySelector("#surname");
const email = document.querySelector("#email");
const birthdate = document.querySelector("#birthdate");
const username = document.querySelector("#username");

const password = document.querySelector("#password");
const passwordError = document.getElementById("password-error");
const conditions = document.querySelector(".checkbox-input");
  
function validate() {
    
    const firstNameIsValid = firstName.value.trim().length >= 2;
    const lastNameIsValid = lastName.value.trim().length >= 2;
    const userNameIsValid = username.value.trim().length >= 2;
    const emailIsValid = email.checkValidity();
    const birthdateIsValid = birthdate.value !== "";
    const passwordIsValid = password.checkValidity();

    if (firstNameIsValid && lastNameIsValid && emailIsValid && birthdateIsValid && userNameIsValid && passwordIsValid) {
        form.reset()
    } else {
        throw new Error("Formulaire non valide");
    }
}

form.addEventListener("submit", validate);


conditions.addEventListener("click", disableSubmit)

function disableSubmit(event) {

  const conditionsAreAccepted = event.target.checked;   
  if(conditionsAreAccepted === false) {                 
  submitButton.setAttribute("disabled", "true");

   } else {
  submitButton.removeAttribute("disabled");       
  }
}
