
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();}
require('fpdf.php');
include('inc/connect.php');
class PDF extends FPDF{

// Page header
function Header(){
    // Logo
    $this->Image('src/logo.png',95,30,40);
    // Arial bold 15
    $this->SetFont('Arial','B',12);
    // Move to the right
    $this->Cell(100);
	 $this->Ln(10);
    // Title
    $this->Cell(200,60,'KIMIRONKO CAR PARK',0,0,'C');
	$this->Ln(6);
	$this->SetFont('Arial','B',8);
	$this->Cell(200,100,'RECEIPT',10,0,'C');
   
}


// Page footer
function Footer(){
    // Position at 1.5 cm from bottom
    $this->SetY(-30);
    // Arial italic 8
    $this->SetFont('Arial','I',10);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$phone=$_SESSION['phone'];
$sql=mysqli_query($conn, "SELECT * FROM zones WHERE phone='$phone' and status='RESERVED'");
	while($row=mysqli_fetch_array($sql)){
// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',15);
$pdf->Ln(55);
$pdf->Cell(0,8,'______________________',0,1);
$pdf->SetFont('Times','',6);
$pdf->Cell(0,1,'Date: '. $row['d1'],0,1);
$pdf->SetFont('Times','',10);
$pdf->Cell(0,7,'Plate Number : '. $row['platenumber'],0,1);
$pdf->Cell(0,4,'Visa Card No. : '. $row['account'],0,1);
$pdf->Cell(0,6,'Amount : 120/-',0,1);
$pdf->Cell(30,5,'______________________',0,1);
$pdf->SetFont('Times','B',8);
$pdf->Cell(45,3,'Note: Parking Fee is not refundable',0,1,'C');
$pdf->SetFont('Times','',6);
$pdf->Cell(0,7,'You may need to provide this receipt on request',0,1);
//$pdf->Cell(0,7,'',0,1);
    
$pdf->Output();
}
?>