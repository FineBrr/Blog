<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
$db = require_once "../database/database.php";
require_once "../partials/_header.php";
require_once "../partials/navigation.php";

$username = $_POST['username'];
$email = $_POST["email"];
$pass = $_POST["password"];
$con_pass = $_POST['confirm_pass'];
$gender = $_POST['gender'];

$sql4 = "select * from Gender ";
$state = $db->prepare($sql4);
$state->execute();
?>
<head>
    <title>Реєстрація</title>
    <!-- # Google Fonts -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Neuton:wght@700&family=Work+Sans:wght@400;500;600;700&display=swap"
    <!-- # CSS Plugins -->
    <link rel="stylesheet" href="../css/pointer.css">
    <link rel="stylesheet" href="../source/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<div class="container">
    <div class="row">
        <div class="col-xl-5 col-md-4 m-auto p-5 mt-lg-5 bg-info">
            <form action="" method="post" enctype="multipart/form-data">
                <p class="text-center"><b>Реєстрація</b></p>
                <div class="mb-3">
                    <input type="text" name="username" placeholder="Ім'я користувача" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" placeholder="Ел. адреса" class="form-control" required>
                </div>
                <div class="mb-3 input-group">
                    <input type="password" name="password" placeholder="Пароль" class="form-control" id="pass"
                           required>
                    <div class="input-group-append">
                        <span class="input-group-text ">
                            <i class="fa fa-eye pointer" onclick="passFunction()"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-3 input-group">
                    <input type="password" name="confirm_pass" placeholder="Підтвердіть пароль"
                           class="form-control" id="confirm_pass" required>
                    <div class="input-group-append">
                        <span class="input-group-text ">
                            <i class="fa fa-eye pointer" onclick="confirm_passFunction()"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <select name="gender" class="form-control">
                        <option value="">Стать</option>
                        <?php
                        while ($sex = $state->fetch(PDO::FETCH_ASSOC)) {
                            $gender_name = $sex['name'];
                            ?>
                            <option value="<?= $gender_name ?>"><?= $gender_name ?></option>
                            <?php
                        } ?>
                        ?>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="profile">Додати зображення профілю</label>
                    <input type="file" id="profile" name="profile" title="add profile picture"
                           placeholder="add profile picture"
                           class="form-control">
                </div>
                <div class="mt-3">
                    <input type="submit" name="register" value="Зареєструватися" class="btn btn-primary">
                </div>
                <div class="mb-3">
                    <?php
                    if (isset($_POST["register"])) {
                        try {
                            $sql_username = "Select * from user where username = '$username' ";
                            $user_st = $db->prepare($sql_username);
                            $user_st->execute();
                            $user_result = $user_st->fetch();
                            if ($user_result >= 1) {
                                echo "<div class='mt-3 bg-danger'>Ім'я користувача вже існує</div>";
                            } elseif (strlen($username) < 4) {
                                echo "<div class='mt-3 bg-danger'>Ім'я користувача має бути не менше 4 символів</div>";
                            } elseif (strlen($username) > 24) {
                                echo "<div class='mt-3 bg-danger'>Максимальний символ імені користувача - 24</div>";
                            } elseif (strlen($pass) < 8) {
                                echo "<div class='mt-3 bg-danger'>Пароль має бути 8 символів</div>";
                            } elseif ($pass != $con_pass) {
                                echo "<div class='mt-3 bg-danger'>Пароль не збігається</div>";
                            } else {
                                $sql = "Select * from user where email = '$email' ";
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->fetch();
                                if ($result >= 1) {
                                    echo "<div class='mt-3 bg-danger'>Електронна пошта вже існує</div>";
                                } else {
                                    $con_pass = hash('sha256', $_POST['confirm_pass']);
                                    if ($_FILES['profile']['tmp_name'] != '') {
                                        $profile_img = addslashes(file_get_contents($_FILES['profile']['tmp_name']));
                                        $not_empty = "insert into user (username, email, password, gender ,role, profile) values ('$username', '$email', '$con_pass', '$gender', 'Користувач','$profile_img' )";
                                        $pdo_st = $db->prepare($not_empty);
                                        $pdo_st->execute();
                                    } elseif (empty($_FILES['profile']['name']) && $gender == 'Чол') {
                                        $male = addslashes(
                                            file_get_contents("https://bootdey.com/img/Content/avatar/avatar7.png")
                                        );
                                        $sql2 = "insert into user (username, email, password, gender ,role, profile) values ('$username', '$email', '$con_pass', '$gender', 'Користувач','$male' )";
                                        $st = $db->prepare($sql2);
                                        $st->execute();
                                    } else {
                                        $female = addslashes(
                                            file_get_contents("https://bootdey.com/img/Content/avatar/avatar8.png")
                                        );
                                        $female_sql = "insert into user (username, email, password, gender ,role, profile) values ('$username', '$email', '$con_pass', '$gender', 'Користувач','$female' )";
                                        $statm = $db->prepare($female_sql);
                                        $statm->execute();
                                    }
                                }
                                if ($st || $stmt || $pdo_st) {
                                    echo "<script> window.location.href='login.php' </script>";
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
<footer>
    <?php
    require_once "../partials/_footer.php";
    ?>
</footer>

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