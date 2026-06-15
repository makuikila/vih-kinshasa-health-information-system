<?php
session_start();
 require "fpdf.php";
 $serveur = "localhost";
$login = "root";
$pass = "";

    
    $connection = new PDO("mysql:host=$serveur;dbname=vihsida", $login, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $nom=$_SESSION['unite_c'];
    $stmt=$connection->query('SELECT COUNT(*) From fiche where unite_f=\''. $_SESSION['unite_c'] .'\'');
    $id=$stmt->fetchColumn();
    $stmt2=$connection->query('SELECT COUNT(test_p) From fiche WHERE test_p = \'oui\' and unite_f=\''. $_SESSION['unite_c'] .'\'');
    $nbre_test=$stmt2->fetchColumn();
    $stmt3=$connection->query('SELECT COUNT(retrait_p) From fiche WHERE retrait_p = \'oui\' and unite_f=\''. $_SESSION['unite_c'] .'\'');
    $nbre_retrait=$stmt3->fetchColumn();
    $stmt4=$connection->query('SELECT COUNT(positif_p) From fiche WHERE positif_p = \'oui\' and unite_f=\''. $_SESSION['unite_c'] .'\'');
    $nbre_positif=$stmt4->fetchColumn();
    $stmt5=$connection->query('SELECT COUNT(contact_p) From fiche WHERE contact_p = \'oui\' and unite_f=\''. $_SESSION['unite_c'] .'\'');
    $nbre_contact=$stmt5->fetchColumn();
    
    $sol=$connection->query('SELECT id_f From fiche where unite_f=\''. $_SESSION['unite_c'] .'\'');
    $idit=$sol->fetch();
    
    $stmt6=$connection->query('SELECT COUNT(positif_cas) From cascontact WHERE positif_cas = \'oui\' and id_p=\'$idit\'');
    $nbre_poscas=$stmt6->fetchColumn();
    $stmt7=$connection->query('SELECT COUNT(retrait_cas) From cascontact WHERE retrait_cas = \'oui\' and id_p=\'$idit\'');
    $nbre_retrcas=$stmt7->fetchColumn();
    $stmt8=$connection->query('SELECT COUNT(sousarv_cas) From cascontact WHERE sousarv_cas = \'oui\' and id_p=\'$idit\'');
    $nbre_arvcas=$stmt8->fetchColumn();
    $stmt9=$connection->query('SELECT COUNT(*) From femme where id_pa=\'$idit\'');
    $nbre_femme=$stmt9->fetchColumn();
    $stmt10=$connection->query('SELECT COUNT(enfant_suivi) From femme WHERE enfant_suivi= \'oui\' and id_pa=\'$idit\'');
    $nbre_enfa=$stmt10->fetchColumn();
    $stmt11=$connection->query('SELECT COUNT(sousarv_p) From fiche WHERE sousarv_p=\'oui\' and unite_f=\''. $_SESSION['unite_c'] .'\'');
    $nbre_arv=$stmt11->fetchColumn();
    $stmt12=$connection->query('SELECT COUNT(etat_p) From fiche WHERE etat_p="hospitalisation" and unite_f=\''. $_SESSION['unite_c'] .'\'');
    $nbre_hosp=$stmt12->fetchColumn();
    $stmt13=$connection->query('SELECT COUNT(etat_p) From fiche WHERE etat_p="perdu" and unite_f=\''. $_SESSION['unite_c'] .'\'');
    $nbre_perd=$stmt13->fetchColumn();
    $stmt14=$connection->query( 'SELECT COUNT(etat_p) From fiche WHERE etat_p="deced" and unite_f=\''. $_SESSION['unite_c'] .'\'');
    $nbre_dece=$stmt14->fetchColumn();
    $stmt15=$connection->query('SELECT COUNT(etat_p) From fiche WHERE etat_p="recup" and unite_f=\''. $_SESSION['unite_c'] .'\'');
    $nbre_recup=$stmt15->fetchColumn();
    $stmt16=$connection->query('SELECT COUNT(etat_p) From fiche WHERE etat_p="aucun" and unite_f=\''. $_SESSION['unite_c'] .'\'');
    $nbre_aucun=$stmt16->fetchColumn();
    $stmt17=$connection->query('SELECT COUNT(rithme_p) From fiche WHERE rithme_p="jour" and unite_f=\''. $_SESSION['unite_c'] .'\'');
    $nbre_jour=$stmt17->fetchColumn();
    $stmt18=$connection->query('SELECT COUNT(rithme_p) From fiche WHERE rithme_p="aucun" and unite_f=\''. $_SESSION['unite_c'] .'\'');
    $nbre_pasjour=$stmt18->fetchColumn();
    $stmt19=$connection->query('SELECT SUM(sensibilisation) From unite where nom_u=\''. $_SESSION['unite_c'] .'\'');
    $nbre_cumsens=$stmt19->fetchColumn();
    $stmt20=$connection->query('SELECT SUM(distributions) From unite where nom_u=\''. $_SESSION['unite_c'] .'\'');
    $nbre_cumdistr=$stmt20->fetchColumn();
    $stmt21=$connection->query('SELECT SUM(ist_consult) From unite where nom_u=\''. $_SESSION['unite_c'] .'\'');
    $nbre_cumcons=$stmt21->fetchColumn();
    $stmt22=$connection->query('SELECT SUM(ist_diag) From unite where nom_u=\''. $_SESSION['unite_c'] .'\'');
    $nbre_cumdiag=$stmt22->fetchColumn();
    $stmt23=$connection->query('SELECT SUM(ist_contact) From unite where nom_u=\''. $_SESSION['unite_c'] .'\'');
    $nbre_cumcont=$stmt23->fetchColumn();
    
    


    /*$stmt = $connection->query('SELECT * from fiche where unite_f=\''. $_SESSION['unite_c'] .'\'');
    while($user=$stmt->fetch(PDO::FETCH_OBJ))*/
    
    /*$reque2='SELECT nom_p From fiche where unite_f=:unite_f';
    $stmt = $connection->prepare($reque2);
    $stmt->execute(array(
        'unite_f'=>$nom
    ));
    
    */




    
    
    
    

class myPDF extends FPDF{
    function header(){
         $this->Image('armoire.png',10,6,30);
         $this->SetFont('Times','B',13);
         $this->Cell(176,5,'REPUBLIQUE DEMOCRATIQUE DU CONGO',0,0,'C');
         $this->Ln();
         $this->SetFont('Times','B',11);
         $this->Cell(176,5,'PROGRAMME NATIONAL DE LUTTE CONTRE LE VIH',0,0,'C');
         $this->Ln();
         $this->Ln();
         $this->Ln();
         $this->SetFont('Times','B',14);
         $this->Cell(176,5,'RAPPORT DES DONNEES DE LA STRUCTURE ',0,0,'C');
         $this->Cell(276);
         $this->Image('pnmls.png',165,6,30);
         $this->Ln(20);
    }
    function footer(){
         $this->Sety(-15);
         $this->SetFont('Arial','',8);
         $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
    }
    
    

}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10,'Nombres des malades Recu :'.$id,0,1);
$pdf->Cell(0,10,'Nombres des malades testes :'.$nbre_test,0,1);
$pdf->Cell(0,10,'Nombres des malades ayant recu les resultats:'.$nbre_retrait,0,1);
$pdf->Cell(0,10,'Nombres des cas testes positifs:'.$nbre_positif,0,1);
$pdf->Cell(0,10,'Nombres des cas contact:'.$nbre_contact,0,1);
$pdf->Cell(0,10,'Nombres des cas contact positifs:'.$nbre_poscas,0,1);
$pdf->Cell(0,10,'Nombres des cas contact ayant recu les resultats: '.$nbre_retrcas,0,1);
$pdf->Cell(0,10,'Nombres des cas contact sous ARV: '.$nbre_arvcas,0,1);
$pdf->Cell(0,10,'Nombres des femmes enceintes recensees:'.$nbre_femme,0,1);
$pdf->Cell(0,10,'Nombres denfants suivis:'.$nbre_enfa,0,1);
$pdf->Cell(0,10,'Nombres des malades hospitalises:'.$nbre_hosp,0,1);
$pdf->Cell(0,10,'Nombres des malades perdus de vue: '.$nbre_perd,0,1);
$pdf->Cell(0,10,'Nombres des malades decedes:'.$nbre_dece,0,1);
$pdf->Cell(0,10,'Nombres des malades recupere:'.$nbre_recup,0,1);
$pdf->Cell(0,10,'autres:'.$nbre_aucun,0,1);
$pdf->Cell(0,10,'Patients avec rithme Journalier: '.$nbre_jour,0,1);
$pdf->Cell(0,10,'Patient avec aucun rithme:'.$nbre_pasjour,0,1);
$pdf->Cell(0,10,'Informations additionnelles ',0,1);
$pdf->Cell(0,10,'Nombre des personnes sensibilisees : '.$nbre_cumsens,0,1);
$pdf->Cell(0,10,'Nombres dintrants distribuee '.$nbre_cumdistr,0,1);
$pdf->Cell(0,10,'Cas IST',0,1);
$pdf->Cell(0,10,'Nombres des cas recus en consultation : '.$nbre_cumcons,0,1);
$pdf->Cell(0,10,'Nombres des cas IST diagnostiques : '.$nbre_cumdiag,0,1);
$pdf->Cell(0,10,'Nombres des cas conatct : '.$nbre_cumcont,0,1);


$pdf->Output();
?>