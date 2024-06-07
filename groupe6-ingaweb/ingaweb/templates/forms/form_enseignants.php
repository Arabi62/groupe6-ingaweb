<form action="enseignants.php" method="post">
    <div class="form-container">

        <?php
        // Affichage des notifications
        if (isset($_SESSION['notification'])) {
            echo '<div class="notification">' . htmlspecialchars($_SESSION['notification']) . '</div>';
            unset($_SESSION['notification']);
        }
        ?>

        <input type="hidden" name="matricule_enseignant" value="<?= isset($enseignant) ? $enseignant['matricule_enseignant'] : '' ?>">
        <div class="form-group">
            <label for="matricule_enseignant">Matricule</label>
            <input type="text" name="matricule_enseignant" id="matricule_enseignant" value="<?= isset($enseignant) ? $enseignant['matricule_enseignant'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="<?= isset($enseignant) ? $enseignant['nom'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="<?= isset($enseignant) ? $enseignant['prenom'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="date_naissance">Date de Naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" value="<?= isset($enseignant) ? $enseignant['date_naissance'] : '' ?>" required>
        </div>
        <div class="form-group">
            <button type="submit" name="ajouter_enseignant">Ajouter</button>
            <button type="submit" name="modifier_enseignant">Modifier</button>
            <button type="submit" name="supprimer_enseignant" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant ?');">Supprimer</button>
        </div>
    </div>
</form>
