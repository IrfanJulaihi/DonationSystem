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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_Recordset1 = "-1";


  $colname_Recordset1 =$_SESSION['MM_Username'];


mysql_select_db($database_donation, $donation);
$query_Recordset1 = sprintf("SELECT * FROM useraccount WHERE username = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $donation) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


 $Username=$row_Recordset1['username'];
if (isset($_POST['Donation'])){
$DonationAmount=$_POST['Donation'];
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = "INSERT INTO donationinfo (username, Amount,DateDonate,Status) VALUES ('$Username','$DonationAmount',Now(),'Unverify')";
  mysql_select_db($database_donation, $donation);
  $Result1 = mysql_query($insertSQL, $donation) or die(mysql_error());

  $insertGoTo = "DonatorHomePage.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
   echo "<script>alert('Congratulations..!!You have successfully make a donation');
 window.location.href = 'DonatorHomePage.php';
  </script>";
  
}

 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Donation</title>
<link href="../css/TableCSSDonation.css" rel="stylesheet" type="text/css" >
<script>
function goBack() {
    window.history.back();
}
</script>
</head>

<body>
<button onclick="goBack()">Go Back</button>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>" onsubmit="return validate()">
  <div align="center">
    <p style="color: rgb(41, 6, 6);
font-size: 50px;
font-family:Arial;
text-shadow: rgb(230, 172, 172) -2px 5px 5px;"> NEW DONATION</p>
    <p style="color: rgb(41, 6, 6);
font-size: 50px;
font-family:Arial;
text-shadow: rgb(230, 172, 172) -2px 5px 5px;">
      
    </p>
    <table width="324" border="1" class="CSSTableGenerator">
      <tr>
        <td  colspan="2">DONATION INFORMATION:</td>
      </tr>
      
      <tr>
        <td width="144">NAME:</td>
        <td width="164"><span id="sprytextfield2">
          <label for="Name3"></label>
        </span><?php echo $row_Recordset1['Name']; ?></td>
      </tr>
      <tr>
        <td>Username</td>
        <td><span id="sprytextfield3">
        <label for="ICNO"></label>
        </span><?php echo $row_Recordset1['username']; ?></td>
      </tr>
      <tr>
        <td>Telephone No:</td>
        <td><span id="sprytextfield4">
          <label for="HomeAddress"></label>
        <?php echo $row_Recordset1['TelNo']; ?></span></td>
      </tr>
      <tr>
        <td>Email:</td>
        <td><span id="sprytextfield5">
          <label for="City"></label>
        <?php echo $row_Recordset1['email']; ?></span></td>
      </tr>
      <tr>
        <td>Address:</td>
        <td><?php echo $row_Recordset1['Address']; ?></td>
      </tr>
      <tr>
        <td>PostCode</td>
        <td><span id="sprytextfield6">
          <label for="DateOfBirth"></label>
        <?php echo $row_Recordset1['postcode']; ?></span></td>
      </tr>
      <tr>
        <td>Amount to donate:</td>
        <td><label for="Donation">RM:
            <input type="text" name="Donation" id="Donation"  required="required"/>
        </label></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><label for="Race">
          <input type="submit"  value="Donate" width="100" height="30" />
        </label></td>
      </tr>
    </table>
    <span id="sprytextfield1">
    </span></div>
  <span id="sprytextfield1">
  <label for="Name2"></label>
  <div align="center"></div>
  </span>
  <div align="center">
    <input type="hidden" name="MM_insert" value="form1" />
    
  </div>
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
