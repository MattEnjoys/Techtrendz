<?php
require_once __DIR__ . "/templates/header.php"; // Inclusion du fichier d'en-tête HTML
require_once __DIR__ . "/../lib/pdo.php"; // Inclusion du fichier pour la gestion de la base de données
require_once __DIR__ . "/../lib/article.php"; // Inclusion du fichier pour les fonctions relatives aux articles

// Récupération du numéro de page depuis les paramètres GET, ou 1 si non défini
if (isset($_GET["page"])) {
    $page = (int) $_GET["page"];
} else {
    $page = 1;
}

// Récupération des articles pour la page courante
$articles = getArticles($pdo, _ADMIN_ITEM_PER_PAGE_, $page);

// Récupération du nombre total d'articles dans la base de données
$totalArticles = getTotalArticle($pdo);

// Calcul du nombre total de pages nécessaires pour afficher tous les articles avec la pagination
$totalPages = ceil($totalArticles / _ADMIN_ITEM_PER_PAGE_);
?>

<h1 class="py-5">Liste des articles</h1>
<div class="d-flex gap-2 justify-content-left py-5">
    <a class="btn btn-primary d-inline-flex align-items-left"
       href="article.php">
        Ajouter un article
    </a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article) { ?>
            <tr>
                <th scope="row">
                    <?= $article["id"]; ?>
                </th>
                <td>
                    <?= $article["title"]; ?>
                </td>
                <td>
                    <a href="../actualite.php?id=<?= $article["id"] ?>">Voir</a>
                    <a href="article.php?id=<?= $article['id'] ?>">Modifier</a>
                    | <a href="article_delete.php?id=<?= $article['id'] ?>"
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php if ($totalPages > 1) { ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <li class="page-item <?php if ($i === $page) {
                    echo "active";
                } ?>">
                    <a class="page-link"
                       href="?page=<?= $i; ?>"><?= $i; ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>
<?php } ?>

<?php require_once __DIR__ . "/templates/footer.php"; // Inclusion du fichier de pied de page HTML ?>