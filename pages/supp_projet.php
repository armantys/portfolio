<?php

    if(isset($_GET["id"]) && !empty($_GET["id"])){
        require_once("config.php");

        $id_projet=strip_tags($_GET["id"]);

        $requete="DELETE FROM projet WHERE id_projet=:id_projet";

        $envoie=$db->prepare($requete);

        $envoie->bindValue(":id_projet", $id_projet, PDO::PARAM_INT);

        $envoie->execute();
     
       header('location:back_off_projet.php');
    }