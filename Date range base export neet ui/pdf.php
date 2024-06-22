<?php
require_once('tcpdf/tcpdf.php'); // Include TCPDF library

include_once("sdb.php");

$forg = $_REQUEST['org'];

$_SESSION['2org'] = $_REQUEST['org'];

$fmdt = $_SESSION['2fdt'];
$todt = $_SESSION['2tdt'];
$ab = $_SESSION['username'];

$sql_query = "SELECT bdt,awbno,btype,trans,org,dest,pcs,awgt,cwgt,netval,custname,rname,ewayno,cust_inv_val,upi_ref,cltd_by,rem from entry where bdt between '$fmdt' and '$todt'  and entusr = '".$_SESSION['username']."' order by bdt,org,dest,awbno,btype ";
$resultset = mysqli_query($con, $sql_query) or die("database error:". mysqli_error($con));

// Create new PDF instance
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Booking Details Report');
$pdf->SetSubject('Booking Details Report');
$pdf->SetKeywords('Booking, Details, Report');

// Set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', 'B', 12);

// REPORT HEADER
$columnHeaderu = $_SESSION['username'];
$columnHeader1 = "BOOKING DETAILS ...From.." . $fmdt . "-to-" . $todt;

$columnHeader = "Booking Date" . "\t" . "AWBNO" . "\t" . "Book Type" . "\t" . "Mode" . "\t" . "Origin" . "\t" . "Destination" . "\t" . "Pieces" . "\t" . "Act.Weight" . "\t" . "Char.Weight" . "\t" . "Freight Value" . "\t" . "Consignor Name" . "\t" . "Consignee Name" . "\t" . "E-Way No" . "\t" . "Invoice Value" . "\t" . "UPI-REF" . "\t" . "CLTD-BY" . "\t" . "Remarks" . "\t";

$row2 = array();
while ($rows = mysqli_fetch_assoc($resultset)) {
    $row2[] = $rows;
}

$html = '<h1>' . ucwords($columnHeaderu) . '</h1>';
$html .= '<h2>' . ucwords($columnHeader1) . '</h2>';
$html .= '<table border="1">';
$html .= '<tr>';
$headers = explode("\t", $columnHeader);
foreach ($headers as $header) {
    $html .= '<th>' . $header . '</th>';
}
$html .= '</tr>';
foreach ($row2 as $row) {
    $html .= '<tr>';
    foreach ($row as $cell) {
        $html .= '<td>' . $cell . '</td>';
    }
    $html .= '</tr>';
}
$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('booking_details.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
