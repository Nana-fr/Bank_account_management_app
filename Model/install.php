<?php
try {
    $connection = new PDO('mysql:host=localhost;dbname=banque_php', 'banquePHP', 'banque76',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}
?>