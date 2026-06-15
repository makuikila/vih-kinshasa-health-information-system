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
if(isset($_GET['id_c']) AND $_GET['id_c'] > 0)
{
    $getid = intval($_GET['id_c']);
    $req='SELECT * FROM compte WHERE id_c=?';
    $requser = $connection->prepare($req);
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
}
$nbre_test=1;
$nbre_mal='';
$nbre_retrait='';
$nbre_positif='';
$nbre_contact='';
$nbre_poscas='';
$nbre_retrcas='';
$nbre_arvcas='';
$nbre_femme='';
$nbre_enfa='';
$nbre_arv='';
$nbre_hosp='';
$nbre_perd='';
$nbre_dece='';
$nbre_recup='';
$nbre_aucun='';
$nbre_jour='';
$nbre_pasjour='';
$nbre_cumsens='';
$nbre_cumdistr='';
$nbre_cumcons='';
$nbre_cumdiag='';
$nbre_cumcont='';



    $requete = 'SELECT COUNT(*) From fiche where zone_f=\''. $_SESSION['zone_c'] .'\'';
    $resultat = $connection->prepare($requete);
    $resultat->execute();
    $nbre_mal = $resultat->fetchColumn();
    

    $requete1 = 'SELECT COUNT(test_p) From fiche WHERE test_p = \'oui\' and zone_f=\''. $_SESSION['zone_c'] .'\'' ;
    $resultat1 = $connection->prepare($requete1);
    $resultat1->execute();
    $nbre_test = $resultat1->fetchColumn();

    $requete2 = 'SELECT COUNT(retrait_p) From fiche WHERE retrait_p = \'oui\' and zone_f=\''. $_SESSION['zone_c'] .'\'';
    $resultat2 = $connection->prepare($requete2);
    $resultat2->execute();
    $nbre_retrait = $resultat2->fetchColumn();

    $requete3 = 'SELECT COUNT(positif_p) From fiche WHERE positif_p = \'oui\' and zone_f=\''. $_SESSION['zone_c'] .'\'';
    $resultat3 = $connection->prepare($requete3);
    $resultat3->execute();
    $nbre_positif = $resultat3->fetchColumn();

    $requete4 = 'SELECT COUNT(contact_p) From fiche WHERE contact_p = \'oui\' and zone_f=\''. $_SESSION['zone_c'] .'\'';
    $resultat4 = $connection->prepare($requete4);
    $resultat4->execute();
    $nbre_contact = $resultat4->fetchColumn();

    $sol=$connection->query('SELECT id_f From fiche where zone_f=\''. $_SESSION['zone_c'] .'\'');
    $idit=$sol->fetch();

    $requete5 = 'SELECT COUNT(positif_cas) From cascontact WHERE positif_cas = \'oui\' and id_p=\'$idit\'';
    $resultat5 = $connection->prepare($requete5);
    $resultat5->execute();
    $nbre_poscas = $resultat5->fetchColumn();

    $requete6 = 'SELECT COUNT(retrait_cas) From cascontact WHERE retrait_cas = \'oui\' and id_p=\'$idit\'';
    $resultat6 = $connection->prepare($requete6);
    $resultat6->execute();
    $nbre_retrcas = $resultat6->fetchColumn();

    $requete7 = 'SELECT COUNT(sousarv_cas) From cascontact WHERE sousarv_cas = \'oui\' and id_p=\'$idit\'';
    $resultat7 = $connection->prepare($requete7);
    $resultat7->execute();
    $nbre_arvcas = $resultat7->fetchColumn();

    $requete8 = 'SELECT COUNT(*) From femme where id_pa=\'$idit\'';
    $resultat8 = $connection->prepare($requete8);
    $resultat8->execute();
    $nbre_femme = $resultat8->fetchColumn();

    $requete9 = 'SELECT COUNT(enfant_suivi) From femme WHERE enfant_suivi= \'oui\' and id_pa=\'$idit\'';
    $resultat9 = $connection->prepare($requete9);
    $resultat9->execute();
    $nbre_enfa = $resultat9->fetchColumn();

    $requete10 = 'SELECT COUNT(sousarv_p) From fiche WHERE sousarv_p=\'oui\' and zone_f=\''. $_SESSION['zone_c'] .'\'';
    $resultat10 = $connection->prepare($requete10);
    $resultat10->execute();
    $nbre_arv = $resultat10->fetchColumn();

    $requete11 = 'SELECT COUNT(etat_p) From fiche WHERE etat_p="hospitalisation" and zone_f=\''. $_SESSION['zone_c'] .'\'';
    $resultat11 = $connection->prepare($requete11);
    $resultat11->execute();
    $nbre_hosp = $resultat11->fetchColumn();

    $requete12 = 'SELECT COUNT(etat_p) From fiche WHERE etat_p="perdu" and zone_f=\''. $_SESSION['zone_c'] .'\'';
    $resultat12 = $connection->prepare($requete12);
    $resultat12->execute();
    $nbre_perd = $resultat12->fetchColumn();

    $requete13 = 'SELECT COUNT(etat_p) From fiche WHERE etat_p="deced" and zone_f=\''. $_SESSION['zone_c'] .'\'';
    $resultat13 = $connection->prepare($requete13);
    $resultat13->execute();
    $nbre_dece = $resultat13->fetchColumn();

    $requete14 = 'SELECT COUNT(etat_p) From fiche WHERE etat_p="recup" and zone_f=\''. $_SESSION['zone_c'] .'\'';
    $resultat14 = $connection->prepare($requete14);
    $resultat14->execute();
    $nbre_recup = $resultat14->fetchColumn();

    $requete15 = 'SELECT COUNT(etat_p) From fiche WHERE etat_p="aucun" and zone_f=\''. $_SESSION['zone_c'] .'\'';
    $resultat15 = $connection->prepare($requete15);
    $resultat15->execute();
    $nbre_aucun = $resultat15->fetchColumn();

    $requete16 = 'SELECT COUNT(rithme_p) From fiche WHERE rithme_p="jour" and zone_f=\''. $_SESSION['zone_c'] .'\'';
    $resultat16 = $connection->prepare($requete16);
    $resultat16->execute();
    $nbre_jour = $resultat16->fetchColumn();

    $requete17 = 'SELECT COUNT(rithme_p) From fiche WHERE rithme_p="aucun" and zone_f=\''. $_SESSION['zone_c'] .'\'';
    $resultat17 = $connection->prepare($requete17);
    $resultat17->execute();
    $nbre_pasjour = $resultat17->fetchColumn();

    $requete18 = 'SELECT SUM(sensibilisation) From unite where zone_u=\''. $_SESSION['zone_c'] .'\'';
    $resultat18 = $connection->prepare($requete18);
    $resultat18->execute();
    $nbre_cumsens = $resultat18->fetchColumn();

    $requete19 = 'SELECT SUM(distributions) From unite where zone_u=\''. $_SESSION['zone_c'] .'\'';
    $resultat19 = $connection->prepare($requete19);
    $resultat19->execute();
    $nbre_cumdistr = $resultat19->fetchColumn();

    $requete20 = 'SELECT SUM(ist_consult) From unite where zone_u=\''. $_SESSION['zone_c'] .'\'';
    $resultat20 = $connection->prepare($requete20);
    $resultat20->execute();
    $nbre_cumcons = $resultat20->fetchColumn();

    $requete21 = 'SELECT SUM(ist_diag) From unite where zone_u=\''. $_SESSION['zone_c'] .'\'';
    $resultat21 = $connection->prepare($requete21);
    $resultat21->execute();
    $nbre_cumdiag = $resultat21->fetchColumn();

    $requete22 = 'SELECT SUM(ist_contact) From unite where zone_u=\''. $_SESSION['zone_c'] .'\'';
    $resultat22 = $connection->prepare($requete22);
    $resultat22->execute();
    $nbre_cumcont = $resultat22->fetchColumn();

?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Zone de santé</title>
        <link rel="stylesheet" type="text/css" href="caneva.css"/>
    </head>
    <body>
        <header>
            <img src="sida.png" class="float1"/>
            <img src="sida.png" class="float2" />
        </header>
        
        <div align="center">
            <section class="insc" style="width: 800px;height: 1300px;">
                <h3><strong class="first">Données de la zone de santé</strong></h3>
                <br/><br/>
                <form method="POST" action="">   
                    <fieldset id="pe">
                        <legend><strong style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;font-size: 1.3em;">Informations sur la zone de santé'</strong></legend>    
                            <div class="tete">
                                <table>
                                    <tr>
                                        <td align="center"><label for="Zone"><strong class="second1">Zone de Santé</strong></label></td>      
                                        
                                    </tr>
                                        
                                    <tr>
                                        <td align="center"><label for="zone"><?php echo $_SESSION['zone_c'];?></label> </td>      
                                        
                                    </tr>
                                </table>
                            </div>
                    </fieldset>
                    <fieldset id="pet">
                        <legend><strong style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;font-size: 1.3em;">Informations spécifiques</strong></legend>
                        <table>
                            <tr> 
                                <td><label for="agecas" class="adr2"><strong class="second">Nombres des malades Réçu :</strong></label></td>    
                                <td class="td"><label for="recu"><?php echo $nbre_mal;?></label></td> 
                            </tr>
                            <tr>        
                                <td><label for="agecas" class="adr2"><strong class="second">Nombres des malades testés :</strong></label></td>    
                                <td class="td"><label for="test"><?php echo $nbre_test;?></label></td>
                            </tr>
                            <tr> 
                                
                                <td><label for="agecas" class="adr2"><strong class="second">Nombres des malades ayant réçu les résultats:</strong></label></td>    
                                <td class="td"><label for="recut"><?php echo $nbre_retrait;?></label></td> 
                            </tr>
                            <tr>
                                <td><label for="agecas" class="adr2"><strong class="second">Nombres des cas testés positifs:</strong></label></td>    
                                <td class="td"><label for="cas"><?php echo $nbre_positif;?></label></td> 
                            </tr>
                            <tr>
                                <td><label for="agecas" class="adr2"><strong class="second">Nombres des cas contact:</strong></label></td>    
                                <td class="td"><label for="contact"><?php echo $nbre_contact;?></label></td> 
                            </tr>
                            <tr>
                                <td><label for="agecas" class="adr2"><strong class="second">Nombres des cas contact positifs:</strong></label></td>    
                                <td class="td"><label for="contactp"><?php echo $nbre_poscas;?></label></td> 
                            </tr>
                            <tr>  
                                <td><label for="agecas" class="adr2"><strong class="second">Nombres des cas contact ayant récu les résultats:</strong></label></td>    
                                <td class="td"><label for="contactr"><?php echo $nbre_retrcas;?></label></td> 
                            </tr>
                            <tr>
                                <td><label for="agecas" class="adr2"><strong class="second">Nombres des cas contact sous ARV:</strong></label></td>    
                                <td class="td"><label for="contacta"><?php echo $nbre_arvcas;?></label></td> 
                            </tr>
                            <tr>
                                <td><label for="agecas" class="adr2"><strong class="second">Nombres des femmes enceintes récensées:</strong></label></td>    
                                <td class="td"><label for="femme"><?php echo $nbre_femme;?></label></td> 
                            </tr>
                            <tr>
                                <td><label for="agecas" class="adr2"><strong class="second">Nombres d'enfants suivis:</strong></label></td>    
                                <td class="td"><label for="enfant"><?php echo $nbre_enfa;?></label></label></td> 
                            </tr>
                            <tr>
                                <td><label for="agecas" class="adr2"><strong class="second">Nombres des malades sous ARV:</strong></label></td>    
                                <td class="td"><label for="arv"><?php echo $nbre_arv;?></label></td> 
                            </tr>
                            <tr>
                                <td><label for="agecas" class="adr2"><strong class="second">Nombres des malades hospitalisés:</strong></label></td>    
                                <td class="td"><label for="hospi"><?php echo $nbre_hosp;?></label></td> 
                            </tr>
                            <tr>
                                <td><label for="agecas" class="adr2"><strong class="second">Nombres des malades perdus de vue:</strong></label></td>    
                                <td class="td"><label for="perdu"><?php echo $nbre_perd;?></label></td> 
                            </tr>
                            <tr>
                                <td><label for="agecas" class="adr2"><strong class="second">Nombres des malades décédés:</strong></label></td>    
                                <td class="td"><label for="deced"><?php echo $nbre_dece;?></label></td> 
                            </tr>
                            <tr>
                                <td><label for="agecas" class="adr2"><strong class="second">Nombres des malades récupéré:</strong></label></td>    
                                <td class="td"><label for="recup"><?php echo $nbre_recup;?></label></td> 
                            </tr>
                            <tr>

                                <td><label for="agecas" class="adr2"><strong class="second">autres:</strong></label></td>    
                                <td class="td"><label for="autr"><?php echo $nbre_aucun;?></label></td>
                            </tr>
                        </table> 
                        <br/>
                        <table>    
                            <tr>
                                <td> Rithme de soins</td>
                            </tr>
                        </table>
                        <br/>
                        <table>
                            <tr>
                                <td><label for="agecas" class="adr2"><strong class="second">Patients avec rithme Journalier:</strong></label></td>    
                                <td class="td"><label for="jour"><?php echo $nbre_jour;?></label></label></td> 
                            </tr>
                            <tr>
                                <td><label for="agecas" class="adr2"><strong class="second">Patient avec aucun rithme:</strong></label></td>    
                                <td class="td"><label for="journ"><?php echo $nbre_pasjour;?></label></td> 
                            </tr>
                        </table>
                        <br/>
                        <table>    
                            <tr>
                                
                                <td ><strong class="secon"> Informations additionnelles</td>
                                <td><td ><strong class="seco"> Cumule</strong></td>
                            </tr>
                            <tr>                                      
                                <td><label for="ageca" class="adr2"><strong class="second">Sensiblisation des masses :</strong></label></td>    
                                
                                <td><label for="cum" class="tdd"><?php echo $nbre_cumsens;?></label></label></td>
                            </tr>
                            <tr>
                                <td><label for="agec" class="adr2"><strong class="second">Distribution des intrants :</strong></label></td>    
                                
                                <td><label for="cumu" class="tdd"><?php echo $nbre_cumdistr;?></label></label></td>
                            </tr>    
                            <tr>
                                
                                <td ><strong class="secon"> Cas IST</strong></td>
                                <td><td ><strong class="seco"> Cumule</strong></td>
                            </tr>
                            <tr>
                                <td><label for="age" class="adr2"><strong class="second">Nombres des cas réçus en consultation :</strong></label></td>    
                                
                                <td><label for="cumul" class="tdd"><?php echo $nbre_cumcons;?></label></label></td>
                            </tr>
                            <tr>
                                <td><label for="ag" class="adr2"><strong class="second">Nombres des cas IST diagnostiqués :</strong></label></td>    
                                
                                <td><label for="cumule" class="tdd"><?php echo $nbre_cumdiag;?></label></label></td>
                            </tr>
                            <tr>
                                <td><label for="ag1" class="adr2"><strong class="second">Nombres des cas conatct :</strong></label></td>    
                                
                                <td><label for="cumules" class="tdd"><?php echo $nbre_cumcont;?></label></label></td>
                            </tr>
                        </table>
                        <br/>
                             
                    </fieldset>
                    <div class="fieldsets">
                        
                        <button type=submit formaction="http://localhost/pdf_project/zone.php" align="center">Etat de sortie</button>
                        <button type=submit formaction="http://localhost/project/rapporteur.php" align="center">Annuler</button>
                    </div> 
                </form>
                <?php

                
                ?>
            </section>
            <br/><br/>
            
        </div>
    </body>

</html>