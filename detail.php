<?php require_once('Connections/SQLmy.php'); ?>
<?php
$colname_detailRecordset = "-1";
if (isset($_GET['id'])) {
  $colname_detailRecordset = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_SQLmy, $SQLmy);
$query_detailRecordset = sprintf("SELECT * FROM db3 WHERE ID = %s", $colname_detailRecordset);
$detailRecordset = mysql_query($query_detailRecordset, $SQLmy) or die(mysql_error());
$row_detailRecordset = mysql_fetch_assoc($detailRecordset);
$totalRows_detailRecordset = mysql_num_rows($detailRecordset);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
<table width="100" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td>ID</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="text" name="" value="" /></td>
    <td><input type="text" name="" value="" /></td>
    <td><input type="text" name="" value="" /></td>
    <td><input type="text" name="" value="" /></td>
  </tr>
  <tr>
    <td><input type="submit" name="" value="更新" /></td>
    <td>刪除</td>
  </tr>
</table>

</body>
</html>
<?php
mysql_free_result($detailRecordset);
?>
