<?php
    session_start();
    require_once("pages/config.php");

    $sql= "SELECT * FROM projet";
   
    $envoie= $db->prepare($sql);
    $envoie->execute();

    $projets=$envoie->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/section1.css">
    <link rel="stylesheet" href="css/section2.css">
    <link rel="stylesheet" href="css/section3.css">
    <link rel="stylesheet" href="css/section4.css">
    <link rel="stylesheet" href="css/section5.css">
    <link rel="stylesheet" href="css/carousel.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/font.css">
    <title>Portfolio Ludovic Souquet</title>
</head>
<header>
<nav class="navbar">
      <div class="navbar-container container">
          <input type="checkbox" name="" id="">
          <div class="hamburger-lines">
              <span class="line line1"></span>
              <span class="line line2"></span>
              <span class="line line3"></span>
          </div>
          <ul class="menu-items">
              <li><a href="#section2"> A propos</a></li>
              <li><a href="#section3">Projet</a></li>
              <li><a href="#section4">Langage</a></li>
              <li><a href="#section5">Me contacter</a></li>
              <li> <a href="pages/page_co.php"> connexion</a></li>
          </ul>
          
      </div>
</nav>
</header>
<body>
    <section id="section_1" class="section_1">
        <img class="logo" src="./img/logo_kitsune.png" alt="logo_portfolio">
        <h1 class="nom_moi">souquet ludovic</h1>
        <div class= "full">
        <p class="devweb">Developpeur Web </p>
        <p class="devweb">Full Stack</p>
        </div>
    </section>
    <section id="section2" class="section2">
        <div class="moi">
            <?php
            echo "<h2>A propos de moi</h2>";
            $requete= $db->prepare("SELECT * FROM description WHERE id");
            $requete->execute();
            
            $description=$requete->fetchAll(PDO::FETCH_ASSOC);
            foreach ($description as $desc){
                if($desc['etat'] == 1){
            ?>
            <p class="description_moi"> <?= $desc['ma_description'] ?></br>
        
           <?php } 
            }?>
            </p>
            <p class="cv">n'h??sitez pas a visualiser <a target="blank" href="./CV Ludovic SOUQUET.pdf" data-insertor-exclude="1">mon CV</a></p>
        </div>
    </section>
    <section id="section3" class="section3">

    <?php
            
        foreach($projets as $proj){
            if($proj["etat"] == 1){
        echo    '<div class="jadoo">
                    <p class="les_projets">'.$proj['nom_projet'].'</p>
                 <button id = "btn-'.$proj['id_projet'].'" class="bouton"'.$proj['id_projet'].'>  <img id="projet" class"img_demo"   src="./img/'.$proj['img_projet'].'" alt="'.$proj['nom_projet'].'"></button>
                </div>
                <!-- The Modal -->
                <div id="myModal-'.$proj['id_projet'].'" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <ul class="gallery">
                        <li><img class="img_modal" src="./img/'.$proj['img_projet'].'" ></li>
                        <li><img class="img_modal" src="./img/'.$proj['img_projet2'].'"></li>
                        <li><img class="img_modal" src="./img/'.$proj['img_projet3'].'" ></li>
                        <li><img class="img_modal" src="./img/'.$proj['img_projet4'].'" ></li>
                        <p class="description_projet">'.$proj['description_projet'].'</p>
                    </ul>
                </div>

                </div>  '; ?>
        
        <?php    
        }
       }
       $requete= $db->prepare("SELECT * FROM langage WHERE id");
            $requete->execute();

            $langage=$requete->fetchAll(PDO::FETCH_ASSOC);
            echo "</section>"; 
            echo '<section id="section4" class="section4">';
            foreach ($langage as $lang){
                if($lang['etat'] == 1){
        ?>
  
    
        <div class="les_langage">
            <h3><?= $lang["nom"]?></h3>
            <img id=<?= $lang["id"]?> class=<?= $lang["nom"]?> src=<?="./img/".$lang["img1"] ?> alt="logo langage">
         <?php   if (!empty($lang["img2"])){ ?>
            <img id=<?= $lang["id"]?> class=<?= $lang["nom"]?> src=<?="./img/".$lang["img2"] ?> alt="logo langage">
         <?php   }?>
        </div>
    
<?php
    }
}
 echo "</section>";

if ($_POST){ // quelqu'un a appuy??e sur le bouton du formulaire
    if(isset($_POST["nom"]) && !empty($_POST["nom"]) // si le champs sont bien rempli
        && isset($_POST["prenom"]) && !empty($_POST["prenom"]) && isset($_POST["email"]) && !empty($_POST["email"])
        && isset($_POST["telephone"]) && !empty($_POST["telephone"]) && isset($_POST["objet"]) && !empty($_POST["objet"])
        && isset($_POST["message"]) && !empty($_POST["message"])
    ){
        $nom = strip_tags($_POST["nom"]);
        $prenom = strip_tags($_POST["prenom"]);
        $email = strip_tags($_POST["email"]);
        $tel = strip_tags($_POST["telephone"]);
        $objet = strip_tags($_POST["objet"]);
        $message = strip_tags($_POST["message"]);

        $requete = "INSERT INTO contact (nom,prenom,email,telephone,objet,message) VALUES (:nom,:prenom,:email,:telephone,:objet,:message)";

        $envoie = $db->prepare($requete);

        $envoie->bindValue(":nom",$nom);
        $envoie->bindValue(":prenom",$prenom);
        $envoie->bindValue(":email",$email);
        $envoie->bindValue(":telephone",$tel);
        $envoie->bindValue(":objet",$objet);
        $envoie->bindValue(":message",$message);

        $envoie->execute();
       
      
    };

} 

?>

    

    <section id="section5" class="section5">
        <div class="form1">  
            <form class="formulaire" method="POST">

             <p>Formulaire de contct</p>
                <div class="nom_prenom">
                    <div class="nom">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" required>
                    </div>
                    <div class="prenom">
                        <label for="prenom">Prenom</label>
                        <input type="text" name="prenom" id="prenom">
                    </div>
                </div>
                <div class="mail_tel">
                    <div class="mail">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div class="tel">
                        <label for="telephone">Telephone</label>
                        <input type="tel" name="telephone" id="telephone" pattern="[0-9]{10}">
                        
                    </div>    
                </div>
                <div class="obj">
                <label for="objet">Objet</label>
                <input class="text_obj" type="text" name="objet" id="objet">
                </div>
                <div class="mess">
                <label for="message">Message</label>
                <textarea class="text_mess" type="text" minlength="2" maxlength="500" name="message" id="message"></textarea>
                </div>
                <button type="submit">envoyer</button>
            </form>

            <div class="contact_moi">
            </div>
        </div> 
    </section>
    <footer>
        <div class="footer">
            <p> copyright 2022 - tous droit reserv??s </p>
            <p><a onclick="alert('mention l??gale')">mentions l??gales - RGPD</a></p>
            <div class="logo_nom">
                <img class="logo_footer" src="./img/logo_kitsune.png" alt="logo_footer">
                <p>Souquet Ludovic</p>
            </div>
        </div>
    </footer>
    <script src="js/index.js" async></script>
    <script src="js/carousel.js" async></script>
</body>
</html>