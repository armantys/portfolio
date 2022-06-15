<?php
    session_start();
    require_once("config.php");
    if (!empty($_SESSION)){
        
        if ($_POST){ // quelqu'un a appuyée sur le bouton du formulaire
            if( !empty($_POST['nom'])  && isset($_POST['etat'])
            ){
                
                $id= strip_tags($_GET["id"]);
                $nom = strip_tags($_POST['nom']);
                $etat = strip_tags($_POST['etat']);

                $requete = "UPDATE langage SET nom=:nom, etat=:etat WHERE id=:id";
                
                $envoie = $db->prepare($requete);
                $envoie->bindValue(":id", $id, PDO::PARAM_INT);
                $envoie->bindValue(':etat',$etat, PDO::PARAM_INT);
                $envoie->bindValue(':nom',$nom, PDO::PARAM_STR);
               
                $envoie->execute();


                if(isset($_FILES["img1"]['name'])  && !empty($_FILES["img1"]['name']) && isset($_FILES["img2"]['name'])  && !empty($_FILES["img2"]['name']) 
                ){
                    move_uploaded_file($_FILES["img1"]["tmp_name"], "../img/".$_FILES["img1"]["name"]);
                    move_uploaded_file($_FILES["img2"]["tmp_name"], "../img/".$_FILES["img2"]["name"]);
                   $requete = "UPDATE langage SET img1=:img1, img2=:img2 WHERE id=:id";
                   $envoie = $db->prepare($requete);
                   $envoie->bindValue(':id',$id);
                   $envoie->bindValue(':img1',$img1, PDO::PARAM_STR);
                   $envoie->bindValue(':img2',$img2, PDO::PARAM_STR);
                   $envoie->execute();
                }

                header("Location:back_off_langage.php");
                
            }else{
                echo "vous n'avez pas rempli tous les champs";
            }
        }
        if(isset($_GET["id"]) && !empty($_GET["id"])){
          
            $id=strip_tags($_GET["id"]);

            $requete= "SELECT * FROM langage WHERE id=:id";

            $envoie=$db->prepare($requete);
            $envoie->bindValue(":id", $id, PDO::PARAM_INT);
            $envoie->execute();

            $resultat=$envoie->fetch();

            if($resultat["etat"]== 1 ){
                $visible="checked";
            }else{
                $visible="";
            }
            $invisible=$resultat["etat"]== 0 ?"checked":"";
            
            if(!$resultat){
                header("Location:back_off_langage.php");
            }

        } else{
            header("Location:back_off_langage.php");
        }

    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="../css/modif_langage.css">
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
            <label for="nom">nom du langage</label>
            <input type="text" name="nom" id="nom" value="<?= $resultat["nom"]?>">
            <div class="les_img">
                <div class="les_fichier">
                    <div class="fichier">
                        <img src="../img/<?=$resultat['img1']?>" alt="">
                        <input type="file" name="img1" id="img1" value="<?= $resultat["img1"]?>">
                        </div>
                        <div  class="fichier">
                        <?php if (!empty($resultat["img2"])){ ?>
                        <img src="../img/<?=$resultat['img2']?>" alt="">
                        <input type="file" name="img2" id="img2" value="<?= $resultat["img2"]?>">
                        <?php
                        }else{
                        ?>   
                        <label for="img_projet2">ajouter une image</label>
                        <input type="file" name="img2" id="img2" value="<?= $resultat["img2"]?>">
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <div class="visible">
                <div class="invisible">
                    <input type="radio" id="visible" name="etat" value= 1 <?=$visible?>  >
                    <label for="etat">visible</label>
                </div>
                <div class="invisible">
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