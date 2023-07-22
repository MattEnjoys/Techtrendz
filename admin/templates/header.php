<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/session.php";
require_once __DIR__ . "/../../lib/menu.php";
adminOnly();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Page administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
          crossorigin="anonymous">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet"
          href="../assets/css/override-bootstrap.css">

</head>

<body>

    <div class="container d-flex">
        <header>
            <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark"
                 style="width: 280px;">
                <a href="/"
                   class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <svg class="bi pe-none me-2"
                         width="40"
                         height="32">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                    <span class="fs-4">Panel Admin</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto align-items-center">
                    <?php foreach ($mainMenuAdmin as $key => $menuItem) {
                        if (!array_key_exists("exclude", $menuItem)) {
                            ?>
                            <li class="nav-item">
                                <a href="<?= $key; ?>"
                                   class="nav-link px-2 <?php if ($key === $currentPage)
                                       echo "active"; ?>">
                                    <?php if ($key === "index_admin.php") { ?>
                                        <i class="bi bi-speedometer2 pe-none me-2"></i>
                                    <?php } elseif ($key === "articles_admin.php") { ?>
                                        <i class="bi bi-table pe-none me-2"></i>
                                    <?php } ?>
                                    <?= $menuItem["menu_title"]; ?>
                                </a>
                            </li>
                        <?php }
                    } ?>
                </ul>
                <hr>
                <div class="d-flex flex-column flex-shrink-0 text-bg-dark">
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') { ?>
                        <a href="../logout.php"
                           class="btn btn-primary">Déconnexion</a>
                    <?php } ?>
                </div>
                <hr>
            </div>
        </header>
        <!-- Fin NavBar de Bootstrap -->
        <main class="d-flex flex-column px-4">