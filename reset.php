<?php
    session_start();

    require 'mailfunction.php';

    if(isset($_POST['emailReset'])){

        if(!filter_var($_POST['emailReset'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'Email invalide';
        }

        // Si il n'y a pas d'erreurs
        if(!isset($errors)){

        // Connexion à la BDD
            try{
                $bdd = new PDO('mysql:host=localhost;dbname=users;charset=utf8', 'root', '');
            } catch(Exception $e){
                die('Erreur de connexion à la bdd');
            }
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Selection du compte (hypothétique) ayant déjà l'adresse email dans le formulaire
            $verifyIfExist = $bdd->prepare('SELECT * FROM user WHERE email = ?');

            $verifyIfExist->execute(array(
                $_POST['emailReset']
            ));

            $account = $verifyIfExist->fetch();

            if(empty($account)){
                $errors[] = 'compte inconnu';
            }else{
                // Génération aléatoire d'une clé
                $key = md5(rand().time().uniqid());
                $email = $_POST['emailReset'];
                $destinataire =  $_POST['emailReset'];
                $object = "Changer de mot de passe" ;
                $content = 'Pour changer de mot de passe, veuillez cliquer sur le lien ci dessous
ou copier/coller dans votre navigateur internet.
 
http://wf3Project/changeMdp.php?log='.urlencode($email).'&key='.urlencode($key).'
 
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';
                sendMail($destinataire, $content, $object);
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
    <form action="reset.php" method="POST">
        <input type="text" name="emailReset" placeholder="Votre email">
        <input type="submit">
    </form>

    <?php

        if(isset($errors)){
            foreach($errors as $error){
                echo '<p style="color:red;">' . $error . '</p>';
            }
        }
    ?>
</body>
</html>