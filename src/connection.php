<?php
session_start();
$serveur = "localhost";
$login = "root";
$pass = "";
try{
    $connection = new PDO("mysql:host=$serveur;dbname=vihsida", $login, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
}
catch(PDOException $e){
    echo 'Echec :' .$e->getMessage();
}
if(isset($_POST['formconnect']))
{
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $motdepasseconnect = sha1($_POST['motdepasseconnect']);
    if(!empty($mailconnect) AND !empty($motdepasseconnect))
    {
        $requete = "SELECT * FROM compte WHERE mail_c = ? AND pswd_c = ? "; 
        $requser = $connection->prepare($requete);
        $requser->execute(array($mailconnect, $motdepasseconnect));
        $userexist = $requser->rowCount();
        if($userexist == 1)
        {   
            $requete2 = "SELECT * FROM compte WHERE mail_c = ? AND pswd_c = ? "; 
            $requser2 = $connection->prepare($requete);
            $requser2->execute(array($mailconnect, $motdepasseconnect));
            $userexist2 = $requser2->fetch();
            $_SESSION['id_c'] = $userexist2['id_c'];
            $_SESSION['zone_c'] = $userexist2['zone_c'];
            $_SESSION['aire_c'] = $userexist2['aire_c'];
            $_SESSION['unite_c'] = $userexist2['unite_c'];
            $_SESSION['fonction_c'] = $userexist2['fonction_c'];
            if($_SESSION['fonction_c'] == "infirmier")
            {
                header("Location: infirmier.php");
            }
            else
            {
                header("Location: rapporteur.php");
            }
            
        }
        else
        {
            $erreur = "Mauvais mail ou mot de passe !";
        }
    }
    else
    {
        $erreur = "Tous les champs doivent etre completes";
    }
}
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Connection</title>
        <link rel="stylesheet" type="text/css" href="form5.css" />
    </head>
    <body>
        <p class="bouton">

            <div align=right>
                <ul id="menu-demo3">
                    <li><strong><a href="page 1.html">Accueil</a></strong>
                        
                    </li>

                </ul>
            </div>
        </p>
        
        <div align="center">
            <section class="insc">
                <h3><strong class="first">Connexion</strong></h3>
                <br/><br/>
                <form method="POST" action="">
                    <input type="text" name="mailconnect" placeholder="Votre Nom de compte"/><br/>
                    <input type="password" name="motdepasseconnect" placeholder="Votre Mot de passe"/><br/>
                    
                    <input type="submit" name="formconnect" value="Se connecter" id="button"/>
                </form>
                <?php

                if(isset($erreur))
                {
                    echo '<font color="red">'.$erreur."</font>";  
                }
                ?>
            </section>

            <br/><br/><br/><br/>
            
            <p style="color :  black; font-size: 1.2em;">Pas de compte? Veillez vous inscrire en <strong><a href="http://localhost/project/inscription.php">cliquant ici</a></strong></p>
            
            
        </div>
    </body>

</html>