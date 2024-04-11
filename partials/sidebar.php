<?php

error_reporting(E_ERROR | E_PARSE);
$sql = "Select * from categories";
$st = $db->prepare($sql);
$st->execute();

?>

<link rel="stylesheet" href="../source/plugins/bootstrap/bootstrap.min.css">
<div class="col-lg-4">
    <div class="widget-blocks">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="widget">
                    <h2 class="section-title mb-3">Категорії</h2>
                    <div class="widget-body">
                        <ul class="widget-list">
                            <?php
                            while ($result = $st->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <li><a href="../post/category.php?name=<?= $result['name'] ?>"><?= $result['name'] ?>
                                        <span class="ml-auto"></span></a>
                                </li>
                                <?php
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>