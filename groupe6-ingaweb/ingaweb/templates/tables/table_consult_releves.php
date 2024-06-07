<table>
    <thead>
        <tr>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Code Matière</th>
            <th>Nom Matière</th>
            <th>Note</th>
            <th>Session</th>
            <th>Crédits</th>
            <th>Semestre</th>
            <th>Département</th>
            <th>Année</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($releves as $releve) { ?>
            <tr>
                <td><?php echo htmlspecialchars($releve['matricule']); ?></td>
                <td><?php echo htmlspecialchars($releve['nom']); ?></td>
                <td><?php echo htmlspecialchars($releve['prenom']); ?></td>
                <td><?php echo htmlspecialchars($releve['code_matiere']); ?></td>
                <td><?php echo htmlspecialchars($releve['nom_matiere']); ?></td>
                <td><?php echo htmlspecialchars($releve['note']); ?></td>
                <td><?php echo htmlspecialchars($releve['session']); ?></td>
                <td><?php echo htmlspecialchars($releve['credit']); ?></td>
                <td><?php echo htmlspecialchars($releve['semestre']); ?></td>
                <td><?php echo htmlspecialchars($releve['departement']); ?></td>
                <td><?php echo htmlspecialchars($releve['annee']); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
