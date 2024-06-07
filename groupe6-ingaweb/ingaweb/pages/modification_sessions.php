<?php
include("../includes/config_bd.php");
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

if (!isset($_POST['session'])) {
    header('Location: sessions.php');
    exit();
}

$session = $_POST['session'];
$sel = 'SELECT * FROM sessions WHERE session = :session';
$requete = $bd->prepare($sel);
$requete->bindParam(':session', $session);
$requete->execute();
$session = $requete->fetch(PDO::FETCH_ASSOC);

if (!$session) {
    header('Location: sessions.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Session</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include("../includes/header.php"); ?>

    <div class="gestion">
        <?php include("../templates/forms/form_sessions.php"); ?>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>
