<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
$db = include "../database/database.php";
if (isset($_SESSION['user_data'])) {
    $admin = $_SESSION['user_data']['0'];
}
$comments = "select * from user where username = '$admin'";
$st = $db->prepare($comments);
$st->execute();
while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
    $profile = $row['profile'];
}
?>
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
            <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
            <div class="sidebar-brand-text mx-3">Блог</div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="../users/admin.php"> <span>Пости</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Nav Item - Tables -->
        <?php
        if ($admin == "Admin") {
            ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="../post/categories.php"> <span>Категорії</span> </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="../users/users.php"> <span>Користувачі</span> </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link collapsed" href="../users/admin_comments.php"> <span>Коментарі</span> </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <?php
        } ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="../users/edit_profile.php"> <span>Редагувати профіль</span> </a>
        </li>
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i
                            class="fa fa-bars"></i></button>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                    class="fas fa-search fa-fw"></i> </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow +animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button"><i
                                                    class="fas fa-search fa-sm"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">
                          <?php
                          if (isset($_SESSION['user_data'])) {
                              echo $_SESSION['user_data']['0'];
                          }
                          ?>
                        </span> <img class="img-profile rounded-circle"
                                     src="data:image;base64, <?= base64_encode($profile) ?>"> </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="../users/admin.php"> <i
                                        class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Профіль</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                               href="../authorization/logout.php"> <i
                                        class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>Вийти </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top"> <i class="fa fa-angle-up"></i> </a>
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
            <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
