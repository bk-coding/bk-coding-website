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
    // Vérifie si l'élément existe
    var element = document.getElementById(bouton);
    if (element) {
        // Change l'affichage en "block" ou en "none" selon son état actuel
        element.style.display = (element.style.display === 'none' || element.style.display === '') ? 'block' : 'none';
    }
}