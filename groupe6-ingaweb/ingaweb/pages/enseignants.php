<?php
include("../includes/config_bd.php");
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$enseignants = [];
$sel = 'SELECT * FROM enseignants';
$requete = $bd->prepare($sel);
$requete->execute();
$enseignants = $requete->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['ajouter_enseignant'])) {
    $matricule = $_POST['matricule_enseignant'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];

    // Vérifier si l'enseignant existe déjà
    $verif = 'SELECT COUNT(*) FROM enseignants WHERE matricule_enseignant = :matricule_enseignant ';
    $requete_verif = $bd->prepare($verif);
    $requete_verif->bindParam(':matricule_enseignant', $matricule);
    $requete_verif->execute();
    $count = $requete_verif->fetchColumn();

    if ($count == 0) {
        // Ajouter l'enseignant seulement s'il n'existe pas déjà
        $ins = 'INSERT INTO enseignants (matricule_enseignant, nom, prenom, date_naissance) VALUES (:matricule_enseignant, :nom, :prenom, :date_naissance)';
        $requete = $bd->prepare($ins);
        $requete->bindParam(':matricule_enseignant', $matricule);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':date_naissance', $date_naissance);
        $requete->execute();
        $_SESSION['notification'] = "L'enseignant  ajouté avec succès.";
        header("Location: enseignants.php");
        exit();
    } else {
        $_SESSION['notification'] = "L'enseignant avec ce matricule existe déjà.";
    }
}

if (isset($_POST['modifier_enseignant'])) {
    $matricule = $_POST['matricule_enseignant'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];

    $upd = 'UPDATE enseignants SET matricule_enseignant = :matricule_enseignant, nom = :nom, prenom = :prenom, date_naissance = :date_naissance WHERE matricule_enseignant = :matricule_enseignant';
    $requete = $bd->prepare($upd);
    $requete->bindParam(':matricule_enseignant', $matricule);
    $requete->bindParam(':nom', $nom);
    $requete->bindParam(':prenom', $prenom);
    $requete->bindParam(':date_naissance', $date_naissance);
    $requete->execute();
    $_SESSION['notification'] = "L'enseignant  modifié avec succès.";
    header("Location: enseignants.php");
    exit();
}

if (isset($_POST['supprimer_enseignant'])) {
    $matricule = $_POST['matricule_enseignant'];

    $del = 'DELETE FROM enseignants WHERE matricule_enseignant = :matricule_enseignant';
    $requete = $bd->prepare($del);
    $requete->bindParam(':matricule_enseignant', $matricule);
    $requete->execute();
    $_SESSION['notification'] = "L'enseignant  supprimé avec succès.";
    header("Location: enseignants.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Enseignants</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include("../includes/header.php"); ?>

    <div class="gestion">
        <?php include("../templates/forms/form_enseignants.php"); ?>
        <h3>Liste des Enseignants</h3>
        <?php include("../templates/tables/table_enseignants.php"); ?>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>
