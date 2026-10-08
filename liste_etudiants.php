<?php

require_once 'connexion.php';

$sql = "SELECT 
            etudiants.id,
            etudiants.nom,
            etudiants.prenom,
            etudiants.age,
            filieres.nom AS filiere
        FROM etudiants
        JOIN filieres
            ON etudiants.filiere_id = filieres.id
        ORDER BY etudiants.nom ASC";

$stmt = $pdo->query($sql);

$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
</head>

<body>

<h1>Liste des étudiants</h1>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Âge</th>
        <th>Filière</th>
    </tr>

    <?php foreach ($etudiants as $etudiant): ?>

        <tr>
            <td><?= htmlspecialchars($etudiant['id']) ?></td>
            <td><?= htmlspecialchars($etudiant['nom']) ?></td>
            <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
            <td><?= htmlspecialchars($etudiant['age']) ?></td>
            <td><?= htmlspecialchars($etudiant['filiere']) ?></td>
        </tr>

    <?php endforeach; ?>

</table>

</body>
</html>