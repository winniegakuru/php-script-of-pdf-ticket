# php-script-of-pdf-ticket
a dynamic php script to auto generate a pdf file

Download FPDF library from www.fpdf.org/download ;a zip file and extract it. For PHP use the file fpdf.php from the extracted fpdf.zip file. Put the fpdf.php in the same location as the your php file say Reciept.php. Include the file to your Reciept.php file.

require('fpdf.php');
we divide the page into 2 sections: header ( ) , table( ) and footer( ).
function header will look like this;
                           function Header()
{$name ='Winnie';
$phone= '+254701008108';
$date= date("Y/m/d");
    // Logo the path and name of the image,x-location, Y-position and size
    $this->Image('logo.png',40,13,30);
    // function font type,bold and size
    $this->SetFont('Arial','B',20);
//color in rgb format
     $this->SetTextColor(128,0,255);
    // Move to the right/X-position
    $this->Cell(80);
    // Title; width, height, title,border(LRTB),line, alignment
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
function Loaddata( )
function LoadData($file)
{   //variables
     $ename='Trans summit';
     $company ='SyncSoft';
     $location='View Park Towers';
     $cserial ='Env/1233';
     $ttype ='2341657';
     $tcode='tytre';
     $mount = 'today';
     $ecode= 'sumit3';
//an array containing data to bepopulated to the table
     $lines=array("Event Name: ".$ename." ;Event code:$ecode",
             "Company Name: ".$company." ;Company Code: $cserial.;",              
             "Ticket Type: ".$ttype." ;Ticket Code: $tcode.;",
              "Event Location: ".$location." ;Amount: $mount.;",);
    $data = array();
    foreach($lines as $line)
//uses ; to mark the end of a cell and , to mark the end of a column
        $data[ ] = explode(';',trim($line));
    return $data;
}
function Table( )
function FancyTable($data)
{ // y-position   
$Y = 50;
    $Y_Fields_Name_position = 90;
    $Y_Table_Position = 96;
    $this->SetY($Y); 
     
   // Colors, line width and bold font    
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
     $w = array(80, 80, 10, 10);
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
     foreach($data as $row)
    {   $this-> SetX(25);
// cellwidth , height, text, (left,right,top,bottom) margin, border,alignment
        $this->Cell($w[0],14,$row[0],'LRTB',0,'L');
        $this->Cell($w[1],14,$row[1],'LRTB',0,'L');
        $this->Ln( );
    }
function footer ( )
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




the above functions are inserted inside a class PDF( )
the class looks like this:
class PDF extends FPDF
{
function header ( )
funtion loaddata( )
function table ( )
function footer ( )
}
and finally adding the class.
// Instanciation of inherited class
$pdf = new PDF();
// Column headings
// Data loading
$data = $pdf->LoadData();
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->FancyTable($data);
$pdf->Output();

