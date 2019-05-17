<?php require_once('../Connections/donation.php'); ?>
<?php
session_start();
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
$colname_Recordset5 = "-1";
if (isset($_GET['ID'])) {
  $colname_DetailDonation = $_GET['ID'];
}
mysql_select_db($database_donation, $donation);
$query_Recordset1 = "SELECT * FROM donationinfo 
inner join useraccount
on donationinfo.username=useraccount.username Where donationinfo.DonateID = $colname_DetailDonation";
$Recordset1 = mysql_query($query_Recordset1, $donation) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$colname_username = "-1";

  $colname_username = $row_Recordset1['username'];

$sum="SELECT SUM(Amount)
FROM donationinfo Where username ='$colname_username'
";
$Recordset2 = mysql_query($sum, $donation) or die(mysql_error());
$row = mysql_fetch_array($Recordset2);




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Donation Detail</title>
<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 50%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
   background:-o-linear-gradient(bottom, #4c4c4c 5%, #000000 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #4c4c4c), color-stop(1, #000000) );	background:-moz-linear-gradient( center top, #4c4c4c 5%, #000000 100% );	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#4c4c4c", endColorstr="#000000");	background: -o-linear-gradient(top,#4c4c4c,000000);
background-color:#4c4c4c;
border:0px solid #000000;
text-align:center;
border-width:0px 0px 1px 1px;
font-size:14px;
font-family:Arial;
font-weight:bold;
color:#ffffff;
}
</style>
<script>
function goBack() {
    window.history.back();
}
</script>
</head>

<body>
<button onclick="goBack()">Go Back</button>
<div align="center">

  <p style="color: rgb(0, 0, 0);
font-size: 50px;
font-family:arial;
text-shadow: rgb(71, 71, 71) 3px 2px 2px;">Donor Profile of <?php echo $row_Recordset1['Name']; ?></p>
  <table  border="1" id="customers">
    <tr>
      <th colspan="2"><div align="center">Donor Info</div></th>
      
    </tr>
    <tr>
      <td>DONATION ID:</td>
      <td><p style="color:red;"><strong>A<?php echo $row_Recordset1['DonateID']; ?></strong><strong></strong></p></td>
    </tr>
    <tr>
      <td width="144">ACCOUNT USERNAME:</td>
      <td width="164"><strong><?php echo $row_Recordset1['Username']; ?></strong></td>
    </tr>
    <tr>
      <td>NAME:</td>
      <td><?php echo $row_Recordset1['Name']; ?></td>
    </tr>
    <tr>
      <td>ADDRESS:</td>
      <td><?php echo $row_Recordset1['Address']; ?></td>
    </tr>
    <tr>
      <td>POSTCODE:</td>
      <td><?php echo $row_Recordset1['postcode']; ?></td>
    </tr>
    <tr>
      <td>TELEPHONE NO:</td>
      <td><?php echo $row_Recordset1['TelNo']; ?></td>
    </tr>
    <tr>
      <td>EMAIL:</td>
      <td><?php echo $row_Recordset1['email']; ?></td>
    </tr>
    <tr>
      <th colspan="2"><div align="center">Bank Info</div></th>
      
    </tr>
    <tr>
      <td>Bank Name:</td>
      <td><?php echo $row_Recordset1['BankName']; ?></td>
    </tr>
    <tr>
      <td>Bank Account No:</td>
      <td><?php echo $row_Recordset1['BankAccount']; ?></td>
    </tr>
    <tr>
      <td>Amount Donate:</td>
      <td>RM<?php echo $row_Recordset1['Amount']; ?></td>
    </tr>
    <tr>
      <td>Date Donate:</td>
      <td><?php echo date("d-m-Y",strtotime($row_Recordset1['DateDonate']));?> </td>
    </tr>
    <tr>
      <td>Donation Status:</td>
      <td><?php echo $row_Recordset1['Status']; ?></td>
    </tr>
    <tr>
      <td>Donation Duration Unverify:</td>
      
      
      
      
      
      <td><?php 
	  
	 $Date1=date("Y-m-d",strtotime($row_Recordset1['DateDonate']));
	 
	  
	  
	  $datetime1 = new DateTime($Date1);
$datetime2 = new DateTime('now');
$interval = $datetime1->diff($datetime2);
echo $interval->format('%R%a days');?></td>
    </tr>
    <tr>
      <td>Total Donation:</td>
      <td>RM<?php echo $row['SUM(Amount)']; ?></td>
    </tr>
  </table>
</div>
<p align="center">&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
