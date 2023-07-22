<?php
/**
 * Ajoute un nouvel utilisateur à la base de données.
 *
 * @param PDO $pdo L'objet PDO pour la connexion à la base de données.
 * @param string $first_name Le prénom de l'utilisateur à ajouter.
 * @param string $last_name Le nom de famille de l'utilisateur à ajouter.
 * @param string $email L'adresse e-mail de l'utilisateur à ajouter.
 * @param string $password Le mot de passe de l'utilisateur à ajouter (sera haché avant d'être stocké dans la base de données).
 * @param string $role Le rôle de l'utilisateur à ajouter (par défaut "user").
 * @return bool Renvoie true en cas de succès, false en cas d'échec.
 */
function addUser(PDO $pdo, string $first_name, string $last_name, string $email, string $password, $role = "user")
{
    $sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `role`) VALUES (:first_name, :last_name, :email, :password, :role);";
    $query = $pdo->prepare($sql);

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $query->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);

    return $query->execute();
}

/**
 * Vérifie les informations de connexion d'un utilisateur dans la base de données.
 *
 * @param PDO $pdo L'objet PDO pour la connexion à la base de données.
 * @param string $email L'adresse e-mail de l'utilisateur à vérifier.
 * @param string $password Le mot de passe de l'utilisateur à vérifier.
 * @return array|false Renvoie les informations de l'utilisateur si les informations de connexion sont valides, sinon renvoie false.
 */
function verifyUserLoginPassword(PDO $pdo, string $email, string $password)
{
    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    } else {
        return false;
    }
}