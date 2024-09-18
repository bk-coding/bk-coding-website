<!--
BK-Coding.net
file: deconnexion.php
author: Bastien Kilian
 -->

<?php
session_start(); // Démarrage de la session pour accéder aux variables de session

// Détruire toutes les variables de session
session_unset();

// Si vous voulez détruire complètement la session, effacez également le cookie de session.
// Notez que cela détruira la session et pas seulement les données de session !
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
        $params['path'], $params['domain'], 
        $params['secure'], $params['httponly']
    );
}

// Finalement, détruire la session.
session_destroy();

// Rediriger l'utilisateur vers la page de connexion ou la page d'accueil après la déconnexion
header("Location: index.php");
exit;
?>
