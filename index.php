<?php

session_start();

if(isset($_SESSION['account'])){
    header('Location: profil.php');
}

// Inclusion du fichier contenant la fonction de vérification du captcha
require('recaptcha_valid.php');
require('mailfunction.php');

// Si tous les champs du formulaire sont là
if(isset($_POST['name']) &&
    isset($_POST['firstname']) &&
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['confirmPassword']) &&
    isset($_POST['g-recaptcha-response'])){

    // Bloc de vérification des champs
    if(!preg_match( '#^[a-z]{3,50}$#i', $_POST['name'])){
        $errors[] = 'Nom invalide';
    }

    if(!preg_match('#^[a-z]{3,50}$#i', $_POST['firstname'])){
        $errors[] = 'Prénom invalide';
    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Email invalide';
    }

    if(!preg_match('#^.{3,500}$#', $_POST['password'])){
        $errors[] = 'Password invalide';
    }

    if($_POST['password'] != $_POST['confirmPassword']){
        $errors[] = 'Confirmation password invalide';
    }

    // Vérification que le captcha soit valide
    if(!recaptcha_valid($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR'])){
        $errors[] = 'Recaptcha invalide';
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
            $_POST['email']
        ));

        $account = $verifyIfExist->fetch();

        // Si account est vide, c'est que l'email n'est pas utilisée, sinon erreur
        if(empty($account)){

            // Insertion du nouveau compte en BDD
            $response = $bdd->prepare('INSERT INTO user(email, password, ip, date, name, firstname  ) VALUES(?, ?, ?, ?, ?, ?)');

            $response->execute(array(
                $_POST['email'],
                password_hash($_POST['password'], PASSWORD_BCRYPT),
                $_SERVER['REMOTE_ADDR'],
                date('Y-m-d'),
                $_POST['name'],
                $_POST['firstname']
            ));
            // Si la requête SQL a touchée au moins 1 ligne tout vas bien, sinon erreur
            if($response->rowCount() > 0){
                $success = 'Compte créé !';
            } else {
                $errors[] = 'Problème lors de la création du compte.';
            }

        } else {
            $errors[] = 'Email déjà utilisée';
        }
        //envoie du mail d'activation
 
        // Récupération des variables nécessaires au mail de confirmation	
        $email = $_POST['email'];
        $login = $_POST['password'];
        
        // Génération aléatoire d'une clé a amaliorer
        $key = md5(rand().time().uniqid());
        
        
        // Insertion de la clé dans la base de données (à adapter en INSERT si besoin)
        $stmt = $bdd->prepare("UPDATE user SET activate_key=:key WHERE email like :login");
        $stmt->bindParam(':key', $key);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        
        
        // Préparation du mail contenant le lien d'activation
        $destinataire = $email;
        $object = "Activer votre compte" ;
        // $entete = "From: inscription@votresite.com" ;
        
        // Le lien d'activation est composé du login(log) et de la clé(key)
        $content = 'Bienvenue sur VotreSite,
        
        Pour activer votre compte, veuillez cliquer sur le lien ci dessous
        ou copier/coller dans votre navigateur internet.
        
        http://wf3Project/comfirmation.php?log='.urlencode($email).'&key='.urlencode($key).'
        
        
        ---------------
        Ceci est un mail automatique, Merci de ne pas y répondre.';
        
        sendMail($destinataire, $content, $object);
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice inscription password hash</title>

    <!-- Ajout du fichier JS de fonctionnement de recaptcha v2 -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<?php
    require 'menu.php';
?>


<?php

// Si success n'existe pas, on affiche le formulaire, sinon on affiche success
if(!isset($success)){

?>
    <form action="index.php" method="POST">
        <input type="text" name="name" placeholder="name">
        <input type="text" name="firstname" placeholder="firstname">
        <input type="text" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <input type="password" name="confirmPassword" placeholder="confirmPassword">
        <!-- insertion champ recaptcha google avec clé publique -->
        <div class="g-recaptcha" data-sitekey="6LfJ8HcUAAAAADSATsaou1zeRq7FnkI4K7XPXoUQ"></div>
        <input type="submit">
    </form>
    <?php
} else {
    echo '<p style="color:green;">' . $success . '</p>';
}

// Si il y a des erreurs, on les affiches
if(isset($errors)){
    foreach($errors as $error){
        echo '<p style="color:red;">' . $error . '</p>';
    }
}
?>

</body>
</html>