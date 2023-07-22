<?php
/**
 * Connexion à la base de données MySQL en utilisant PDO.
 * Les informations de connexion sont récupérées à partir des constantes définies dans le fichier de configuration.
 * Si la connexion échoue, une exception est levée et un message d'erreur est affiché.
 */
try {
    $pdo = new PDO("mysql:dbname=" . _DB_NAME_ . ";host=" . _DOMAIN_ . ";charset=utf8mb4", _DB_USER_, _DB_PASSWORD_);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}