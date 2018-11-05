<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="profil.php">Profil</a></li>
        <?php
            if(!isset($_SESSION['account'])){
        ?>
        <li><a href="connexion">Connexion</a></li>
        <?php
            }
        ?>
        <?php
            if(!isset($_SESSION['account'])){
        ?>
        <li><a href="inscription">Inscription</a></li>
        <?php
            }
        ?>
        <?php
            if(isset($_SESSION['account'])){
        ?>
        <li><a href="deconnexion">Déconnexion</a></li>
        <?php
            }
        ?>

    </ul>
</nav>