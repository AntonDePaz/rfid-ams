<?php 

require 'fpdf.php';
include '../includes/session.php';


class mypdf extends FPDF
{
	function header(){
		// $this->Image('',10,6);
		$this->SetFont('Arial','B',12);
		$this->Cell(276,5,'SSC ATTENDANCE',0,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->Cell(276,10,'Sogod Southern Leyte',0,0,'C');
		$this->Ln(20);
	}
	function footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	function headerTable(){
		$this->SetFont('Times','B',10);
		$this->Cell(20,10,'ID',1,0,'C');
		$this->Cell(35,10,'IDNUMBER',1,0,'C');
		$this->Cell(45,10,'FIRSTNAME',1,0,'C');
		$this->Cell(45,10,'LASTNAME',1,0,'C');
		$this->Cell(20,10,'YEAR',1,0,'C');
		$this->Cell(25,10,'SECTION',1,0,'C');
		$this->Cell(55,10,'COURSE',1,0,'C');
		$this->Cell(45,10,'MAJOR',1,0,'C');
		$this->Ln();

	}
	function viewtable($conn){
		$this->SetFont('Times','',12);
		$sql = "SELECT * FROM students".$_SESSION['sy_id']." where sem".$_SESSION['sem_id']." = 1 ";
        $query = $conn->query($sql);
        while($row = $query->fetch_assoc()){

        	$this->Cell(20,10,'ID',1,0,'C');
			$this->Cell(35,10,$row['id_number'],1,0,'C');
			$this->Cell(45,10,$row['firstname'],1,0,'C');
			$this->Cell(45,10,$row['lastname'],1,0,'C');
			$this->Cell(20,10,$row['year'],1,0,'C');
			$this->Cell(25,10,$row['section'],1,0,'C');
			$this->Cell(55,10,$row['course'],1,0,'C');
			$this->Cell(45,10,$row['major'],1,0,'C');
			$this->Ln();

        }

	}
	
}

$pdf = new mypdf();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewtable($conn);
$pdf->Output();















 ?>