<?php

$db = include "../database/database.php";

if (isset($_GET['delete_comm'])) {
    $comment = $_GET['delete_comm'];
    try {
        $sql = "DELETE FROM comments WHERE comment = '$comment'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        header("Location: admin_comments.php");
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
} elseif (isset($_GET['delete_cat'])) {
    $cat_name = $_GET['delete_cat'];
    try {
        $sql = "DELETE FROM categories WHERE name = '$cat_name'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        header("Location: ../post/categories.php");
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
} elseif (isset($_GET['delete_pub'])) {
    $id = $_GET['delete_pub'];
    $select = "Select * from publication where id_pub = '$id'";
    $st = $db->prepare($select);
    $st->execute();
    while ($result = $st->fetch(PDO::FETCH_ASSOC)) {
        $image_name = $result['image_name'];
    }
    $filePath = "../source/images/" . "$image_name";
    try {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $sql = "DELETE FROM publication WHERE id_pub = '$id'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        header("Location: admin.php");
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
} elseif (isset($_GET['delete_user'])) {
    $username = $_GET['delete_user'];
    try {
        $sql = "DELETE FROM user WHERE username = '$username'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        header("Location: users.php");
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}

?>
