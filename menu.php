<nav>
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="profil.php">Profil</a></li>
        <?php
            if(!isset($_SESSION['account'])){
        ?>
        <li><a href="connexion.php">Connexion</a></li>
        <?php
            }
        ?>
        <?php
            if(!isset($_SESSION['account'])){
        ?>
        <li><a href="index.php">Inscription</a></li>
        <?php
            }
        ?>
        <?php
            if(isset($_SESSION['account'])){
        ?>
        <li><a href="deconnexion.php">Déconnexion</a></li>
        <?php
            }
        ?>

    </ul>
</nav>