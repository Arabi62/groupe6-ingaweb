<table>
    <thead>
        <tr>
            <th>Code Matière</th>
            <th>Nom Matière</th>
            <th>Crédits</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($matieres as $matiere): ?>
        <tr>
            <td><?= $matiere['code_matiere'] ?></td>
            <td><?= $matiere['nom_matiere'] ?></td>
            <td><?= $matiere['credit'] ?></td>
            <td>
                <form action="modification_matieres.php" method="post" style="display: inline;">
                    <input type="hidden" name="code_matiere" value="<?= $matiere['code_matiere'] ?>">
                    <button type="submit">Modifier</button>
                </form>
                <form action="matieres.php" method="post" style="display: inline;">
                    <input type="hidden" name="code_matiere" value="<?= $matiere['code_matiere'] ?>">
                    <button type="submit" name="supprimer_matiere" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette matière ?');">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
