<?php
session_start();

// Vérifier si le prénom est déjà stocké dans un cookie
if (isset($_COOKIE['prenom'])) {
    $prenom = $_COOKIE['prenom'];
    echo "Bonjour $prenom !";
    echo "<br>";
    echo '<form method="POST" action="">';
    echo '<input type="submit" name="deco" value="Déconnexion">';
    echo '</form>';

    // Vérifier si le bouton "Déconnexion" est soumis
    if (isset($_POST['deco'])) {
        // Supprimer le cookie
        setcookie('prenom', '', time() - 3600);
        // Rediriger vers la page actuelle pour actualiser l'affichage
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }

} else {
    // Vérifier si le formulaire de connexion est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connexion'])) {
        $prenom = $_POST['prenom'];

        // Stocker le prénom dans un cookie pendant 1 heure
        setcookie('prenom', $prenom, time() + 3600);

        // Rediriger vers la page actuelle pour actualiser l'affichage
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }

    // Afficher le formulaire de connexion
    echo '<form method="POST" action="">';
    echo '<label for="prenom">Prénom :</label>';
    echo '<input type="text" name="prenom" id="prenom" required>';
    echo '<input type="submit" name="connexion" value="Connexion">';
    echo '</form>';
}
?>
