<?php
$serveur = "localhost";
$login = "root";
$pass = "";

try{
    $connection = new PDO("mysql:host=$serveur;dbname=vihsida", $login, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    echo 'connection à la base de données réussit';
}
catch(PDOException $e){
    echo 'Echec :' .$e->getMessage();
}

/*$dsn = 'mysql:host=localhost;dbname=espace_membre;port=3308;charset=utf8';
$pdo = new PDO($dsn, 'root' , '');
*/
if (isset($_POST['forminscription']))
{
    $pseudo = htmlspecialchars($_POST['nom']);
    $sexe = htmlspecialchars($_POST['sexe']);
    $zone = htmlspecialchars($_POST['ZONE']);
    $aire = htmlspecialchars($_POST['AIRE']);
    $unite = htmlspecialchars($_POST['UNITE']);
    $fonction = htmlspecialchars($_POST['fonction']);
    $mail = htmlspecialchars($_POST['mail']);
    $motdepasse = sha1($_POST['motdepasse']);
    $motdepasse2 = sha1($_POST['motdepasse2']);
    if(!empty($_POST['nom']) AND !empty($_POST['sexe']) AND !empty($_POST['ZONE']) AND !empty($_POST['AIRE']) AND !empty($_POST['UNITE']) AND !empty($_POST['fonction']) AND !empty($_POST['mail']) AND !empty($_POST['motdepasse']) AND !empty($_POST['motdepasse2']))
    {
        

        $pseudolength = strlen($pseudo);
        if($pseudolength <= 255)
        {
            $sexelength = strlen($sexe);
            if($sexe<=10)
            {
                $zonelength = strlen($zone);
                if($zone<=25)
                {
                    $airelength = strlen($aire);
                    if($aire<=25)
                    {
                        $unitelength = strlen($unite);
                        if($unite<=25)
                        {
                            $fonctionlength = strlen($fonction);
                            if($fonction<=25)
                            {    
                                if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                                {
                                    $requete = "SELECT * FROM compte WHERE mail_c= ?";
                                    $reqmail = $connection->prepare($requete);
                                    $reqmail->execute(array($mail));
                                    $mailexist = $reqmail-> rowCount();
                                    if($mailexist == 0)
                                    {

                                    
                                        if($motdepasse==$motdepasse2)
                                        {
                                            $req = "INSERT INTO compte(nom_c, sexe_c, zone_c, aire_c, unite_c, fonction_c, mail_c, pswd_c) VALUES(?,?,?,?,?,?,?,?)";
                                            $insertmbr = $connection->prepare($req);
                                            $insertmbr->execute(array($pseudo, $sexe, $zone, $aire, $unite, $fonction, $mail, $motdepasse));
                                            $erreur = "Votre compte a bien ete cree !";
                                            
                                        }
                                        else
                                        {
                                            $erreur = "Vos deux mots de passe ne correspondent pas";
                                        }
                                    }
                                    else
                                    {
                                        $erreur = "Adresse mail deja utilisee !";
                                    }
                                }
                                else
                                {
                                    $erreur = "Votre adresse mail n'est pas valide";
                                }
                            }
                            else
                            {
                                $erreur = "La fonction n'est pas spécifié";
                            }
                        }
                        else
                        {
                            $erreur = "Veillez choisir votre unité ou structure sanitaire";
                        }
                    }
                    else
                    {
                        $erreur = "Veillez choisir votre aire de santé";
                    }
                }
                else
                {
                    $erreur = "Veillez choisir votre zone de santé";
                }
            }
            else
            {
                $erreur = "Choisissez votre sexe";
            }     
        }
        else
        {
            $erreur = "Votre pseudo ne doit pas depasser 255 caracteres";
        }

    }
    else
    {
        $erreur="Tous les champs doivent etre completer";
        
    }
}
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Inscription</title>
        <link rel="stylesheet" type="text/css" href="inscr.css"/>
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
            
                <form method="POST" action="">
                    <fieldset>
                        <h3><strong class="first">Inscription</strong></h3>
                        <br/>
                        <input type="text" placeholder="Nom d'utilisateur"  name="nom" value="<?php if(isset($pseudo)) { echo $pseudo; }?>"/><br/>                   
                        <table>
                            <tr>
                                <td align="left"><label class="sex"><strong class="second">Sexe :</strong></label></td>    
                                
                                <td align="left"><input type="radio" name="sexe" value="masculin" id="mascullin"  /> <label for="masculin" class="m"><strong class="second">Masculin</strong></label><input type="radio" name="sexe" value="feminin" id="feminin"/> <label for="feminin" class="m1"><strong class="second">Feminin</strong></label></td>
                            </tr>
                            <tr>
                                <td align="left"><label for="ZONE" class="sex"><strong class="second">Zone de santé</strong></label></td>
                                <td align="left">    
                                    <select name="ZONE" id="ZONE">
                                        <option value="AMBA">AMBA</option>
                                        <option value="FUNA">FUNA</option>
                                        <option value="TSHANGU">TSHANGU</option>
                                        <option value="LUKUNGA">LUKUNGA</option>
                                        <option value="KOKOLO">KOKOLO</option>
                                        
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="left"><label for="AIRE" class="sex"><strong class="second">Aire de santé</strong></label></td>
                                <td align="left">    
                                    <select name="AIRE" id="AIRE">
                                        <optgroup label="AMBA">
                                            <option value="INDUSTRIE">INDUSTRIE</option>
                                            <option value="COMMERCE">COMMERCE</option>
                                        </optgroup>
                                        <optgroup label="FUNA">
                                            <option value="KALAMU">KALAMU</option>
                                            <option value="YOLO">YOLO</option>
                                        </optgroup>
                                        <optgroup label="TSHANGU">
                                            <option value="SOEUR">SOEUR</option>
                                            <option value="PRIVE">PRIVE</option>
                                        </optgroup>
                                        <optgroup label="LUKUNGA">
                                            <option value="FLEUVE">FLEUVE</option>
                                            <option value="VILLE">VILLE</option>
                                        </optgroup>
                                        <optgroup label="KOKOLO">
                                            <option value="POLICE">POLICE</option>
                                            <option value="ARME">ARME</option>
                                        </optgroup>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="left"><label for="UNITE" class="sex"><strong class="second">structure de santé</strong></label></td>
                                <td align="left">    
                                    <select name="UNITE" id="UNITE">
                                        <optgroup label="INDUSTRIE">
                                            <option value="BOMOKO">BOMOKO</option>
                                            <option value="LIBIKI">LIBIKI</option>
                                        </optgroup>
                                        <optgroup label="COMMERCE">
                                            <option value="LISEKUA">LISEKUA</option>
                                            <option value="BOSOLO">BOSOLO</option>
                                        </optgroup>
                                        <optgroup label="KALAMU">
                                            <option value="ELIKYA">ELIKYA</option>
                                            <option value="BONDEKO">BONDEKO</option>
                                        </optgroup>
                                        <optgroup label="YOLO">
                                            <option value="AKRAM">AKRAM</option>
                                            <option value="MABANGA">MABANGA</option>
                                        </optgroup>
                                        <optgroup label="SOEUR">
                                            <option value="MISERICORDE">MISERICORDE</option>
                                            <option value="ESPERANCE">ESPERANCE</option>
                                        </optgroup>
                                        <optgroup label="PRIVE">
                                            <option value="CHINOIS">CHINOIS</option>
                                            <option value="TRADI">TRADI</option>
                                        </optgroup>
                                        <optgroup label="FLEUVE">
                                            <option value="NGALIEMA">NGALIEMA</option>
                                            <option value="KINOISE">KINOISE</option>
                                        </optgroup>
                                        <optgroup label="VILLE">
                                            <option value="DIAMANT">DIAMANT</option>
                                            <option value="YEMO">YEMO</option>
                                        </optgroup>
                                        <optgroup label="POLICE">
                                            <option value="CAMP 1">CAMP 1</option>
                                            <option value="CAMP 2">CAMP 2</option>
                                        </optgroup>
                                        <optgroup label="ARME">
                                            <option value="BASE 1">BASE 1</option>
                                            <option value="BASE 2">BASE 2</option>
                                        </optgroup>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="left"><label class="sex"><strong class="second">Fonction :</strong></label></td>   
                                <td><input type="radio" name="fonction" value="infirmier" id="infirmier"  /> <label for="infirmier" class="m"><strong class="second">Infirmier(ère)</strong></label><input type="radio" name="fonction" value="rapporteur" id="rapporteur"/> <label for="rapporteur" class="m1"><strong class="second">Rapporteur</strong></label></td>
                            </tr>
                            <tr>
                                <td align="left"><label for="mail"><strong class="second">Adresse Mail :</strong></label></td>    
                                
                                <td align="left"><input type="email" placeholder="votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; }?>" class="pas"/></td>
                            </tr>
                            
                            <tr>
                                <td align="left"><label for="motdepasse"><strong class="second">Mot de passe :</strong></label></td>    
                                
                                <td align="left"><input type="password" name="motdepasse" placeholder="Votre Mot de passe"/></td>
                            </tr>
                            <tr>
                                <td align="left"><label for="motdepasse2"><strong class="second">Confirmé votre Mot de passe :</strong></label></td>    
                                
                                <td align="left"><input type="password" placeholder="Saisissez de nouveau votre mot de passe" id="motdepasse2" name="motdepasse2" class="pas"/></td>
                            </tr>
                        </table>
                        <br/><br/>
                            <input type="submit" name="forminscription" value="Je m'inscris"/>
                    </fieldset>        
                </form>
                <?php

                if(isset($erreur))
                {
                    echo '<font color="red">'.$erreur."</font>";  
                }
                ?>
            </section>
            
        </div>
        <br/>
    </body>

</html>