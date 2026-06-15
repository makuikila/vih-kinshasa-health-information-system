<?php
session_start();
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
if(isset($_GET['id_c']) AND $_GET['id_c'] > 0)
{
    $getid = intval($_GET['id_c']);
    $req='SELECT * FROM compte WHERE id_c=?';
    $requser = $connection->prepare($req);
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
}
    $requete = 'SELECT COUNT(*) From fiche';
    $resultat = $connection->prepare($requete);
    $resultat->execute();
    $numero = $resultat->fetchColumn();
    $numero = $numero+1;
/*$dsn = 'mysql:host=localhost;dbname=espace_membre;port=3308;charset=utf8';
$pdo = new PDO($dsn, 'root' , '');
*/

if (isset($_POST['fiche']))
{
    $nom = htmlspecialchars($_POST['Nom']);
    $post = htmlspecialchars($_POST['Post']);
    $prenom = htmlspecialchars($_POST['Prenom']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $naissance = htmlspecialchars($_POST['naissance']);
    $sexe = htmlspecialchars($_POST['sexe']);
    $categorie = htmlspecialchars($_POST['categorie']);
    $adresse = htmlspecialchars($_POST['Adresse']);
    $etat = htmlspecialchars($_POST['etat']);
    $test = htmlspecialchars($_POST['test']);
    $retrait = htmlspecialchars($_POST['retrait']);
    $positif = htmlspecialchars($_POST['positif']);
    $contact = htmlspecialchars($_POST['contact']);
    $nomcas = htmlspecialchars($_POST['nomcas']);
    $agecas = htmlspecialchars($_POST['agecas']);
    $sexecas = htmlspecialchars($_POST['sexecas']);
    $positifcas = htmlspecialchars($_POST['positifcas']);
    $retraitcas = htmlspecialchars($_POST['retraitcas']);
    $arvcas = htmlspecialchars($_POST['arvcas']);
    $enceinte = htmlspecialchars($_POST['enceinte']);
    $phase = !empty($_POST['phase']) ? $_POST['phase'] : NULL;
    $enfant = htmlspecialchars($_POST['enfant']);
    $arv = htmlspecialchars($_POST['arv']);
    $frequence = htmlspecialchars($_POST['frequence']);
    $rithme = htmlspecialchars($_POST['rithme']);
    if(!empty($_POST['Nom']) AND !empty($_POST['Post']) AND !empty($_POST['Prenom']) AND !empty($_POST['naissance']) AND !empty($_POST['sexe']) AND !empty($_POST['categorie']) AND !empty($_POST['Adresse']) AND !empty($_POST['etat']) AND !empty($_POST['test']) AND !empty($_POST['retrait']) AND !empty($_POST['positif']) AND !empty($_POST['contact']) AND !empty($_POST['enceinte']) AND !empty($_POST['arv']) AND !empty($_POST['frequence']) AND !empty($_POST['rithme']))
    {
        $Nomlog=strlen($nom);
        if($Nomlog<=255)
        {
            $Postlog=strlen($post);
            if($Postlog<=255)
            {
                $Prelog=strlen($prenom);
                if($Prelog<=255)
                {
                    $telelog=strlen($telephone);
                    if($telelog<=20)
                    {
                        $adrelog=strlen($adresse);
                        if($adrelog<=255)
                        {
                            $reque = "INSERT INTO fiche(zone_f, aire_f, unite_f, nom_p, post_p, prenom_p, telephone_p, naissance_p, sexe_p, categorie_p, adresse_p, r_d_struct_p, test_p, retrait_p, positif_p, contact_p, femme_f, sousarv_p, etat_p, rithme_p) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                            $insert = $connection->prepare($reque);
                            $insert->execute(array($_SESSION['zone_c'],$_SESSION['aire_c'],$_SESSION['unite_c'], $nom, $post, $prenom, $telephone, $naissance, $sexe, $categorie, $adresse, $etat, $test, $retrait, $positif, $contact, $enceinte, $arv, $frequence, $rithme));
                            
                            if($contact=="oui")
                            {
                                $nomcaslong=strlen($nomcas);
                                if($nomcaslong<=255)
                                { 
                                    $reque1 = "INSERT INTO cascontact(id_p, nom_cas, age_cas, sexe_cas, positif_cas, retrait_cas, sousarv_cas) VALUES(?,?,?,?,?,?,?)";
                                    $insert1 = $connection->prepare($reque1);
                                    $insert1->execute(array($numero, $nomcas, $agecas, $sexecas, $positifcas, $retraitcas, $arvcas));
                                }
                            }
                            if($enceinte=="oui")
                            {
                                $reque2 = "INSERT INTO femme(id_pa, moment_depist, enfant_suivi) VALUES(?,?,?)";
                                $insert2 = $connection->prepare($reque2);
                                $insert2->execute(array($numero, $phase, $enfant));
                            }
                            $erreur = "Votre compte a bien ete cree !";
                        }
                        else
                        {
                            $erreur= "Veillez saisir une adresse valide";
                        }
                    }
                    else
                    {
                        $erreur= "Veillez saisir un numéro de téléphone valide";
                    }
                }
                else
                {
                    $erreur= "Veillez saisir un prénom valide";
                }
            }
            else
            {
                $erreur= "Veillez saisir un post-nom valide";
            }
        }
        else
        {
            $erreur= "Veillez saisir un nom valide";
        }
    }
    else
    {
        $erreur= "Veillez remplir les cases obligatoires";
    }
}
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>fiche patient</title>
        <link rel="stylesheet" type="text/css" href="form3.css"/>
    </head>
    <body>
        <header>
            <img src="sida.png" class="float1"/>
            <img src="sida.png" class="float2" />
        </header>
        
        <div align="center">
            <section class="insc" style="width: 800px;height: 1300px;">
                <h3><strong class="first">Fiche patient N°<?php echo $numero; ?></strong></h3>
                <br/><br/>
                <form method="POST" action="">   
                    <fieldset>
                        <legend><strong style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;font-size: 1.3em;">Informations sur la structure</strong></legend>    
                            <table>
                                <tr>
                                    <td align="center"><label for="Zone"><strong class="second1">Zone de Santé</strong></label></td>      
                                    <td align="center"><label for="Aire"><strong class="second1">Aire de santé</strong></label></td>  
                                    <td align="center"><label for="Unite"><strong class="second1">Hopitale</strong></label></td> 
                                </tr>
                                    
                                </tr>
                                    <td align="center"><label for="Zone"><strong class="second1"><?php echo $_SESSION['zone_c']; ?></strong></label></td>      
                                    <td align="center"><label for="Aire"><strong class="second1"><?php echo $_SESSION['aire_c']; ?></strong></label></td>  
                                    <td align="center"><label for="Unite"><strong class="second1"><?php echo $_SESSION['unite_c']; ?></strong></label></td>
                                <tr>
                            </table>
                    </fieldset>
                    <fieldset>
                        <legend><strong style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;font-size: 1.3em;">Informations sur le patient</strong></legend>
                                        
                                
                                        
                        <input type="text" placeholder="Nom du patient" class="Nom" name="Nom" value=""/><br/>
                        <input type="text" placeholder="Post-Nom du patient" class="Nom" name="Post" value=""/><br/>
                        <input type="text" placeholder="Prénom du patient" class="Nom" name="Prenom" value=""/><br/>
                        <input type="text" placeholder="Numéro de téléphone" class="Nom" name="telephone" value=""/><br/>
                        <label for="naissance"><strong class="second">Date de naissance :</strong></label><input type="date" name="naissance" value=""/><br/>        
                            <table>    
                                   
                                <tr>
                                    <td align="center"><label class="sex"><strong class="second">Sexe :</strong></label><input type="radio" name="sexe" value="masculin" id="masculin"  /> <label for="masculin" class="m"><strong class="second" title="Homme">M</strong></label><input type="radio" name="sexe" value="feminin" id="feminin"/> <label for="feminin" class="m1"><strong class="second" title="Femme">F</strong></label></td>    
                                    <td align="right"><label ><strong class="second">Catégorie :</strong><input type="radio" name="categorie" value="PS" id="PS"/><label for="PS" class="cat"><strong class="second" title="Professionnel de sexe">PS</strong></label><input type="radio" name="categorie" value="TG" id="TG"/> <label for="TG" class="cat"><strong class="second" title="Transgenre">TG</strong></label><input type="radio" name="categorie" value="HSH" id="HSH"  /> <label for="HSH" class="cat"><strong class="second" title="Homme s'accouplant avec des hommes">HSH</strong></label><input type="radio" name="categorie" value="UDI" id="UDI"  /> <label for="UDI" class="cat"><strong class="second" title="Utilisateur des drogues injectables">UDI</strong></label><input type="radio" name="categorie" value="MI" id="MI"/><label for="MI" class="cat"><strong class="second" title="Minier">MI</strong></label><input type="radio" name="categorie" value="HU" id="HU"/><label for="HU" class="cat"><strong class="second" title="Homme en uniforme">HU</strong></label><input type="radio" name="categorie" value="NO" id="NO"  /><label for="NO"><strong class="second"title="Normal">NO</strong></label></td>
                                </tr>
                            </table>
                            <br/><br/>
                            
                        <label for="Adresse" class="adr2"><strong class="second">Adresse</strong></label><input type="text" placeholder="Exemple : 12, Av. YAKATA C)KALAMU" id="Adresse" name="Adresse" value="" class="adr"/>
                            <table>    
                                <tr>
                                    <td align="left"><label class="pad"><strong class="second">Réçu dans la structure :</strong></label></td>   
                                    <td><input type="radio" name="etat" value="hospitalisation" id="hospitalisation"  /> <label for="hospitalisation" class="cat"><strong class="second">Hospitalisation</strong></label></td>
                                    <td><input type="radio" name="etat" value="consultation" id="consultation"/> <label for="consultation" class="cat"><strong class="second">Consultation</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"><label class="pad"><strong class="second">Test :</strong></label></td>   
                                    <td><input type="radio" name="test" value="oui" id="fait"  /> <label for="fait" class="cat"><strong class="second">Fait</strong></label></td>
                                    <td><input type="radio" name="test" value="non" id="pas_fait"/> <label for="pas_fait" class="cat"><strong class="second">Pas fait</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"><label class="pad"><strong class="second">A retiré le résultat :</strong></label></td>   
                                    <td><input type="radio" name="retrait" value="oui" id="oui"  /> <label for="oui" class="cat"><strong class="second">Oui</strong></label></td>
                                    <td><input type="radio" name="retrait" value="non" id="non"/> <label for="non" class="cat"><strong class="second">Non</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"><label class="pad"><strong class="second">Cas testé positif :</strong></label></td>   
                                    <td><input type="radio" name="positif" value="oui" id="oui1"  /> <label for="oui1" class="cat"><strong class="second">Oui</strong></label></td>
                                    <td><input type="radio" name="positif" value="non" id="non1"/> <label for="non1" class="cat"><strong class="second">Non</strong></label></td>
                                </tr>
                            </table>
                            <hr/>
                            <table> 
                                <tr>
                                    <td align="left"><label class="pad"><strong class="second">Cas contacts :</strong></label></td>   
                                    <td><input type="radio" name='contact' value="oui" id="ouic"  /> <label for="ouic" class="cat"><strong class="second">Oui</strong></label></td>
                                    <td><input type="radio" name='contact' value="non" id="nonc"/> <label for="nonc" class="cat"><strong class="second">Non</strong></label></td>
                                </tr>
                            </table>
                        <br/>
                        <label for="nomcas" class="adr2"><strong class="second">Noms :</strong></label>    
                        <input type="text" placeholder="Exemple: LUKOMBO Albert" id="nomcas" name="nomcas" value="" class="adr"/>
                        <br/>                             
                        <label for="agecas" class="adr2"><strong class="second">Age :</strong></label>    
                        <input type="number" id="agecas" name="agecas" value="" class="num"/>
                        <br/>
                            <table> 
                                <tr>    
                                    <td class="sex"><label class="sex"><strong class="second">Sexe :</strong></label></td>    
                                    <td><input type="radio" name="sexecas" value="masculin" id="mascullinc"  /> <label for="masculinc" class="m"><strong class="second" title="Homme">M</strong></label><input type="radio" name="sexecas" value="feminin" id="femininc"/> <label for="femininc" class="m1"><strong class="second" title="Femme">F</strong></label></td>
                                </tr>
                               
                                <tr>
                                    <td class="sex"><label class="sex"><strong class="second">Dépisté VIH + :</strong></label></td>    
                                    <td><input type="radio" name="positifcas" value="oui" id="ouic1"  /> <label for="ouic1" class="m"><strong class="second">OUI</strong></label><input type="radio" name="positifcas" value="non" id="nonc1"/> <label for="nonc1" class="m1"><strong class="second">Non</strong></label></td>
                                </tr>
                                <tr>
                                    <td class="sex"><label class="sex"><strong class="second">Ayant retiré le résultat :</strong></label></td>   
                                    <td><input type="radio" name="retraitcas" value="oui" id="ouic2"  /> <label for="ouic2" class="m"><strong class="second">Oui</strong></label><input type="radio" name="retraitcas" value="non" id="nonc2"/> <label for="nonc2" class="m1"><strong class="second">Non</strong></label></td>

                                </tr>
                                <tr>
                                    <td class="sex"><label class="sex"><strong class="second">Sous ARV :</strong></label></td>   
                                    <td><input type="radio" name="arvcas" value="oui" id="ouic3"  /> <label for="ouic3" class="m"><strong class="second">Oui</strong></label><input type="radio" name="arvcas" value="non" id="nonc3"/> <label for="nonc3" class="m1"><strong class="second">Non</strong></label></td>
                                </tr>
                            </table>
                            <hr/>
                            <table>
                                <tr>
                                    <td align="left"><label class="pad"><strong class="second">Femme enceinte ou allaitante :</strong></label></td>   
                                    <td><input type="radio" name="enceinte" value="oui" id="ouic4"  /> <label for="ouic4" class="cat"><strong class="second">Oui</strong></label></td>
                                    <td><input type="radio" name="enceinte" value="non" id="nonc4"/> <label for="nonc4" class="cat"><strong class="second">Non</strong></label></td>
                                </tr>
                            </table>
                            <br/>
                            <table>
                                <tr>
                                    <td align="left"><label class="sex"><strong class="second">Moment du dépistage :</strong></label></td>   
                                    <td align="left"><input type="radio" name="phase" value="pre" id="pre"  /> <label for="pre" class="m"><strong class="second">Phase pré-natal</strong></label></td>
                                    
                                </tr>
                                <tr>
                                    <td align="left"></td>
                                    <td align="left"><input type="radio" name="phase" value="nat" id="nat"/> <label for="nat" class="m"><strong class="second">Phase natal</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"></td>
                                    <td align="left"><input type="radio" name="phase" value="post" id="post"/> <label for="post" class="m"><strong class="second">Phase post-natal</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"><label class="sex"><strong class="second">Enfant(s) suivi(s) :</strong></label></td>   
                                    <td align="left"><input type="radio" name="enfant" value="oui" id="ouic5"  /> <label for="ouic5" class="m"><strong class="second">Oui</strong></label><input type="radio" name="enfant" value="non" id="nonc5"/> <label for="nonc5" class="m1"><strong class="second">Non</strong></label></td>
                                </tr>
                            </table>
                            <hr/>
                            <table>
                                <tr>
                                    <td align="left"><label class="sex"><strong class="second">Patient sous ARV :</strong></label></td>   
                                    <td align="left"><input type="radio" name="arv" value="oui" id="ouic6"  /> <label for="ouic6" class="m"><strong class="second">Oui</strong></label><input type="radio" name="arv" value="non" id="nonc6"/> <label for="nonc6" class="m1"><strong class="second">Non</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"><label ><strong class="second">Etat du patient :</strong></label></td>   
                                    <td align="left"><input type="radio" name="frequence" value="hospi" id="hospi"  /> <label for="hospi" class="m"><strong class="second">Hospitalisé</strong></label></td>
                                    
                                </tr>
                                <tr>
                                    <td align="left"></td>
                                    <td align="left"><input type="radio" name="frequence" value="perdu" id="perdu"/> <label for="perdu" class="m"><strong class="second">Perdu de vue</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"></td>
                                    <td align="left"><input type="radio" name="frequence" value="deced" id="deced"/> <label for="deced" class="m"><strong class="second">Décedé</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"></td>
                                    <td align="left"><input type="radio" name="frequence" value="recup" id="recup"/> <label for="recup" class="m"><strong class="second">Pris en charge</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"></td>
                                    <td align="left"><input type="radio" name="frequence" value="aucun" id="aucun"/> <label for="aucun" class="m"><strong class="second">Aucun</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"><label class="sex"><strong class="second">Rithme de soins :</strong></label></td>   
                                    <td align="left"><input type="radio" name="rithme" value="jour" id="jour"  /> <label for="jour" class="m"><strong class="second">Journalier</strong></label></td>  
                                </tr>
                                <tr>
                                    <td align="left"></td>
                                    <td align="left"><input type="radio" name="rithme" value="aucun" id="aucun1"/> <label for="aucun1" class="m"><strong class="second">Aucun</strong></label></td>
                                </tr>            
                            </table>    
                    </fieldset>
                    <div class="fieldsets">
                        <button type="submit" name="fiche" align="center">Enregistrer</button>
                        <button oneclick="window.location.href='http://localhost/project/infirmier.php';" align="center">Etat de sortie</button>
                        <button type="submit" formaction="http://localhost/project/infirmier.php" align="center">Annuler</button>
                    </div> 
                </form>
                <?php

                if(isset($erreur))
                {
                    echo '<font color="red">'.$erreur."</font>";  
                }
                ?>
            </section>
            <br/><br/>
            
        </div>
    </body>

</html>