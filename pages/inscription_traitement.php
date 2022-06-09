<?php
    require_once 'config.php';

    if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_retype'])){

        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_retype = htmlspecialchars($_POST['password_retype']);

        $check = $db->prepare('SELECT pseudo, mdp, email FROM admin WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row == 0){

            if(strlen($pseudo) <= 100){
                $pseudo = substr($pseudo,0,255);

                if(strlen($email) <= 100){

                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){

                        if($password == $password_retype){

                            $password = hash('sha256', $password);
                            $ip = $_SERVER['REMOTE_ADDR'];

                            $insert = $db->prepare('INSERT INTO utilisateurs(pseudo, email, password, ip) VALUES(:pseudo, :email, :password, :ip)');
                            $insert->execute(array(
                                'pseudo' => $pseudo,
                                'email' => $email,
                                'password' => $password,
                                'ip' => $ip
                            ));
                                header('location:inscription.php?reg_err=success');
                        }else header('location:inscription.php?reg_err=password');
                    }else header('location:inscription.php?reg_err=email');
                }else header('location: inscription.php?reg_err=email_lenght');  
            }else  header('location: inscription.php?reg_err=pseudo_lenght');
    }else header('location:inscription.php?reg_err=already');
       
    
}