<?php
include("../includes/config_bd.php");
session_start();

if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'enseignant')) {
    header('Location: ../login.php');
    exit();
}

$releves = [];
$sel = 'SELECT * FROM releves';
$requete = $bd->prepare($sel);
$requete->execute();
$releves = $requete->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['ajouter_releve'])) {
    $matricule_etudiant = $_POST['matricule_etudiant'];
    $code_matiere = $_POST['code_matiere'];
    $note = $_POST['note'];
    $session = $_POST['session'];
    $semestre = $_POST['semestre'];
    $departement = $_POST['departement'];
    $annee = $_POST['annee'];
    $matricule_enseignant = $_POST['matricule_enseignant'];

    // Vérification des doublons
    $sel = 'SELECT * FROM releves WHERE matricule_etudiant = :matricule_etudiant AND code_matiere = :code_matiere AND session = :session AND matricule_enseignant = :matricule_enseignant';
    $requete = $bd->prepare($sel);
    $requete->bindParam(':matricule_etudiant', $matricule_etudiant);
    $requete->bindParam(':code_matiere', $code_matiere);
    $requete->bindParam(':session', $session);
    $requete->bindParam(':matricule_enseignant', $matricule_enseignant);
    $requete->execute();
    
    if ($requete->rowCount() > 0) {
        $_SESSION['notification'] = "Le relevé existe déjà.";
    } else {
        $ins = 'INSERT INTO releves (matricule_etudiant, code_matiere, note, session, semestre, departement, annee, matricule_enseignant) VALUES (:matricule_etudiant, :code_matiere, :note, :session, :semestre, :departement, :annee, :matricule_enseignant)';
        $requete = $bd->prepare($ins);
        $requete->bindParam(':matricule_etudiant', $matricule_etudiant);
        $requete->bindParam(':code_matiere', $code_matiere);
        $requete->bindParam(':note', $note);
        $requete->bindParam(':session', $session);
        $requete->bindParam(':semestre', $semestre);
        $requete->bindParam(':departement', $departement);
        $requete->bindParam(':annee', $annee);
        $requete->bindParam(':matricule_enseignant', $matricule_enseignant);
        $requete->execute();
        $_SESSION['notification'] = "relevé  ajouté avec succès.";
        header("Location: releves.php");
        exit();
    }
}

if (isset($_POST['modifier_releve'])) {
    $id = $_POST['id_releve'];
    $matricule_etudiant = $_POST['matricule_etudiant'];
    $code_matiere = $_POST['code_matiere'];
    $note = $_POST['note'];
    $session = $_POST['session'];
    $semestre = $_POST['semestre'];
    $departement = $_POST['departement'];
    $annee = $_POST['annee'];
    $matricule_enseignant = $_POST['matricule_enseignant'];

    $upd = 'UPDATE releves SET matricule_etudiant = :matricule_etudiant, code_matiere = :code_matiere, note = :note, session = :session, semestre = :semestre, departement = :departement, annee = :annee, matricule_enseignant = :matricule_enseignant WHERE id_releve = :id_releve';
    $requete = $bd->prepare($upd);
    $requete->bindParam(':id_releve', $id);
    $requete->bindParam(':matricule_etudiant', $matricule_etudiant);
    $requete->bindParam(':code_matiere', $code_matiere);
    $requete->bindParam(':note', $note);
    $requete->bindParam(':session', $session);
    $requete->bindParam(':semestre', $semestre);
    $requete->bindParam(':departement', $departement);
    $requete->bindParam(':annee', $annee);
    $requete->bindParam(':matricule_enseignant', $matricule_enseignant);
    $requete->execute();
    $_SESSION['notification'] = "relevé  modifié avec succès.";
    header("Location: releves.php");
    exit();
}

if (isset($_POST['supprimer_releve'])) {
    $id = $_POST['id_releve'];

    $del = 'DELETE FROM releves WHERE id_releve = :id_releve';
    $requete = $bd->prepare($del);
    $requete->bindParam(':id_releve', $id);
    $requete->execute();
    $_SESSION['notification'] = "relevé  supprimé avec succès.";
    header("Location: releves.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Relevés de Notes</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include("../includes/header.php"); ?>

    <div class="gestion">
        <?php include("../templates/forms/form_releves.php"); ?>
        <h3>Liste des Relevés de Notes</h3>
        <?php include("../templates/tables/table_releves.php"); ?>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>
