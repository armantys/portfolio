<?php
    session_start();
    require_once("config.php");
    if (!empty($_SESSION)){

        if ($_POST){ // quelqu'un a appuyée sur le bouton du formulaire
            if( !empty($_POST['nom_projet'])  && !empty($_POST["description_projet"]) && isset($_POST['etat'])
            ){
                $id= strip_tags($_GET["id"]);
                $nom_projet = strip_tags($_POST['nom_projet']);
              
                $description_projet = strip_tags($_POST["description_projet"]);
                $etat = strip_tags($_POST['etat']);

                $requete = "UPDATE projet SET nom_projet=:nom_projet, description_projet=:description_projet, etat=:etat WHERE id_projet=:id_projet";
                
                $envoie = $db->prepare($requete);
                $envoie->bindValue(":id_projet", $id, PDO::PARAM_INT);
                $envoie->bindValue(':etat',$etat, PDO::PARAM_INT);
                $envoie->bindvalue(":description_projet",$description_projet, PDO::PARAM_STR);
                $envoie->bindValue(':nom_projet',$nom_projet, PDO::PARAM_STR);
               
                $envoie->execute();


                if(isset($_FILES["img_projet"]['name'])  && !empty($_FILES["img_projet"]['name']) && isset($_FILES["img_projet2"]['name'])  && !empty($_FILES["img_projet2"]['name']) 
                && isset($_FILES["img_projet3"]['name'])  && !empty($_FILES["img_projet3"]['name']) && isset($_FILES["img_projet4"]['name'])  && !empty($_FILES["img_projet4"]['name'])){
                    move_uploaded_file($_FILES["img_projet"]["tmp_name"], "../img/".$_FILES["img_projet"]["name"]);
                    move_uploaded_file($_FILES["img_projet2"]["tmp_name"], "../img/".$_FILES["img_projet2"]["name"]);
                    move_uploaded_file($_FILES["img_projet3"]["tmp_name"], "../img/".$_FILES["img_projet3"]["name"]);
                    move_uploaded_file($_FILES["img_projet4"]["tmp_name"], "../img/".$_FILES["img_projet4"]["name"]);
                   $requete = "UPDATE projet SET img_projet=:img_projet, img_projet2=:img_projet2, img_projet3=:img_projet3, img_projet4=:img_projet4 WHERE id_projet=:id_projet";
                   $envoie = $db->prepare($requete);
                   $envoie->bindValue(':id_projet',$id_projet);
                   $envoie->bindValue(':img_projet',$img_projet, PDO::PARAM_STR);
                   $envoie->bindValue(':img_projet2',$img_projet2, PDO::PARAM_STR);
                   $envoie->bindValue(':img_projet3',$img_projet3, PDO::PARAM_STR);
                   $envoie->bindValue(':img_projet4',$img_projet4, PDO::PARAM_STR);
                   $envoie->execute();
                }

                header("Location:back_off_projet.php");
                
            }else{
                echo "vous n'avez pas rempli tous les champs";
            }
        }

        if(isset($_GET["id"]) && !empty($_GET["id"])){
          
            $id=strip_tags($_GET["id"]);

            $requete= "SELECT * FROM projet WHERE id_projet=:id_projet";

            $envoie=$db->prepare($requete);
            $envoie->bindValue(":id_projet", $id, PDO::PARAM_INT);
            $envoie->execute();

            $resultat=$envoie->fetch();

            if($resultat["etat"]== 1 ){
                $visible="checked";
            }else{
                $visible="";
            }
            $invisible=$resultat["etat"]== 0 ?"checked":"";
            
            if(!$resultat){
                header("Location:back_off_projet.php");
            }

        } else{
            header("Location:back_off_projet.php");
        }

    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="../css/modif_desc.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ajout_php</title>
    </head>
    <body>
        <header>
        <a href="back_off_description.php">Ma description</a>
        <a href="back_off_projet.php">Mes projets</a>
        <a href="Back_off_langage.php">les languages</a>
        <a href="back_off_contact.php">La messagerie</a>
        <a href="deconnexion.php">deconnexion</a>
        </header>
        
        <form class="ajout" method="POST">
        <label for="nom_projet">nom du projet</label>
        <input type="text" name="nom_projet" id="nom_projet" value="<?= $resultat["nom_projet"]?>">
        <label for="description_projet">description du projet</label>
        <textarea type="text" name="description_projet" id="description_projet"><?= $resultat["description_projet"]?></textarea>
        <div class="les_img">
            <div class="les_2">
                <label for="img_projet"><img src="../img/<?= $resultat['img_projet']?>" alt=""></label>
                <input type="file" name="img_projet" id="img_projet" value="<?= $resultat["img_projet"]?>">
            </div>
            <div class="les_2">
                <label for="img_projet2"><img src="../img/<?= $resultat['img_projet2']?>" alt=""></label>
                <input type="file" name="img_projet2" id="img_projet2" value="<?= $resultat["img_projet2"]?>">
            </div>
            <div class="les_2">
                <label for="img_projet3"><img src="../img/<?= $resultat['img_projet3']?>" alt=""></label>
                <input type="file" name="img_projet3" id="img_projet3" value="<?= $resultat["img_projet3"]?>">
            </div>
            <div class="les_2">
                <label for="img_projet4"><img src="../img/<?= $resultat['img_projet4']?>" alt=""></label>
                <input type="file" name="img_projet4" id="img_projet4" value="<?= $resultat["img_projet4"]?>">
            </div>
        </div>
        <div>
            <div>
                <input type="radio" id="visible" name="etat" value= 1 <?=$visible?>  >
                <label for="etat">visible</label>
            </div>
            <div>
                <input type="radio" id="invisible" name="etat" value= 0  <?=$invisible?> >
                <label for="etat">invisible</label>
            </div>
        </div>
        <button type="submit">modif</button>
    </form>
    </body>
    </html>
    
<?php
}else header('location: ../index.php');