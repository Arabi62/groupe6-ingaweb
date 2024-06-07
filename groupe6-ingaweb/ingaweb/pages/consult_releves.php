<?php
include("../includes/config_bd.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

$releves = [];

// Gestion des filtres
$filters = [];
$sqlConditions = [];

if (!empty($_POST['nom'])) {
    $filters['nom'] = $_POST['nom'];
    $sqlConditions[] = 'e.nom LIKE :nom';
}

if (!empty($_POST['matricule_etudiant'])) {
    $filters['matricule_etudiant'] = $_POST['matricule_etudiant'];
    $sqlConditions[] = 'e.matricule_etudiant LIKE :matricule_etudiant';
}

if (!empty($_POST['semestre'])) {
    $filters['semestre'] = $_POST['semestre'];
    $sqlConditions[] = 'r.semestre = :semestre';
}

$sqlCondition = !empty($sqlConditions) ? ' AND ' . implode(' AND ', $sqlConditions) : '';

$sel = 'SELECT e.matricule_etudiant AS matricule, e.nom, e.prenom, m.code_matiere, m.nom_matiere, m.credit, s.session, r.note, r.semestre, r.departement, r.annee
        FROM releves AS r
        JOIN etudiants AS e ON r.matricule_etudiant = e.matricule_etudiant
        JOIN matieres AS m ON r.code_matiere = m.code_matiere
        JOIN sessions AS s ON r.session = s.session
        WHERE 1=1 ' . $sqlCondition;

$requete = $bd->prepare($sel);

if (!empty($filters['nom'])) {
    $requete->bindValue(':nom', '%' . $filters['nom'] . '%', PDO::PARAM_STR);
}

if (!empty($filters['matricule_etudiant'])) {
    $requete->bindValue(':matricule_etudiant', '%' . $filters['matricule_etudiant'] . '%', PDO::PARAM_STR);
}

if (!empty($filters['semestre'])) {
    $requete->bindValue(':semestre', $filters['semestre'], PDO::PARAM_STR);
}

$requete->execute();
$releves = $requete->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation des Relevés de Notes</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include("../includes/header.php"); ?>

    <div class="consultation">
        <h3>Relevés de Notes</h3>
        
        <!-- Formulaire de recherche -->
        <form class="filter-form" method="post" action="consult_releves.php">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" value="<?php echo isset($filters['nom']) ? htmlspecialchars($filters['nom']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="matricule">Matricule:</label>
                <input type="text" id="matricule_etudiant" name="matricule_etudiant" value="<?php echo isset($filters['matricule_etudiant']) ? htmlspecialchars($filters['matricule_etudiant']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="semestre">Semestre:</label>
                <input type="text" id="semestre" name="semestre" value="<?php echo isset($filters['semestre']) ? htmlspecialchars($filters['semestre']) : ''; ?>">
            </div>
            <button type="submit">Rechercher</button>
        </form>

        <?php include("../templates/tables/table_consult_releves.php"); ?>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>

