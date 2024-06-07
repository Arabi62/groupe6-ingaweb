<form action="releves.php" method="post">
    <div class="form-container">

        <?php
        // Affichage des notifications
        if (isset($_SESSION['notification'])) {
            echo '<div class="notification">' . htmlspecialchars($_SESSION['notification']) . '</div>';
            unset($_SESSION['notification']);
        }
        ?>

        <input type="hidden" name="id_releve" value="<?= isset($releve) ? $releve['id_releve'] : '' ?>">
        <div class="form-group">
            <label for="matricule_etudiant">Étudiant</label>
            <input type="text" name="matricule_etudiant" id="matricule_etudiant" value="<?= isset($releve) ? $releve['matricule_etudiant'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="code_matiere">Code Matière</label>
            <input type="text" name="code_matiere" id="code_matiere" value="<?= isset($releve) ? $releve['code_matiere'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="note">Note</label>
            <input type="text" name="note" id="note" value="<?= isset($releve) ? $releve['note'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="session">Session</label>
            <input type="number" name="session" id="session" value="<?= isset($releve) ? $releve['session'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="semestre">Semestre</label>
            <input type="number" name="semestre" id="semestre" value="<?= isset($releve) ? $releve['semestre'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="departement">Département</label>
            <input type="text" name="departement" id="departement" value="<?= isset($releve) ? $releve['departement'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="annee">Année</label>
            <input type="number" name="annee" id="annee" value="<?= isset($releve) ? $releve['annee'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="matricule_enseignant">Matricule Enseignant</label>
            <input type="text" name="matricule_enseignant" id="matricule_enseignant" value="<?= isset($releve) ? $releve['matricule_enseignant'] : '' ?>" required>
        </div>
        <div class="form-group">
            <button type="submit" name="ajouter_releve">Ajouter</button>
            <button type="submit" name="modifier_releve">Modifier</button>
            <button type="submit" name="supprimer_releve" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce relevé ?');">Supprimer</button>
        </div>
    </div>
</form>
