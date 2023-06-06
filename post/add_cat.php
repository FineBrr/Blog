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
    <meta name="David" content="">
    <title>Додати категорію</title>
    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="../vendor/css/admin-panel.css">
    <link rel="stylesheet" href="../source/plugins/bootstrap/bootstrap.min.css">
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

<div id="page-top">
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
                                Додати категорію
                            </h6>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div>
                                    <input type="text" name="cat_name" placeholder="Назва категорії"
                                           class="form-control" required>
                                </div>
                                <div class="mt-3">
                                    <input type="submit" name="submit" value="Додати" class="btn btn-primary">
                                    <a class="btn btn-secondary" href="categories.php">Назад</a>
                                </div>
                                <div class="mt-4">
                                    <?php
                                    $cat_name = $_POST['cat_name'];
                                    if (isset($_POST['submit'])) {
                                        try {
                                            $sql = "Select * from categories where name = '$cat_name' ";
                                            $st = $db->prepare($sql);
                                            $st->execute();
                                            $result = $st->fetch(PDO::FETCH_ASSOC);
                                            if ($result) {
                                                echo "<p class='bg-danger p-2'>Category name already exist </p>";
                                            } else {
                                                $sql2 = "INSERT INTO `categories` (name) VALUES ('$cat_name')";
                                                $stmt = $db->prepare($sql2);
                                                $stmt->execute();
                                                if ($stmt) {
                                                    echo "<p class='bg-success p-2'>  Category has been added successfully </p>";
                                                }
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
</div>
</div>
<!-- Footer -->
<footer>
    <?php
    require_once "../partials/_footer.php" ?>
</footer>
<!-- End of Footer -->
<!-- End of Content Wrapper -->
<!-- End of Page Wrapper -->


</html>