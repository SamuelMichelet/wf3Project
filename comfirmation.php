<?php
    if(isset($_GET['id']) && isset($_GET['key'])){

        if(!is_int($_GET['id']) || $_GET['id'] < 0){
            $errors[] = 'id invalide';
        }

        if(!preg_match('#^[0-9a-f]{32}$#', $_GET['key'])){
            $errors[] = 'Clef invalide';
        }

        if(!isset($errors)){
            try{ // Connexion à la base de donnée
                $bdd = new PDO('mysql:host=localhost;dbname=users;charset=utf8', 'root', '');
            } catch(Exception $e){
                die('Erreur avec la BDD'); // gestion des erreurs
            }
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // gestion des erreurs sql

            $request = $bdd->prepare('SELECT * FROM user WHERE activate_key = ? AND id = ?');
            $request->execute(array(
                $_GET['key'],
                $_GET['id']
            ));
            $user = $request->fetch(PDO::FETCH_ASSOC);

            if(!empty($user)){
                $success = 'Votre compte est validé';
            } else {
                $fail = 'Erreur votre compte n\'est pas validé';
            }

        } else {
            header('Location: home.php');
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
        if(isset($success)){
            echo $success;
        } else {
            echo $fail;
        }
    ?>
    <p> Votre compte est désormais actif.</p>
</body>
</html>