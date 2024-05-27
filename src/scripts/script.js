document.addEventListener("DOMContentLoaded", function() {

    var submitButton = document.querySelector("button[type='submit']");
    var form = document.querySelector("form");

    form.addEventListener("submit", function(event) {
        // Vérifie si un message d'erreur est présent
        if (errorMessage.innerHTML !== "") {
            event.preventDefault(); // Empêche l'envoi du formulaire
            alert("Veuillez corriger les erreurs avant de soumettre le formulaire.");
        }
    });

});