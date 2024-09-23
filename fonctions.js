function editLien(lien) {
    document.getElementById('lienId').value = lien.id;
    document.getElementById('type_section').value = lien.type_section;
    document.getElementById('nom_interne').value = lien.nom_interne;
    document.getElementById('cible').value = lien.cible;
    document.getElementById('adresse_lien').value = lien.adresse_lien;
    document.getElementById('icon').value = lien.icon;
    document.getElementById('titre_bouton').value = lien.titre_bouton;
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

