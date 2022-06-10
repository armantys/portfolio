<?php
    session_start();
    require_once 'config.php';

    if(isset($_POST["pseudo"])&& isset($_POST["password"])) {

        $pseudo = htmlspecialchars($_POST["pseudo"]);
        $password = htmlspecialchars($_POST['password']);

        $check = $db->prepare('SELECT pseudo, password, email FROM utilisateurs WHERE id_user  ');
        $check->execute(array (
            'pseudo' => $pseudo,
            'password' => $password ));
       
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row == 1){

            if($data['pseudo'] == $pseudo){

                $password = hash('sha256', $password);

                if($data['password'] === $password){

                    $_SESSION['user'] = $data['pseudo'];
                    header('location:back_office.php');
                }else header('location:page_co.php?login_err=password');
            }else header('location:page_co.php?login_err=pseudo');
        }else header('location:page_co.php?login_err=already');
    }  else header('location:./../index.php');
       
    


    