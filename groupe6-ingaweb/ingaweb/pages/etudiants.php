<?php
include("../includes/config_bd.php");
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$etudiants = [];
$sel = 'SELECT * FROM etudiants';
$requete = $bd->prepare($sel);
$requete->execute();
$etudiants = $requete->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['ajouter_etudiant'])) {
    $matricule = $_POST['matricule_etudiant'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];

    // Vérifier si l'étudiant existe déjà
    $verif = 'SELECT COUNT(*) FROM etudiants WHERE matricule_etudiant = :matricule_etudiant';
    $requete_verif = $bd->prepare($verif);
    $requete_verif->bindParam(':matricule_etudiant', $matricule);
    $requete_verif->execute();
    $count = $requete_verif->fetchColumn();

    if ($count == 0) {
        // Ajouter l'étudiant seulement s'il n'existe pas déjà
        $ins = 'INSERT INTO etudiants (matricule_etudiant, nom, prenom, date_naissance) VALUES (:matricule_etudiant, :nom, :prenom, :date_naissance)';
        $requete = $bd->prepare($ins);
        $requete->bindParam(':matricule_etudiant', $matricule);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':date_naissance', $date_naissance);
        $requete->execute();
        $_SESSION['notification'] = "L'étudiant  ajouté avec succès.";
        header("Location: etudiants.php");
        exit();
    } else {
        $_SESSION['notification'] = "L'étudiant avec ce matricule existe déjà.";
    }
}

if (isset($_POST['modifier_etudiant'])) {
    $matricule = $_POST['matricule_etudiant'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];

    $upd = 'UPDATE etudiants SET matricule_etudiant = :matricule_etudiant, nom = :nom, prenom = :prenom, date_naissance = :date_naissance WHERE matricule_etudiant = :matricule_etudiant';
    $requete = $bd->prepare($upd);
    $requete->bindParam(':matricule_etudiant', $matricule);
    $requete->bindParam(':nom', $nom);
    $requete->bindParam(':prenom', $prenom);
    $requete->bindParam(':date_naissance', $date_naissance);
    $requete->execute();
    $_SESSION['notification'] = "L'étudiant  modifié avec succès.";
    header("Location: etudiants.php");
    exit();
}

if (isset($_POST['supprimer_etudiant'])) {
    $matricule = $_POST['matricule_etudiant'];

    $del = 'DELETE FROM etudiants WHERE matricule_etudiant = :matricule_etudiant';
    $requete = $bd->prepare($del);
    $requete->bindParam(':matricule_etudiant', $matricule);
    $requete->execute();
    $_SESSION['notification'] = "L'étudiant  supprimé avec succès.";
    header("Location: etudiants.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Étudiants</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include("../includes/header.php"); ?>

    <div class="gestion">
        <?php include("../templates/forms/form_etudiants.php"); ?>
        <h3>Liste des Étudiants</h3>
        <?php include("../templates/tables/table_etudiants.php"); ?>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>
