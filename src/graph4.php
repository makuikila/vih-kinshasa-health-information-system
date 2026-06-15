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

// Some data
$data = array($val7,$val8);

// Create the Pie Graph. 
$graph = new PieGraph(520,350);

$theme_class= new VividTheme;
$graph->SetTheme($theme_class);

// Set A title for the plot
$graph->title->Set("Pourcentage des patients sous ARV et non sous ARV");

// Create
$p1 = new PiePlot3D($data);
$graph->Add($p1);

$p1->ShowBorder();
$p1->SetCenter(0.5,0.4);
$p1->SetColor('red');
$p1->ExplodeAll();

$graph->Stroke();


?>



