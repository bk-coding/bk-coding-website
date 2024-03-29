<?php
session_start();

include('functions.php');

require_once('dbconfig.php');

// Vérifie si les données du formulaire ont été soumises
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = clean_input($_POST['username']);
    $password = clean_input($_POST['password']);

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
