<?php

require_once 'connexion.php';

$recherche = '';

$etudiants = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['recherche'])) {

    $recherche = $_GET['recherche'];

    $sql = "SELECT 
                etudiants.id,
                etudiants.nom,
                etudiants.prenom,
                etudiants.age,
                filieres.nom AS filiere
            FROM etudiants
            JOIN filieres
                ON etudiants.filiere_id = filieres.id
            WHERE etudiants.nom LIKE :recherche
            ORDER BY etudiants.nom ASC";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':recherche' => '%' . $recherche . '%'
    ]);

    $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Recherche étudiant</title>
</head>

<body>

<h1>Rechercher un étudiant</h1>

<form method="GET">

    <input
        type="text"
        name="recherche"
        placeholder="Entrez un nom"
        value="<?= htmlspecialchars($recherche) ?>"
    >

    <button type="submit">Rechercher</button>

</form>

<br>

<?php if ($recherche !== ''): ?>

    <h2>Résultats pour : <?= htmlspecialchars($recherche) ?></h2>

    <?php if (count($etudiants) > 0): ?>

        <table border="1">

            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Âge</th>
                <th>Filière</th>
            </tr>

            <?php foreach ($etudiants as $etudiant): ?>

                <tr>
                    <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                    <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                    <td><?= htmlspecialchars($etudiant['age']) ?></td>
                    <td><?= htmlspecialchars($etudiant['filiere']) ?></td>
                </tr>

            <?php endforeach; ?>

        </table>

    <?php else: ?>

        <p>Aucun étudiant trouvé.</p>

    <?php endif; ?>

<?php endif; ?>

</body>
</html>