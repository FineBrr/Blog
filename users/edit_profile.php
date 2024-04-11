<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
require_once "../partials/_header.php";
include "../partials/admin_header.php";

$username = $_SESSION['user_data']['0'];
$gender = $_SESSION['user_data']['2'];
$sql = "Select * from user where username = '$username'";
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
    <title>Редагування</title>
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
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-md-4 m-auto p-5 mt-lg-5 bg-info">
                <?php
                while ($result = $st->fetch(PDO::FETCH_ASSOC)) {
                    $name = $result['username'] ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <p class="text-center"><b><?= $result['username'] ?></b></p>
                        <div class="mb-3">
                            <input type="email" name="email" placeholder="Ел. адреса"
                                   class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="edit_email" value="Редагувати ел. адресу"
                                   class="btn btn-primary">
                        </div>
                        <div class="mb-3 input-group">
                            <input type="password" name="password" placeholder="Пароль"
                                   class="form-control" id="pass">
                            <div class="input-group-append">
                        <span class="input-group-text ">
                            <i class="fa fa-eye pointer" onclick="passFunction()"></i>
                        </span>
                            </div>
                        </div>
                        <div class="mb-3 input-group">
                            <input type="password" name="confirm_pass" placeholder="Підтвердіть пароль"
                                   class="form-control" id="confirm_pass">
                            <div class="input-group-append">
                        <span class="input-group-text ">
                            <i class="fa fa-eye pointer" onclick="confirm_passFunction()"></i>
                        </span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <input type="submit" name="edit_pass" value="Редагувати пароль" class="btn btn-primary">
                        </div>
                        <div class="mt-3">
                            <label for="profile">Редагувати зображення профілю</label>
                            <input type="file" name="profile" placeholder="Image" class="form-control">
                            <img src="data:image;base64, <?=
                            base64_encode($result['profile']) ?>" width="10%" alt="" class="border">
                        </div>
                        <div class="mt-3">
                            <input type="submit" name="edit_profile" value="Редагувати профіль" class="btn btn-primary">
                            <input type="submit" name="delete_profile" value="Скинути профіль" class="btn btn-primary">
                        </div>
                    </form>
                    <?php
                }
                $user = $_POST['username'];
                $email = $_POST['email'];
                $pass = $_POST['password'];
                $confirm_pass = $_POST['confirm_pass'];
                try {
                    $sql_username = "Select * from user where email = '$email' ";
                    $user_st = $db->prepare($sql_username);
                    $user_st->execute();
                    $user_result = $user_st->fetch();
                    if ($user_result >= 1) {
                        echo "<div class='mt-3 bg-danger'>Ел. адреса вже зайнята</div>";
                    } elseif (!empty($user) && strlen($user) < 4) {
                        echo "<div class='mt-3 bg-danger'>Ім'я користувача має бути не менше 4 символів</div>";
                    } elseif (!empty($user) && strlen($user) > 24) {
                        echo "<div class='mt-3 bg-danger'>Максимальний символ імені користувача - 24</div>";
                    } elseif (!empty($pass) && strlen($pass) < 8) {
                        echo "<div class='mt-3 bg-danger'>Пароль має бути 8 символів</div>";
                    } elseif ($pass != $confirm_pass) {
                        echo "<div class='mt-3 bg-danger'>Пароль не збігається</div>";
                    } else {
                        if (isset($_POST['edit_email'])) {
                            $edit_username = "update user set email = '$email' where username = '$username' ";
                            $edit_st = $db->prepare($edit_username);
                            $edit_st->execute();
                        } elseif (isset($_POST["edit_pass"])) {
                            $confirm_pass = hash('sha256', $_POST['confirm_pass']);
                            $edit_username = "update user set password = '$confirm_pass' where username = '$username' ";
                            $edit_st = $db->prepare($edit_username);
                            $edit_st->execute();
                        } elseif (isset($_POST["edit_profile"])) {
                            $profile_img = addslashes(file_get_contents($_FILES['profile']['tmp_name']));
                            $edit_username = "update user set profile = '$profile_img' where username = '$username' ";
                            $edit_st = $db->prepare($edit_username);
                            $edit_st->execute();
                        } elseif (isset($_POST['delete_profile']) && $gender == 'Чол') {
                            $profile_img = addslashes(
                                file_get_contents("https://bootdey.com/img/Content/avatar/avatar7.png")
                            );
                            $edit_username = "update user set profile = '$profile_img' where username = '$username' ";
                            $edit_st = $db->prepare($edit_username);
                            $edit_st->execute();
                        } elseif (isset($_POST['delete_profile']) && $gender == 'Жін') {
                            $profile_img = addslashes(
                                file_get_contents("https://bootdey.com/img/Content/avatar/avatar8.png")
                            );
                            $edit_username = "update user set profile = '$profile_img' where username = '$username' ";
                            $edit_st = $db->prepare($edit_username);
                            $edit_st->execute();
                        }
                        if ($edit_st) {
                            echo "<p class='bg-success p-2'>  Профіль успішно відредагований</p>";
                        }
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

                ?>
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

<script>
    function passFunction() {
        var p = document.getElementById("pass");
        if (p.type === "password") {
            p.type = "text";
        } else {
            p.type = "password";
        }
    }

    function confirm_passFunction() {
        var c = document.getElementById("confirm_pass");
        if (c.type === "password") {
            c.type = "text";
        } else {
            c.type = "password";
        }
    }
</script>