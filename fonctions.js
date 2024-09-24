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

function afficheCat(cat) {
    var cats = ['catliens', 'catUsers'];
    cats.forEach(function(c) {
        document.getElementById(c).style.display = (c === cat) ? 'block' : 'none';
    });
    
    document.getElementById('btnLiens').classList.remove('active');
    document.getElementById('btnUsers').classList.remove('active');

    if (cat === 'catUsers') {
        document.getElementById('btnUsers').classList.add('active');
    } else {
        document.getElementById('btnLiens').classList.add('active');
    }
}
