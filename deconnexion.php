<?php
session_start();

// vérification
if(!isset($_SESSION['account'])){
    header('Location: connexion.php');
    die();
}

// suppression de la session account
unset($_SESSION['account']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        include 'menu.php';
    ?>

    <p> Vous êtes désormais déconnecté </p>
</body>
</html>