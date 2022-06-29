<?php require_once('Connections/SQLmy.php'); ?>
<?php
$maxRows_IndexRecordset = 3;
$pageNum_IndexRecordset = 0;
if (isset($_GET['pageNum_IndexRecordset'])) {
  $pageNum_IndexRecordset = $_GET['pageNum_IndexRecordset'];
}
$startRow_IndexRecordset = $pageNum_IndexRecordset * $maxRows_IndexRecordset;

mysql_select_db($database_SQLmy, $SQLmy);
$query_IndexRecordset = "SELECT * FROM db3";
$query_limit_IndexRecordset = sprintf("%s LIMIT %d, %d", $query_IndexRecordset, $startRow_IndexRecordset, $maxRows_IndexRecordset);
$IndexRecordset = mysql_query($query_limit_IndexRecordset, $SQLmy) or die(mysql_error());
$row_IndexRecordset = mysql_fetch_assoc($IndexRecordset);

if (isset($_GET['totalRows_IndexRecordset'])) {
  $totalRows_IndexRecordset = $_GET['totalRows_IndexRecordset'];
} else {
  $all_IndexRecordset = mysql_query($query_IndexRecordset);
  $totalRows_IndexRecordset = mysql_num_rows($all_IndexRecordset);
}
$totalPages_IndexRecordset = ceil($totalRows_IndexRecordset/$maxRows_IndexRecordset)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
<table border="1" cellspacing="1" cellpadding="1" align="center" style="margin-top: 58px">
  <tr>
    <td colspan="4" align="right">新增</td>
  </tr>
  <tr>
    <td colspan="4">從x~y共z筆</td>
  </tr>
  <tr>
    <td>ID</td>
    <td>Name</td>
    <td>Old</td>
    <td>Addr</td>
  </tr>
  
  <?php do { ?>
  <tr>
    <td><?php echo $row_IndexRecordset['ID']; ?></td>
    <td><?php echo $row_IndexRecordset['Name']; ?></td>
    <td><?php echo $row_IndexRecordset['Old']; ?></td>
    <td><?php echo $row_IndexRecordset['Addr']; ?></td>
  </tr>
  <?php } while ($row_IndexRecordset = mysql_fetch_assoc($IndexRecordset)); ?>
</table>

</body>
</html>
<?php
mysql_free_result($IndexRecordset);
?>
