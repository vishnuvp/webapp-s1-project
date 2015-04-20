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

function Header() {
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
}

function addTable($header, $data) {
    // Column widths
    $w = array(30, 60, 80, 25);
     if(empty($data)) {
        $this->Cell(190,6,'No Users Found',1,'C');
        $this->Ln();
        return;
    }
    // Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row['uid'],1,'LR');
        $this->Cell($w[1],6,$row['name'],1,'LR');
        $this->Cell($w[2],6,$row['email'],1,'LR');
        $this->Cell($w[3],6,$row['info'],1,'LR');
        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}


}

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if($_POST['report_type'] == 1) {
        $sem = check_input($_POST['s_info']);

        $db_connection = new DBConnection;
        $db_connection->connect();
        $data = $db_connection->query('user', 'uid,name,email,info', "TYPE='STUDENT' AND info='$sem'",null,null);
        //print_r($result);
        $db_connection->disconnect();
        $header = array('User ID', 'Name', 'Email ID', 'Semester');
    }

    else if($_POST['report_type'] == 2) {
        $f_info = check_input($_POST['f_info']);
        $db_connection = new DBConnection;
        $db_connection->connect();
        $data = $db_connection->query('user', 'uid,name,email,info', "TYPE='FACULTY' AND info='$f_info'",null,null);
        //print_r($result);
        $db_connection->disconnect();
        $header = array('User ID', 'Name', 'Email ID', 'Faculty Type');

    }

}

$pdf = new PDF();

//$data = array(array('India','New Delhi','123456','1000000000'));

$pdf->SetFont('Arial','',12);
$pdf->AddPage();
$pdf->addTable($header,$data);
$pdf->Output();
?>