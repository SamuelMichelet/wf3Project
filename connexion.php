<?php

session_start();

if(isset($_POST['email']) && isset($_POST['password'])){
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Email invalide';
    }

    if(!preg_match('#^.{3,300}$#', $_POST['password'])){
        $errors[] = 'Mot de passe, Invalide';
    }

    if(!isset($errors)){
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=users;charset=utf8', 'root', '');
        } catch(Exception $e){
            die('Erreur avec la BDD');
        }

        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $request = $bdd->prepare('SELECT * FROM user WHERE email = ?');
        $request->execute(array(
            $_POST['email']
        ));
        $userInfos = $request->fetch(PDO::FETCH_ASSOC);

        if(!empty($userInfos)){
            if(password_verify($_POST['password'], $userInfos['password'])){
                $_SESSION["account"] = $userInfos;
                $success = 'Vous êtes connecté';
            } else {
                $errors[] = 'Mot de passe Incorrect';
            }
        } else {
            $errors[] = 'Adresse mail inconnue';
        }
    }
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
    <?php
        require 'menu.php';
    ?>
    <form action="connexion.php" method="POST">
        <label for="email">E-mail</label>
        <input type="text" name="email">
        <label for="password">Password</label>
        <input type="text" name="password">
        <input type="submit" value="Connexion">
    </form>

<?php
if(isset($errors)){
    foreach($errors as $error){
        echo '<p>' . $error . '</p>';
    }
} else {
    if(isset($success)){
        echo $success;
    }
}
?>
</body>
</html>