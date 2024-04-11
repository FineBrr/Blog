<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
$db = require_once "../database/database.php";
require_once "../partials/_header.php";
require_once "../partials/navigation.php";
$email = $_POST["email"];
$pass = hash('sha256', $_POST["password"]);
if (isset($_POST["submit"])) {
    try {
        $sql = "Select * from `user` where email = '$email' and password = '$pass' ";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            header("Location: ../users/admin.php");
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}

?>
<head>
    <title>Авторизація</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Neuton:wght@700&family=Work+Sans:wght@400;500;600;700&display=swap"
    <!-- # CSS Plugins -->
    <link rel="stylesheet" href="../css/pointer.css">
    <link rel="stylesheet" href="../source/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xl-5 col-md-4 m-auto p-5 mt-lg-5 bg-info">
            <form action="" method="post">
                <p class="text-center"><b>Увійдіть у свій обліковий запис</b></p>
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
                <div class="mb-3">
                    <input type="submit" name="submit" value="Увійти" class="btn btn-primary">
                </div>
                <div class="mb-3">
                    <?php
                    if (isset($_POST["submit"])) {
                        if ($result) {
                            $user_data = array(
                                $result['username'],
                                $result['role'],
                                $result['gender'],
                                $result['email'],
                                $result['password']
                            );
                            $log_user = array($result['username'], $result['gender']);
                            $_SESSION['user_data'] = $user_data;
                            $_SESSION['log_user'] = $log_user;
                        } else {
                            echo "<div class='mb-3'><p class='bg-danger p-2'> Невірні ім'я користувача або пароль </p></div>";
                        }
                    }
                    ?>

                </div>
                <div class="text-center mb-3">
                    <b>У вас немає облікового запису?</b>
                    <a href="../authorization/registration.php">Реєструйтеся</a>
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
</body>

<script>
    function passFunction() {
        var p = document.getElementById("pass");
        if (p.type === "password") {
            p.type = "text";
        } else {
            p.type = "password";
        }
    }
</script>