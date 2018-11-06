<?php

// session
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

    <?php
        require 'menu.php';
    if(isset($_SESSION['account'])){

        
     ?>
        
        <h1>Profil de <strong><?= $_SESSION['account']['name'] . ' ' . $_SESSION['account']['firstname']; ?></strong> :</h1>
        <ul>
            <li>Email : <?= $_SESSION['account']['email']; ?></li>
            <li>Date : <?= date('d-m-Y', strtotime($_SESSION['account']['date'])); ?></li>
        </ul>
        <?php
    } else {
        
        echo '<h1>Connectez vous</h1><p><a href="connexion.php">connexion</a></p>';
    }
    ?>
</body>
</html>