<?php
require('fpdf.php');
require_once('../includes/utilities.inc');
require_once('../includes/search.inc');
require_once('../includes/session.inc');
require_once('../includes/db.class.inc');

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
    $this->Cell(30,10,'Overdue Report','C');
    // Line break
    $this->Ln(20);
}

function addTable($header, $data) {
    // Column widths
    $w = array(30, 80, 30, 50);
    // Header
    if(empty($data)) {
        $this->Cell(190,6,'No Overdue Records',1,'C');
        $this->Ln();
        return;
    }

    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        $this->Cell($w[0],6,'CSED-'.convert_4digits($row['bid']),1,'LR');
        $this->Cell($w[1],6,substr($row['title'],0,80),1,'LR');
        $this->Cell($w[2],6,$row['uid'],1,'LR');
        $this->Cell($w[3],6,substr($row['name'],0,50),1,'LR');
        $this->Ln();
    }
    
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}


}

$pdf = new PDF();
$header = array('Book ID', 'Title', 'User ID', 'Name');

$db_connection = new DBConnection;
$db_connection->connect();
$result = $db_connection->dquery('SELECT book.bid, book.title, issue.return_date, issue.issue_date,user.uid,user.name FROM book,issue,user where (book.bid=issue.bid AND user.uid=issue.uid AND issue.return_date<CURRENT_DATE())');

$data = array();
$i = 0;
if(!$result)
    return false;
while($row = mysql_fetch_assoc($result)) {
    $data[$i++] = $row;
}
//$db_connection->query('user', 'bid,name,email,type', null,null,null);
//print_r($result);


//$data = array(array('India','New Delhi','123456','1000000000'));

$pdf->SetFont('Arial','',12);
$pdf->AddPage();
$pdf->addTable($header,$data);
$pdf->Output();
?>