<?php
include("../includes/config_bd.php");
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}



$matricule = $_POST['matricule_etudiant'];
$sel = 'SELECT * FROM etudiants WHERE matricule_etudiant = :matricule_etudiant';
$requete = $bd->prepare($sel);
$requete->bindParam(':matricule_etudiant', $matricule);
$requete->execute();
$etudiant = $requete->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Étudiant</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include("../includes/header.php"); ?>

    <div class="gestion">
        <?php include("../templates/forms/form_etudiants.php"); ?>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>
