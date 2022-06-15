<?php
    session_start();
    require_once 'config.php';

    if (!empty($_SESSION)){
        
    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/back_office.css">
    <link rel="stylesheet" href="../css/font.css">
    <title>back office</title>
</head>
<body>
    <div>
    <h1>Bienvenue sur le back office</h1>
    </div>
    <div class="pseudo_img">
        <img class="blason" src="../img/blason_armantis.png" alt=""></img>
    </div>
    <div class="categorie">
        <a href="back_off_description.php">Ma description</a>
        <a href="back_off_projet.php">Mes projets</a>
        <a href="Back_off_langage.php">les languages</a>
        <a href="back_off_contact.php">La messagerie</a>
        <a href="deconnexion.php">deconnexion</a>
    </div>
</body>
</html>

<?php
    }else header('location: ../index.php');