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
    <link rel="stylesheet" href="../css/back_off_description.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
    <a href="back_office.php">back office</a>
    <a href="back_off_projet.php">Mes projets</a>
    <a href="Back_off_langage.php">les languages</a>
    <a href="back_off_contact.php">La messagerie</a>
    <a href="deconnexion.php">deconnexion</a>
    </header>
    <h1>Back office description</h1>

    <section class="ajout">
        <p>ajouter une description</p>
    <?php
    $requete=$db->prepare("SELECT * FROM description");
    $requete->execute();
    $madescription = $requete->fetchAll(PDO::FETCH_ASSOC);

    if ($_POST){ // quelqu'un a appuyée sur le bouton du formulaire
        if(isset($_POST["ma_description"]) && !empty($_POST["ma_description"]) && isset($_POST['etat']) && !empty(['etat'])){

            $ma_description = strip_tags($_POST["ma_description"]);
            $etat = strip_tags($_POST['etat']);


    $requete2=$db->prepare("INSERT INTO description (ma_description,etat) VALUES(:ma_description,:etat)");

    $requete2->bindValue(':ma_description',$ma_description);
    $requete2->bindValue(':etat',$etat);
    $requete2->execute();
    header('location:back_off_description.php');
    }
}
    ?>
    <form class="ajout" method="POST">
        <textarea type="text" name="ma_description" id="ma_description"></textarea>
        <input type="radio" id="visible" name="etat" value= 1  >
        <label for="etat">visible</label>
        <input type="radio" id="invisible" name="etat" value= 0  >
        <label for="etat">invisible</label>
        <button type="submit">ajouter</button>
    </form>
    </section>

    <table class="tableau">
        <thead>
            <th>id</th>
            <th>Description</th>
            <th>etat</th>
        </thead>
        <tbody>
            <?php 
                foreach($madescription as $madesc){
            ?>
                <tr>
                    <td><?= $madesc["id"] ?></td>
                    <td><?= $madesc["ma_description"]?></td>
                    <td><?=$madesc["etat"]?></td>
                    <td><a href="supp_desc.php?id=<?= $madesc["id"] ?>">supprimer</a></td>
                    <td><a href="modif_desc.php?id=<?= $madesc["id"] ?>">modif</a></td>
                </tr>
            <?php }
            ?>
            
        </tbody>
    </table>
</body>
</html>


<?php
    }else header('location: ../index.php');