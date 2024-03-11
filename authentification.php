<?php
session_start();

// Paramètres de connexion à la base de données
$host = 'localhost'; // ou l'IP du serveur de base de données
$dbname = 'u626852211_BKCsite';
$username = 'u626852211_BKC';
$password = 'Kilian03+';

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Configuration des attributs PDO pour générer des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Impossible de se connecter à la base de données : " . $e->getMessage());
}

// Vérifie si les données du formulaire ont été soumises
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Préparation de la requête SQL pour récupérer l'utilisateur par son nom d'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Récupération de l'utilisateur
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            // Rediriger l'utilisateur vers une autre page après la connexion réussie
            // header("Location: page_accueil.php");
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Identifiants incorrects.";
        }
    } catch (PDOException $e) {
        die("Erreur d'exécution de la requête : " . $e->getMessage());
    }
}
?>
