<?php

// session
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        .menu li{
            display:inline;
            margin:3px;
        }
    </style>
</head>
<body>
    <?php
    if(isset($_SESSION['account'])){
     ?>
        
        <h1>Profile de <strong><?= $_SESSION['name'] . ' ' . $_SESSION['firstname']; ?></strong> :</h1>
        <ul>
            <li>Email : <?= $_SESSION['email']; ?></li>
            <li>Date : <?= date('d-m-Y', strtotime($_SESSION['date'])); ?></li>
        </ul>
        <?php
    } else {
        echo '<h1>Connectez vous</h1><p><a href="connexion.php">connexion</a></p>';
    }
    ?>
</body>
</html>