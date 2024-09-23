function editLien(lien) {
    document.getElementById('lienId').value = lien.id;
    document.getElementById('type_section').value = lien.type_section;
    document.getElementById('nom_interne').value = lien.nom_interne;
    document.getElementById('cible').value = lien.cible;
    document.getElementById('adresse_lien').value = lien.adresse_lien;
    document.getElementById('icon').value = lien.icon;
    document.getElementById('titre_bouton').value = lien.titre_bouton;
}
function editUser(utilisateur) {
    document.getElementById('userId').value = utilisateur.id;
    document.getElementById('username').value = utilisateur.username;
    document.getElementById('password').value = utilisateur.password;
    document.getElementById('email').value = utilisateur.email;
    document.getElementById('role').value = utilisateur.role;
}

function afficheCat(bouton) {
    // Récupérer toutes les divs qui doivent être affichées
    var categories = ['catliens', 'catUsers']; 
    // Masquer toutes les catégories
    categories.forEach(function(cat) {
        var element = document.getElementById(cat);
        if (element) {
            element.style.display = 'none';
        }
    });

    // Affiche uniquement la div spécifiée
    var selectedElement = document.getElementById(bouton);
    if (selectedElement) {
        selectedElement.style.display = 'block'; // Affiche la div correspondante
    }

    // Changer l'apparence des boutons
    var buttons = document.querySelectorAll('#paramtoolbar button'); // Sélectionne tous les boutons
    buttons.forEach(function(btn) {
        btn.classList.remove('active'); // Supprime la classe 'active' de tous les boutons
    });

    // Ajouter la classe 'active' au bouton cliqué
    var activeButton = Array.from(buttons).find(btn => btn.onclick.toString().includes(bouton));
    if (activeButton) {
        activeButton.classList.add('active'); // Ajoute la classe 'active' au bouton actif
    }
}
function submitForm(formId) {
    var formData = new FormData(document.getElementById(formId));
    
    // Envoyer la requête AJAX
    fetch('parametres.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // Vérifiez si la réponse est ok (statut 200-299)
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json(); // On retourne directement la réponse au format JSON
    })
    .then(data => {
        // Réinitialiser le formulaire ou mettre à jour l'interface si nécessaire
        document.getElementById(formId).reset();
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
}

