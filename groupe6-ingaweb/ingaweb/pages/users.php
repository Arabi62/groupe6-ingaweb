<?php
include("../includes/config_bd.php");
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$users = [];
$sel = 'SELECT * FROM users';
$requete = $bd->prepare($sel);
$requete->execute();
$users = $requete->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['ajouter_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    // Vérification des doublons
    $sel = 'SELECT * FROM users WHERE email = :email OR username = :username';
    $requete = $bd->prepare($sel);
    $requete->bindParam(':email', $email);
    $requete->bindParam(':username', $username);
    $requete->execute();
    
    if ($requete->rowCount() > 0) {
        $_SESSION['notification'] = "L'utilisateur existe déjà.";
    } else {
        $ins = 'INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)';
        $requete = $bd->prepare($ins);
        $requete->bindParam(':username', $username);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':password', $password);
        $requete->bindParam(':role', $role);
        $requete->execute();
        $_SESSION['notification'] = "Utilisateur ajouté avec succès.";
        header("Location: users.php");
        exit();
    }
}

if (isset($_POST['modifier_user'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $upd = 'UPDATE users SET username = :username, email = :email, role = :role WHERE id = :id';
    $requete = $bd->prepare($upd);
    $requete->bindParam(':id', $id);
    $requete->bindParam(':username', $username);
    $requete->bindParam(':email', $email);
    $requete->bindParam(':role', $role);
    $requete->execute();
    $_SESSION['notification'] = "Utilisateur modifié avec succès.";
    header("Location: users.php");
    exit();
}

if (isset($_POST['supprimer_user'])) {
    $id = $_POST['id'];

    $del = 'DELETE FROM users WHERE id = :id';
    $requete = $bd->prepare($del);
    $requete->bindParam(':id', $id);
    $requete->execute();
    $_SESSION['notification'] = "Utilisateur supprimé avec succès.";
    header("Location: users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include("../includes/header.php"); ?>

    <div class="gestion">
        
        <?php include("../templates/forms/form_users.php"); ?>
        <h3>Liste des Utilisateurs</h3>
        <?php include("../templates/tables/table_users.php"); ?>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>
