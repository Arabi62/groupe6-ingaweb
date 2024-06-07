<form action="matieres.php" method="post">
    <div class="form-container">
        <?php
        // Affichage des notifications
        if (isset($_SESSION['notification'])) {
            echo '<div class="notification">' . htmlspecialchars($_SESSION['notification']) . '</div>';
            unset($_SESSION['notification']);
        }
        ?>
        <div class="form-group">
            <label for="code_matiere">Code Matière</label>
            <input type="text" name="code_matiere" id="code_matiere" value="<?= isset($matiere) ? $matiere['code_matiere'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="nom_matiere">Nom Matière</label>
            <input type="text" name="nom_matiere" id="nom_matiere" value="<?= isset($matiere) ? $matiere['nom_matiere'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="credit">Crédits</label>
            <input type="number" name="credit" id="credit" value="<?= isset($matiere) ? $matiere['credit'] : '' ?>" required>
        </div>
        <div class="form-group">
            <button type="submit" name="ajouter_matiere">Ajouter</button>
            <button type="submit" name="modifier_matiere">Modifier</button>
            <button type="submit" name="supprimer_matiere" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette matière ?');">Supprimer</button>
        </div>
    </div>
</form>
