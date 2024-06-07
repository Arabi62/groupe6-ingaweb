<form action="etudiants.php" method="post">
    <div class="form-container">

        <?php
        // Affichage des notifications
        if (isset($_SESSION['notification'])) {
            echo '<div class="notification">' . htmlspecialchars($_SESSION['notification']) . '</div>';
            unset($_SESSION['notification']);
        }
        ?>

        <div class="form-group">
            <label for="matricule_etudiant">Matricule</label>
            <input type="text" name="matricule_etudiant" id="matricule_etudiant" value="<?= isset($etudiant) ? $etudiant['matricule_etudiant'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="<?= isset($etudiant) ? $etudiant['nom'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="<?= isset($etudiant) ? $etudiant['prenom'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="date_naissance">Date de Naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" value="<?= isset($etudiant) ? $etudiant['date_naissance'] : '' ?>" required>
        </div>
        <div class="form-group">
            <button type="submit" name="ajouter_etudiant">Ajouter</button>
            <button type="submit" name="modifier_etudiant">Modifier</button>
            <button type="submit" name="supprimer_etudiant" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">Supprimer</button>
        </div>
    </div>
</form>
