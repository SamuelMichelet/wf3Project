<?php
    
    if(isset($_POST['newMdp'])){

            // Connexion à la BDD
                try{
                    $bdd = new PDO('mysql:host=localhost;dbname=users;charset=utf8', 'root', '');
                } catch(Exception $e){
                    die('Erreur de connexion à la bdd');
                }
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

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
    <form action="changeMdp.php" method="POST">
        <input type="text" name="newMdp" placeholder="nouveau mdp">
        <input type="submit">
    </form>
</body>
</html>