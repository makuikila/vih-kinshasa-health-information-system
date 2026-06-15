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

// Some data
$data = array($val1,$val2);

// Create the Pie Graph. 
$graph = new PieGraph(520,350);

$theme_class= new VividTheme;
$graph->SetTheme($theme_class);

// Set A title for the plot
$graph->title->Set("pourcentage des hommes positifs contre le nombre des femmes positifs au VIH");

// Create
$p1 = new PiePlot3D($data);
$graph->Add($p1);

$p1->ShowBorder();
$p1->SetCenter(0.5,0.4);
$p1->SetColor('red');
$p1->ExplodeAll();

$graph->Stroke();


?>



