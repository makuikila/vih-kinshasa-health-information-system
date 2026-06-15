<?php
session_start();
 $serveur = "localhost";
$login = "root";
$pass = "";


    $connection = new PDO("mysql:host=$serveur;dbname=vihsida", $login, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$id='';
if(isset($_POST['id_patient'])){
    $id = $_POST['id_patient'];
}
if(!empty($_POST['update'])){
    $newnom = htmlspecialchars($_POST['newnom']);
    $newpost = htmlspecialchars($_POST['newpost']);
    $newprenom = htmlspecialchars($_POST['newprenom']);
    $newtelephone = htmlspecialchars($_POST['newtelephone']);
    $newnaissance = htmlspecialchars($_POST['newnaissance']);
    $newsexe = htmlspecialchars($_POST['newsexe']);
    $newcategorie = htmlspecialchars($_POST['newcategorie']);
    $newadresse = htmlspecialchars($_POST['newadresse']);
    $newtest = htmlspecialchars($_POST['newtest']);
    $newretrait = htmlspecialchars($_POST['newretrait']);
    $newpositif = htmlspecialchars($_POST['newpositif']);
    $contact = htmlspecialchars($_POST['contact']);
    $enceinte = htmlspecialchars($_POST['enceinte']);
    $newarv = htmlspecialchars($_POST['newsousarv']);
    $newfrequence = htmlspecialchars($_POST['newfrequence']);
    $newrithme = htmlspecialchars($_POST['newrithme']);

    $stmt = $connection->exec('UPDATE fiche SET nom_p=\'makoso\' WHERE id_f=\''. $_SESSION['unite_c'] .'\'');
    /*$reque = ;
    $insert = $connection->prepare($reque);*/
                            
}
    $reque2='SELECT * From fiche where id_f=\''. $id .'\'';
    $use= $connection->prepare($reque2);
    $use->execute(array());
    $user=$use->fetch();

?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>fiche patient</title>
        <link rel="stylesheet" type="text/css" href="fichemod.css"/>
    </head>
    <body>
        <header>
            <img src="sida.png" class="float1"/>
            <img src="sida.png" class="float2" />
        </header>
        
        <div align="center">
            <section class="insc" style="width: 800px;height: 1300px;">
                <h3><strong class="first">Fiche patient N°<?php echo $id; ?></strong></h3>
                <br/><br/>
                <form method="POST" action="fichemod.php" enctype="multipart/form-data">   
                    <fieldset>
                        <legend><strong style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;font-size: 1.3em;">Informations sur la structure</strong></legend>    
                            <table>
                                <tr>
                                    <td align="center"><label for="Zone"><strong class="second1">Zone de Santé</strong></label></td>      
                                    <td align="center"><label for="Aire"><strong class="second1">Aire de santé</strong></label></td>  
                                    <td align="center"><label for="Unite"><strong class="second1">Hopitale</strong></label></td> 
                                </tr>
                                    
                                </tr>
                                    <td align="center"><label for="Zone"><strong class="second1"><?php if(isset($user['zone_f'])){ echo $user['zone_f']; } ?></strong></label></td>      
                                    <td align="center"><label for="Aire"><strong class="second1"><?php if(isset($user['aire_f'])){echo $user['aire_f'];} ?></strong></label></td>  
                                    <td align="center"><label for="Unite"><strong class="second1"><?php if(isset($user['unite_f'])){echo $user['unite_f'];} ?></strong></label></td>
                                <tr>
                            </table>
                    </fieldset>
                    <fieldset>
                        <legend><strong style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;font-size: 1.3em;">Informations sur le patient</strong></legend>
                                        
                                
                                        
                        <input type="text" placeholder="Nom du patient" class="Nom" name="newnom" value="<?php if(isset($user['nom_p'])){ echo $user['nom_p'];} ?>"/><br/>
                        <input type="text" placeholder="Post-Nom du patient" class="Nom" name="newpost" value="<?php if(isset($user['post_p'])){ echo $user['post_p'];} ?>"/><br/>
                        <input type="text" placeholder="Prénom du patient" class="Nom" name="newprenom" value="<?php if(isset($user['prenom_p'])){ echo $user['prenom_p']; }?>"/><br/>
                        <input type="text" placeholder="Numéro de téléphone" class="Nom" name="newtelephone" value="<?php if(isset($user['telephone_p'])){echo $user['telephone_p'];} ?>"/><br/>
                        <label for="naissance"><strong class="second">Date de naissance :</strong></label><input type="date" name="newnaissance" value=""/><br/>        
                            <table>    
                                   
                                <tr>
                                    <td align="center"><label class="sex"><strong class="second">Sexe :</strong></label><input type="radio" name="newsexe" <?php if (isset($user['sexe_p']) && $user['sexe_p'] == "masculin") { echo "checked"; } ?> value="masculin" id="masculin"  /> <label for="masculin" class="m"><strong class="second" title="Homme">M</strong></label><input type="radio" name="newsexe" <?php if (isset($user['sexe_p']) && $user['sexe_p'] == "feminin") { echo "checked"; } ?> value="feminin" id="feminin"/> <label for="feminin" class="m1"><strong class="second" title="Femme">F</strong></label></td>    
                                    <td align="right"><label ><strong class="second">Catégorie :</strong><input type="radio" name="newcategorie" <?php if (isset($user['categorie_p']) && $user['categorie_p'] == "PS") { echo "checked"; } ?> value="PS" id="PS"/><label for="PS" class="cat"><strong class="second" title="Professionnel de sexe">PS</strong></label><input type="radio" name="newcategorie" <?php if (isset($user['categorie_p']) && $user['categorie_p'] == "TG") { echo "checked"; } ?> value="TG" id="TG"/> <label for="TG" class="cat"><strong class="second" title="Transgenre">TG</strong></label><input type="radio" name="newcategorie" <?php if (isset($user['categorie_p']) && $user['categorie_p'] == "HSH") { echo "checked"; } ?> value="HSH" id="HSH"  /> <label for="HSH" class="cat"><strong class="second" title="Homme s'accouplant avec des hommes">HSH</strong></label><input type="radio" name="newcategorie" <?php if (isset($user['categorie_p']) && $user['categorie_p'] == "UDI") { echo "checked"; } ?> value="UDI" id="UDI"  /> <label for="UDI" class="cat"><strong class="second" title="Utilisateur des drogues injectables">UDI</strong></label><input type="radio" name="newcategorie" <?php if (isset($user['categorie_p']) && $user['categorie_p'] == "MI") { echo "checked"; } ?> value="MI" id="MI"/><label for="MI" class="cat"><strong class="second" title="Minier">MI</strong></label><input type="radio" name="newcategorie" <?php if (isset($user['categorie_p']) && $user['categorie_p'] == "HU") { echo "checked"; } ?> value="HU" id="HU"/><label for="HU" class="cat"><strong class="second" title="Homme en uniforme">HU</strong></label><input type="radio" name="newcategorie" <?php if (isset($user['categorie_p']) && $user['categorie_p'] == "NO") { echo "checked"; } ?> value="NO" id="NO"  /><label for="NO"><strong class="second"title="Normal">NO</strong></label></td>
                                </tr>
                            </table>
                            <br/><br/>
                            
                        <label for="Adresse" class="adr2"><strong class="second">Adresse</strong></label><input type="text" placeholder="Exemple : Matthieu" id="Adresse" name="newadresse" value="<?php if(isset($user['adresse_p'])){ echo $user['adresse_p'];}?>" class="adr"/>
                            <table>    
                                
                                <tr>
                                    <td align="left"><label class="pad"><strong class="second">Test :</strong></label></td>   
                                    <td><input type="radio" name="newtest" <?php if (isset($user['test_p']) && $user['test_p'] == "oui") { echo "checked"; } ?> value="oui" id="fait"  /> <label for="fait" class="cat"><strong class="second">Fait</strong></label></td>
                                    <td><input type="radio" name="newtest" <?php if (isset($user['test_p']) && $user['test_p'] == "non") { echo "checked"; } ?> value="non" id="pas_fait"/> <label for="pas_fait" class="cat"><strong class="second">Pas fait</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"><label class="pad"><strong class="second">A retiré le résultat :</strong></label></td>   
                                    <td><input type="radio" name="newretrait" <?php if (isset($user['retrait_p']) && $user['retrait_p'] == "oui") { echo "checked"; } ?> value="oui" id="oui"  /> <label for="oui" class="cat"><strong class="second">Oui</strong></label></td>
                                    <td><input type="radio" name="newretrait" <?php if (isset($user['retrait_p']) && $user['retrait_p'] == "non") { echo "checked"; } ?> value="non" id="non"/> <label for="non" class="cat"><strong class="second">Non</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"><label class="pad"><strong class="second">Cas testé positif :</strong></label></td>   
                                    <td><input type="radio" name="newpositif" <?php if (isset($user['positif_p']) && $user['positif_p'] == "oui") { echo "checked"; } ?> value="oui" id="oui1"  /> <label for="oui1" class="cat"><strong class="second">Oui</strong></label></td>
                                    <td><input type="radio" name="newpositif" <?php if (isset($user['positif_p']) && $user['positif_p'] == "non") { echo "checked"; } ?> value="non" id="non1"/> <label for="non1" class="cat"><strong class="second">Non</strong></label></td>
                                </tr>
                            </table>
                            <hr/>
                            <table> 
                                <tr>
                                    <td align="left"><label class="pad"><strong class="second">Cas contacts :</strong></label></td>   
                                    <td><input type="radio" name="contact" value="oui" id="ouic"  /> <label for="ouic" class="cat"><strong class="second">Oui</strong></label></td>
                                    <td><input type="radio" name="contact" value="non" id="nonc"/> <label for="nonc" class="cat"><strong class="second">Non</strong></label></td>
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
                                    <td align="left"><input type="radio" name="newsousarv" <?php if (isset($user['sousarv_p']) && $user['sousarv_p'] == "oui") { echo "checked"; } ?> value="oui" id="ouic6"  /> <label for="ouic6" class="m"><strong class="second">Oui</strong></label><input type="radio" name="newsousarv" <?php if (isset($user['sousarv_p']) && $user['sousarv_p'] == "non") { echo "checked"; } ?> value="non" id="nonc6"/> <label for="nonc6" class="m1"><strong class="second">Non</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"><label ><strong class="second">Etat du patient :</strong></label></td>   
                                    <td align="left"><input type="radio" name="newfrequence" <?php if (isset($user['etat_p']) && $user['etat_p'] == "hospi") { echo "checked"; } ?> value="hospi" id="hospi"  /> <label for="hospi" class="m"><strong class="second">Hospitalisé</strong></label></td>
                                    
                                </tr>
                                <tr>
                                    <td align="left"></td>
                                    <td align="left"><input type="radio" name="newfrequence" <?php if (isset($user['etat_p']) && $user['etat_p'] == "perdu") { echo "checked"; } ?> value="perdu" id="perdu"/> <label for="perdu" class="m"><strong class="second">Perdu de vue</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"></td>
                                    <td align="left"><input type="radio" name="newfrequence" <?php if (isset($user['etat_p']) && $user['etat_p'] == "deced") { echo "checked"; } ?> value="deced" id="deced"/> <label for="deced" class="m"><strong class="second">Décedé</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"></td>
                                    <td align="left"><input type="radio" name="newfrequence" <?php if (isset($user['etat_p']) && $user['etat_p'] == "recup") { echo "checked"; } ?> value="recup" id="recup"/> <label for="recup" class="m"><strong class="second">Pris en charge</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"></td>
                                    <td align="left"><input type="radio" name="newfrequence" <?php if (isset($user['etat_p']) && $user['etat_p'] == "aucun") { echo "checked"; } ?> value="aucun" id="aucun"/> <label for="aucun" class="m"><strong class="second">Aucun</strong></label></td>
                                </tr>
                                <tr>
                                    <td align="left"><label class="sex"><strong class="second">Rithme de soins :</strong></label></td>   
                                    <td align="left"><input type="radio" name="newrithme" <?php if (isset($user['rithme_p']) && $user['rithme_p'] == "jour") { echo "checked"; } ?> value="jour" id="jour"  /> <label for="jour" class="m"><strong class="second">Journalier</strong></label></td>  
                                </tr>
                                <tr>
                                    <td align="left"></td>
                                    <td align="left"><input type="radio" name="newrithme" <?php if (isset($user['rithme_p']) && $user['rithme_p'] == "aucun") { echo "checked"; } ?> value="aucun" id="aucun1"/> <label for="aucun1" class="m"><strong class="second">Aucun</strong></label></td>
                                </tr>            
                            </table>    
                    </fieldset>
                    <div class="fieldsets">
                        <input type="submit" align="center" name ="update" <value="Mettre à jour"/>
                        <button oneclick="fichemod.php';" align="center">Etat de sortie</button>
                        <button type="submit" formaction="modification.php" align="center">Annuler</button>
                    </div> 
                </form>
            </section>
            <br/><br/>
            
        </div>
    </body>

</html>