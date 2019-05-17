<?php require_once('../Connections/donation.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}










$MM_authorizedUsers = "1";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../donatorpage/DonatorHomePage.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
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

mysql_select_db($database_donation, $donation);




$query_Recordset1 = "SELECT * FROM donationinfo 

";
$Recordset1 = mysql_query($query_Recordset1, $donation) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


$sum="SELECT SUM(Amount)
FROM donationinfo
";
$Recordset2 = mysql_query($sum, $donation) or die(mysql_error());
$row = mysql_fetch_array($Recordset2);

$sum="SELECT COUNT(Amount)
FROM donationinfo
";
$Recordset4 = mysql_query($sum, $donation) or die(mysql_error());
$rowCount = mysql_fetch_array($Recordset4);




$query_Recordset3 = "SELECT * FROM donationinfo";
$Recordset3 = mysql_query($query_Recordset3, $donation) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Page</title>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script>
function changeAction(val){
    document.getElementById('SearchForm').setAttribute('action', val);

}
</script>
</head>
<link href="../css/TableCSSCode.css" rel="stylesheet" type="text/css" >
<link href="../cssmenu/styles.css" rel="stylesheet" type="text/css" >
</head>
<body background="file:///C|/xampp/htdocs/InternProject/images/bg.gif">
<p><img src="../01_sedc_logo (1).gif" width="175" height="67" alt="NGO LOGO" />
</p>
<span style="font-weight:normal;position: absolute; top: 12px; left: 1064px;color:#000000;letter-spacing:1pt;word-spacing:2pt;font-size:20px;text-align:left;font-family:arial black, sans-serif;line-height:1;"> You logged in as ,<span style="text-shadow:1px 1px 1px rgba(107,107,107,1);font-weight:normal;color:#2CC746;letter-spacing:1pt;word-spacing:2pt;font-size:25px;text-align:left;font-family:arial black, sans-serif;line-height:1;">ADMIN</span></span>
<p>&nbsp;</p>
<p style="text-shadow:1px 1px 1px rgba(255,240,105,1);font-weight:normal;color:#000000;background-color:#FFFCFC;letter-spacing:1pt;word-spacing:2pt;font-size:35px;text-align:center;font-family:arial black, sans-serif;line-height:1;margin:0px;padding:0px;">DONATION TRACKING SYSTEM</p>
<p>Welcome,<strong><?php echo $_SESSION['MM_Username']?></strong></p>
<div id='cssmenu'>
  <ul id="MenuBar1" class="MenuBarHorizontal" align="center">
    <li><a class="MenuBarItemSubmenu" href="RegisteredUser.php">Account Management</a>
  
    </li>
   
    	
    <li><a href="../Logout.php">Logout</a></li>
  </ul>
</div>
<p>&nbsp;</p>



<div align="center" >
  <table width="263%" border="1" class="CSSTableGenerator" align="center">
    <tr>
    </td><td width="120"><div align="center">No.</div></td>
      <td width="98"><div align="center">Donation ID</div>
     
      <td width="111"><div align="center">Username </div></td>
      <td width="130"><div align="center">Donation Amount</div></td>
      <td width="137"><div align="center">Date of Donation</div></td>

      <td width="134"><div align="center">Status</div></td>
      <td width="165"><div align="center">Modify</div></td>
      </tr>
    <?php $count=1; ?>
    <?php for($a=0;$a<$rowCount['COUNT(Amount)'];$a++) { ?>
      <tr>
        <td><div align="center"><?php echo $count++; ?></div></td>
        <td align="center"><div align="center"> <a href="AdminViewDetailDonation.php?ID=<?php echo $row_Recordset1['DonateID'];?>">A<?php echo $row_Recordset1['DonateID']; ?></a></div></td>
        
        
        <td><div align="center"><?php echo $row_Recordset1['Username']; ?></div></td>
        <td><div align="center">RM<?php echo $row_Recordset1['Amount']; ?></div></td>
        
        <td><div align="center"><?php echo $row_Recordset1['DateDonate']; ?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['Status']; ?></div></td>
        <!--Code to change the color of status-->
        <td><a href="DonationUpdate.php?ID=<?php echo $row_Recordset1['DonateID']; ?>" >
        <input type="button" style="background-color:Green;" name="button3" id="button3" value="Verified" onclick="" />
        </a> <a href="DonationDelete.php?ID=<?php echo $row_Recordset1['DonateID']; ?>" >
        <input type="button" style="background-color:Red;" name="button3" id="button3" value="Delete" onclick="" />
        </a> </td>
        
        <?php $row_Recordset1 = mysql_fetch_assoc($Recordset1); }  ?>
    </tr>
</table>
</div>
<p><?php echo $rowCount['COUNT(Amount)'];?> records found.<br>

</p>
<p>Total Donation:RM<?php echo $row['SUM(Amount)']; ?></p>
<p>&nbsp;</p>
<p>&nbsp; </p>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
  </script>
</body>
</html>
<?php

mysql_free_result($Recordset1);
?>
