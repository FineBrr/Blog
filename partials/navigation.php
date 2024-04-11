<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
$log_user = $_SESSION['log_user'];
?>
<link rel="stylesheet" href="../source/plugins/bootstrap/bootstrap.min.css">
<!-- Bootstrap core JavaScript-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="../vendor/js/sb-admin-2.min.js"></script>
<!-- Page level plugins -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<header class="navigation">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light px-0">
            <a class="navbar-brand order-1 py-0" href="../index.php">YourBlog
            </a>
            <div class="navbar-actions order-3 ml- ml-md-5">
                <button aria-label="navbar toggler" class="navbar-toggler border-0" type="button" data-toggle="collapse"
                        data-target="#navigation"><span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <?php
            if (isset($_GET['search'])) {
                $searchbar = $_GET['search'];
            } else {
                $searchbar = '';
            }
            ?>

            <form action="../partials/search.php" method="get" class="search order-lg-3 order-md-2 order-3 ml-auto">
                <input id="search-query" name="search" type="search" placeholder="Пошук..." autocomplete="off">
            </form>
            <div class="collapse navbar-collapse text-center order-lg-2 order-4" id="navigation">
                <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../partials/about_author.php">Про автора</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../users/contact.php">Контакт</a>
                    </li>
                    <?php
                    if (!isset($log_user)) {
                        ?>
                        <li class="nav-item"><a class="nav-link" href="../authorization/login.php">Увійти</a>
                        <?php
                    } else {
                        ?>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                <?php
                                if (isset($_SESSION['user_data'])) {
                                    echo $_SESSION['user_data']['0'];
                                }
                                ?>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../users/admin.php">
                                    <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Профіль</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"
                                   href="../authorization/logout.php"> <i
                                            class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i> Вийти</a>
                            </div>
                        </li>
                        <?php
                    } ?>
                </ul>
            </div>
        </nav>
    </div>
</header>

