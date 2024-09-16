document.querySelectorAll('.icone').forEach((element, index) => {
    element.addEventListener('click', function() {
        const passwdElement = document.querySelectorAll('.passwd')[index];
        if (passwdElement.type === "password" && passwdElement.value !== '') {
            passwdElement.type = "text";
            element.src = "../img/coup-doeil.png";
        }
        else if(passwdElement.type == '')
        {
            passwdElement.value = '';
        }
        else {
            passwdElement.type = "password";
            element.src = "../img/option-dinterface-a-oeil-ouvert-visible.png";
        }
    });
});
 // Fonction pour réinitialiser les champs de saisie
 function resetInputs() {
    // Sélectionner tous les champs de saisie avec la classe 'reset-input'
    var tape = document.querySelectorAll('.passwd');
    document.querySelector('.username').value = '';
    // Parcourir chaque champ et le réinitialiser
    tape.forEach(function(inputs) {
        inputs.value = ''; // Réinitialiser la valeur
    });
}

// Fonction pour rendre la div cliquable
document.querySelectorAll('.black, .white').forEach(function(div) {
    div.addEventListener('click', function() {
        var link = div.querySelector('a');  // Trouver le lien à l'intérieur de la div
        if (link) {
            window.location.href = link.href;  // Rediriger vers l'URL du lien
        }
    });
});

// Appeler la fonction de réinitialisation lorsque la page est chargée
window.onload = resetInputs;
