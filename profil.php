<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        .menu li{
            display:inline;
            margin:3px;
        }
    </style>
</head>
<body>
    <?php
    // Si il y a des erreurs, on les affiche, sinon on affiche les détails de l'article demandé
    if(isset($errors)){
        foreach($errors as $error){
            echo '<p style="color:red;">'.$error.'</p>';
        }
    } else { ?>
        
        <h1>Détail de l'article <strong><?php echo htmlspecialchars($article['title']); ?></strong> :</h1>
        <ul>
            <li>Contenu : <?php echo htmlspecialchars($article['content']); ?></li>
            <li>Auteur : <?php echo htmlspecialchars($article['author']); ?></li>
            <li>Date : <?php echo htmlspecialchars(date('d m Y', strtotime($article['date']))); ?></li>
        </ul>
        <?php
    }
    ?>
    <p><a href="index.php">Retour à la liste des articles</a></p>
</body>
</html>