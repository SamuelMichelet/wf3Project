<?php
    
    // Vérification
    if(isset($_POST['newMdp'])){

            // Insertion à la BDD
            require 'model.php';
                // $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $newMDP = $bdd->prepare('UPDATE user SET password :mdp');
        $newMDP->bindValue('mdp', $_POST['newMdp']);
    }
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

    <!-- validation du nouveau mdp -->
    <form action="changeMdp.php" method="POST">
        <input type="text" name="newMdp" placeholder="nouveau mdp">
        <input type="submit">
    </form>
</body>
</html>