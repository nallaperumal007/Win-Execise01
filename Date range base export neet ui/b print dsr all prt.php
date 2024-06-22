
<?php
include('sdb.php');
include("sauth.php");
?>

<?php
session_start();
?>

<?php
$sno=1;

$porg=$_SESSION['2org'];

$fmdt=$_SESSION['2fdt'];
$todt=$_SESSION['2tdt'];

?>


<?php

	$a = "";		
	$b = "ALL ENTRIES....BOOKING &nbsp;&nbsp;DETAILS";		
	$title = $b;
$query =  "SELECT * from entry where bdt between '$fmdt' and '$todt'   and entusr = '".$_SESSION['username']."' order by bdt,dest,awbno,btype";
$result = mysqli_query($con, $query);
		
	?>
<?php
$count=1;

$queryc = "SELECT * from comp_info "; 
		$resultc = mysqli_query($con, $queryc) or die ( mysqli_error());
		$rowc = mysqli_fetch_assoc($resultc);

	$col= $rowc["comp_name"];
	$ctaxno= $rowc["taxcode"];
	
?>

<div style="text-align: center;">


<p style="font-size:100%" > &nbsp;&nbsp; <?php echo $col ; ?> &nbsp;&nbsp; </font> </p>

<p style="font-size:100%" ><strong><font size="5"><?php echo $a; ?></font></strong><?php echo $title; ?> </p>
<p style="font-size:100%" > Report From :
<strong><?php echo date('d M, Y', strtotime($fmdt)) ; ?> </strong>&nbsp;&nbsp; to &nbsp;&nbsp; 
<strong> <?php echo date('d M, Y', strtotime($todt)) ; ?> </strong></p>

  
  


<table border="1" style="left:0px;height:60px;width:100%;text-align:left;font-size:110%;border:1px solid gray;" >
  <tr>

        <td style="text-align: center;color:black;background-color:#E6E8E8;font-size:80%;">S.No</td>
        <td style="text-align: center;color:black;background-color:#E6E8E8;font-size:80%;" >User</font></td>
        <td style="text-align: center;color:black;background-color:#E6E8E8;font-size:80%;" >Inv.No</font></td>		
        <td style=" text-align: center;color:black;background-color:#E6E8E8;font-size:80%;" >Book.Date</td>
        <td style=" text-align: center;color:black;background-color:#E6E8E8;font-size:80%;" >Book Type</font></td>	
        <td style=" text-align: center;color:black;background-color:#E6E8E8;font-size:80%;" >CD.No</font></td>					
        <td style=" text-align: center;color:black;background-color:#E6E8E8;font-size:80%;" >ORG</td>
        <td style="text-align: center;color:black;background-color:#E6E8E8;font-size:80%;" >DEST</td>
		<td style=" text-align: center;color:black;background-color:#E6E8E8;font-size:80%;" >Pcs</td>
        <td style=" text-align: center;color:black;background-color:#E6E8E8;font-size:80%;" >A.Wgt</td>
        <td style=" text-align: center;color:black;background-color:#E6E8E8;font-size:80%;" >C.Wgt</td>
		<td style=" text-align: center;color:black;background-color:#E6E8E8;font-size:80%;" >Consignor</td>
		<td style=" text-align: center;color:black;background-color:#E6E8E8;font-size:80%;" >Consignee</td>
        <td style=" text-align: center;color:black;background-color:#E6E8E8;font-size:80%;" >E-Way.No</td>
		<td style=" text-align: center;color:black;background-color:#E6E8E8;font-size:80%;" >Cust_Inv.Val</td>

  </tr>

  <tr>

<?php
$count=1;
$tpcs=0;
$twgt=0;

?>





   <?php
   if(mysqli_num_rows($result) > 0)
   {
   ?>
	   
		      
    <?php
    while($row = mysqli_fetch_array($result))
    {
   ?>

  <tr style="color:white;"  id="<?php echo $row["id"]; ?>" >
  <td  style="width: 40px; text-align: center;font-size:100%;"><font color="black"><?php echo $count; ?></font></td></th>
  <td  style="text-align: center;font-size:60%;" ><font color="black"><?php echo $row["entusr"]; ?></td>
  <td  style="text-align: center;font-size:60%;" ><font color="black"><?php echo $row["invno"]; ?></td>  
  <td  style="width :130px;text-align: center;font-size:80%;" ><font color="black"><?php echo date('d-M, Y', strtotime($row["bdt"])); ?></td>
  <td  style="text-align: center;font-size:80%;" ><font color="black"><?php echo $row["btype"]; ?></td>
  <td style="width: 140px; text-align: center;color:black; " ><font size="5"><strong><?php echo $row["awbno"]; ?></strong></font></td>  

  <td  style=" text-align: center;font-size:80%;;color:black;"><?php echo $row["org"]; ?></td>
  <td  style=" text-align: center;font-size:100%;;color:black;"><?php echo $row["dest"]; ?></td>
  <td  style=" text-align: center;font-size:90%;;color:black;"><?php echo $row["pcs"]; ?></td>
  <td  style=" text-align: right;font-size:90%;;color:black;"><?php echo $row["awgt"]; ?></td>
  <td  style=" text-align: right;font-size:90%;;color:black;"><?php echo $row["cwgt"]; ?></td> 
    <td  style=" text-align: left;font-size:90%;;color:black;"><?php echo $row["custname"]; ?></td>
  <td  style=" text-align: left;font-size:90%;;color:black;"><?php echo $row["rname"]; ?></td>
 
  <td  style=" text-align: right;font-size:90%;;color:black;"><?php echo $row["ewayno"]; ?></td> 
    <td  style=" text-align: right;font-size:90%;;color:black;"><?php echo $row["cust_inv_val"]; ?></td>  
	

     </tr>
    </tbody>
   <?php
   $count++; 
   $tpcs = $tpcs + $row["pcs"]; 
   $tawgt = $tawgt + $row["awgt"]; 
   $twgt = $twgt + $row["cwgt"]; 

      }
   ?>
<tr>
	  <td  style="text-align: center;font-size:100%;"><font color="black"></font></td></th>
        <td style="text-align: center;color:black; " ><font size="5"></strong></font></td>
        <td style="text-align: center;color:black; " ></td> 
  		<td style="text-align: center;color:black; " ></td>    
		        <td style="text-align: center;color:black; " ></td> 
  		<td style="text-align: center;color:black; " ></td>     
        <td style="text-align: left;color:black;font-size:80%; " ></td>     
		<td style="text-align: left;color:black;font-size:80%; " ></td>   
		<td style="text-align: left;color:black;font-size:80%; " ></td> 
				<td style="text-align: left;color:black;font-size:80%; " ></td>   	  		        
		<td style="text-align: center;color:black;background-color:#E6E8E8;font-size:120%; " ><?php echo $tpcs; ?></td>
        <td style="text-align: center;color:black;background-color:#E6E8E8;font-size:120%; " ><?php echo $tawgt; ?></td>
        <td style="text-align: center;color:black;background-color:#E6E8E8;font-size:120%; " ><?php echo $tcwgt; ?></td>           

</tr>
    </table>
	


   </div>
   <?php
   }
   ?>
   
</div></td></tr></table>

