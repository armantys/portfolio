<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/page_co.css">
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
                <input type="password" name="password" id="motdepasse" class="form_control" placeholder="mot de passe" required="required" autocomplete="off">
            </div>
            <input type="checkbox" onclick="Afficher()">
            <div class="form_group">
                <button type="submit" class="bouton_co">connexion</button>
            </div>
            <a href="../index.php">retour a l'index</a>
        </form>

    </div>
    <script>
function Afficher()
{ 
var input = document.getElementById("motdepasse"); 
if (input.type === "password")
{ 
input.type = "text"; 
} 
else
{ 
input.type = "password"; 
} 
} 
</script>
    
</body>
</html>