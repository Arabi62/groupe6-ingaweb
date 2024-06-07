<table>
    <thead>
        <tr>
            <th>Session</th>
            <th>Date Début</th>
            <th>Date Fin</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sessions as $session): ?>
        <tr>
            <td><?= htmlspecialchars($session['session']) ?></td>
            <td><?= htmlspecialchars($session['date_debut']) ?></td>
            <td><?= htmlspecialchars($session['date_fin']) ?></td>
            <td>
                <form action="modification_sessions.php" method="post" style="display: inline;">
                    <input type="hidden" name="session" value="<?= htmlspecialchars($session['session']) ?>">
                    <button type="submit">Modifier</button>
                </form>
                <form action="sessions.php" method="post" style="display: inline;">
                    <input type="hidden" name="session" value="<?= htmlspecialchars($session['session']) ?>">
                    <button type="submit" name="supprimer_session" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette session ?');">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
