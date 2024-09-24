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
    
    fetch('parametres.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // Vérifiez si la réponse est ok (statut 200-299)
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
        }
        return response.text(); // Récupérer la réponse en texte brut
    })
    .then(data => {
        console.log("Réponse brute :", data); // Afficher la réponse brute pour débogage
        let jsonData;
        try {
            jsonData = JSON.parse(data); // Essayez de convertir la réponse en JSON
        } catch (e) {
            throw new Error('Erreur lors de la conversion JSON: ' + e.message);
        }
        
        console.log(jsonData.message); // Afficher le message de succès ou d'erreur
        alert(jsonData.message); // Optionnel : message de confirmation
        document.getElementById(formId).reset(); // Réinitialiser le formulaire

        // Vous pouvez ajouter ici du code pour mettre à jour l'interface
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Une erreur est survenue: ' + error.message);
    });
}
