<?php
session_start();

// Initialiser le tableau de jeu
if (!isset($_SESSION['morpion'])) {
    $_SESSION['morpion'] = [
        ['', '', ''],
        ['', '', ''],
        ['', '', '']
    ];
}

// Initialiser le symbole du joueur actuel
if (!isset($_SESSION['turn'])) {
    $_SESSION['turn'] = 'X';
}

// Fonction pour vérifier s'il y a un gagnant
function checkWinner($player)
{
    $morpion = $_SESSION['morpion'];

    // Vérification des lignes
    for ($i = 0; $i < 3; $i++) {
        if ($morpion[$i][0] === $player && $morpion[$i][1] === $player && $morpion[$i][2] === $player) {
            return true;
        }
    }

    // Vérification des colonnes
    for ($i = 0; $i < 3; $i++) {
        if ($morpion[0][$i] === $player && $morpion[1][$i] === $player && $morpion[2][$i] === $player) {
            return true;
        }
    }

    // Vérification des diagonales
    if (($morpion[0][0] === $player && $morpion[1][1] === $player && $morpion[2][2] === $player)
        || ($morpion[0][2] === $player && $morpion[1][1] === $player && $morpion[2][0] === $player)) {
        return true;
    }

    return false;
}

// Vérifier si un bouton a été cliqué
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset'])) {
        // Réinitialiser la partie
        $_SESSION['morpion'] = [
            ['', '', ''],
            ['', '', ''],
            ['', '', '']
        ];
        $_SESSION['turn'] = 'X'; // Réinitialiser le symbole du joueur actuel
    } else if (isset($_POST['cell'])) {
        $cell = explode(',', $_POST['cell']);
        $row = $cell[0];
        $col = $cell[1];

        // Vérifier si la case est vide
        if ($_SESSION['morpion'][$row][$col] === '') {
            // Mettre le symbole du joueur actuel dans la case
            $_SESSION['morpion'][$row][$col] = $_SESSION['turn'];

            // Vérifier si le joueur actuel a gagné
            if (checkWinner($_SESSION['turn'])) {
                echo $_SESSION['turn'] . ' a gagné !';
                // Réinitialiser la partie
                $_SESSION['morpion'] = [
                    ['', '', ''],
                    ['', '', ''],
                    ['', '', '']
                ];
                $_SESSION['turn'] = 'X'; // Réinitialiser le symbole du joueur actuel
            } else {
                // Changer le symbole du joueur actuel
                $_SESSION['turn'] = ($_SESSION['turn'] === 'X') ? 'O' : 'X';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Jeu du Morpion</title>
    <style>
        .morpion-btn {
            width: 100px;
            height: 100px;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <form method="POST">
        <table>
            <?php for ($i = 0; $i < 3; $i++) : ?>
                <tr>
                    <?php for ($j = 0; $j < 3; $j++) : ?>
                        <td>
                            <button type="submit" name="cell" value="<?= $i ?>,<?= $j ?>" class="morpion-btn"><?= $_SESSION['morpion'][$i][$j] ?></button>
                        </td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>
        <button type="submit" name="reset">Réinitialiser la partie</button>
    </form>
</body>
</html>





