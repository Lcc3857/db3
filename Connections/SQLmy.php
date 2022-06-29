<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_SQLmy = "localhost";
$database_SQLmy = "db3";
$username_SQLmy = "root";
$password_SQLmy = "12345678";
$SQLmy = mysql_pconnect($hostname_SQLmy, $username_SQLmy, $password_SQLmy) or trigger_error(mysql_error(),E_USER_ERROR); 
?>