<?php
// Tableau temporaire avant la mise en place de la BDD
// $articles = [
//     ["title" => "Php VS Python", "content" => "PHP Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus quidem labore rerum quod quis qui, aut, ut distinctio aperiam quae ipsa beatae hic inventore vero et ad itaque totam voluptatibus.", "image" => "1-php-vs-python.jpg"],
//     ["title" => "React ou React Native ?", "content" => "React Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus quidem labore rerum quod quis qui, aut, ut distinctio aperiam quae ipsa beatae hic inventore vero et ad itaque totam voluptatibus.", "image" => "2-react-vs-react-native.jpg"],
//     ["title" => "Les meilleurs outils devops !", "content" => "Devops Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus quidem labore rerum quod quis qui, aut, ut distinctio aperiam quae ipsa beatae hic inventore vero et ad itaque totam voluptatibus.", "image" => "3-devops.png"],
// ];

/*
Page 1:
LIMIT 0, 10
Page 2:
LIMIT 10, 10
Page 3:
LIMIT 20, 10
Page 4:
LIMIT 30, 10

param : page et limit
offest = (page - 1) * limit
Page 3
30     = (3 -1) * 10
*/
function getArticleById(PDO $pdo, int $id): array|bool
{
    $query = $pdo->prepare("SELECT * FROM articles WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getArticles(PDO $pdo, int $limit = null, int $page = null): array|bool
{
    $sql = "SELECT * FROM articles ORDER BY id DESC";

    if ($limit && !$page) {
        $sql .= " LIMIT  :limit";
    }
    if ($limit && $page) {
        $sql .= " LIMIT :offest, :limit";
    }

    $query = $pdo->prepare($sql);

    if ($limit) {
        $query->bindValue(":limit", $limit, PDO::PARAM_INT);
    }
    if ($page) {
        $offset = ($page - 1) * $limit;
        $query->bindValue(":offest", $offset, PDO::PARAM_INT);
    }

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getTotalArticles(PDO $pdo): int|bool
{
    $sql = "SELECT COUNT(*) as total FROM articles";
    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function saveArticle(PDO $pdo, string $title, string $content, string|null $image, int $category_id, int $id = null): bool
{
    if ($id === null) {
        $query = $pdo->prepare("INSERT INTO articles (title, content, image, category_id) "
            . "VALUES(:title, :content, :image, :category_id)");
    } else {
        $query = $pdo->prepare("UPDATE `articles` SET `title` = :title, "
            . "`content` = :content, "
            . "image = :image, category_id = :category_id WHERE `id` = :id;");

        $query->bindValue(':id', $id, $pdo::PARAM_INT);
    }

    $query->bindValue(':title', $title, $pdo::PARAM_STR);
    $query->bindValue(':content', $content, $pdo::PARAM_STR);
    $query->bindValue(':image', $image, $pdo::PARAM_STR);
    $query->bindValue(':category_id', $category_id, $pdo::PARAM_INT);
    return $query->execute();
}

function deleteArticle(PDO $pdo, int $id): bool
{

    $query = $pdo->prepare("DELETE FROM articles WHERE id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
function getArticleImage(string|null $image): string
{
    if ($image === null) {
        return _ASSETS_IMAGES_FOLDER_ . "default-article.jpg";
    } else {
        return _ARTICLES_IMAGES_FOLDER_ . htmlentities($image);
    }
}

function getTotalArticle(PDO $pdo): int
{
    $sql = "SELECT COUNT(*) as total FROM articles;";

    $query = $pdo->prepare($sql);

    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}