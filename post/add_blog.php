<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
require_once "../partials/_header.php";
include "../partials/admin_header.php";

if (isset($_SESSION['user_data'])) {
    $author = $_SESSION['user_data']['0'];
}

$sql = "Select * from categories order by name DESC ";
$st = $db->prepare($sql);
$st->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Додати блог</title>
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
            <h5 class="mb-2 text-gray-800">Пост</h5>
            <div class="row">
                <div class="col-xl-6 col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="font-weight-bold text-primary mt-2">
                                Опублікувати пост
                            </h6>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="mt-3">
                                    <input type="text" name="title" placeholder="Назва"
                                           class="form-control" required>

                                </div>
                                <div class="mt-3">
                                    <label for="blog_body">Опис</label>
                                    <textarea class="form-control" placeholder="Опис" name="body" rows="2"
                                              id="blog_body"></textarea>
                                </div>
                                <div class="mt-3">
                                    <input type="file" name="image" placeholder="Image" class="form-control" required>
                                </div>
                                <div class="mt-3">
                                    <select class="form-control" name="category" required>
                                        <option value="">Виберіть категорію</option>
                                        <?php
                                        while ($result = $st->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <option value="<?= $result['name'] ?>"> <?= $result['name'] ?></option>
                                            <?php
                                        } ?>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <input type="submit" name="submit" value="Опублікувати" class="btn btn-primary">
                                    <a class="btn btn-secondary" href="../users/admin.php">Назад</a>
                                </div>
                                <div class="mt-4">
                                    <?php
                                    if (isset($_POST['submit'])) {
                                        try {
                                            $title = $_POST['title'];
                                            $body = $_POST['body'];
                                            $category = $_POST['category'];
                                            $image_name = $_FILES['image']['name'];
                                            $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                                            $allow_type = ['jpg', 'png', 'jpeg'];
                                            $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                                            move_uploaded_file(
                                                $_FILES['image']['tmp_name'],
                                                "../source/images/" . $_FILES['image']['name']
                                            );
                                            if (in_array($image_ext, $allow_type)) {
                                                $post_sql = "INSERT INTO `publication` (title, body, image, image_name, category, author) VALUES ('$title', '$body', '$image', '$image_name', '$category', '$author')";
                                                $stmt = $db->prepare($post_sql);
                                                $stmt->execute();
                                                if ($stmt) {
                                                    echo "<p class='bg-success p-2'>  Блог успішно опубліковано </p>";
                                                }
                                            } else {
                                                echo "Підтримуються лише файли у форматах 'jpeg', 'png' та 'jpg'";
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

<!-- Footer -->
<footer>
    <?php
    require_once "../partials/_footer.php";
    ?>
</footer>
<!-- End of Footer -->
<!-- End of Content Wrapper -->
<!-- End of Page Wrapper -->
<script>
    CKEDITOR.replace('blog_body')
    CKEDITOR.config.language = 'uk';
</script>

</html>