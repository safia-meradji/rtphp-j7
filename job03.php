<?php
session_start();

// Vérifier si la variable de session "prenoms" existe
if (!isset($_SESSION['prenoms'])) {
    $_SESSION['prenoms'] = array();
}

// Ajouter le prénom à la variable de session lors de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['prenom'])) {
        $prenom = $_POST['prenom'];
        $_SESSION['prenoms'][] = $prenom;
    } elseif (isset($_POST['reset'])) {
        unset($_SESSION['prenoms']);
    }
}

// Afficher la liste des prénoms
if (isset($_SESSION['prenoms'])) {
    echo "<ul>";
    foreach ($_SESSION['prenoms'] as $prenom) {
        echo "<li>$prenom</li>";
    }
    echo "</ul>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste de prénoms</title>
</head>
<body>
    <form method="POST" action="">
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required>
        <input type="submit" name="action" value="Ajouter">
        <input type="submit" name="action" value="Reset" onclick="return confirm('Êtes-vous sûr de vouloir réinitialiser la liste des prénoms ?');">
    </form>
</body>
</html>



