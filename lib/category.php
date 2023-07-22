<?php
/**
 * Récupère la liste des catégories à partir de la base de données.
 *
 * @param PDO $pdo Connexion à la base de données.
 * @return array Un tableau contenant les catégories récupérées depuis la base de données.
 */
function getCategories(PDO $pdo)
{
    // Requête SQL pour récupérer toutes les catégories de la table 'categories'
    $sql = 'SELECT * FROM categories';
    $query = $pdo->prepare($sql);
    $query->execute();

    // Récupération et retour des catégories sous forme d'un tableau
    return $query->fetchAll();
}