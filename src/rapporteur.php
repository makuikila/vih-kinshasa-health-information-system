<?php
session_start();
$serveur = "localhost";
$login = "root";
$pass = "";

    $connection = new PDO("mysql:host=$serveur;dbname=vihsida", $login, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   


$nbre_positif1='';
$nbre_positif2='';
$requete = $connection->query ('SELECT COUNT(positif_p) From fiche WHERE positif_p = \'oui\' and sexe_p=\'masculin\' and zone_f=\''. $_SESSION['zone_c'] .'\'');
$nbre_positif1 = $requete->fetchColumn();
$requete2 = $connection->query ('SELECT COUNT(positif_p) From fiche WHERE positif_p = \'oui\' and sexe_p=\'feminin\' and zone_f=\''. $_SESSION['zone_c'] .'\'');
$nbre_positif2 = $requete2->fetchColumn();
if($nbre_positif1==0 AND $nbre_positif2==0)
{
    $nbre_positif1=$nbre_positif1+1;
    $nbre_positif2=$nbre_positif2+1;
    $nbre_positif= $nbre_positif1 + $nbre_positif2;
    $val1=(($nbre_positif1*100)/$nbre_positif);
    $val2=(($nbre_positif2*100)/$nbre_positif);
}
else{
    $nbre_positif= $nbre_positif1 + $nbre_positif2;
    $val1=(($nbre_positif1*100)/$nbre_positif);
    $val2=(($nbre_positif2*100)/$nbre_positif);
}
$nbre_test1='';
$nbre_test2='';
$requet = $connection->query ('SELECT COUNT(test_p) From fiche WHERE test_p = \'oui\' and zone_f=\''. $_SESSION['zone_c'] .'\'');
$nbre_test1 = $requet->fetchColumn();
$requet2 = $connection->query ('SELECT COUNT(retrait_p) From fiche WHERE retrait_p = \'oui\' and zone_f=\''. $_SESSION['zone_c'] .'\'');
$nbre_test2 = $requet2->fetchColumn();
if($nbre_test1==0 AND $nbre_test2==0)
{
    $nbre_test1=$nbre_test1+1;
    $nbre_test2=$nbre_test2+1;
    $nbre_positi= $nbre_test1 + $nbre_test2;
    $val3=(($nbre_test1*100)/$nbre_positi);
    $val4=(($nbre_test2*100)/$nbre_positi);
}
else{
    $nbre_positi= $nbre_test1 + $nbre_test2;
    $val3=(($nbre_test1*100)/$nbre_positi);
    $val4=(($nbre_test2*100)/$nbre_positi);
}

$casfemme='';
$sol=$connection->query('SELECT id_f From fiche where zone_f=\''. $_SESSION['zone_c'] .'\'');
$id=$sol->fetch();
$reque = $connection->query('SELECT COUNT(positif_cas) From cascontact WHERE positif_cas = \'oui\' and sexe_cas = \'masculin\' and id_p=\'$id\'');
$cashomme = $reque->fetchColumn();
$reque2 = $connection->query ('SELECT COUNT(positif_cas) From cascontact WHERE positif_cas = \'oui\' and sexe_cas = \'feminin\' and id_p=\'$id \'');
$casfemme = $reque2->fetchColumn();
if($cashomme==0 AND $casfemme==0)
{
    $cashomme=$cashomme+1;
    $casfemme=$casfemme+1;
    $nbre_posit= $cashomme + $casfemme;
    $val5=(($cashomme*100)/$nbre_posit);
    $val6=(($casfemme*100)/$nbre_posit);
}
else{
    $nbre_posit= $cashomme + $casfemme;
    $val5=(($cashomme*100)/$nbre_posit);
    $val6=(($casfemme*100)/$nbre_posit);
}
$ouiarv='';
$nonarv='';
$requ = $connection->query ('SELECT COUNT(sousarv_p) From fiche WHERE sousarv_p=\'oui\' and zone_f=\''. $_SESSION['zone_c'] .'\'');
$ouiarv = $requ->fetchColumn();
$requ2 = $connection->query ('SELECT COUNT(sousarv_p) From fiche WHERE sousarv_p=\'non\' and zone_f=\''. $_SESSION['zone_c'] .'\'');
$nonarv = $requ2->fetchColumn();
if($ouiarv==0 AND $nonarv==0)
{
    $ouiarv=$ouiarv+1;
    $nonarv=$nonarv+1;
    $nbre_posi= $ouiarv + $nonarv;
    $val7=(($ouiarv*100)/$nbre_posi);
    $val8=(($nonarv*100)/$nbre_posi);
}
else{
    $nbre_posi= $ouiarv + $nonarv;
    $val7=(($ouiarv*100)/$nbre_posi);
    $val8=(($nonarv*100)/$nbre_posi);
}

?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Rapporteur</title>
        <link rel="stylesheet" type="text/css" href="form23.css" />
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="page 1.html">Accueil</a></li>
                    <li><a href="http://localhost/project/deconnexion.php">Déconnection</a></li>                     
                </ul>
            </nav>
        </header>
        <div class="emballage">
                <div class="contenant">
                    <h1 class="titre">RAPPORTAGE DES DONNEES</h1>
                    <form method="POST" action="">
                        <div class="fieldset">
                            <button type="submit" formaction="http://localhost/project/caneva_zone.php">Rapport Zone de santé</button><br/>
                            <button type="submit" formaction="http://localhost/project/caneva_aire.php">Rapport Aire de santé</button><br/>
                            <button type="submit" formaction="http://localhost/project/caneva_unite.php">Rapport structure de santé</button><br/>
                            <p> Différents graphiques </p>
                            <button type="submit" formaction="http://localhost/project/graph1.php" id="butto">Infections hommes(<?php echo $val1; ?>) contre femmes (<?php echo $val2; ?>)</button><br/>
                            <button type="submit" formaction="http://localhost/project/graph2.php" id="butto">Tests faits(<?php echo $val3; ?>) contre resulats rétirés (<?php echo $val4; ?>)</button><br/>
                            <button type="submit" formaction="http://localhost/project/graph3.php" id="butt">Cas contacts hommes(<?php echo $val5; ?>) contre cas contacts femmes (<?php echo $val6; ?>)</button><br/>
                            <button type="submit" formaction="http://localhost/project/graph4.php" id="butt">Patients sous ARV(<?php echo $val7; ?>) contre patients non sous ARV (<?php echo $val8; ?>)</button><br/>
                            <button type=submit formaction="http://localhost/pdf_project/zone1.php">Liste des malades</button>
                        </div class="fieldset">    
                    </form>
                    
                </div>
        </div>        
    </body>

</html>
