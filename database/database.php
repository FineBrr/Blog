<?php

try {
    $connection = new PDO('mysql:host=localhost;dbname=Blog', 'root', '');
} catch (PDOException $e) {
    echo $e->getMessage();
}
return $connection;