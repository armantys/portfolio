<?php
    require_once("pages/connexion.php");

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
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/section1.css">
    <link rel="stylesheet" href="./css/section2.css">
    <link rel="stylesheet" href="./css/section3.css">
    <link rel="stylesheet" href="./css/section4.css">
    <link rel="stylesheet" href="./css/section5.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/font.css">
    <title>Portfolio Ludovic Souquet</title>
</head>
<header>
    <ul>
        <li><a class="lien" href="#section2">A propos</a></li>
        <li ><a class="lien" href="#section3">Projet</a></li>
        <li><a class="lien" href="#section4">langage</a></li>
        <li><a class="lien" href="#section5">Contact</a></li>
    </ul>
</header>
<body>
    <section id="section_1" class="section_1">
        <img class="logo" src="./img/logo_kitsune.png" alt="logo_portfolio">
        <h1>souquet ludovic</h1>
        <p class="devweb">Developpeur Web</p>
    </section>
    <section id="section2" class="section2">
        <div class="moi">
            <h2>A propos de moi</h2>
            <p class="description_moi">hello !! je m'appelle Ludovic Souquet, actuellement en formation </br>
            developpeur web, j'ai déja fais plusieurs catégories de métier qui mon permis </br>
            d'aquérir de l'expérience et des compétence tel que l'organisation </br>
            ou l'autonomie, ayant toujours eu une attirance pour l'informatique et le codage, </br>
            je me suis dirigée vers cette formation qui mélange apprentissage de connaissance et travaille d'équipe. </br>
            la curiosité, l'envie d'avancer et la motivation fond aussi partie de mon vocabulaire. </br>
            n'hésitez pas a me contacter
            </p>
        </div>
    </section>
    <section id="section3" class="section3">

    <?php
        foreach($projets as $proj){
        echo    '<div class="jadoo">
                    <p>'.$proj['nom_projet'].'</p>
                    <img src="./img/'.$proj['img_projet'].'" alt="'.$proj['nom_projet'].'" onclick="page_jeux(event)">
                </div>
                <aside id="modal1" class="modal" aria-hiden="true role="dialog" aria-labelledby="titlemodal" style="display:none;">
                    <div class="modal-wrapper">
                    <h1 id="titlemodal">Hello, little man. I will destroy you!</h1>
                    </div>
                </aside>';
        }
        ?>   
    </section>
    <section id="section4" class="section4">
        <div class="front_end">
            <h3>front-end</h3>
            <img class="les_front" src="./img/logo_ 3_principaux.png" alt="logo html css javascript">
        </div>
        <div class="back_end">
            <h3>back-end</h3>
            <img class="back_end_1" src="./img/logo_php.png" alt="logo php">
            <img class="back_end_2" src="./img/logo_sql.png" alt="logo sql">
        </div>
        <div class="les_cms">
            <h3>les cms</h3>
            <img src="./img/logo_wordpress.png" alt="logo wordpress">
            <img src="./img/logo_bootstrap.png" alt="logo bootstrap">
        </div>
    </section>
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
                        <input type="text" name="email" id="email">
                    </div>
                    <div class="tel">
                        <label for="telephone">Telephone</label>
                        <input type="Num" name="telephone" id="telephone">
                    </div>    
                </div>
                <div class="obj">
                <label for="objet">Objet</label>
                <input class="text_obj" type="text" name="objet" id="objet">
                </div>
                <div class="mess">
                <label for="message">Message</label>
                <input class="text_mess" type="text" name="message" id="message">
                </div>
                <button type="submit">envoyer</button>
            </form>
            <div class="contact_moi">
                <p> l.souquet@live.fr</p>
                <p>06.79.13.91.81</p>
            </div>
        </div> 
    </section>
    <footer>
        <div class="footer">
            <p> copyright 2022 - tous droit reservés</p>
            <p>mentions légales - RGPD</p>
            <div class="logo_nom">
                <img class="logo_footer" src="./img/logo_kitsune.png" alt="logo_footer">
                <p>Souquet Ludovic</p>
            </div>
        </div>
    </footer>
    <script src="js/index.js"></script>
</body>
</html>