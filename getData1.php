<?php

  require_once('includes/load.php');
 ?>
<?php
 global $db;
	/*$strSQL = "SELECT Date_Time,Product_Name,Count,Takt_time,usetime FROM a3 WHERE Date_Time BETWEEN '2022-05-02 08:00' AND '2022-05-03 08:00'";
  $i = 0;
  $ii = 1;
  $localtime = "08:00:00";
  $time = strtotime($localtime);
	$objQuery = $db->query($strSQL);
	$intNumField = mysqli_num_fields($objQuery);
	$rows = array();
	while($row = mysqli_fetch_array($objQuery)) {
		  $timein = $row[$i]['Date_Time'];
    	$rows[] = $row;
    	if 
}
	//print_r(json_encode($rows));
    

	
	//mysqli_close();
	
	echo json_encode($rows);
exit();*/


$query=$db->query("SELECT end_time as endtime,start_time as starttime FROM a3 WHERE Date_Time BETWEEN '2022-06-29 08:00' AND '2022-06-30 08:00'")or die(mysqli_error());

   
   $count = mysqli_num_rows($query);
   $avgtime = 0;
   while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
      $outputendtime = $row['endtime'];
      $outputstarttime = $row['starttime'];
      $timetotal =  (strtotime($outputendtime) - strtotime($outputstarttime));
      $avgtime = ($avgtime + $timetotal);
      echo $timetotal."</br>";
     }
     $avg = ($avgtime/$count);
     echo round($avg);

?>

