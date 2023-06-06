<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
require_once "../partials/_header.php";
include "../partials/admin_header.php";
$name = $_GET['edit'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Змінити категорію</title>
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
<div id="wrapper">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h5 class="mb-2 text-gray-800">Категорії</h5>
        <div class="row">
            <div class="col-xl-6 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h6 class="font-weight-bold text-primary mt-2">
                            Редагувати категорію
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div>
                                <input type="text" name="cat_name" placeholder="Назва категорії"
                                       class="form-control" value="<?= $name ?>" required>
                            </div>
                            <div class="mt-3">
                                <input type="submit" name="submit" value="Редагувати" class="btn btn-primary">
                                <a class="btn btn-secondary" href="categories.php">Назад</a>
                            </div>
                            <div class="mt-4">
                                <?php
                                $cat_name = $_POST['cat_name'];
                                if (isset($_POST['submit'])) {
                                    try {
                                        $sql = "Update categories set name='$cat_name' where name = '$name'";
                                        $stmt = $db->prepare($sql);
                                        $stmt->execute();
                                        if ($stmt) {
                                            echo "<p class='bg-success p-2'>  Категорія успішно оновлена </p>";
                                            echo "<script> window.location.href='categories.php' </script>";
                                        }
                                    } catch (PDOException $ex) {
                                        echo $ex->getMessage();
                                    }
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>