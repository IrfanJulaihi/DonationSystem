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

$colname_Recordset1 = "-1";
if (isset($_GET['DonateID'])) {
  $colname_Recordset1 = $_GET['DonateID'];
}
mysql_select_db($database_donation, $donation);
$query_Recordset2 = sprintf("SELECT * FROM donationinfo WHERE DonateID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset2 = mysql_query($query_Recordset2, $donation) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_Recordset1 = "-1";

  $colname_Recordset1 = $_SESSION['MM_Username'];;

mysql_select_db($database_donation, $donation);
$query_Recordset1 = "SELECT * FROM donationinfo 
inner join useraccount
on donationinfo.Username=useraccount.username 
WHERE useraccount.username='$colname_Recordset1'";

$Recordset1 = mysql_query($query_Recordset1, $donation) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body onload="window.print()">

<pre>
Mohd Irfan bin Julaihi
Yayasan Jantung Malaysia
Titiwangsa,Kuala Lumpur
56000
ifanunik@gmail.com

<?php echo 'now()';?>

Dear <?php echo $row_Recordset1['Name']; ?><br>
I want to take the time to sincerely thank you for your donation to this NGO As you know, we started this campaign to raise fund towards , and your RM<?php echo $row_Recordset2['Amount']; ?> contribution on <?php echo $row_Recordset2['DateDonate']; ?> helps us get one step closer to our goal.
Thanks again for your generosity and support,

[Handwrite your name and campaign name]
</pre>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
