<?php
// Inclusion des fichiers et configurations nécessaires
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/article.php";
require_once __DIR__ . "/lib/menu.php";
require_once __DIR__ . "/templates/header.php";

// Récupération de tous les articles depuis la base de données
$articles = getArticles($pdo);
?>

<h1>Actualités</h1>

<div class="row text-center">
    <!-- Affichage de chaque article sous forme de cartes Bootstrap -->
    <?php foreach ($articles as $key => $article) {
        require __DIR__ . "/templates/article_part.php";
    } ?>
    <!-- Fin de l'affichage des articles -->
</div>

<?php require_once __DIR__ . "/templates/footer.php" ?>