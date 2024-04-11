<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
require_once "../partials/_header.php";
include "../partials/admin_header.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Користувачі</title>
    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="../vendor/css/admin-panel.css">
    <link rel="stylesheet" href="../source/plugins/bootstrap/bootstrap.min.css">
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
<body id="page-top">
<!-- Page Wrapper -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h5 class="mb-2 text-gray-800">Користувачі</h5>
    <!-- DataTales Example -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between">
            <div>
                <a href="../authorization/registration.php">
                    <h6 class="font-weight-bold text-primary mt-2">Реєстрація</h6>
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
                        <th>Ім’я користувача</th>
                        <th>Ел. адреса</th>
                        <th>Роль</th>
                        <th colspan="2">Дії</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($_POST['search'])) {
                        $searchbar = $_POST['searchbar'];
                        $search_bar = "Select * from user where username like '%$searchbar%'";
                        $stmt = $db->prepare($search_bar);
                        $stmt->execute();
                    } else {
                        $sql = "Select * from user";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                    }
                    $count = 0;
                    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $username = $result['username'];
                        ?>
                        <tr class="fw-bold">
                            <td><?= ++$count ?></td>
                            <td><?= $result['username'] ?></td>
                            <td><?= $result['email'] ?></td>
                            <td><?= $result['role'] ?></td>
                            <td>
                                <a href="delete.php?delete_user=<?= $result['username'] ?>"
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

<!-- Footer -->
<footer>
    <?php
    require_once "../partials/_footer.php";
    ?>
</footer>
</body>
</html>