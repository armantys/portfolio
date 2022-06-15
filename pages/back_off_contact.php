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
    <link rel="stylesheet" href="../css/back_off_contact.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>back_office projet</title>
</head>
<body>
    <header>
    <a href="back_office.php">back office</a>
    <a href="back_off_description.php">description</a>
    <a href="Back_off_langage.php">languages</a>
    <a href="back_off_projet.php">projet</a>
    <a href="deconnexion.php">deconnexion</a>
    </header>
    <h1>Back office contact</h1>

    <section class="ajout">
    <?php
    $requete=$db->prepare("SELECT * FROM contact");
    $requete->execute();
    $projets = $requete->fetchAll(PDO::FETCH_ASSOC);


    

    ?>

    <table class="tableau">
        <thead>
            <th>id</th>
            <th>Nom</th>
            <th>prénom</th>
            <th>e-mail</th>
            <th>téléphone</th>
            <th>objet</th>
            <th>message</th>
        </thead>
        <tbody>
            <?php 
                foreach($projets as $proj){
            ?>
                <tr>
                    <td class="autre"><?= $proj["id"] ?></td>
                    <td class="autre"><?= $proj["nom"]?></td>                
                    <td class="autre"><?= $proj["prenom"]?></td>
                    <td class="autre"><?= $proj["email"]?></td>
                    <td class="autre"><?= $proj["telephone"]?></td>
                    <td class="autre"><?= $proj["objet"]?></td>
                    <td class="message"><?=$proj["message"]?></td>
                    <td class="autre"><a href="supp_contact.php?id=<?= $proj["id"] ?>">supprimer</a></td>
                </tr>
            <?php }
            ?>
            
        </tbody>
    </table>
</body>
</html>


<?php
    }else header('location: ../index.php');