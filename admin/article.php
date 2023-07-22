<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";
adminOnly(); // Vérifie que l'utilisateur est un administrateur

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/tools.php";
require_once __DIR__ . "/../lib/article.php";
require_once __DIR__ . "/../lib/category.php";
require_once __DIR__ . "/templates/header.php";

$errors = []; // Tableau pour stocker les erreurs
$messages = []; // Tableau pour stocker les messages de succès
$article = [
    'title' => '',
    'content' => '',
    'category_id' => ''
];

$categories = getCategories($pdo); // Récupère la liste des catégories pour le formulaire

if (isset($_GET['id'])) {
    $article = getArticleById($pdo, $_GET['id']); // Récupère les données de l'article en cas de modification
    if ($article === false) {
        $errors[] = "L'article n'existe pas"; // Message d'erreur si l'article n'existe pas
    }
    $pageTitle = "Formulaire modification article"; // Titre de la page pour la modification d'article
} else {
    $pageTitle = "Formulaire d'ajout d'article"; // Titre de la page pour l'ajout d'article
}

if (isset($_POST['saveArticle'])) {
    $fileName = null;
    if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {
        $checkImage = getimagesize($_FILES["file"]["tmp_name"]);
        if ($checkImage !== false) {
            $fileName = slugify(basename($_FILES["file"]["name"]));
            $fileName = uniqid() . '-' . $fileName;
            $uploadsFolderPath = dirname(__DIR__) . "/" . _ARTICLES_IMAGES_FOLDER_ADMIN_;

            // On déplace le fichier uploadé dans notre dossier upload
            if (move_uploaded_file($_FILES["file"]["tmp_name"], dirname(__DIR__) . _ARTICLES_IMAGES_FOLDER_ADMIN_ . $fileName)) {
                if (isset($_POST['image'])) {
                    unlink(dirname(__DIR__) . _ARTICLES_IMAGES_FOLDER_ADMIN_ . $_POST['image']); // Supprime l'ancienne image si on a posté une nouvelle
                }
            } else {
                $errors[] = "Le fichier n'a pas été uploadé"; // Message d'erreur en cas d'échec d'upload
            }
        } else {
            $errors[] = "Le fichier doit être une image"; // Message d'erreur si le fichier n'est pas une image valide
        }
    } else {
        if (isset($_GET['id'])) {
            if (isset($_POST['delete_image'])) {
                unlink(dirname(__DIR__) . _ARTICLES_IMAGES_FOLDER_ADMIN_ . $_POST['image']); // Supprime l'image si on a coché la case de suppression
            } else {
                $fileName = $_POST['image'];
            }
        }
    }
    /* On stocke toutes les données envoyées dans un tableau pour pouvoir afficher
       les informations dans les champs, utile par exemple si on upload un mauvais
       fichier et qu'on ne souhaite pas perdre les données qu'on avait saisies.
    */
    $article = [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'category_id' => $_POST['category_id'],
        'image' => $fileName
    ];
    if (!$errors) {
        if (isset($_GET["id"])) {
            $id = (int) $_GET["id"];
        } else {
            $id = null;
        }
        $res = saveArticle($pdo, $_POST["title"], $_POST["content"], $fileName, (int) $_POST["category_id"], $id);

        if ($res) {
            $messages[] = "L'article a bien été sauvegardé"; // Message de succès si l'article est sauvegardé avec succès
            if (!isset($_GET["id"])) {
                $article = [
                    'title' => '',
                    'content' => '',
                    'category_id' => ''
                ]; // On vide le tableau article pour avoir les champs de formulaire vides
            }
        } else {
            $errors[] = "L'article n'a pas été sauvegardé"; // Message d'erreur si l'article n'a pas été sauvegardé
        }
    }
}
?>

<h1>
    <?= $pageTitle; ?>
</h1>

<?php foreach ($messages as $message) { ?>
    <div class="alert alert-success"
         role="alert">
        <?= $message; ?> <!-- Affiche les messages de succès -->
    </div>
<?php } ?>

<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger"
         role="alert">
        <?= $error; ?> <!-- Affiche les messages d'erreur -->
    </div>
<?php } ?>

<?php if ($article !== false) { ?>
    <form method="POST"
          enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title"
                   class="form-label">Titre</label>
            <input type="text"
                   class="form-control"
                   id="title"
                   name="title"
                   value="<?= $article['title']; ?>">
        </div>
        <div class="mb-3">
            <label for="content"
                   class="form-label">Contenu</label>
            <textarea class="form-control"
                      id="content"
                      name="content"
                      rows="8"><?= $article['content']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="category"
                   class="form-label">Catégorie</label>
            <select name="category_id"
                    id="category"
                    class="form-select">
                <?php foreach ($categories as $category) { ?>
                    <option value="1"
                            <?php if (isset($article['category_id']) && $article['category_id'] == $category['id']) { ?>selected="selected"
                            <?php } ?>>
                        <?= $category['name'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <?php if (isset($_GET['id']) && isset($article['image'])) { ?>
            <p>
                <img src="<?= _ARTICLES_IMAGES_FOLDER_ . $article['image'] ?>"
                     alt="<?= $article['title'] ?>"
                     width="100">
                <label for="delete_image">Supprimer l'image</label>
                <input type="checkbox"
                       name="delete_image"
                       id="delete_image">
                <input type="hidden"
                       name="image"
                       value="<?= $article['image']; ?>">
            </p>
        <?php } ?>
        <p>
            <input type="file"
                   name="file"
                   id="file">
        </p>
        <input type="submit"
               name="saveArticle"
               class="btn btn-primary"
               value="Enregistrer">
    </form>
<?php } ?>

<?php require_once __DIR__ . "/templates/footer.php"; ?>