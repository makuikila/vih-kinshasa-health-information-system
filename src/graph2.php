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

// Some data
$data = array($val3,$val4);

// Create the Pie Graph. 
$graph = new PieGraph(520,350);

$theme_class= new VividTheme;
$graph->SetTheme($theme_class);

// Set A title for the plot
$graph->title->Set("Pourcentage des tests faits par rapport aux nombres des résultats rétirés");

// Create
$p1 = new PiePlot3D($data);
$graph->Add($p1);

$p1->ShowBorder();
$p1->SetCenter(0.5,0.4);
$p1->SetColor('red');
$p1->ExplodeAll();

$graph->Stroke();


?>



