<?php
/**
 * Configuration des paramètres du cookie de session.
 * Le cookie de session est utilisé pour stocker les informations de session côté client.
 * Dans cette configuration, le cookie expirera après 3600 secondes (1 heure).
 * Il sera accessible sur tout le domaine défini dans la constante _DOMAIN_.
 * Le cookie sera accessible à toutes les pages du site grâce au chemin '/'.
 * Le cookie est également configuré en httponly, ce qui signifie qu'il ne peut pas être accédé par JavaScript.
 * Si la propriété 'secure' était définie à true, le cookie ne serait envoyé que via une connexion HTTPS sécurisée.
 */
session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => _DOMAIN_,
    /*'secure' => true,*/
    'httponly' => true
]);

/**
 * Démarrage de la session.
 * La session permet de stocker des variables persistantes entre les différentes pages du site pour un utilisateur connecté.
 * Elle est utilisée ici pour vérifier si l'utilisateur a le rôle "admin".
 * Si l'utilisateur n'est pas connecté (session non définie), il sera redirigé vers la page de connexion (login.php).
 * Si l'utilisateur est connecté mais n'a pas le rôle "admin", il sera redirigé vers la page d'accueil (index.php).
 */
session_start();

/**
 * Fonction pour restreindre l'accès aux utilisateurs avec le rôle "admin".
 * Cette fonction est utilisée pour protéger les pages d'administration.
 * Si l'utilisateur n'est pas connecté ou s'il n'a pas le rôle "admin", il sera redirigé vers la page appropriée.
 */
function adminOnly()
{
    if (!isset($_SESSION['user'])) {
        // Rediriger vers la page de connexion (login.php)
        header('location: ../login.php');
    } else if ($_SESSION['user']['role'] != 'admin') {
        // Rediriger vers la page d'accueil (index.php)
        header('location: ../index.php');
    }
}