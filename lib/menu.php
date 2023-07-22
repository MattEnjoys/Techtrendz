<?php
/**
 * Tableau représentant le menu principal du site.
 * Chaque élément du tableau est une page du site avec ses métadonnées associées.
 * Chaque élément est représenté par une clé correspondant au nom du fichier de la page,
 * et une valeur étant un tableau associatif contenant les métadonnées suivantes :
 * - "menu_title" : Le titre affiché dans le menu pour cette page.
 * - "head_title" : Le titre affiché dans l'en-tête de la page (balise <title>).
 * - "meta_description" : La description utilisée dans la balise meta pour le référencement.
 * - "exclude" (optionnel) : Un booléen indiquant si cette page doit être exclue du menu principal.
 */
$mainMenu = [
    "index.php" => [
        "menu_title" => "Accueil",
        "head_title" => "Accueil TechTrendz - Site d'actu tech",
        "meta_description" => "TechTrendz, l'actu tech !"
    ],
    "actualites.php" => [
        "menu_title" => "Actualités",
        "head_title" => "Actualités tech et dev",
        "meta_description" =>
        "Découvrez toutes nos actualités."
    ],
    "a_propos.php" => [
        "menu_title" => "A propos",
        "head_title" => "A propos de TechTrendz",
        "meta_description" =>
        "L'histoire du site TechTrendz"
    ],
    "contact.php" => [
        "menu_title" => "Contact",
        "head_title" => "Contacter TechTrendz",
        "meta_description" =>
        "Contacter le support technique TechTrendz"
    ],
    "inscription.php" => [
        "menu_title" => "Inscription",
        "head_title" => "S'inscrire à TechTrendz",
        "meta_description"
        => "Inscription TechTrendz",
        "exclude" => true
    ],
    "login.php" => [
        "menu_title" => "Connexion",
        "head_title" => "Connexion TechTrendz",
        "meta_description" =>
        "Connexion TechTrendz",
        "exclude" => true
    ],
];

/**
 * Tableau représentant le menu principal de l'interface d'administration.
 * Chaque élément du tableau est une page de l'interface d'administration avec ses métadonnées associées.
 * Chaque élément est représenté par une clé correspondant au nom du fichier de la page,
 * et une valeur étant un tableau associatif contenant les métadonnées suivantes :
 * - "menu_title" : Le titre affiché dans le menu pour cette page.
 * - "head_title" : Le titre affiché dans l'en-tête de la page (balise <title>).
 * - "meta_description" : La description utilisée dans la balise meta pour le référencement.
 */
$mainMenuAdmin = [
    "index_admin.php" => [
        "menu_title" => "Accueil",
        "head_title" => "Accueil Admin TechTrendz",
        "meta_description"
        => "Admin TechTrendz"
    ],
    "articles_admin.php" => [
        "menu_title" => "Articles",
        "head_title" => "Arcticles TechTrendz",
        "meta_description"
        => "Les articles de TechTrendz"
    ],
];