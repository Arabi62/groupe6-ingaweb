<table>
    <thead>
        <tr>
            <th>Matricule Étudiant</th>
            <th>Code Matière</th>
            <th>Note</th>
            <th>Session</th>
            <th>Semestre</th>
            <th>Département</th>
            <th>Année</th>
            <th>Matricule Enseignant</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($releves as $releve): ?>
        <tr>
            <td><?= $releve['matricule_etudiant'] ?></td>
            <td><?= $releve['code_matiere'] ?></td>
            <td><?= $releve['note'] ?></td>
            <td><?= $releve['session'] ?></td>
            <td><?= $releve['semestre'] ?></td>
            <td><?= $releve['departement'] ?></td>
            <td><?= $releve['annee'] ?></td>
            <td><?= $releve['matricule_enseignant'] ?></td>
            <td>
                <form action="modification_releves.php" method="post" style="display: inline;">
                    <input type="hidden" name="id_releve" value="<?= $releve['id_releve'] ?>">
                    <button type="submit" name="modifier_releve">Modifier</button>
                </form>
                <form action="releves.php" method="post" style="display: inline;">
                    <input type="hidden" name="id_releve" value="<?= $releve['id_releve'] ?>">
                    <button type="submit" name="supprimer_releve" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce relevé ?');">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
