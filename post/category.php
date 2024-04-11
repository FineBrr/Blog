<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
require_once "../partials/_header.php";
require_once "../partials/navigation.php";
$db = require_once "../database/database.php";
$log_user = $_SESSION['log_user'];
$selected_cat = $_GET['name'];
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
$limit = 4;
$offset = ($page - 1) * $limit;

$sql = "Select * from publication left join categories on (publication.category = categories.name) left join user on (publication.author = user.username) where category = '$selected_cat' order by publication.publish_date DESC LIMIT $offset,$limit";
$st = $db->prepare($sql);
$st->execute();

?>
<head>
    <title>Відсортовані публікації</title>
    <link rel="icon" href="../source/images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Neuton:wght@700&family=Work+Sans:wght@400;500;600;700&display=swap"
    <!-- # CSS Plugins -->
    <link rel="stylesheet" href="source/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/pointer.css">

</head>
<body>
<form action="" method="post">
    <main>
        <section class="section">
            <div class="container">
                <div class="row no-gutters-lg">
                    <div class="col-lg-8 mb-5 mb-lg-0">
                        <div class="row">
                            <?php
                            while ($result = $st->fetch(PDO::FETCH_ASSOC)) { ?>
                                <div class="col-md-6 mb-4">
                                    <article class="card article-card article-card-sm h-100">
                                        <a href="../post/single_post.php?id=<?= $result['id_pub'] ?>">
                                            <div class="card-image">
                                                <div class="post-info"><span
                                                            class="fa fa-calendar text-uppercase"><?php
                                                        $date = $result["publish_date"]
                                                        ?>
                                                        <?= date(
                                                            'd m Y',
                                                            strtotime($date)
                                                        ) ?>
                                                </span>
                                                </div>
                                                <img loading="lazy" decoding="async"
                                                     src="data:image;base64, <?= base64_encode($result['image']) ?>"
                                                     class="w-100 h-100">
                                            </div>
                                        </a>
                                        <div class="card-body px-0 pb-0">
                                            <ul class="post-meta mb-2">
                                                <li>
                                                    <a class="fa fa-pencil-square-o text-black"><?= $result['username'] ?></a>
                                                </li>
                                                <li><a class="fa fa-tag text-black"><?= ucfirst(
                                                            $result['category']
                                                        ) ?></a>
                                                </li>
                                            </ul>
                                            <h2><a class="post-title"
                                                   href="../post/single_post.php?id=<?= $result['id_pub'] ?>"><?= $result['title'] ?>
                                                </a></h2>
                                            <p class="card-text"><?= strip_tags(
                                                    substr($result["body"], 0, 660)
                                                ) . "..." ?>
                                            </p>
                                            <div class="content"><a class="read-more-btn"
                                                                    href="../post/single_post.php?id=<?= $result['id_pub'] ?>">Читати
                                                    далі</a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <?php
                            } ?>
                            <!-- pagination -->
                            <nav class="mb-md-50">
                                <?php
                                $pagination = "SELECT COUNT(*) AS total from publication where category = '$selected_cat'";
                                $category = $db->prepare($pagination);
                                $category->execute();
                                while ($result = $category->fetch(PDO::FETCH_ASSOC)) {
                                    $count_post = $result['total'];
                                }
                                $pages = ceil($count_post / $limit);
                                ?>
                                ?>
                                <ul class="pagination justify-content-center">
                                    <?php
                                    for ($i = 1; $i <= $pages; $i++) {
                                        ?>
                                        <li class="page-item <?= ($i == $page) ? $active = "active" : ""; ?>"><a
                                                    href="../post/category.php?page=<?= $i ?>&name=<?= $selected_cat ?>"
                                                    class="page-link">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                        <?php
                                    } ?>
                                </ul>
                            </nav>
                            <!-- pagination -->
                        </div>
                    </div>
                    <?php
                    require_once "../partials/sidebar.php"
                    ?>
                </div>
            </div>
        </section>
    </main>
</form>
</body>
<footer>
    <?php
    require_once "../partials/_footer.php";
    ?>
</footer>