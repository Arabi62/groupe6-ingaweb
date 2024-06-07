<?php
include("../includes/config_bd.php");
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$sessions = [];
$sel = 'SELECT * FROM sessions';
$requete = $bd->prepare($sel);
$requete->execute();
$sessions = $requete->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['ajouter_session'])) {
    $session = $_POST['session'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

    // Vérification des doublons
    $sel = 'SELECT COUNT(*) FROM sessions WHERE session = :session';
    $requete_verif = $bd->prepare($sel);
    $requete_verif->bindParam(':session', $session);
    $requete_verif->execute();
    
    if ($requete_verif->fetchColumn() > 0) {
        $_SESSION['notification'] = "La session existe déjà.";
    } else {
        $ins = 'INSERT INTO sessions (session, date_debut, date_fin) VALUES (:session, :date_debut, :date_fin)';
        $requete = $bd->prepare($ins);
        $requete->bindParam(':session', $session);
        $requete->bindParam(':date_debut', $date_debut);
        $requete->bindParam(':date_fin', $date_fin);
        $requete->execute();
        $_SESSION['notification'] = "Session ajouté avec succès.";
        header("Location: sessions.php");
        exit();
    }
    //$_SESSION['notification'] = "verifie bien tes données.";
}

if (isset($_POST['modifier_session'])) {
    $session = $_POST['session'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

    $upd = 'UPDATE sessions SET session = :session, date_debut = :date_debut, date_fin = :date_fin WHERE session = :session';
    $requete = $bd->prepare($upd);
    $requete->bindParam(':session', $session);
    $requete->bindParam(':date_debut', $date_debut);
    $requete->bindParam(':date_fin', $date_fin);
    $requete->execute();
    $_SESSION['notification'] = "Session modifié avec succès.";
    header("Location: sessions.php");
    exit();
}

if (isset($_POST['supprimer_session'])) {
    $session = $_POST['session'];

    $del = 'DELETE FROM sessions WHERE session = :session';
    $requete = $bd->prepare($del);
    $requete->bindParam(':session', $session);
    $requete->execute();
    $_SESSION['notification'] = "Session  supprimé avec succès.";
    header("Location: sessions.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Sessions</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include("../includes/header.php"); ?>

    <div class="gestion">
        <?php include("../templates/forms/form_sessions.php"); ?>
        <h3>Liste des Sessions</h3>
        <?php include("../templates/tables/table_sessions.php"); ?>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>
