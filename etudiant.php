<?php

require_once "connexion.php";

$nom = $_GET["nom"];

$sql = "SELECT *
        FROM etudiants
        WHERE nom LIKE :nom";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":nom" => "%" . $nom . "%"
]);

$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($etudiants as $etudiant) {
    echo $etudiant["nom"] . " ";
    echo $etudiant["prenom"] . "<br>";
}

?>