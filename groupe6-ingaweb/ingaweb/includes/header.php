<header>
    <h1>Application d'Archivage des Relevés de Notes</h1>
    <nav>
        <ul>
            <li><a href="../pages/consult_releves.php">Relevés de Notes</a></li>
            <li><a href="../pages/consult_sessions.php">Sessions d'Examens</a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
                <li><a href="../pages/enseignants.php">Enseignants</a></li>
                <li><a href="../pages/etudiants.php">Étudiants</a></li>
                <li><a href="../pages/matieres.php">Matières</a></li>
                <li><a href="../pages/sessions.php">Sessions</a></li>
                <li><a href="../pages/releves.php">Relevés</a></li>
                <li><a href="../pages/users.php">Utilisateurs</a></li>
            <?php } elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'enseignant') { ?>
                <li><a href="../pages/releves.php">Relevés</a></li>
            <?php } ?>   
            <li><a href="../logout.php">Déconnexion</a></li>
        </ul>
    </nav>
</header>
