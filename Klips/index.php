<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klips</title>
    <script src="js/main.js" defer></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <?php
    session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=klips', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    //var_dump($bdd) 
    if (!isset($_SESSION['pseudo'])) {
        header("Location: signin.php");
        exit;
    }
    ?>
    <?php $date = date('m/d/Y h:i:s a', time());?>
</head>

<body>

    <button class="float-bnt" onclick="openPopup(), audio.play();" >
        <i class="fa-solid fa-plus"></i>
    </button>
    <button class="up-bnt" onclick="audio.play();" >
        <i class="fa-sharp fa-solid fa-up-long"></i>
    </button>

    <nav class="navbar">
        <a href="index.php" class="logo">KLIPS</a>
        <div class="nav-links">
            <ul>
                <li><a href="index.php"><i class="fa-solid fa-house"></i></a></li>
                <li><a href="profil.php" ><i class="fa-solid fa-user"></i></a></li>
                <li><a href="deco.php" ><i class="fa fa-sign-in"></i></a></li> 
            </ul>
        </div>
        <div class="bars"><i class="fa-solid fa-bars"></i></div>
    </nav>

    <div class="container">

        <div class="popupsup" id="popupsup">
            <h1>Are you sure you want to delete your post ?</h1>
            <div class="supbottom">
                <?php
                    if (isset($_GET['post_id'])) { ?>
                        <a class="yes" href="delete.php?id=<?php echo $_GET['post_id']; ?>">YES</a>
                <?php
                    }
                ?>
                <a class="yes">YES</a>
                <button class="no">NO</button>
            </div>
        </div>
        <div class="main">
        
            
            <div class="tag">
                <label for="jeux">TAGS</label>

                <select name="jeux" id="jeux">
                        <option selected disabled> Choisis un jeu !</option>
                        <option value="Valorant">Valorant</option>
                        <option value="Overwatch">Overwatch</option>
                        <option value="Csgo">Csgo</option>
                        <option value="Apex">Apex</option>
                        <option value="LoL">LoL</option>
                        <option value="RL">RL</option>
                        <option value="StarCraft">StarCraft</option>
                        <option value="Dota 2">Dota 2</option>
                        <option value="Quake Live">Quake Live</option>
                        <option value="Street Fighter V">Street Fighter V</option>
                    

                </select>

            </div>
            <div class="zone-post">
                <div class="post">

                    <?php

                    if(isset($_FILES['file'])) {


                        $image= $_FILES['file']['name'];
                        $upload = "img/".$image;


                        $imgsize= $_FILES['file']['size'];
                        $maxsize = 2000000;

                        if ($imgsize > $maxsize){
                            ?><h4><?php echo "Votre fichier ne doit pas dépasser les 2 MO."?></h4><?php
                            echo "";
                        } else {
                            move_uploaded_file($_FILES['file']['tmp_name'], $upload);

                            if ($_POST) {
                                $bdd->exec("INSERT INTO post (message,date,tag,pseudo,src) VALUES ('$_POST[message]',NOW(),'$_POST[tag]','$_SESSION[pseudo]','$image')");
                                header('Location: index.php');
                            }
        
                        }

                        
                    }  elseif ($_POST) {
                        $bdd->exec("INSERT INTO post (message,date,tag,pseudo) VALUES ('$_POST[message]',NOW(),'$_POST[tag]','$_SESSION[pseudo]')");
                        header('Location: index.php');
                    }       
                            
                        $r = $bdd->query('SELECT * FROM post ORDER BY date DESC');
                        
                            foreach($r as $message) : ?>

                            <article class="postall <?php echo $message['tag']; ?> ">
                                <div class="post-top">
                                    <h4><?php echo $message['pseudo']?></h4>
                                    <p><?php echo $message['date']; ?></p>
                                    <p class="tagpost"><?php echo $message['tag'] ?></p>
                                    
                                    <?php if ($message['pseudo'] === $_SESSION['pseudo']) { ?>
                                        <form class="formget" method='GET'>
                                            <input type="hidden" name="post_id" value="<?php echo  $message['id_post']?>">
                                            <button type='button' class='sup'><i class="fa-solid fa-trash-can" id='message-<?php echo $message['id_post']; ?>'></i></button>
                                        </form>
                                    <?php }?>
                                        
                                    
                                </div>
                                <div class="post-desc">
                                    <p><?php echo $message['message']; ?></p>
                                </div>
                                
                                <div class="post-video">
                                    <?php if($message['src'] != '') : ?>
                                        <img alt="image de publication" class="imgpost" src="img/<?php echo $message['src']; ?>">
                                    <?php endif; ?>
                                </div>
                               
                            </article>
                            
                        <?php endforeach; ?>

                    
                    

                </div>
            </div>

        </div>
        <div class="popup" id="popup">

            <button class="wip" onclick="closePopup(), audio.play();"><i class="fa-solid fa-xmark"></i></button>
            <form autocomplete="off" method="post" enctype="multipart/form-data">         
                <input type="text" name="message" placeholder="klipez ..">
                
                <div class="tag">
                    <label for="jeux">TAGS</label>

                    <select name="tag" >
                        <option selected disabled> Choisis un jeu !</option>
                        <option value="Valorant">Valorant</option>
                        <option value="Overwatch">Overwatch</option>
                        <option value="Csgo">Csgo</option>
                        <option value="Apex">Apex</option>
                        <option value="LoL">LoL</option>
                        <option value="RL">RL</option>
                        <option value="StarCraft">StarCraft</option>
                        <option value="Dota 2">Dota 2</option>
                        <option value="Quake Live">Quake Live</option>
                        <option value="Street Fighter V">Street Fighter V</option>
                        

                    </select>

                </div>

                <div class="popup-bottom">
                    <label class="file">
                        <i class="fa-solid fa-upload"></i>
                        <input type="file" name="file">
                        
                    </label>
                    <input type="submit" name="post" class="klipez" onclick="audio.play();" value="Klipez">
                </div>

                
            </form>
        </div>
    </div>
    <?php
                    
    ?>
    <footer>
            <a href="">Terms of Service</a>
            <a href="">Privacy Policy</a>
            <a href="">Cookie Policy</a>
            <a href="">Accessibility</a>
            <a href="">Accessibility</a>
            <a href="">More</a>
            <p> © 2023 Klips, Inc.</p>

    </footer>

    
    
</body>
</html>