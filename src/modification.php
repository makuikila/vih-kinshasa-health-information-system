<?php
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
$_SESSION=array();
if(isset($_POST['valider']))
{ 
    $number= !empty($_POST['id_patient']) ? $_POST['id_patient'] : NULL;
    $text= htmlspecialchars($_POST['nom_patient']);
    if(!empty($number) AND !empty($text))
    {
        $requete = 'SELECT * FROM fiche WHERE id_f = ? AND nom_p = ?'; 
        $requser = $connection->prepare($requete);
        $requser->execute(array($number, $text));
        $use= $requser->fetch();
        session_start();
        $_SESSION['id_f']=$use['id_f'];
        $userexist = $requser->rowCount();
        
        if($userexist == 1)
        { 
            header("Location: fichemod.php");
        }
        else
        {
            $erreur = "Veillez saisir des informations valident";
        }
    }
    else
    {
        $erreur = "Veillez completer tous les champs";
    }
}
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Modification</title>
        <link rel="stylesheet" type="text/css" href="modification.css" />
    </head>
    <body>
        <p class="bouton">

            <div align=right>
                <ul id="menu-demo3">
                    <li><strong><a href="http://localhost/project/infirmier.php">Retour</a></strong>
                        
                    </li>

                </ul>
            </div>
        </p>
        
        <div align="center">
            <section class="insc">
                <h3><strong class="first">Connexion</strong></h3>
                <br/><br/>
                <form method="POST" action="fichemod.php">
                    <input type="number" name="id_patient" placeholder="Id du patient"/><br/>
                    <input type="text" name="nom_patient" placeholder="Nom du patient"/><br/>
                    <input type="submit" name="valider" value="Valider"/> 
                </form>
                <?php
                if(isset($erreur))
                {
                    echo '<font color="red">'.$erreur."</font>";  
                }
                ?>
            </section>

            <br/><br/><br/><br/>
            
            
            
        </div>
    </body>

</html>