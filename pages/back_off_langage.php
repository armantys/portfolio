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
    <link rel="stylesheet" href="../css/back_off_projet.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>back_office langage</title>
</head>
<body>
    <header>
    <a href="back_office.php">back office</a>
    <a href="back_off_description.php">description</a>
    <a href="Back_off_projet.php">les projet</a>
    <a href="back_off_contact.php">La messagerie</a>
    <a href="deconnexion.php">deconnexion</a>
    </header>
    <h1>Back office langage</h1>

    <section class="ajout">
    <?php
    $requete=$db->prepare("SELECT * FROM langage");
    $requete->execute();
    $projets = $requete->fetchAll(PDO::FETCH_ASSOC);

    if ($_POST){ // quelqu'un a appuyée sur le bouton du formulaire
        if( !empty(['nom'])  && !empty($_POST["img1"])  && !empty($_POST["img2"]) && isset($_POST["etat"])
          
){
        
         
         
           
            $nom = strip_tags($_POST['nom']);
            $img1 = strip_tags($_POST["img1"]);
            $img2 = strip_tags($_POST['img2']);
            $etat = strip_tags($_POST['etat']);


    $requete2=$db->prepare("INSERT INTO langage (nom,img1,img2,etat) 
                            VALUES(:nom,:img1,:img2,:etat)");

    $requete2->bindValue(':nom',$nom);
    $requete2->bindValue(':img1',$img1);
    $requete2->bindValue(':img2',$img2);
    $requete2->bindValue(':etat',$etat);
    $requete2->execute();
    header('location:back_off_langage.php');
    }
}
    ?>
    <form class="ajout" method="POST">
        <label class="nom_desc"  for="nom">nom du langage</label>
        <input class="nom" type="text" name="nom" id="nom">
        <div class="file">
        <label for="img1">img1</label>
        <input type="file" name="img1" id="img1">
        <label for="img2">img2</label>
        <input type="file" name="img2" id="img2">
        </div>
        <div>
            <div class="radio">
                <input type="radio" id="visible" name="etat" value= 1  >
                <label for="etat">visible</label>
            </div>
            <div class="radio">
                <input type="radio" id="invisible" name="etat" value= 0  >
                <label for="etat">invisible</label>
            </div>
        </div>
        <button type="submit">ajouter</button>
    </form>
    </section>

    <table class="tableau">
        <thead>
            <th>id</th>
            <th>Nom</th>
            <th class="img" >img1</th>
            <th class="img">img2</th>
            <th>etat</th>
        </thead>
        <tbody>
            <?php 
                foreach($projets as $proj){
            ?>
                <tr>
                    <td><?= $proj["id"] ?></td>
                    <td><?= $proj["nom"]?></td>                
                    <td class="img"><img src="../img/<?= $proj["img1"]?>" alt=""></td>
                    <td class="img"><img src="../img/<?= $proj["img2"]?>" alt=""></td>
                    <td><?=$proj["etat"]?></td>
                    <td><a href="supp_langage.php?id=<?= $proj["id"] ?>">supprimer</a></td>
                    <td><a href="modif_langage.php?id=<?= $proj["id"] ?>">modif</a></td>
                </tr>
            <?php }
            ?>
            
        </tbody>
    </table>
</body>
</html>


<?php
    }else header('location: ../index.php');