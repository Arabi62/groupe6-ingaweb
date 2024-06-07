<?php
include("../includes/config_bd.php");
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$matieres = [];
$sel = 'SELECT * FROM matieres';
$requete = $bd->prepare($sel);
$requete->execute();
$matieres = $requete->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['ajouter_matiere'])) {
    $code_matiere = $_POST['code_matiere'];
    $nom_matiere = $_POST['nom_matiere'];
    $credit = $_POST['credit'];

    // Vérifier si la matière existe déjà
    $verif = 'SELECT COUNT(*) FROM matieres WHERE code_matiere = :code_matiere';
    $requete_verif = $bd->prepare($verif);
    $requete_verif->bindParam(':code_matiere', $code_matiere);
    $requete_verif->execute();
    $count = $requete_verif->fetchColumn();

    if ($count == 0) {
        // Ajouter la matière seulement si elle n'existe pas déjà
        $ins = 'INSERT INTO matieres (code_matiere, nom_matiere, credit) VALUES (:code_matiere, :nom_matiere, :credit)';
        $requete = $bd->prepare($ins);
        $requete->bindParam(':code_matiere', $code_matiere);
        $requete->bindParam(':nom_matiere', $nom_matiere);
        $requete->bindParam(':credit', $credit);
        $requete->execute();
        $_SESSION['notification'] = "matière ajouté avec succès.";
        header("Location: matieres.php");
        exit();
    } else {
        $_SESSION['notification'] = "La matière avec ce code existe déjà.";
    }
}

if (isset($_POST['modifier_matiere'])) {
    $code_matiere = $_POST['code_matiere'];
    $nom_matiere = $_POST['nom_matiere'];
    $credit = $_POST['credit'];

    $upd = 'UPDATE matieres SET code_matiere = :code_matiere, nom_matiere = :nom_matiere, credit = :credit WHERE code_matiere = :code_matiere';
    $requete = $bd->prepare($upd);
    $requete->bindParam(':code_matiere', $code_matiere);
    $requete->bindParam(':nom_matiere', $nom_matiere);
    $requete->bindParam(':credit', $credit);
    $requete->execute();
    $_SESSION['notification'] = "matière modifié avec succès.";
    header("Location: matieres.php");
    exit();
}

if (isset($_POST['supprimer_matiere'])) {
    $code_matiere = $_POST['code_matiere'];

    $del = 'DELETE FROM matieres WHERE code_matiere = :code_matiere';
    $requete = $bd->prepare($del);
    $requete->bindParam(':code_matiere', $code_matiere);
    $requete->execute();
    $_SESSION['notification'] = "matière supprimé avec succès.";
    header("Location: matieres.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Matières</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include("../includes/header.php"); ?>

    <div class="gestion">
        <?php include("../templates/forms/form_matieres.php"); ?>
        <h3>Liste des Matières</h3>
        <?php include("../templates/tables/table_matieres.php"); ?>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>
