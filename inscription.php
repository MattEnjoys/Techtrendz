<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/tools.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/user.php";
require_once __DIR__ . "/lib/menu.php"; // Ajoutez cette ligne pour inclure menu.php
require_once __DIR__ . "/templates/header.php";

$errors = [];
$messages = [];
if (isset($_POST['addUser'])) {
    /*
        @todo ajouter la vérification sur les champs
        Cette partie du code vérifie si le formulaire d'inscription a été soumis (si la variable $_POST['addUser'] est définie).
        Ensuite, elle appelle la fonction addUser pour ajouter un nouvel utilisateur à la base de données.
        Les données du formulaire (prénom, nom, email et mot de passe) sont transmises en tant qu'arguments à la fonction addUser.
        Si l'ajout de l'utilisateur est réussi (retourne true), un message de succès est ajouté à la liste $messages[].
        Sinon, s'il y a une erreur lors de l'ajout de l'utilisateur (retourne false), un message d'erreur est ajouté à la liste $errors[].
        @todo - À compléter : Il est suggéré de mettre en place la vérification des champs du formulaire avant d'ajouter l'utilisateur.
    */
    $res = addUser($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password']);
    if ($res) {
        $messages[] = 'Merci pour votre inscription';
    } else {
        $errors[] = 'Une erreur s\'est produite lors de votre inscription';
    }
}

?>

<h1>Inscription</h1>

<?php foreach ($messages as $message) { ?>
    <div class="alert alert-success"
         role="alert">
        <?= $message; ?>
    </div>
<?php } ?>
<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger"
         role="alert">
        <?= $error; ?>
    </div>
<?php } ?>
<form method="POST">
    <div class="mb-3">
        <label for="first_name"
               class="form-label">Prénom</label>
        <input type="text"
               class="form-control"
               id="first_name"
               name="first_name">
    </div>
    <div class="mb-3">
        <label for="last_name"
               class="form-label">Nom</label>
        <input type="text"
               class="form-control"
               id="last_name"
               name="last_name">
    </div>
    <div class="mb-3">
        <label for="email"
               class="form-label">Email</label>
        <input type="email"
               class="form-control"
               id="email"
               name="email">
    </div>
    <div class="mb-3">
        <label for="password"
               class="form-label">Mot de passe</label>
        <input type="password"
               class="form-control"
               id="password"
               name="password">
    </div>

    <input type="submit"
           name="addUser"
           class="btn btn-primary"
           value="Enregistrer">

</form>

<?php
require_once 'templates/footer.php';
?>