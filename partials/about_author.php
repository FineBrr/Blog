<?php

error_reporting(E_ERROR | E_PARSE);
include "_header.php";
include "navigation.php";
$db = include "../database/database.php";
?>
<head>
    <title>Про автора</title>
    <!-- # CSS Plugins -->
    <link rel="stylesheet" href="../source/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<style>
    .indent {
        text-indent: 2%;
    }
</style>
<main>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto mb-5 mb-lg-0">
                    <img loading="lazy" decoding="async" src="../source/images/author.png"
                         class="img-fluid  mb-4"
                         alt="Author Image">
                    <h1 class="mb-4">Кіш Давід</h1>
                    <div class="content indent">
                        <p class="indent text-justify">
                            Привіт! Мене звати Кіш Давід, і я з нетерпінням очікую на майбутнє, яке мені
                            приготувала освіта. Я глибоко захоплений своєю професійною галуззю і віддаю перевагу
                            набуттю знань і вмінь, щоб стати успішним фахівцем.</p>

                        <p> Мої студентські роки були наповнені вивченням різних аспектів мого обраного напрямку.
                            Від засвоєння теоретичних основ до практичних застосувань, я старанно працював, щоб
                            отримати високу якість освіти. Мені цікаво було вивчати різноманітні предмети, такі як
                            (ОПАМ, ООП, БД, веб-розробка так ін.), які допомогли мені зрозуміти глибину і
                            сутність моєї професії.</p>
                        <p>Під час навчання я також брав участь у проектах і лабораторних роботах, де
                            використовував свої знання для розв’язання реальних проблем. Це надало мені можливість
                            випробувати свої навики в практичному середовищі та зрозуміти, як мої навички можуть
                            бути застосовані для досягнення конкретних результатів.</p>
                        <p> Я завжди прагну до саморозвитку та постійного вдосконалення. Я відкритий до нових ідей,
                            інновацій та технологій, які можуть поліпшити мої знання і навички. Я розумію, що для
                            досягнення успіху в моїй галузі потрібно бути готовим до постійних змін і відкритим до
                            нових викликів.</p>
                        <p> Мої майбутні плани включають продовження професійного росту та внесення свого внеску в
                            обрану галузь. Я прагну стати висококваліфікованим фахівцем, який працює над
                            розв’язанням складних проблем і сприяє прогресу у своїй галузі.</p>
                    </div>
                </div>
                <?php
                include "sidebar.php";
                ?>
            </div>
        </div>
    </section>
</main>
<footer>
    <?php
    include "_footer.php";
    ?>
</footer>
