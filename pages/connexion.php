<?php
    session_start();
    require_once 'config.php';

    if(isset($_POST["email"])&& isset($_POST["password"])) {

        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST['password']);

        $check = $db->prepare('SELECT pseudo, password, email FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row == 1){

            if(filter_var($email,FILTER_VALIDATE_EMAIL)){

                $password = hash('sha256', $password);

                if($data['password'] === $password){

                    $_SESSION['user'] = $data['pseudo'];
                    header('location:landing.php');
                }

            }else header('location:page_co.php?login_err=email');
        }else header('location:page_co.php?login_err=already');
    }  else header('location:./../index.php');
       
    


    