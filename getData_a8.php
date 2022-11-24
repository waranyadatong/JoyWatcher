<?php
  require_once('includes/load.php');
  /*$page = $_SERVER['PHP_SELF'];
  $now = time();
  $today = strtotime('8:00');
  $tomorrow = strtotime('tomorrow 8:00');
  if (($today - $now) > 0) {
    $refreshTime = $today - $now;
  } else {
    $refreshTime = $tomorrow - $now;
  }
  header("Refresh: $refreshTime; url=$page");
?>

<?php*/
  //$page = $_SERVER['PHP_SELF'];
  $the_now = strtotime(date('H:i:s'));
  $the_time8 = strtotime(date('H:i:s',strtotime('08:00:01')));
  $the_time12 = strtotime(date('H:i:s',strtotime('12:00:01')));
  $the_time24 = strtotime(date('H:i:s',strtotime('00:00:01')));

  if ($the_time8 > $the_now) {
    $Start = date('Y-m-d H:i:s',date(strtotime("+0 day", mktime(8,0,0))));
    $End = date('Y-m-d H:i:s',date(strtotime("+1 day", mktime(8,0,0))));
  } elseif ($the_time12 < $the_now) {
    $Start = date('Y-m-d H:i:s',date(strtotime("+0 day", mktime(8,0,0))));
    $End = date('Y-m-d H:i:s',date(strtotime("+1 day", mktime(8,0,0)))); 
  } elseif ($the_time24 < $the_now) {
    $Start = date('Y-m-d H:i:s',date(strtotime("+0 day", mktime(8,0,0))));
    $End = date('Y-m-d H:i:s',date(strtotime("+1 day", mktime(8,0,0)))); 
  } else {
    $Start = date('Y-m-d H:i:s',date(strtotime("-1 day", mktime(8,0,0))));
    $End = date('Y-m-d H:i:s',date(strtotime("+0 day", mktime(8,0,0)))); 
  }
  global $db;
	$strSQL = "SELECT Date_Time,Product_Name,Count,start_time,end_time FROM a8 WHERE Date_Time BETWEEN '$Start' AND '$End'";
	$objQuery = $db->query($strSQL);
	$intNumField = mysqli_num_fields($objQuery);
	$rows = array();
	while($row = mysqli_fetch_array($objQuery)){
    $rows[] = $row;
  }
	//print_r(json_encode($rows));  
	echo json_encode($rows);
  exit();
?>
  
