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

function editCachet(cachet) {
	document.getElementById('cachetId').value = cachet.id;
	document.getElementById('user').value = cachet.user;
	document.getElementById('date_debut').value = cachet.date_debut;
	document.getElementById('date_fin').value = cachet.date_fin;
	document.getElementById('nombre_cachet').value = cachet.nombre_cachet;
	document.getElementById('nombre_heure').value = cachet.nombre_heure;
	document.getElementById('montant_brut').value = cachet.montant_brut;
	document.getElementById('montant_net').value = cachet.montant_net;
	document.getElementById('description').value = cachet.description;
}

function afficheCat(cat) {
	// Récupérez tous les boutons contenant l'attribut data-cat
	const buttons = document.querySelectorAll('.toolbarbtn');
	const cats = []; // Tableau pour contenir les identifiants des catégories

	buttons.forEach(button => {
		cats.push(button.getAttribute('data-cat')); // Ajoute chaque data-cat au tableau
	});

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

function toggleFields() {
	const nombreCachet = document.getElementById('nombre_cachet');
	const nombreHeure = document.getElementById('nombre_heure');

	if (nombreCachet.value) {
		nombreHeure.disabled = true; // Désactive le champ nombre_heure
	} else {
		nombreHeure.disabled = false; // Réactive le champ nombre_heure
	}

	if (nombreHeure.value) {
		nombreCachet.disabled = true; // Désactive le champ nombre_cachet
	} else {
		nombreCachet.disabled = false; // Réactive le champ nombre_cachet
	}
}

let calculableNet = true; // État pour savoir si le montant_net est calculable

function updateMontantNet() {
	if (calculableNet) {
		const montantBrut = parseFloat(document.getElementById('montant_brut').value.trim()) || 0;
		const montantNet = montantBrut * (1 - 0.26); // Retirer 26%
		document.getElementById('montant_net').value = montantNet.toFixed(2); // Affiche le montant net avec 2 décimales
	}
}

function setCalculable(isCalculable) {
	calculableNet = isCalculable; // Met à jour l'état calculable lors du focus/perte de focus
}

function validateForm() {
	const montantBrut = document.getElementById('montant_brut').value.trim();
	const montantNet = document.getElementById('montant_net').value.trim();

	// Vérifie que montant_brut est rempli
	if (montantBrut === "") {
		alert("Veuillez remplir le montant brut.");
		return false; // Empêche la soumission du formulaire
	}

	// Vérifie que l'un ou l'autre champ est rempli
	if (montantBrut === "" && montantNet === "") {
		alert("Veuillez remplir au moins le montant brut, le montant net sera calculé automatiquement.");
		return false; // Empêche la soumission du formulaire
	}

	return true; // Autorise la soumission du formulaire
}
