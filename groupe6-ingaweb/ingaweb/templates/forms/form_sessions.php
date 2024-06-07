<form action="sessions.php" method="post">
    <div class="form-container">

        <?php
            // Affichage des notifications
            if (isset($_SESSION['notification'])) {
                echo '<div class="notification">' . htmlspecialchars($_SESSION['notification']) . '</div>';
                unset($_SESSION['notification']);
            }
        ?>

        <div class="form-group">
            <label for="session">Session</label>
            <input type="number" name="session" id="session" value="<?= isset($session) ? htmlspecialchars($session['session']) : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="date_debut">Date Début</label>
            <input type="date" name="date_debut" id="date_debut" value="<?= isset($session) ? htmlspecialchars($session['date_debut']) : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="date_fin">Date Fin</label>
            <input type="date" name="date_fin" id="date_fin" value="<?= isset($session) ? htmlspecialchars($session['date_fin']) : '' ?>" required>
        </div>
        <div class="form-group">
            <button type="submit" name="ajouter_session">Ajouter</button>
            <button type="submit" name="modifier_session">Modifier</button>
            <button type="submit" name="supprimer_session" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette session ?');">Supprimer</button>
        </div>
    </div>    
</form>
