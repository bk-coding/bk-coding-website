function editLien(lien) {
	document.getElementById("lienId").value = lien.id;
	document.getElementById("type_section").value = lien.type_section;
	document.getElementById("nom_interne").value = lien.nom_interne;
	document.getElementById("cible").value = lien.cible;
	document.getElementById("adresse_lien").value = lien.adresse_lien;
	document.getElementById("icon").value = lien.icon;
	document.getElementById("titre_bouton").value = lien.titre_bouton;
}

function editUser(utilisateur) {
	document.getElementById("userId").value = utilisateur.id;
	document.getElementById("username").value = utilisateur.username;
	document.getElementById("password").value = utilisateur.password;
	document.getElementById("email").value = utilisateur.email;
	document.getElementById("role").value = utilisateur.role;
}

function afficheCat(cat) {
	const cats = ["catliens", "catusers"]; // Il peut être extrait dynamiquement si nécessaire
	cats.forEach(function (c) {
		document.getElementById(c).style.display = c === cat ? "block" : "none";
	});

	// Retire "active" de tous les boutons
	cats.forEach(function (c) {
		document.getElementById("btn" + ucfirst(c)).classList.remove("active");
	});

	// Ajoute "active" à celui qui est sélectionné
	document.getElementById("btn" + ucfirst(cat)).classList.add("active");
}

// Fonction d'assistance pour mettre en majuscule la première lettre
function ucfirst(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}
