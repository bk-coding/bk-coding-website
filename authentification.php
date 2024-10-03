<!--
BK-Coding.net
file: authentification.php
author: Bastien Kilian
 -->

<?php
// Start a new session or reuse an existing one
session_start();

// Include the functions file to make them available in this script
include('functions.php');

// Require the database configuration file
require_once('dbconfig.php');

// Check if the login form has been submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    try {
        // Clean and prepare the input data for SQL injection prevention
        $username = clean_input($_POST['username']);
        $password = clean_input($_POST['password']);

        // Prepare a SQL query to retrieve the user by their username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Fetch the user from the database
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the user exists and if the password is correct
        if ($user && password_verify($password, $user['password'])) {
            // Régénérer l'ID de session pour éviter les attaques de fixation de session
            session_regenerate_id(true); // True pour supprimer l'ancienne session
            // Set session variables to indicate that the user has logged in successfully
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];
            // Rediriger l'utilisateur vers une autre page après la connexion réussie
            // header("Location: page_accueil.php");
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Identifiants incorrects.";
        }
    } catch (PDOException $e) {
        // Catch any PDO exceptions and display an error message
        echo "An error occurred: " . $e->getMessage();
    }
}
?>