<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klips</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/signin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <?php
    session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=klips', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    //var_dump($bdd)
    
    if(isset($_POST['envoi'])) {
        if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])) {

            $pseudo = htmlspecialchars($_POST['pseudo']);
            $mdp = sha1($_POST['mdp']);

            $recupUser = $bdd->prepare('SELECT *  FROM user WHERE pseudo = ? AND mdp = ?');
            $recupUser -> execute(array($pseudo, $mdp));

            if($recupUser->rowCount() > 0) {

                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['mdp'] = $mdp;
                $_SESSION['id'] = $recupUser->fetch()['id'];
                echo $_SESSION['pseudo'];

                header('Location: index.php');
                
            }else{
                ?> <div class="centerform"><h6 class='incr'> <?php echo'Votre mot de passe ou pseudo est incorrect ! '; ?></h6></div><?php
            }



        }else {
            ?> <h6 class='remplir'> <?php echo'Veuillez remplir tous les champs ...  '; ?></h6><?php
        }
        
        
    }

    ?>

</head>
<body>
    <div class="centerform">
        <form method = "post">
            <h3>Connexion</h3>
            <div class="input-group mb-3">
            <input type="text" name ='pseudo' class="form-control " placeholder="Pseudo" aria-label="Username" >
            </div>
            <div class="input-group mb-3">
            <input type="password" name='mdp' class="form-control " placeholder="Password" aria-label="Recipient's username" >
            </div>
            <a href="signup.php">Devenez membre ici !</a> 
    
            <div class="col-12">
            <input class="btn btn-primary" name='envoi' type="submit" value =" Sign-up">
            </div>

            
        </form>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>