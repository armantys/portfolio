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
    <title>back_office projet</title>
</head>
<body>
    <header>
    <a href="back_office.php">back office</a>
    <a href="back_off_description.php">description</a>
    <a href="Back_off_langage.php">les languages</a>
    <a href="back_off_contact.php">La messagerie</a>
    <a href="deconnexion.php">deconnexion</a>
    </header>
    <h1>Back office projet</h1>

    <section class="ajout">
    <?php
    $requete=$db->prepare("SELECT * FROM projet");
    $requete->execute();
    $projets = $requete->fetchAll(PDO::FETCH_ASSOC);

    if ($_POST){ // quelqu'un a appuyée sur le bouton du formulaire
        if( !empty(['nom_projet'])  && !empty($_POST["img_projet"])  && !empty($_POST["img_projet2"]) 
         && !empty($_POST["img_projet3"])  && !empty($_POST["img_projet4"])  && !empty($_POST["description_projet"])  && isset($_POST["etat"])
){
        
         
         
           
            $nom_projet = strip_tags($_POST['nom_projet']);
            $img_projet = strip_tags($_POST["img_projet"]);
            $img_projet2 = strip_tags($_POST['img_projet2']);
            $img_projet3 = strip_tags($_POST["img_projet3"]);
            $img_projet4 = strip_tags($_POST['img_projet4']);
            $description_projet = strip_tags($_POST["description_projet"]);
            $etat = strip_tags($_POST['etat']);


    $requete2=$db->prepare("INSERT INTO projet (nom_projet,img_projet,img_projet2,img_projet3,img_projet4,description_projet,etat) 
                            VALUES(:nom_projet,:img_projet,:img_projet2,:img_projet3,:img_projet4,:description_projet,:etat)");

    $requete2->bindValue(':nom_projet',$nom_projet);
    $requete2->bindValue(':img_projet',$img_projet);
    $requete2->bindValue(':img_projet2',$img_projet2);
    $requete2->bindValue(':img_projet3',$img_projet3);
    $requete2->bindValue(':img_projet4',$img_projet4);
    $requete2->bindValue(':description_projet',$description_projet);
    $requete2->bindValue(':etat',$etat);
    $requete2->execute();
    header('location:back_off_projet.php');
    }
}
    ?>
    <form class="ajout" method="POST">
        <label class="nom_desc"  for="nom_projet">nom du projet</label>
        <input class="nom_projet" type="text" name="nom_projet" id="nom_projet">
        <label class="nom_desc" for="description_projet">description du projet</label>
        <textarea type="text" name="description_projet" id="description_projet"></textarea>
        <div class="file">
        <label for="img_projet">img1</label>
        <input type="file" name="img_projet" id="img_projet">
        <label for="img_projet2">img2</label>
        <input type="file" name="img_projet2" id="img_projet2">
        <label for="img_projet3">img3</label>
        <input type="file" name="img_projet3" id="img_projet3">
        <label for="img_projet4">img4</label>
        <input type="file" name="img_projet4" id="img_projet4">
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
            <th class="img">img1</th>
            <th class="img">img2</th>
            <th class="img">img3</th>
            <th class="img">img4</th>
            <th>Description</th>
            <th>etat</th>
        </thead>
        <tbody>
            <?php 
                foreach($projets as $proj){
            ?>
                <tr>
                    <td><?= $proj["id_projet"] ?></td>
                    <td><?= $proj["nom_projet"]?></td>                
                    <td class="img"><img src="../img/<?= $proj["img_projet"]?>" alt=""></td>
                    <td class="img"><img src="../img/<?= $proj["img_projet2"]?>" alt=""></td>
                    <td class="img"><img src="../img/<?= $proj["img_projet3"]?>" alt=""></td>
                    <td class="img"><img src="../img/<?= $proj["img_projet4"]?>" alt=""></td>
                    <td><?=$proj["description_projet"]?></td>
                    <td><?=$proj["etat"]?></td>
                    <td><a href="supp_projet.php?id=<?= $proj["id_projet"] ?>">supprimer</a></td>
                    <td><a href="modif_projet.php?id=<?= $proj["id_projet"] ?>">modif</a></td>
                </tr>
            <?php }
            ?>
            
        </tbody>
    </table>
</body>
</html>


<?php
    }else header('location: ../index.php');