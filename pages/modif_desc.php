<?php
    session_start();
    require_once("config.php");
    if (!empty($_SESSION)){

        if ($_POST){ // quelqu'un a appuyée sur le bouton du formulaire
            if( isset($_POST["ma_description"]) && !empty($_POST["ma_description"]) && isset($_POST['etat']) // si le champs sont bien rempli
            ){
                $id= strip_tags($_GET["id"]);
                $description = strip_tags($_POST["ma_description"]);
                $etat = strip_tags($_POST['etat']);


                $requete = "UPDATE description SET  ma_description=:ma_description, etat=:etat WHERE id=:id";
                $envoie = $db->prepare($requete);
                $envoie->bindValue(":id", $id, PDO::PARAM_INT);
                $envoie->bindValue(':etat',$etat, PDO::PARAM_INT);
                $envoie->bindvalue(":ma_description",$description, PDO::PARAM_STR);

                $envoie->execute();

                header("Location:back_off_description.php");
                
            }else{
                echo "vous n'avez pas rempli tous les champs";
            }
        }

        if(isset($_GET["id"]) && !empty($_GET["id"])){
          
            $id=strip_tags($_GET["id"]);

            $requete= "SELECT * FROM description WHERE id=:id";

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
                header("Location:back_off_description.php");
            }

        } else{
            header("Location:back_off_description.php");
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
        
        <form method="POST">
            <label for="description">Description</label>
            <textarea type="text" name="ma_description" id="ma_desciption" ><?= $resultat["ma_description"]?></textarea>
            <input type="radio" id="visible" name="etat" value= 1 <?=$visible?> >
            <label for="etat">visible</label>
            <input type="radio" id="invisible" name="etat" value= 0  <?=$invisible?>>
            <label for="etat">invisible</label>
            <button type="submit">modif</button>
        </form>


    </body>
    </html>
    
<?php
}else header('location: ../index.php');