<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_donation = "localhost";
$database_donation = "donation";
$username_donation = "root";
$password_donation = "";
$donation = mysql_pconnect($hostname_donation, $username_donation, $password_donation) or trigger_error(mysql_error(),E_USER_ERROR); 
?>