<?php

    // Vérification
    if(isset($_GET['id']) && isset($_GET['key'])){

        if(!is_int($_GET['id']) || $_GET['id'] < 1){
            $errors[] = 'id invalide';
        }

        if(!preg_match('#^[0-9a-f]{32}$#i', $_GET['key'])){
            $errors[] = 'Clef invalide';
        }

        if(!isset($errors)){
            require 'model.php';
            // $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

            // requête préparée confirmation de compte
            $request = $bdd->prepare('SELECT * FROM user WHERE activate_key = ? AND id = ?');
            $request->execute(array(
                $_GET['key'],
                $_GET['id']
            ));
            $user = $request->fetch(PDO::FETCH_ASSOC);

            if(!empty($user)){
                $success = 'Votre compte est validé';
                $comfirm = $bdd->query('UPDATE user SET  active_account = 1');
            } else {
                $fail = 'Erreur votre compte n\'est pas validé';
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

    // message de succès ou d'échec
        if(isset($success)){
            echo $success;
        } else {
            echo $fail;
        }
    ?>
    <p> Votre compte est désormais actif.</p>
</body>
</html>