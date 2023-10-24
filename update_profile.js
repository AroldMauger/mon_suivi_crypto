// DESKTOP //
const updateButton = document.getElementById('update-profile-button');
updateButton.addEventListener('click', function(event) {
    event.stopPropagation();

    let username = document.getElementById('username-from-db');
    let email = document.getElementById('email-from-db');
    let date = document.getElementById('date-from-db');
    const validateButton = document.getElementById('validate-update-button')

    // Remplacez chaque span par un champ d'entrée
    username.innerHTML = `<input type="text" id="username-input" value="${username.textContent}" />`;
    email.innerHTML = `<input type="email" id="email-input" value="${email.textContent}" />`;
    date.innerHTML = `<input type="date" id="date-input" value="${date.textContent}" />`;

    // Modifiez le bouton pour "Valider"
    updateButton.style.display = "none";
    validateButton.style.display = "block";
});
document.body.addEventListener('click', function(event) {
    if (event.target.id === "validate-update-button") {
        let usernameInput = document.getElementById('username-input').value;
        let emailInput = document.getElementById('email-input').value;
        let dateInput = document.getElementById('date-input').value;

        // Désactivez temporairement le bouton
        event.target.disabled = true;
        console.log(usernameInput)
        fetch('update_profile.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                username: usernameInput,
                email: emailInput,
                datenaissance: dateInput
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data && data.success) {
                // Mettez à jour les éléments <span> et informez l'utilisateur du succès
                document.getElementById('username-from-db').textContent = usernameInput;
                document.getElementById('email-from-db').textContent = emailInput;
                document.getElementById('date-from-db').textContent = dateInput;

                event.target.textContent = "Modifier profil";
                event.target.id = "update-profile-button";
                alert("Profil mis à jour avec succès!");
            } else {
                console.error("Erreur lors de la mise à jour du profil");
                alert("Une erreur s'est produite lors de la mise à jour. Veuillez réessayer.");
            }
        })
        .catch(error => {
            console.error('Erreur lors de la requête fetch:', error);
            alert("Une erreur s'est produite lors de la mise à jour. Veuillez réessayer.");
        })
        .finally(() => {
            // Réactivez le bouton une fois que tout est terminé
            event.target.disabled = false;
        });
    }
});


// MOBILE //
const updateButtonMobile = document.getElementById('update-profile-button-mobile');
updateButtonMobile.addEventListener('click', function(event) {
    event.stopPropagation();

    let username = document.getElementById('username-from-db');
    let email = document.getElementById('email-from-db');
    let date = document.getElementById('date-from-db');
    const validateButton = document.getElementById('validate-profile-button-mobile')

    // Remplacez chaque span par un champ d'entrée
    username.innerHTML = `<input type="text" id="username-input" value="${username.textContent}" />`;
    email.innerHTML = `<input type="email" id="email-input" value="${email.textContent}" />`;
    date.innerHTML = `<input type="date" id="date-input" value="${date.textContent}" />`;

    // Modifiez le bouton pour "Valider"
    updateButtonMobile.style.display = "none";
    validateButton.style.display = "block";
});
document.body.addEventListener('click', function(event) {
    if (event.target.id === "validate-profile-button-mobile") {
        let usernameInput = document.getElementById('username-input').value;
        let emailInput = document.getElementById('email-input').value;
        let dateInput = document.getElementById('date-input').value;

        // Désactivez temporairement le bouton
        event.target.disabled = true;
        console.log(usernameInput)
        fetch('update_profile.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                username: usernameInput,
                email: emailInput,
                datenaissance: dateInput
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data && data.success) {
                // Mettez à jour les éléments <span> et informez l'utilisateur du succès
                document.getElementById('username-from-db').textContent = usernameInput;
                document.getElementById('email-from-db').textContent = emailInput;
                document.getElementById('date-from-db').textContent = dateInput;

                event.target.id = "update-profile-button-mobile";
                alert("Profil mis à jour avec succès!");
            } else {
                console.error("Erreur lors de la mise à jour du profil");
                alert("Une erreur s'est produite lors de la mise à jour. Veuillez réessayer.");
            }
        })
        .catch(error => {
            console.error('Erreur lors de la requête fetch:', error);
            alert("Une erreur s'est produite lors de la mise à jour. Veuillez réessayer.");
        })
        .finally(() => {
            // Réactivez le bouton une fois que tout est terminé
            event.target.disabled = false;
        });
    }
});