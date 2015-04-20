<?php
require('fpdf.php');
require_once('../includes/db.class.inc');
require_once('../includes/session.inc');
require_once('../includes/utilities.inc');
if(olm_session_get_role() != 'Admin')
    {
    //  echo 'redirecting to home';
        header("Location:/m140163cs/olm/index.php");
    }

class PDF extends FPDF {

/*function Header() {
    // Logo
    $this->Image('../assets/images/logo-white.jpg',10,6,20);
    // Arial bold 15
    $this->SetFont('Arial','B',16);
    // Move to the right
    $this->Cell(20);
    $this->Cell(30,5,'CSED LIBRARY','C');
    $this->Ln(6);
    $this->Cell(20);
    $this->SetFont('Arial','',12);
    $this->Cell(30,5,'Department of Computer Science','C');
    $this->Ln(6);
    $this->Cell(20);
    $this->Cell(30,5,'NIT Calicut','C');
    $this->Ln(10);
    
    $this->Cell(75);
    $this->SetFont('Arial','BU',16);
    $this->Cell(30,10,'Users Lists','C');
    // Line break
    $this->Ln(20);
}*/

function generateCertificate($roll_no,$fine) {
    // Column widths
    // print_r($roll_no);
        $this->Cell(190,7,$roll_no,1,0,'C');

       // $this->Cell(195,6,$roll_no,1,'LR');
        $this->Ln();
        $this->Cell(95,7,'Amount Due',1,0,'L');

        $this->Cell(95,7,$fine,1,0,'L');
        $this->Ln();
        $this->Cell(190,30,'',1,1,'R','');
        $this->Cell(190,7,'ABC XYZ',1,0,'R');
        $this->Ln();
        $this->Cell(190,7,'Librarian',1,0,'R');
         $this->Ln();

  
    $this->Cell(190,0,'','T');
}


}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  $roll_no = check_input($_POST['roll_no']);
//print_r($roll_no);
   $db_connection = new DBConnection;
   $db_connection->connect();
   $notes = $db_connection->get_notifications($roll_no);
   $db_connection->disconnect();
      $pdf = new PDF();
//print_r($notes);
//$data = array(array('India','New Delhi','123456','1000000000'));

$pdf->SetFont('Arial','',12);
$pdf->AddPage();
$pdf->generateCertificate($roll_no,$notes['fine']);
$pdf->Output();

}

else {
    header("Location:generate_certificate.php");
}

?>