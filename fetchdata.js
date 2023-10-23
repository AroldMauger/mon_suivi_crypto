document.addEventListener("DOMContentLoaded", function() {
    var userContainer = document.querySelector('.user-info-container');

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'database.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            var data = JSON.parse(xhr.responseText);
            data.forEach(function(info) {
                var username = document.querySelector('#username-from-db');
                username.className = 'user-info';
                username.textContent = 'Nom d\'utilisateur: ' + info.username;
                userContainer.appendChild(username);

                var email = document.querySelector('#email-from-db');
                email.className = 'user-info';
                email.textContent = 'Email: ' + info.email;
                userContainer.appendChild(email);

                var datenaissance = document.querySelector('#date-from-db');
                datenaissance.className = 'user-info';
                datenaissance.textContent = 'Date de naissance: ' + info.datenaissance;
                userContainer.appendChild(datenaissance);
            });
        } else if (xhr.status !== 200) {
            console.log('Erreur lors de la requête AJAX.');
        }
    };

    xhr.send();
});
