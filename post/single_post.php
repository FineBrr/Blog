<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
include "../partials/_header.php";
include "../partials/navigation.php";
$db = require_once "../database/database.php";
$id = $_GET['id'];
$sql1 = "Select * from publication left join categories on (publication.category = categories.name) left join user on (publication.author = user.username) where id_pub = '$id'";
$stmt = $db->prepare($sql1);
$stmt->execute();

?>


<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<head>
    <title>Окремий пост</title>
    <link rel="icon" href="../source/images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Neuton:wght@700&family=Work+Sans:wght@400;500;600;700&display=swap"
    <!-- # CSS Plugins -->
    <link rel="stylesheet" href="../source/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/pointer.css">
</head>
<main>
    <section class="section">
        <div class="container">
            <div class="row">
                <?php
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $blobImage = $result['image'];
                    $blobName = $result['image_name'];
                    $servPath = "../source/images/";
                    $filePath = $servPath . $blobName;

                    $baseUrl = 'http://davidblog/index.php/';

                    $imageUrl = $baseUrl . $filePath;

                    ?>
                    <div class="col-lg-8 mb-5 mb-lg-0">
                        <article>
                            <img loading="lazy" decoding="async"
                                 src=" <?= $imageUrl ?> "
                                 alt="Post Thumbnail"
                                 class="w-100">
                            <ul class="post-meta mb-2 mt-4">
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor"
                                         style="margin-right:5px;margin-top:-4px" class="text-dark"
                                         viewBox="0 0 16 16">
                                        <path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
                                        <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"/>
                                    </svg>
                                    <span class="time"><?php
                                        $date = $result["publish_date"]
                                        ?>
                                        <?= date(
                                            'd m Y',
                                            strtotime($date)
                                        ) ?></span>
                                    <span class="fa fa-tag"><?= $result['category'] ?></span>
                                    <span class="fa fa-pencil-square-o"><?= $result['author'] ?></span>
                                </li>
                            </ul>
                            <h1 class="my-3"><?= $result['title'] ?></h1>
                            <h2 id="paragraph">Параграф</h2>
                            <p><?= $result['body'] ?></p>
                    </div>
                    <?php
                    require_once "../partials/sidebar.php"
                    ?>
                    <?php
                } ?>
                <?php
                if (isset($_POST['add'])) {
                    $comment = $_POST['comment'];
                    $log_user = $_SESSION['log_user']['0'];
                    $comm = "INSERT INTO comments (author, comment, id_pub) VALUES ('$log_user','$comment','$id')";
                    $statement = $db->prepare($comm);
                    $statement->execute();
                }
                ?>
                <?php
                if (isset($_SESSION['log_user'])){ ?>
                <h2><b>Додати коментар</b></h2>
                <div class="mt-3">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
             <textarea class="form-control" name="comment" placeholder="Додати публічний коментар" cols="30"
                       rows="2"></textarea><br>
                                <button style="float:right" class="btn-primary btn" name="add">Додати коментар</button>
                            </div>
                        </div>
                    </form>
                    <?php
                    } ?>
                    <h2><b>Коментарі</b></h2>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            include "comments.php" ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<footer>
    <?php
    require_once "../partials/_footer.php";
    ?>
</footer>

