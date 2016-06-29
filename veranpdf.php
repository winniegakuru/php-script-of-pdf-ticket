<?php
require('fpdf.php');
 

class PDF extends FPDF
{
// Page header
function Header()
{$name ='Winnie';
$phone= '+254701008108';
$date= date("Y/m/d");
    // Logo
    $this->Image('logo.png',40,13,30);
    // Arial bold 15
    $this->SetFont('Arial','B',20);
     $this->SetTextColor(128,0,255);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(25,20,'Veran Events Ticket',0,0,'C');

//overides the above settings
    $this->SetFont('Arial','I',12);
     $this->SetTextColor(0);
    $this->Cell(-40);
    $this->Cell(25,35,'Name: '.$name.'');
    $this->Cell(-25);
    $this->Cell(25,45,'Phone No.: '.$phone.'');
    $this->Cell(-25);
    $this->Cell(25,55,'Date: '.$date.'');
    // Line break
    $this->Ln(10);
}
function LoadData($file)
{   
     $ename='Trans summit';
     $company ='SyncSoft';
     $location='View Park Towers';
     $cserial ='Env/1233';
     $ttype ='2341657';
     $tcode='tytre';
     $mount = 'today';
     $ecode= 'sumit3';
     $lines=array("Event Name: ".$ename." ;Event code:$ecode",
             "Company Name: ".$company." ;Company Code: $cserial.;",              
             "Ticket Type: ".$ttype." ;Ticket Code: $tcode.;",
              "Event Location: ".$location." ;Amount: $mount.;",);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}
 
// Colored table
function FancyTable($data)
{   $Y = 50;
    $Y_Fields_Name_position = 90;
    $Y_Table_Position = 96;
    $this->SetY($Y); 
     
   // Colors, line width and bold font
    
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(80, 80, 10, 10);
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
     foreach($data as $row)
    {   $this-> SetX(25);
        $this->Cell($w[0],14,$row[0],'LRTB',0,'L');
        $this->Cell($w[1],14,$row[1],'LRTB',0,'L');
        $this->Ln();
    }
    
}
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-13);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
$this->Cell(0,10,'Designed by winnie(+254701008108)',0,0,'C'); 
$this->SetY(-18);   
$this->Cell(0,10,'www.veranevents.com',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
// Column headings
//$header = array('det', 'details');
// Data loading
$data = $pdf->LoadData();
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->FancyTable($data);
$pdf->Output();
?>
