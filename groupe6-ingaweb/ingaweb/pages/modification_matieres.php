<?php
include("../includes/config_bd.php");
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

if (!isset($_POST['code_matiere'])) {
    header('Location: matieres.php');
    exit();
}

$code_matiere = $_POST['code_matiere'];
$sel = 'SELECT * FROM matieres WHERE code_matiere = :code_matiere';
$requete = $bd->prepare($sel);
$requete->bindParam(':code_matiere', $code_matiere);
$requete->execute();
$matiere = $requete->fetch(PDO::FETCH_ASSOC);

if (!$matiere) {
    header('Location: matieres.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Matière</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include("../includes/header.php"); ?>

    <div class="gestion">
        <?php include("../templates/forms/form_matieres.php"); ?>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>
