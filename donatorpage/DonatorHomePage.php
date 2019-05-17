<?php require_once('../Connections/donation.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "2";
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

$MM_restrictGoTo = "../adminpage/AdminHomePage.php";
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

$colname_Recordset1 = "-1";

  $colname_Recordset1 = $_SESSION['MM_Username'];

mysql_select_db($database_donation, $donation);
$query_Recordset1 = sprintf("SELECT * FROM donationinfo WHERE Username = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $donation) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Page</title>
<script>
function changeAction(val){
    document.getElementById('SearchForm').setAttribute('action', val);

}
</script>
</head>
<link href="TableCSSCode.css" rel="stylesheet" type="text/css" >
<link href="../css/TableCSSCode.css" rel="stylesheet" type="text/css" >
<link href="../cssmenu/styles.css" rel="stylesheet" type="text/css" >
</head>
<body background="../../images/bg.gif">
<p><img src="../../01_sedc_logo (1).gif" width="175" height="67" alt="NGO LOGO" />
</p>
<p style="font-weight:normal;color:#000000;position: absolute; top: 12px; left: 1064px;letter-spacing:1pt;word-spacing:2pt;font-size:20px;text-align:left;font-family:arial black, sans-serif;line-height:1;">You logged in as, <span style="text-shadow:1px 1px 1px rgba(107,107,107,1);font-weight:normal;color:#0F2FFC;letter-spacing:1pt;word-spacing:2pt;font-size:25px;text-align:left;font-family:arial black, sans-serif;line-height:1;">Staff </span></p>
<p>&nbsp;</p>
<p style="text-shadow:1px 1px 1px rgba(255,240,105,1);font-weight:normal;color:#000000;background-color:#FFFCFC;letter-spacing:1pt;word-spacing:2pt;font-size:35px;text-align:center;font-family:arial black, sans-serif;line-height:1;margin:0px;padding:0px;">DONATION TRACKING SYSTEM</p>
<p>Welcome,<strong><?php echo $_SESSION['MM_Username']?></strong></p>
<div align="center"> </div>
<div id='cssmenu'>
  <ul id="MenuBar1" class="MenuBarHorizontal" align="center">
    <li><a class="MenuBarItemSubmenu" href="NewDonation.php">New Donation</a>
  
    </li>
    <li><a href="EditProfileDonators.php" class="MenuBarItemSubmenu">Edit Profile</a>
    
    </li>
    
    <li><a href="../Logout.php">Logout</a></li>
  </ul>
</div>
<p><?php echo $totalRows_Recordset1?> records found.</p>
<div align="center">
  <table width="263%" border="1" class="CSSTableGenerator">
    <tr>
    </td><td width="120"><div align="center">No.</div></td>
      <td width="98"><div align="center">Donation ID</div>
      <td width="120"><div align="center">Name of Donor</div></td>
      <td width="130"><div align="center">Donation Amount</div></td>
      <td width="137"><div align="center">Date of Donation</div></td>
     
      <td width="134"><div align="center">Status</div></td>
      <td width="134"><div align="center">Receipt</div></td>
      </tr>
    <?php $count=1; ?>
    <?php do { ?>
      <tr>
        
        <td><div align="center"><?php echo $count++; ?></div></td>
        <td><div align="center">A<?php echo $row_Recordset1['DonateID']; ?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['Username']; ?></div></td>
        <td><div align="center">RM<?php echo $row_Recordset1['Amount']; ?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['DateDonate']; ?></div></td>
        
        <td><div align="center"><?php echo $row_Recordset1['Status']; ?></div></td>
        <td>
         <?php if ($row_Recordset1['Status']=='Unverify'){?>
     <a href="DonationThanksLetter.php?DonateID=<?php echo $row_Recordset1['DonateID']; ?>" >
         <div align="center" ><input type="hidden" style="background-color:#00FFFF;" name="button3" id="button3" value="Print" onClick="" />
        </a></div>
      <?php }elseif($row_Recordset1['Status']=='Verified'){?>
      <a href="DonationThanksLetter.php?DonateID=<?php echo $row_Recordset1['DonateID']; ?>" >
       <div align="center"> <input type="button" style="background-color:#00FFFF;" name="button3" id="button3" value="Print" onClick="" /></div>
        </a><?php }?>
       
        
        
        
        </td>
       
        
        
        <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </tr>
</table>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp; </p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
