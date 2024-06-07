<?php
include("../includes/config_bd.php");
session_start();

if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'enseignant')) {
    header('Location: ../login.php');
    exit();
}

if (!isset($_POST['id_releve'])) {
    header('Location: releves.php');
    exit();
}

$id = $_POST['id_releve'];
$sel = 'SELECT * FROM releves WHERE id_releve = :id_releve';
$requete = $bd->prepare($sel);
$requete->bindParam(':id_releve', $id);
$requete->execute();
$releve = $requete->fetch(PDO::FETCH_ASSOC);

if (!$releve) {
    header('Location: releves.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Relevé</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include("../includes/header.php"); ?>

    <div class="gestion">
        <?php include("../templates/forms/form_releves.php"); ?>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>
