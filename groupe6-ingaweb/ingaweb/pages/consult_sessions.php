<?php
include("../includes/config_bd.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

$sessions = [];
$sel = 'SELECT * FROM sessions';
$requete = $bd->prepare($sel);
$requete->execute();
$sessions = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation des Sessions d'Examens</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include("../includes/header.php"); ?>

    <div class="consultation">
        <h3>Sessions d'Examens</h3>
        <?php include("../templates/tables/table_consult_sessions.php"); ?>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>
