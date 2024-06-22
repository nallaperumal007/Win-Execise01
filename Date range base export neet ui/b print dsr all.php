
<?php
include('sdb.php');
include("sauth.php");
include("b print dsr all xls.php");
include('header.php');
?>


<?php
session_start();
?>

<?php
$sno=1;

$fmdt=$_SESSION['2fdt'];
$todt=$_SESSION['2tdt'];

?>

<!-- Branch list -->
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- jQuery -->

<?php

	$a = "";		
	$b = "ALL ENTRIES....BOOKING &nbsp;&nbsp;DETAILS";		
		$title = $a.$b;	
$query =  "SELECT * from entry where bdt between '$fmdt' and '$todt' and entusr = '".$_SESSION['username']."'     order by bdt,awbno,dest";
$result = mysqli_query($con, $query);
		

	
?>





<script>
       function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
</script>
<style type="text/css">
<!--
.style5 {font-weight: bold}
-->
</style>
  

<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.navbar3 {
  overflow: hidden;
  background-color: #ffe3ba;
  position: fixed;
  top: 50;
  width: 100%;
    padding: 8px;
}

.navbar4 
{
  overflow: hidden;
  background-color: #E6E7E8;
  position: fixed;
  width: 100%;
    padding: 8px;
  margin-top: 90px;
}


.navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.navbar a:hover {
  background: #f1f1f1;
  color: black;
}

.navbar a.active {
  background-color: #04AA6D;
  color: white;
}

.main {
  padding: 16px;
  margin-bottom: 30px;
}
</style>

</head>
<script>
function goBack() {
  window.history.back();
}
</script>


<body>

<div class="navbar3" align="center" >
  <button style="text-align: center;width:100px;" ><a href="dash branch.php"><font clor="black">Dashboard</a> </button>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <button style="text-align: center;width:100px;" onClick="goBack()" ><font clor="black">Back</a> </button>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <l  style="text-align: center;width:200px;" ><strong><?php echo  $title; ?> </strong></l>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <l  style="text-align: right;width:100px;"  ><a href="slogout.php"><font clor="black">Logout</a></l>
  
  </font></l>
</div>

</body>
</html>


<!-- Branch list -->

<div id="container">
</strong>
<form action="" method="post" name="myform" class="style5" id="myForm"  >
<input type="hidden" name="new" value="1" />
<!--
<input class="button1" type="submit"  value="CHECK--LIST---PRINT" name='prt'  confirm('Print...Are you sure?') style="position:absolute; width:209px; left:854px; top:235px; font-size:130%; text-align: center; font-size:130%; color:white; font-weight: bold; z-index:220; height: 72px;" >
   -->
   
   <!-- Recieved -->
 

<l style="position:absolute; overflow:hidden; left:287px; top:135px; width:75px; height:22px;font-size:100%;color:black;text-align: center;color:white;background-color:#333333;z-index:22">From</l>

<input type="fmdt" type="text" value="<?php echo  date('d M, Y', strtotime($fmdt)); ?>"   style="position:absolute;width:125px;left:355px;top:135px;border:1px solid black;text-align: center;color:red;font-size:100%;z-index:5">
 
<input type="todt"  name="text2" type="text"  style="position:absolute;width:125px;left:580px;top:135px;border:1px solid black;text-align: center;color:red;font-size:100%;z-index:5" value="<?php echo  date('d M, Y', strtotime($todt)); ?>" />

   <l style="position:absolute; overflow:hidden; left:516px; top:135px; width:64px; height:22;font-size:100%;color:black;text-align: center;color:white;background-color:#333333;z-index:22">to</l>
   
    


  <!DOCTYPE html>
<html>
  
<head>
  <style>
  
  
#content{
    border:1px solid darkgrey;
    border-radius:3px;
    padding:5px;
    width: 98%;
    margin: 0 auto;
  margin-top:190px;
}

.p1 {
  font-family: "Times New Roman", Times, serif;
}



/* Table */
#emp_table {
    border:3px solid lavender;
    border-radius:3px;

}

/* Table header */

.tr_header th a{
    color: white;
    text-decoration: none;
}


    .fixTableHead {
      overflow-y: auto;
      height: 400px;
    }
    .fixTableHead thead th {
      position: sticky;
      top: 0;
    }
	
	
	
    table {
      border-collapse: collapse;        
      width: 100%;
    }
    th,
    td {
      padding: 8px 15px;
      border: 1px solid darkgrey;
    }
    th {
      background: dodgerblue;
    }
	.tr_header th
	{
    color:white;
    padding:7px 0px;
    letter-spacing: 1px;
}


/* Table rows and columns */
#emp_table td{
    padding:5px;
}
#emp_table tr:nth-child(even){
    background-color:lavender;
    color:black;
	
}

#div_pagination{
    width:100%;
    text-align:center;
}

td.fitwidth 
{
    width: 1px;
    white-space: nowrap;
}


  </style>
</head>
  
  <?php
  $sno = 1;
  ?>
  
<body>
  <div id="content"  class="fixTableHead">
    <table id="myTable" width="100%" id="emp_table" class="p1">
      <th class="fitwidth" ead >
	          <tr class="tr_header" >
			  
<th class="fitwidth"  class="fitwidth"  align="center" style="font-size: 15px;width:3%;"  >S.No </td>
<th class="fitwidth"  align="center" style="color:white;background-color:green;text-align: center;">INVOICE NO</th>
<th class="fitwidth"  align="center" style="color:white;background-color:green;text-align: center;">E </th>
<th class="fitwidth"  width="30%" align="center" style="color:white;background-color:red;text-align: center;">X </th>
<th class="fitwidth"  align="center" style=" text-align: center;color:white;background-color:#0080ff;font-size:100%;">Date</b></th>
<th class="fitwidth"  align="center" style=" text-align: center;color:white;background-color:#0080ff;font-size:100%;">Type</b></th>
<th class="fitwidth"  align="center" style=" text-align: center;color:white;background-color:#0080ff;font-size:100%;">Mode</b></th>

			<th class="fitwidth"  style="background-color: #CACAC7 " ><input name="name" id="myInput" type="text" maxlength=15 autocomplete="off" onKeyUp="myFunction()" placeholder="Find AWB.No" style="text-align: center;font-size:100%;color:black;width:110px;">
	&nbsp;	</th>
	
<th class="fitwidth"  align="center" style=" text-align: center;color:white;background-color:#0080ff;font-size:100%;">ORG</b></th>
<th class="fitwidth"  align="center" style=" text-align: center;color:white;background-color:#0080ff;font-size:100%;">DEST</b></th>

<th class="fitwidth"  align="center" style=" text-align: center;color:white;background-color:#0080ff;font-size:100%;">PCS</th>
<th class="fitwidth"  align="center" style=" text-align: center;color:white;background-color:#0080ff;font-size:100%;">A-WGT</th>
<th class="fitwidth"  align="center" style=" text-align: center;color:white;background-color:#0080ff;font-size:100%;">C-WGT</th>	
<th class="fitwidth"  align="center" style=" text-align: center;color:white;background-color:#0080ff;font-size:100%;">Amount</th>	
		
			<th class="fitwidth"  style="background-color: #CACAC7 " ><input name="name" id="myInput1" type="text" maxlength=15 autocomplete="off" onKeyUp="myFunction1()" placeholder="Find Consignor" style="text-align: center;font-size:100%;color:black;width:210px;">
	&nbsp;	</th>
	
<th class="fitwidth"  align="center" style=" text-align: center;color:white;background-color:#0080ff;font-size:100%;width:210px;">Consignee</th>

<th class="fitwidth"  align="center" style="background-color:#0080ff;color:white;font-size:100%;">E-Way No</th>
<th class="fitwidth"  align="center" style="background-color:#0080ff;color:white;font-size:100%;">Cust.Inv.Value</th>
<th class="fitwidth"  align="center" style="background-color:#0080ff;color:white;font-size:100%;">UPI-Ref</th>
<th class="fitwidth"  align="center" style="background-color:#0080ff;color:white;font-size:100%;">Cltd-BY</th>
<th class="fitwidth"  align="center" style="background-color:#0080ff;color:white;font-size:100%;">Payment-Remarks</th>

</th>


<?php

$count1 =1;
	
foreach ($con->query($query) as $row2 ) 
{?>

		<tr>
<td class="fitwidth" align="center"><?php echo $count1; ?></td>
<td class="fitwidth" style="text-align: center;color:black;font-size:100%;z-index:16" ><?php echo $row2["invno"]?></a></td>
<td class="fitwidth" style="text-align: center;background-color:F1F0F1" ><a href="b ho awb find chk prt.php?awbno=<?php echo $row2["awbno"]; ?>"></font><strong><img src="images/edt-but.png" width=17 height=17></a></strong></td>



<td class="fitwidth" style=" text-align: center;background-color:F1F0F1" id=delete onClick="ConfirmDelete()" ><a onClick=\"javascript: return confirm("Delete Entry...");\" href="javascript:delete_id(<?php echo $row2["awbno"]; ?>)"><font color="red"><img src="images/del-but.png" width=17 height=17></a></font></a></td>

<td class="fitwidth" style="text-align: center;color:black;font-size:100%;z-index:16" ><?php echo date("d-M, Y", strtotime($row2["bdt"])); ?></td>
<td class="fitwidth" style="text-align: center;color:black;font-size:100%;z-index:16" ><?php echo $row2["btype"]?></a></td>
<td class="fitwidth" style="text-align: center;color:black;font-size:100%;z-index:16" ><?php echo $row2["trans"]?></a></td>

<td class="fitwidth" style="text-align: center;color:black;font-size:100%;z-index:16" ><?php echo $row2["awbno"]?></a></td>
<td class="fitwidth" style="text-align: center;color:red;font-size:100%;z-index:16" ><?php echo $row2["org"]?></a></td>
<td class="fitwidth" style="text-align: center;color:blue;font-size:100%;z-index:16" ><?php echo $row2["dest"]?></a></td>
	<td class="fitwidth" style="text-align: center;color:black;font-size:100%;z-index:16"><?php echo $row2["pcs"]?></a></td>
	<td class="fitwidth" style="text-align: right;color:black;font-size:100%;z-index:16"><?php echo $row2["awgt"]?></a></td>
	<td class="fitwidth" style="text-align: right;color:black;font-size:100%;z-index:16"><?php echo $row2["cwgt"]?></a></td>
	
	<?php
	if (  $row2['btype'] != "CREDIT" )
	{
	$tval =$row2['netval'];
	?>
	<td class="fitwidth" style="text-align: right;color:black;font-size:100%;color:red;z-index:16"><?php echo $row2['netval']?></a></td>
<?php
}
else
{
$tval ='0';
?>

	<td class="fitwidth" style="text-align: right;color:black;font-size:100%;z-index:16"></td>

<?php
}
?>
	
	<td class="fitwidth" style="text-align: left;color:black;font-size:100%;color:black;z-index:16"><?php echo $row2['custname']?></a></td>
	<td class="fitwidth" style="text-align: left;color:black;font-size:100%;color:black;z-index:16"><?php echo $row2['rname']?></a></td>


 	<td class="fitwidth" style="text-align: right;color:black;font-size:100%;z-index:16"><?php echo $row2['ewayno']?></a></td>
	<td class="fitwidth" style="text-align: right;color:black;font-size:100%;z-index:16"><?php echo $row2['cust_inv_val']?></a></td> 
	<td class="fitwidth" style="text-align: center;color:black;font-size:100%;z-index:16"><?php echo $row2['upi_ref']?></a></td> 
	<td class="fitwidth" style="text-align: left;color:black;font-size:100%;z-index:16"><?php echo $row2['cltd_by']?></a></td> 
		<td class="fitwidth" style="text-align: left;color:black;font-size:100%;z-index:16"><?php echo $row2['rem']?></a></td>   
 

<?php
	$count1++; 

	$tpcs =$tpcs+$row2["pcs"];
	$tawgt =$tawgt+$row2["awgt"]; 
	$tcwgt =$tcwgt+$row2["cwgt"]; 
	$ttval =$ttval+$tval; 
$tcd = $count1-1;

} 	
?>

</tr>
<tr>
<td class="fitwidth" align="center"></td>

<td class="fitwidth" style=" text-align: center;font-size:70%;background-color:F1F0F1" ><a href=""></font><strong></a></strong></td>


<td class="fitwidth" style=" text-align: center;font-size:70%;background-color:F1F0F1" ></strong></td>

<td class="fitwidth" ></td>


<td class="fitwidth" style="text-align: left;color:black;font-size:100%;z-index:16" ></td>
<td class="fitwidth" style="text-align: center;color:red;font-size:90%;z-index:16" ></td>
<td class="fitwidth" style="text-align: center;color:blue;font-size:90%;z-index:16" ></td>
<td class="fitwidth" style="text-align: center;color:blue;font-size:90%;z-index:16" ></td>
	<td class="fitwidth" style="text-align: left;color:black;font-size:80%;color:black;z-index:16"></td>
	<td class="fitwidth" style="text-align: left;color:black;font-size:80%;color:black;z-index:16"></td>

	<td class="fitwidth" style="width:50px;text-align: center;color:black;font-size:100%;z-index:16"><?php echo $tpcs ?></td>
	<td class="fitwidth" style="width:100px;text-align: right;color:black;font-size:100%;z-index:16"><?php echo $tawgt ?></td>
	<td class="fitwidth" style="width:100px;text-align: right;color:black;font-size:100%;z-index:16"><?php echo $tcwgt ?></td>
	<td class="fitwidth" style="width:100px;text-align: right;color:black;font-size:100%;color:red;z-index:16"><?php echo $ttval ?></td>
		
  
<?php  echo "</table>"; 
?>

</tr>
</tr>
</div>
</div>
</div>


<input name="totcd" type="text" value ="<?php echo $tcd; ?>"  readonly style="position:absolute; overflow:hidden; left:919px; top:128px; width:130px; font-size:100%;color:red;text-align: center;border:1px solid black;z-index:22">
   <input name="rpcs" type="text" value ="<?php echo $tpcs ; ?>"  readonly style="position:absolute; overflow:hidden; left:919px; top:152px; width:130px; font-size:100%;color:red;text-align: center;border:1px solid black;z-index:22">
  <input name="rwgt" type="text" value ="<?php echo $tcwgt ; ?>" readonly style="position:absolute; overflow:hidden; left:919px; top:176px; width:130px; font-size:100%;color:red;text-align: center;border:1px solid black;z-index:22"> 
  




<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">					
				<button type="submit" id="export_data" name='export_data' value="Export to excel" class="btn btn-info" style="position:absolute;width:152px; left:1072px; top:125px; text-align: center;  z-index:220; ">Export to excel</button>
			</form>

<a href="b print dsr all prt.php"> <button type="button" class="btn btn-info" style="position:absolute; width:152px; left:1072px; top:165px; font-size:100%; text-align: center; color:white z-index:220; " ><font color="white">Print Report</</a></button>
			
			
<script>
function goBack() {
    window.history.go(-1);
}
</script>


</body>
  </html>  
</form>




<strong>
<!--  Delete Singe Record  -->
<script type="text/javascript">function delete_id(id)
{
     if(confirm('Delete This Record ?'))
     {
        window.location.href='b awb del.php?id='+id;
     }
}
</script>


</strong>
<l style="position:absolute; overflow:hidden; left:818px; top:128px; width:99px; height:22;font-size:100%;color:black;text-align: center;color:white;background-color:#0080ff;z-index:22">Tot. AWB </l>

<l style="position:absolute; overflow:hidden; left:818px; top:152px; width:99; height:22;font-size:100%;color:black;text-align: center;color:white;background-color:#0080ff;z-index:22">Tot. Pcs.. </l>

<l style="position:absolute; overflow:hidden; left:818px; top:178px; width:99; height:22;font-size:100%;color:black;text-align: center;color:white;background-color:#0080ff;z-index:22">Tot. Wgt. </l>
<!--
<l style="position:absolute; overflow:hidden; left:818px; top:204px; width:99; height:22;font-size:100%;color:black;text-align: center;color:white;background-color:#999999;z-index:22">Tot. Value. </l>
-->




<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[7];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</strong>

<script>
function myFunction1() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput1");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[14];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

