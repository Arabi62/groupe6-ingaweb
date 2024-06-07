<?php
include("../includes/config_bd.php");
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

if (!isset($_POST['id'])) {
    header('Location: users.php');
    exit();
}

$id = $_POST['id'];
$sel = 'SELECT * FROM users WHERE id = :id';
$requete = $bd->prepare($sel);
$requete->bindParam(':id', $id);
$requete->execute();
$user = $requete->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header('Location: users.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Utilisateur</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include("../includes/header.php"); ?>

    <div class="gestion">
        <?php include("../templates/forms/form_users.php"); ?>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>
