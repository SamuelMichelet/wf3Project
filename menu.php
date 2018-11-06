<nav>
    <ul>
        <li><a href="#">Home</a></li>
       
        <?php
            if(!isset($_SESSION['account'])){ // Affichage si non-connecté
        ?>
        <li><a href="connexion.php">Connexion</a></li>
        <li><a href="index.php">Inscription</a></li>
        
        <?php
            }else{ // Affichage si connecté
        ?> 
        <li><a href="profil.php">Profil</a></li>
        <li><a href="deconnexion.php">Déconnexion</a></li>
        <?php
            }
        ?>

    </ul>
</nav>