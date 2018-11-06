<?php

// connexion à la bdd
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=users;charset=utf8', 'root', '');
    } catch(Exception $e){
        die('Erreur de connexion à la bdd');
    }
// $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>