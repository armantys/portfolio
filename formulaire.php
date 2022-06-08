<?php

    require_once("connexion.php");

    if ($_POST){ // quelqu'un a appuyée sur le bouton du formulaire
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

            $requete = "INSERT INTO contact (nom,description,email,telephone,objet,message) VALUES (:nom,:description,:email,:telephone,:objet,:message)";

            $envoie = $db->prepare($requete);

            $envoie->bindValue(":nom",$nom);
            $envoie->bindValue(":prenom",$prenom);
            $envoie->bindValue(":email",$email);
            $envoie->bindValue(":telephone",$tel);
            $envoie->bindValue(":objet",$objet);
            $envoie->bindValue(":message",$message);

            $envoie->execute();

            header("Location:index.php");
        };

    }
?>