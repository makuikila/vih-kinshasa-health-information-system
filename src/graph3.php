<?php
 // content="text/plain; charset=utf-8"

include ('.\src\jpgraph.php');
include ('.\src\jpgraph_pie.php');
include ('.\src\jpgraph_pie3d.php');
session_start();
$serveur = "localhost";
$login = "root";
$pass = "";


    $connection = new PDO("mysql:host=$serveur;dbname=vihsida", $login, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 


$cashomme='';
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

// Some data
$data = array($val5,$val6);

// Create the Pie Graph. 
$graph = new PieGraph(520,350);

$theme_class= new VividTheme;
$graph->SetTheme($theme_class);

// Set A title for the plot
$graph->title->Set("Pourcentage des cas contacts hommes contre cas contact femmes");

// Create
$p1 = new PiePlot3D($data);
$graph->Add($p1);

$p1->ShowBorder();
$p1->SetCenter(0.5,0.4);
$p1->SetColor('red');
$p1->ExplodeAll();

$graph->Stroke();


?>



