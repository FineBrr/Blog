<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
require_once "../partials/_header.php";
include_once "../partials/admin_header.php";

if (isset($_SESSION['user_data'])) {
    $author = $_SESSION['user_data']['0'];
    $role = $_SESSION['user_data']['1'];
}

?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Адмін</title>
    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="../vendor/css/admin-panel.css">
    <link rel="stylesheet" href="../source/plugins/bootstrap/bootstrap.min.css">
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
<body id="page-top" class="d-flex flex-column min-vh-100">
<!-- Page Wrapper -->
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h5 class="mb-2 text-gray-800">Опубліковані пости</h5>
    <!-- DataTales Example -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between">
            <div>
                <a href="../post/add_blog.php">
                    <h6 class="font-weight-bold text-primary mt-2">Додати пост</h6>
                </a>
            </div>
            <div>
                <form class="navbar-search" method="post">
                    <div class="input-group">
                        <input type="text" name="searchbar" class="form-control bg-white border-0 small"
                               placeholder="Пошук...">
                        <div class="input-group-append">
                            <input class="btn btn-primary" name="search" type="submit" value="">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Номер</th>
                        <th>Назва</th>
                        <th>Категорія</th>
                        <th>Автор</th>
                        <th>Дата публікації</th>
                        <th colspan="2">Дії</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $count = 0;
                    if (isset($_POST['search'])) {
                        $searchbar = $_POST['searchbar'];
                        $search_bar = "Select * from publication where author = '$author' and title like '%$searchbar%' order by publication.publish_date DESC";
                        $st = $db->prepare($search_bar);
                        $st->execute();
                    } elseif ($role == "Адмін") {
                        $sql = "Select * from publication inner join categories on (publication.category = categories.name) inner join user on (publication.author = user.username) order by publication.publish_date DESC";
                        $st = $db->prepare($sql);
                        $st->execute();
                    } else {
                        $sql = "Select * from publication inner join categories on (publication.category = categories.name) inner join user on (publication.author = user.username) where publication.author = '$author' order by publication.publish_date DESC";
                        $st = $db->prepare($sql);
                        $st->execute();
                    }
                    while ($result = $st->fetch(PDO::FETCH_ASSOC)) {
                        $id = $result['id_pub'];
                        ?>
                        <tr class="fw-bold">
                            <td><?= ++$count ?></td>
                            <td><?= $result['title'] ?></td>
                            <td><?= $result['category'] ?></td>
                            <td><?= $result['author'] ?></td>
                            <td><?= date('d-M-Y', strtotime($result['publish_date'])) ?></td>
                            <td>
                                <a href="../post/edit_blog.php?id=<?= $result['id_pub'] ?>"
                                   class="btn btn-success">Редагувати</a>
                            </td>
                            <td>
                                <a href="delete.php?delete_pub=<?= $result['id_pub'] ?>"
                                   class="btn btn-danger">Видалити</a>
                            </td>
                        </tr>

                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Footer -->
<footer>
    <?php
    require_once "../partials/_footer.php";
    ?>
</footer>
<!-- End of Footer -->
<!-- End of Page Wrapper -->
</body>
</html>
