<?php
// Inclusion des fichiers et configurations nécessaires
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/article.php";
require_once __DIR__ . "/lib/menu.php";

// Ajout de la page "actualite.php" au menu principal avec des métadonnées spécifiques pour l'article (à remplir plus tard)
$mainMenu["actualite.php"] = ["head_title" => "Article introuvable", "meta_description" => "Article introuvable", "exclude" => true];

$error = false;

// Vérification si l'ID de l'article est passé dans l'URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    // Récupération des informations de l'article depuis la base de données
    $article = getArticleById($pdo, $id);

    if ($article) {
        // Si l'article existe, on récupère l'image associée à l'article
        $imagePath = getArticleImage($article["image"]);
        // On met à jour les métadonnées de la page "actualite.php" avec les informations de l'article
        $mainMenu["actualite.php"] = ["head_title" => htmlentities($article["title"]), "meta_description" => htmlentities(substr($article["content"], 0, 250)), "exclude" => true];
    } else {
        // Si l'article n'existe pas, on marque une erreur
        $error = true;
    }
} else {
    // Si l'ID de l'article n'est pas présent dans l'URL, on marque une erreur
    $error = true;
}

// Inclusion du fichier d'en-tête (header) qui contient le début de la page HTML
require_once __DIR__ . "/templates/header.php";
?>

<?php if (!$error) { ?>
    <!-- Affichage des informations de l'article dans une mise en page en deux colonnes -->
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
            <!-- Affichage de l'image de l'article -->
            <img src="<?= $imagePath ?>"
                 class="d-block mx-lg-auto img-fluid"
                 alt="<?= htmlentities($article["title"]) ?>"
                 width="700"
                 height="500"
                 loading="lazy">
        </div>
        <div class="col-lg-6">
            <!-- Affichage du titre et du contenu de l'article -->
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">
                <?= htmlentities($article["title"]) ?>
            </h1>
            <p class="lead">
                <?= htmlentities($article["content"]) ?>
            </p>
        </div>
    </div>
<?php } else { ?>
    <!-- Affichage d'un message d'erreur si l'article n'existe pas -->
    <h1>Article introuvable</h1>
<?php } ?>

<?php require_once __DIR__ . "/templates/footer.php"; ?>