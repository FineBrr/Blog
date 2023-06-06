<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
$db = include "../database/database.php";
$id_pub = $_GET['id'];
if (isset($_SESSION['user_data'])) {
    $author = $_SESSION['user_data']['0'];
}

$comments = "select * from comments inner join user on (user.username = comments.author) where id_pub = '$id_pub'";
$st = $db->prepare($comments);
$st->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Коментарі</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/pointer.css">
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
      crossorigin="anonymous">
<div class="container">
    <div class="row">
        <?php
        while ($row = $st->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="col-md-8">
            <div class="media g-mb-30 media-comment">
                <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15"
                     src="data:image;base64, <?= base64_encode($row['profile']) ?>">
                <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                    <div class="g-mb-15">
                        <h5 class="h5 g-color-gray-dark-v1 mb-0"><?= $row['author'] ?></h5>
                        <span class="g-color-gray-dark-v4 g-font-size-12"><?php
                            $date = $row["publish_date"]
                            ?>
                            <?= date(
                                'd m Y',
                                strtotime($date)
                            ) ?></span>
                    </div>
                    <p><?= $row['comment'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
} ?>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script type="text/javascript">

</script>
</body>
</html>
