<?php require_once('Connections/SQLmy.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

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

$queryString_IndexRecordset = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_IndexRecordset") == false && 
        stristr($param, "totalRows_IndexRecordset") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_IndexRecordset = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_IndexRecordset = sprintf("&totalRows_IndexRecordset=%d%s", $totalRows_IndexRecordset, $queryString_IndexRecordset);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
<table border="1" cellspacing="1" cellpadding="1" align="center" style="margin-top: 58px">
  <tr>
    <td colspan="4" align="right"><a href="add.php">新增</a></td>
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
  
  <tr>
    <td><a href="<?php printf("%s?pageNum_IndexRecordset=%d%s", $currentPage, 0, $queryString_IndexRecordset); ?>">第一頁</a></td>
    <td>
	  <a href="<?php printf("%s?pageNum_IndexRecordset=%d%s", $currentPage, max(0, $pageNum_IndexRecordset - 1), $queryString_IndexRecordset); ?>">上一頁</a>
	</td>
    <td>
	  <a href="<?php printf("%s?pageNum_IndexRecordset=%d%s", $currentPage, min($totalPages_IndexRecordset, $pageNum_IndexRecordset + 1),                   $queryString_IndexRecordset); ?>">下一頁</a>
	</td>
    <td><a href="<?php printf("%s?pageNum_IndexRecordset=%d%s", $currentPage, $totalPages_IndexRecordset, $queryString_IndexRecordset); ?>">最後頁</a></td>
  </tr>
</table>

</body>
</html>
<?php
mysql_free_result($IndexRecordset);
?>
