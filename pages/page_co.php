<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page de connexion</title>
</head>
<body>
    <div class="login-form">
        <?php
         if(isset($_GET['login_err'])){

            $err =htmlspecialchars($_GET['login_err']);

            switch($err){

                case 'password':
                    ?>
                    <div class="alert alert-danger">
                       <strong>Erreur</strong> mot de passe incorrect
                    </div>
                    <?php
                    break;
                    case 'pseudo':
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> pseudo incorrect
                        </div>
                        <?php
                    break;
                    case 'already':
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> compte non existant
                        </div>
                        <?php
                    break;

            }

         }
         ?>
        <form action="connexion.php" method="POST">
            <h2 class="text_center">connexion</h2>
            <div class="form_group">
                <input type="text" name="pseudo" class="form_control" placeholder="pseudo" required="required" autocomplete="off">
            </div>
            <div class="form_group">
                <input type="text" name="password" class="form_control" placeholder="mot de passe" required="required" autocomplete="off">
            </div>
            <div class="form_group">
                <button type="submit" class="bouton_co">connexion</button>
            </div>
        </form>
      <!--  <p class="text-center"><a href="inscription.php">inscription</a></p> -->

    </div>
    
</body>
</html>