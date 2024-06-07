<?php
include("../includes/config_bd.php");
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

if (!isset($_POST['matricule_enseignant'])) {
    header('Location: enseignants.php');
    exit();
}

$matricule = $_POST['matricule_enseignant'];
$sel = 'SELECT * FROM enseignants WHERE matricule_enseignant = :matricule_enseignant';
$requete = $bd->prepare($sel);
$requete->bindParam(':matricule_enseignant', $matricule);
$requete->execute();
$enseignant = $requete->fetch(PDO::FETCH_ASSOC);

if (!$enseignant) {
    header('Location: enseignants.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Enseignant</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include("../includes/header.php"); ?>

    <div class="gestion">
        <?php include("../templates/forms/form_enseignants.php"); ?>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>
