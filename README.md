Projet gité sur [le git d'Anthony Laplane](https://github.com/arirangz/studi_techtrendz/).
Deux utilisateurs inscrits pour les essais:
admin@test.com test
user@test.com test

---

# TECHTRENDZ :

## Live 2 :

> Mise en place de la page index.php avec [Bootstrap](https://getbootstrap.com/).

## Live 3 :

> Création de la page a_propos.php, et dossier template dans lequel on met le header.php et le footer.php.
> En notant les données en dur dans index.php, on crée la première boucle pour appeller les cards. Ce qui donnera un affichage dynamique avec l'inclusion de boucles adaptés.
> Création de la page actualite.php.
> Création de la page article.php dans un dossier lib ou l'on met le tableau en dur des données des articles (dans un premier temps, avant l'inclusion de la BDD). On l'appellera dans index.php et dans actualites.php.
> Création de la page article_part.php pour centraliser la card et n'avoir à faire que des appels dans les pages index.php et actualites.php.
> Dans le header.php on rends la NavBar dynamique avec les foreach

## Live 4 :

> Rendre la nav "Active" au clic.
> On crée la page actualite.php, qui permettra au click d'une card, d'aller sur la page de l'article de manière dynamique.
> On crée menu.php ou l'on met le code dynamique du menu pour pouvoir changer les head_title. On rajoute la propiété exclude que l'on définie à true, et dans le header.php on indique dans une condition de l'afficher ou non.
> Dans la page actualite.php, on rajoute substr au mainMenu pour couper la ligne a un nombre de caractère défini.

## Live 5 :

> On rends fonctionnel, dans la page index.php, le bouton "lire la suite".
> On rajoutera htmlentities dans actualite.php et article_part.php pour prémunir des attaques XSS.
> Création et importation de la BDD.
> Prévention contre les injections SSL et failles XSS.

## Live 6 :

> On crée pdo.php pour y mettre les instructions de connection BDD et config.php.
> ASTUCE: On peut faire un config_sample.php pour avoir la structure en locale, et un config.php avec les vraies données déployées. on .gitignore le premier afin de ne pas dévoiler les infos de connection.
> Sur index.php on récupére les articles de manière dynamique. Pour cela, on crée une fonction qui appellera tous les articles depuis article.php sur les pages concernée.
> Condition de gestion d'image, sur article_part.php de sorte que s'il n'y a pas d'image, on affiche l'image par default.
> En découle donc la constante qui définie les images dans le dossier uploads depuis config.php et la modification de l'appel de la constante dans la condition de gestion d'image.
> On centralisera dans config.php le fait d'afficher que 3 articles.

## Live 7 :

> On crée la fonction pour récupérer un article spécifique dans article.php d'après son ID.
> Une fois la BDD en place, on va chercher dedans, et plus dans le tableau en dur de article.php.
> Dans article_part, on gere aussi le fait d'appeler l'article concerné en BDD et plus dans le tableau.
> Gestions d'erreurs dans actialité.php. et de l'affichage de l'image de article_part.php.

> Création d'un interface Administrateur,avec un dossier admin, et les templates associés.
> On met en place login.php pour pouvoir se logger à l'interface administrateur, et on le définis dans le menu dynamique menu.php.

## Live 8 :

> Il faut également déterminer si c'est un administrateur ou un utilisateur, et comparer le tout avec la BDD, depuis login.php.
> On crée user.php pour y mettre la fonction de vérification du mot de passe.
> session.php viendra démmarer la session de l'utilisateurinscrit en BDD et évitera toutes les reco/déco engendrées, et on y met également le cookie de session.

## Live 9 :

> Gestion du logout dans logout.php.
> On gere également les boutons de connexion / deconexion en cas de session active.
> On protège le panel admin avec une fonction dans session.php pour être sur que ce soit un admin qui se connecte.
> CRUD d'articles par l'administrateur: On crée la page articles.php. On limitera le nombre a voir avec une fonction définie dans config.php.
> <<<<<<< HEAD

## Live 10 :

> On inscrit une pagination dans le panel admin, qu'on rends dynamique avec un fonction PHP.
> On récupere le nombre d'articles avec SQL pour adapter la pagination en fonction du résultat obtenu, grâce à la fonction getTotalArticle.

> On termine le projet avec inscription.php, contact.php, lib/category.php, tools.php, article.php et user.php. Et dans admin: article.php et article_delete.php.
