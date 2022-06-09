<?php
    session_start();
    if(!isset($_SESSION['user']))
    header('location:./../index.php');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bonjour !!</title>
</head>
<body>
    <h1>bonjour ! <?php echo $_SESSION['user']; ?></h1>
    <a href="deconnexion.php" class="deco">Déconnexion</a>
</body>
</html>