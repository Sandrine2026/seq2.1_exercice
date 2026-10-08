<?php

require_once 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $filiere_id = $_POST['filiere_id'];

    $sql = "INSERT INTO etudiants 
            (nom, prenom, age, filiere_id)
            VALUES (:nom, :prenom, :age, :filiere_id)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':age' => $age,
        ':filiere_id' => $filiere_id
    ]);

    header('Location: liste_etudiants.php');
    exit;
}

$filieres = $pdo->query("SELECT * FROM filieres ORDER BY nom")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un étudiant</title>
</head>

<body>

<h1>Ajouter un étudiant</h1>

<form method="POST" action="">

    <label>Nom :</label>
    <input type="text" name="nom" required>

    <br><br>

    <label>Prénom :</label>
    <input type="text" name="prenom" required>

    <br><br>

    <label>Âge :</label>
    <input type="number" name="age" required>

    <br><br>

    <label>Filière :</label>

    <select name="filiere_id" required>

        <option value="">-- Choisir une filière --</option>

        <?php foreach ($filieres as $filiere): ?>

            <option value="<?= htmlspecialchars($filiere['id']) ?>">
                <?= htmlspecialchars($filiere['nom']) ?>
            </option>

        <?php endforeach; ?>

    </select>

    <br><br>

    <button type="submit">Ajouter</button>

</form>

</body>
</html>