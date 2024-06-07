<table>
    <thead>
        <tr>
            <th>Session</th>
            <th>Date de Début</th>
            <th>Date de Fin</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sessions as $session) { ?>
            <tr>
                <td><?php echo htmlspecialchars($session['session']); ?></td>
                <td><?php echo htmlspecialchars($session['date_debut']); ?></td>
                <td><?php echo htmlspecialchars($session['date_fin']); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
