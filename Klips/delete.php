<?php

$bdd = new PDO('mysql:host=localhost;dbname=klips', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$sup = "DELETE  FROM POST WHERE id_post = $_GET[id]";
$del = $bdd->prepare($sup);

$del->execute();

header('Location: index.php');

?>