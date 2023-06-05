<?php
// Vérifier si le cookie "nbvisites" existe
if (isset($_COOKIE['nbvisites'])) {
    // Si le cookie existe, récupérer sa valeur et l'incrémenter
    $nbVisites = $_COOKIE['nbvisites'] + 1;
} else {
    // Si le cookie n'existe pas, initialiser le compteur à 1
    $nbVisites = 1;
}

// Définir le cookie avec la nouvelle valeur
setcookie('nbvisites', $nbVisites, time() + (86400 * 30), '/'); // Expire dans 30 jours

// Afficher le contenu du cookie
echo "Nombre de visites : " . $nbVisites;

// Réinitialiser le compteur en supprimant le cookie
if (isset($_POST['reset'])) {
    setcookie('nbvisites', '', time() - 3600, '/'); // Supprimer le cookie en définissant une date d'expiration passée
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
