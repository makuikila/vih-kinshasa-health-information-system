<?php
session_start();
 require "fpdf.php";
 $serveur = "localhost";
$login = "root";
$pass = "";


    $connection = new PDO("mysql:host=$serveur;dbname=vihsida", $login, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $nom=$_SESSION['unite_c'];
    
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
         $this->Cell(276,5,'REPUBLIQUE DEMOCRATIQUE DU CONGO',0,0,'C');
         $this->Ln();
         $this->SetFont('Times','B',11);
         $this->Cell(276,5,'PROGRAMME NATIONAL DE LUTTE CONTRE LE VIH',0,0,'C');
         $this->Ln();
         $this->Ln();
         $this->Ln();
         $this->SetFont('Times','B',14);
         $this->Cell(276,5,'RAPPORT DES DONNEES DE LA STRUCTURE',0,0,'C');
         $this->Cell(276);
         $this->Image('pnmls.png',250,6,30);
         $this->Ln(20);
    }
    function footer(){
         $this->Sety(-15);
         $this->SetFont('Arial','',8);
         $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
    }
    function headerTable(){
         $this->SetFont('Times','B',12);
         $this->Cell(40,10,'Nom',1,0,'C');
         $this->Cell(40,10,'Prenom',1,0,'C');
         $this->Cell(40,10,'Telephone',1,0,'C');
         $this->Cell(40,10,'Sexe',1,0,'C');
         $this->Cell(20,10,'tester',1,0,'C');
         $this->Cell(20,10,'Retrait',1,0,'C');
         $this->Cell(20,10,'Positif',1,0,'C');
         $this->Cell(20,10,'Enc ou All',1,0,'C');
         $this->Cell(20,10,'ARV',1,0,'C');
         $this->Ln();
         
    }
    function viewTable($connection){
        $this->SetFont('Times','B',12);
        $stmt = $connection->query('SELECT * from fiche where unite_f=\''. $_SESSION['unite_c'] .'\'');
        while($user=$stmt->fetch(PDO::FETCH_OBJ))
        {
            $this->SetFont('Times','B',12);
            
            $this->Cell(40,10,$user->nom_p,1,0,'C');
            $this->Cell(40,10,$user->prenom_p,1,0,'L');
            $this->Cell(40,10,$user->telephone_p,1,0,'L');
            $this->Cell(40,10,$user->sexe_p,1,0,'L');
            $this->Cell(20,10,$user->test_p,1,0,'L');
            $this->Cell(20,10,$user->retrait_p,1,0,'L');
            $this->Cell(20,10,$user->positif_p,1,0,'L');
            $this->Cell(20,10,$user->femme_f,1,0,'L');
            $this->Cell(20,10,$user->sousarv_p,1,0,'L');
            $this->Ln();
        }    
    }  
    

}

 $pdf=new myPDF();
 $pdf->AliasNbPages();
 $pdf->AddPage('L','A4',0);
 $pdf->headerTable();
 $pdf->viewTable($connection);
 $pdf->Output();