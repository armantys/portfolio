<?php

$servername = "localhost";
$bdd = "portfolio";
$username = "root";
$mdp = "";

try{
    $db = new PDO("mysql:host=$servername;dbname=$bdd;charset=utf8",$username,$mdp);

    $db-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "erreur de connexion de la base de donnée :" . $e->getMessage();
}

?>