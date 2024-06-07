<?php
$dsn = 'mysql:host=localhost;dbname=archives_db';
$username = 'root';
$password = '';

try {
    $bd = new PDO($dsn, $username, $password);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit();
}
?>
