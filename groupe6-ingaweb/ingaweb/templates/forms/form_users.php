<form action="users.php" method="post">
    <div class="form-container">

    <?php
        // Affichage des notifications
        if (isset($_SESSION['notification'])) {
            echo '<div class="notification">' . htmlspecialchars($_SESSION['notification']) . '</div>';
            unset($_SESSION['notification']);
        }
        ?>

        <input type="hidden" name="id" value="<?= isset($user) ? $user['id'] : '' ?>">
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" value="<?= isset($user) ? $user['username'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= isset($user) ? $user['email'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" <?= isset($user) ? '' : 'required' ?>>
        </div>
        <div class="form-group">
            <label for="role">Rôle</label>
            <select name="role" id="role" required>
                <option value="admin" <?= isset($user) && $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="enseignant" <?= isset($user) && $user['role'] === 'enseignant' ? 'selected' : '' ?>>Enseignant</option>
                <option value="etudiant" <?= isset($user) && $user['role'] === 'etudiant' ? 'selected' : '' ?>>Étudiant</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" name="ajouter_user">Ajouter</button>
            <button type="submit" name="modifier_user">Modifier</button>
            <button type="submit" name="supprimer_user" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</button>
        </div>
    </div>
</form>
