<?php
// Vérifie si l'article a une image associée, sinon utilise l'image par défaut
if ($article["image"] === null) {
    $imagePath = _ASSETS_IMAGES_FOLDER_ . "default-article.jpg";
} else {
    $imagePath = _ARTICLES_IMAGES_FOLDER_ . $article["image"];
}
?>

<!-- Affiche l'article sous forme de carte -->
<div class="col-md-4 my-2">
    <div class="card">
        <!-- Affiche l'image de l'article (image par défaut si aucune image n'est associée) -->
        <img src="<?= $imagePath ?>"
             class="card-img-top"
             alt="<?= htmlentities($article["title"]) ?>">

        <div class="card-body">
            <!-- Affiche le titre de l'article -->
            <h5 class="card-title">
                <?= htmlentities($article["title"]) ?>
            </h5>

            <!-- Affiche un extrait du contenu de l'article (les 100 premiers caractères) -->
            <p class="card-text">
                <?= htmlentities(substr($article["content"], 0, 100)) ?>
            </p>

            <!-- Affiche un lien pour lire l'article complet -->
            <a href="actualite.php?id=<?= $article["id"] ?>"
               class="btn btn-primary">Lire la suite</a>
        </div>
    </div>
</div>