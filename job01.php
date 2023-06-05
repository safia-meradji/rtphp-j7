<?php
session_start();

// Vérifier si la variable de session "nbvisites" existe
if (!isset($_SESSION['nbvisites'])) {
    // Si elle n'existe pas, l'initialiser à 0
    $_SESSION['nbvisites'] = 0;
}

// Incrémenter le compteur à chaque visite
$_SESSION['nbvisites']++;

// Afficher le contenu de la variable de session
echo "Nombre de visites : " . $_SESSION['nbvisites'];

// Réinitialiser le compteur en supprimant la variable de session
if (isset($_POST['reset'])) {
    unset($_SESSION['nbvisites']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Compteur de visites</title>
</head>
<body>
    <form method="POST" action="">
        <input type="submit" name="reset" value="Reset">
    </form>
</body>
</html>
