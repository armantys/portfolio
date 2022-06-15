<?php

    if(isset($_GET["id"]) && !empty($_GET["id"])){
        require_once("config.php");

        $id=strip_tags($_GET["id"]);

        $requete="DELETE FROM langage WHERE id=:id";

        $envoie=$db->prepare($requete);

        $envoie->bindValue(":id", $id, PDO::PARAM_INT);

        $envoie->execute();
     
       header('location:back_off_langage.php');
    }