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
        <?php foreach ($etudiants as $etudiant): ?>
        <tr>
            <td><?= $etudiant['matricule_etudiant'] ?></td>
            <td><?= $etudiant['nom'] ?></td>
            <td><?= $etudiant['prenom'] ?></td>
            <td><?= $etudiant['date_naissance'] ?></td>
            <td>
                <form action="modification_etudiants.php" method="post" style="display: inline;">
                    <input type="hidden" name="matricule_etudiant" value="<?= $etudiant['matricule_etudiant'] ?>">
                    <button type="submit">Modifier</button>
                </form>
                <form action="etudiants.php" method="post" style="display: inline;">
                    <input type="hidden" name="matricule_etudiant" value="<?= $etudiant['matricule_etudiant'] ?>">
                    <button type="submit" name="supprimer_etudiant" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
