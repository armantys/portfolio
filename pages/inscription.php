<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page d'inscription'</title>
</head>
<body>
    <div class="login-form">
    <?php
         if(isset($_GET['reg_err'])){

            $err =htmlspecialchars($_GET['reg_err']);

            switch($err){

                case 'success':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Succès</strong> inscription réussi !
                    </div>
                    <?php
                    break;
                    case 'password':
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> mot de passe différent
                        </div>
                        <?php
                    break;
                    case 'email':
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> email non valide
                        </div>
                        <?php
                    break;
                    case 'email_lenght':
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> email trop long
                        </div>
                        <?php
                    break;
                    case 'pseudo_lenght':
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> pseudo trop long
                        </div>
                        <?php
                    break;
                    case 'already':
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> compte deja existant
                        </div>
                        <?php
                    break;

            }

         }
         ?>
        <form action="inscription_traitement.php" method="POST">
            <h2 class="text_center">inscription</h2>
            <div class="form_group">
                <input type="text" name="pseudo" class="form_control" placeholder="pseudo" required="required" autocomplete="off">
            </div>
            <div class="form_group">
                <input type="text" name="email" class="form_control" placeholder="email" required="required" autocomplete="off">
            </div>
            <div class="form_group">
                <input type="text" name="password" class="form_control" placeholder="mot de passe" required="required" autocomplete="off">
            </div>
            <div class="form_group">
                <input type="text" name="password_retype" class="form_control" placeholder="re-tapez le mot de passe" required="required" autocomplete="off">
            </div>
            <div class="form_group">
                <button type="submit" class="bouton_co">inscription</button>
            </div>
        </form>

    </div>
    
</body>
</html>