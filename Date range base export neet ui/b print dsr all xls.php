<?php
include_once("sdb.php");


$forg=$_REQUEST['org'];

$_SESSION['2org']=$_REQUEST['org'];

$fmdt=$_SESSION['2fdt'];
$todt=$_SESSION['2tdt'];
$ab =$_SESSION['username'];

$sql_query = "SELECT bdt,awbno,btype,trans,org,dest,pcs,awgt,cwgt,netval,custname,rname,ewayno,cust_inv_val,upi_ref,cltd_by,rem from entry where bdt between '$fmdt' and '$todt'  and entusr = '".$_SESSION['username']."' order by bdt,org,dest,awbno,btype ";
$resultset = mysqli_query($con, $sql_query) or die("database error:". mysqli_error($con));

//REPORT  HEADER

$columnHeaderu = $_SESSION['username'];  
$columnHeader1 = "BOOKING DETAILS ...From..".$fmdt."-to-".$todt; 

$columnHeader = "Booking Date" . "\t" . "AWBNO" ."\t" . "Book Type" .  "\t" . "Mode" . "\t" . "Origin" . "\t" . "Destination" . "\t" . "Pieces" . "\t" . "Act.Weight" ."\t" . "Char.Weight" ."\t" . "Freight Value" ."\t" . "Consignor Name" . "\t" . "Consignee Name" . "\t" . "E-Way No" ."\t" . "Invoice Value" ."\t" . "UPI-REF" ."\t" . "CLTD-BY" ."\t". "Remarks" ."\t" ;  
		$setData = '';  
		
		
		
$row2 = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
	$row2[] = $rows;
}	

//header("Content-type: application/octet-stream");  
//header("Content-Disposition: attachment; filename=User_Detail.xls");  
//header('Content-Disposition: attachment; filename="'.$tit.'.xls"'); 
header("Pragma: no-cache");  
header("Expires: 0");  


echo ucwords($columnHeaderu) . "\n" . $setData . "\n"; 
echo ucwords($columnHeader1) . "\n" . $setData . "\n";  
echo ucwords($columnHeader) . "\n" . $setData . "\n";  
  
if(isset($_POST["export_data"])) {	
	//$filename = $forg."_bookings_".date('Ymd') . ".xls";
	$filename = "User_".$ab."_".$fmdt."_".$todt. ".xls";		
	
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=\"$filename\"");	
	$show_coloumn = false;
	if(!empty($row2)) {
	  foreach($row2 as $record) {
		if(!$show_coloumn) {
		  // display field/column names in first row
		  //echo implode("\t", array_keys($record)) . "\n";
		  //$show_coloumn = true;
		}
		echo implode("\t", array_values($record)) . "\n";
	  }
	}
	exit;  
}
?>
