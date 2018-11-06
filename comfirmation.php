<?php
    if(isset($_GET['key']) && isset($_GET['email'])){

        if(preg_match('#^[0-9a-f]{32}$#', $_GET['key'])){
            try{ // Connexion à la base de donnée
                $bdd = new PDO('mysql:host=localhost;dbname=users;charset=utf8', 'root', '');
            } catch(Exception $e){
                die('Erreur avec la BDD'); // gestion des erreurs
            }
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // gestion des erreurs sql
        }

        $request = $bdd->prepare('SELECT * FROM user WHERE activate_key = ?');
        $request->execute(array(
            $_GET['key']
        ));
        $response = $request->fetch(PDO::FETCH_ASSOC);
        var_dump($response);



    } else {
        header('Location: home.php');
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

</body>
</html>