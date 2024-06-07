<table>
    <thead>
        <tr>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de Naissance</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($enseignants as $enseignant): ?>
        <tr>
            <td><?= $enseignant['matricule_enseignant'] ?></td>
            <td><?= $enseignant['nom'] ?></td>
            <td><?= $enseignant['prenom'] ?></td>
            <td><?= $enseignant['date_naissance'] ?></td>
            <td>
                <form action="modification_enseignants.php" method="post" style="display: inline;">
                    <input type="hidden" name="matricule_enseignant" value="<?= $enseignant['matricule_enseignant'] ?>">
                    <button type="submit">Modifier</button>
                </form>
                <form action="enseignants.php" method="post" style="display: inline;">
                    <input type="hidden" name="matricule_enseignant" value="<?= $enseignant['matricule_enseignant'] ?>">
                    <button type="submit" name="supprimer_enseignant" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant ?');">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
