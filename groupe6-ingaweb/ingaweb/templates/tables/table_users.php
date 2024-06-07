<table>
    <thead>
        <tr>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['username'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['role'] ?></td>
            <td>
                <form action="users.php" method="post" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <button type="submit" name="modifier_user" formaction="modification_users.php">Modifier</button>
                </form>
                <form action="users.php" method="post" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <button type="submit" name="supprimer_user" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
