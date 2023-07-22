<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/user.php";
require_once __DIR__ . "/lib/menu.php";
require_once __DIR__ . "/templates/header.php";


$errors = [];

if (isset($_POST["loginUser"])) {
       /*
           Cette partie du code vérifie si le formulaire de connexion a été soumis (si la variable $_POST["loginUser"] est définie).
           Ensuite, elle récupère l'email et le mot de passe saisis par l'utilisateur dans le formulaire.
           Elle appelle la fonction verifyUserLoginPassword pour vérifier si l'utilisateur avec cet email et mot de passe existe dans la base de données.
           Si l'utilisateur est trouvé (la fonction retourne un tableau non vide), cela signifie que les informations de connexion sont valides.
           Dans ce cas, une nouvelle session est générée avec session_regenerate_id(true), et les informations de l'utilisateur sont stockées dans $_SESSION["user"].
           Ensuite, en fonction du rôle de l'utilisateur (utilisateur normal ou administrateur), il est redirigé vers la page d'accueil appropriée (index.php pour les utilisateurs normaux, et admin/index_admin.php pour les administrateurs).
           Si l'utilisateur n'est pas trouvé (la fonction retourne false), cela signifie que les informations de connexion sont incorrectes, et un message d'erreur est ajouté à la liste $errors[].
       */
       $email = $_POST["email"];
       $password = $_POST["password"];

       $user = verifyUserLoginPassword($pdo, $email, $password);
       if ($user) {
              session_regenerate_id(true);
              $_SESSION["user"] = $user;
              if ($user["role"] === "user") {
                     header("location: index.php");
              } elseif ($user["role"] === "admin") {
                     header("location: admin/index_admin.php");
              }
       } else {
              $errors[] = "Email ou mot de passe incorrect";
       }
}


?>


<h1>Login</h1>

<?php foreach ($errors as $error) { ?>
       <div class="alert alert-danger">
              <?= $error; ?>
       </div>
<?php } ?>

<form method="post">
       <div class="mb-3">
              <label class="form-label"
                     for="email">Email</label>
              <input type="email"
                     name="email"
                     id="email"
                     class="form-control"
                     required>
       </div>
       <div class="mb-3">
              <label class="form-label"
                     for="password">Mot de passe</label>
              <input type="password"
                     name="password"
                     id="password"
                     class="form-control"
                     required>
       </div>

       <input type="submit"
              value="Connexion"
              name="loginUser"
              class="btn btn-primary">

</form>

<?php require_once __DIR__ . "/templates/footer.php"; ?>