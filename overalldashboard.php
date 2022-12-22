<?php
	setcookie("PHPSESSID", "", time() - 3600);
	date_default_timezone_set('Asia/Bangkok');
	$page_title = 'Joy Watcher';
	require_once('includes/load.php');
	$page = $_SERVER['PHP_SELF'];
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

<?php
	$the_now = strtotime(date('H:i:s'));
	$the_time = strtotime(date('H:i:s', strtotime('08:00:00')));

	if (isset($_POST['rev']) && $_POST['rev'] == 1) {
		if ($the_time < $the_now) {
			$Start = date('Y-m-d H:i:s', date(strtotime("+0 day", mktime(8,0,0))));
			$End = date('Y-m-d H:i:s', date(strtotime("+1 day", mktime(8,0,0))));
		} else {
			$Start = date('Y-m-d H:i:s', date(strtotime("-1 day", mktime(8,0,0))));
			$End = date('Y-m-d H:i:s', date(strtotime("+0 day", mktime(8,0,0))));
		}

      	global $db;
      	$output = 0;
      	$query = "SELECT count(*) AS total FROM a3 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$result = $db->query($query);
      	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        	$output = $output + $row['total'];
      	}
  
      	$timetotal = 0;
      	$querytime = "SELECT Date_time AS t,Takt_time as tak FROM a3 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resulttime = $db->query($querytime);
      	while ($row = $resulttime->fetch_array(MYSQLI_ASSOC)) {
         	//$takt = $row['tak'];
         	$outputtime = strtotime($row['t']);
         	//$out = $outputtime + $takt;
         	$timetotal = ($outputtime - strtotime($Start))/60;
      	}

      	$avgtime = 0;
      	$timeSecond = 0;
      	$av = 0;
      	$Timeavg = date('H:i:s',strtotime('08:00:00'));
      	$queryavg = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a3 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultavg = $db->query($queryavg);
      	$count = mysqli_num_rows($resultavg);
      	$FirstRun = true;
      	while ($row = $resultavg->fetch_array(MYSQLI_ASSOC)) {
         	if ($FirstRun){ 
            	$FirstRun = false;
            	$starttimeFirst = $row['starttime'];
            	$timeFirst = (strtotime($starttimeFirst) - strtotime($Start)); 
            	if($timeFirst < 300) {
               		$av = ($av + $timeFirst);
            	}
         	} else { 
            	$endtimeSecond = strtotime($row['endtime']);
            	$starttimeSecond = strtotime($row['starttime']); 
            	$takttimeSecond = $row['takttime']; 
            	$Eavg = $endtimeSecond + $takttimeSecond;
            	$timeSecond =  ($Eavg - $starttimeSecond);
            	if($timeSecond < 300) {
               		$avgtime = ($avgtime + $timeSecond);
            	}
         	}    
      	}
      
      	$AVG = ($avgtime + $av);
      	if ($AVG > 0){
         	$avg = ($AVG / $count);
      	} else {
         	$avg = 0;
      	}
      	$processingtime = ($output * $avg)/60;  

      	$Timerunstop = date('H:i:s',strtotime('08:00:00'));
      	$queryrunstop = "SELECT Takt_time as tk,start_time as st,end_time as et FROM a3 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultrunstop = $db->query($queryrunstop);
      	$First=true;
      	$MinFirst = 0;
      	$MaxFirst = 0;
      	$Mintt = 0;
      	$Maxtt = 0;
      	while ($row = $resultrunstop->fetch_array(MYSQLI_ASSOC)) {
         	if ($First){
            	$First = false;
            	$runstartFirst = $row['st'];
            	$timerunstop = (strtotime($runstartFirst) - strtotime($Start));
            	if ($timerunstop < 300){
               		$MinFirst = ($MinFirst + $timerunstop);
            	} else {
               		$MaxFirst = ($MaxFirst + $timerunstop);
            	}
         	} else {
            	$runstopFirst = strtotime($row['et']);
            	$runstopstarttime = strtotime($row['st']);
            	$tk = $row['tk'];  
            	$Erunstop = $runstopFirst + $tk;
            	$timett =  ($Erunstop - $runstopstarttime);
            	if ($timett < 300){
               		$Mintt = ($Mintt + $timett);
            	} else {
               		$Maxtt = ($Maxtt + $timett);
            	}
         	}
      	}

      	$totalrun = ($MinFirst + $Mintt)/60;
      	//$totalstop = ($MaxFirst + $Maxtt)/60;
      	$totalstop = (round($timetotal) - round($totalrun));
   
      	if ($totalrun > 0){
         	$pruntime = (round($totalrun)/round($timetotal))*100;
      	} else {
         	$pruntime = 0;   
      	}

      	if ($totalstop > 0){
         	$pstoptime = (round($totalstop)/round($timetotal))*100;
      	} else {
         	$pstoptime = 0;   
      	}   
      	/* --------------------------- A-3 --------------------------- */

      	$outputA1 = 0;
      	$queryA1 = "SELECT count(*) AS total FROM a1 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultA1 = $db->query($queryA1);
      	while ($rowA1 = $resultA1->fetch_array(MYSQLI_ASSOC)) {
        	$outputA1 = $outputA1 + $rowA1['total'];
      	}
  
      	$timetotalA1 = 0;
      	$querytimeA1 = "SELECT Date_time AS t,Takt_time as tak FROM a1 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resulttimeA1 = $db->query($querytimeA1);
      	while ($rowA1 = $resulttimeA1->fetch_array(MYSQLI_ASSOC)) {
         	//$takt = $row['tak'];
         	$outputtimeA1 = strtotime($rowA1['t']);
         	//$out = $outputtime + $takt;
         	$timetotalA1 = ($outputtimeA1 - strtotime($Start))/60;
      	}

      	$avgtimeA1 = 0;
      	$timeSecondA1 = 0;
      	$avA1 = 0;
      	$TimeavgA1 = date('H:i:s',strtotime('08:00:00'));
      	$queryavgA1 = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a1 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultavgA1 = $db->query($queryavgA1);
      	$countA1 = mysqli_num_rows($resultavgA1);
      	$FirstRunA1 = true;
      	while ($rowA1 = $resultavgA1->fetch_array(MYSQLI_ASSOC)) {
         	if ($FirstRunA1){ 
            	$FirstRunA1 = false;
            	$starttimeFirstA1 = $rowA1['starttime'];
            	$timeFirstA1 = (strtotime($starttimeFirstA1) - strtotime($Start)); 
            	if($timeFirstA1 < 300) {
               		$avA1 = ($avA1 + $timeFirstA1);
            	}
         	} else { 
            	$endtimeSecondA1 = strtotime($rowA1['endtime']);
            	$starttimeSecondA1 = strtotime($rowA1['starttime']); 
            	$takttimeSecondA1 = $rowA1['takttime']; 
            	$EavgA1 = $endtimeSecondA1 + $takttimeSecondA1;
            	$timeSecondA1 =  ($EavgA1 - $starttimeSecondA1);
            	if($timeSecondA1 < 300) {
               		$avgtimeA1 = ($avgtimeA1 + $timeSecondA1);
            	}
         	}    
      	}
      
      	$AVGA1 = ($avgtimeA1 + $avA1);
      	if ($AVGA1 > 0){
         	$avgA1 = ($AVGA1/$countA1);
      	} else {
         	$avgA1 = 0;
      	}
      	$processingtimeA1 = ($outputA1 * $avgA1)/60;  

      	$TimerunstopA1 = date('H:i:s',strtotime('08:00:00'));
      	$queryrunstopA1 = "SELECT Takt_time as tk,start_time as st,end_time as et FROM a1 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultrunstopA1 = $db->query($queryrunstopA1);
      	$FirstA1 = true;
      	$MinFirstA1 = 0;
      	$MaxFirstA1 = 0;
      	$MinttA1 = 0;
      	$MaxttA1 = 0;
      	while ($rowA1 = $resultrunstopA1->fetch_array(MYSQLI_ASSOC)) {
         	if ($FirstA1){
            	$FirstA1 = false;
            	$runstartFirstA1 = $rowA1['st'];
            	$timerunstopA1 = (strtotime($runstartFirstA1) - strtotime($Start));
            	if ($timerunstopA1 < 300){
               		$MinFirstA1 = ($MinFirstA1 + $timerunstopA1);
            	} else {
               		$MaxFirstA1 = ($MaxFirstA1 + $timerunstopA1);
            	}
         	} else {
            	$runstopFirstA1 = strtotime($rowA1['et']);
            	$runstopstarttimeA1 = strtotime($rowA1['st']);
            	$tkA1 = $rowA1['tk'];  
            	$ErunstopA1 = $runstopFirstA1 + $tkA1;
            	$timettA1 =  ($ErunstopA1 - $runstopstarttimeA1);
            	if ($timettA1 < 300){
               		$MinttA1 = ($MinttA1 + $timettA1);
            	} else {
               		$MaxttA1 = ($MaxttA1 + $timettA1);
            	}
         	}
      	}

      	$totalrunA1 = ($MinFirstA1 + $MinttA1)/60;
      	//$totalstop = ($MaxFirst + $Maxtt)/60;
      	$totalstopA1 = (round($timetotalA1) - round($totalrunA1));
   
      	if ($totalrunA1 > 0){
         	$pruntimeA1 = (round($totalrunA1)/round($timetotalA1))*100;
      	} else {
         	$pruntimeA1 = 0;   
      	}

      	if ($totalstopA1 > 0){
         	$pstoptimeA1 = (round($totalstopA1)/round($timetotalA1))*100;
      	} else {
         	$pstoptimeA1 = 0;   
      	} 
      	/* --------------------------- A-1 --------------------------- */

		$outputA2 = 0;
      	$queryA2 = "SELECT count(*) AS total FROM a2 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultA2 = $db->query($queryA2);
      	while ($rowA2 = $resultA2->fetch_array(MYSQLI_ASSOC)) {
        	$outputA2 = $outputA2 + $rowA2['total'];
      	}
  
      	$timetotalA2 = 0;
      	$querytimeA2 = "SELECT Date_time AS t,Takt_time as tak FROM a2 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resulttimeA2 = $db->query($querytimeA2);
      	while ($rowA2 = $resulttimeA2->fetch_array(MYSQLI_ASSOC)) {
         	//$takt = $row['tak'];
         	$outputtimeA2 = strtotime($rowA2['t']);
         	//$out = $outputtime + $takt;
         	$timetotalA2 = ($outputtimeA2 - strtotime($Start))/60;
      	}

      	$avgtimeA2 = 0;
      	$timeSecondA2 = 0;
      	$avA2 = 0;
      	$TimeavgA2 = date('H:i:s',strtotime('08:00:00'));
      	$queryavgA2 = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a2 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultavgA2 = $db->query($queryavgA2);
      	$countA2 = mysqli_num_rows($resultavgA2);
      	$FirstRunA2 = true;
      	while ($rowA2 = $resultavgA2->fetch_array(MYSQLI_ASSOC)) {
         	if ($FirstRunA2){ 
            	$FirstRunA2 = false;
            	$starttimeFirstA2 = $rowA2['starttime'];
            	$timeFirstA2 = (strtotime($starttimeFirstA2) - strtotime($Start)); 
            	if($timeFirstA2 < 300) {
               		$avA2 = ($avA2 + $timeFirstA2);
            	}
         	} else { 
            	$endtimeSecondA2 = strtotime($rowA2['endtime']);
            	$starttimeSecondA2 = strtotime($rowA2['starttime']); 
            	$takttimeSecondA2 = $rowA2['takttime']; 
            	$EavgA2 = $endtimeSecondA2 + $takttimeSecondA2;
            	$timeSecondA2 = ($EavgA2 - $starttimeSecondA2);
            	if($timeSecondA2 < 300) {
               		$avgtimeA2 = ($avgtimeA2 + $timeSecondA2);
            	}
         	}    
      	}
      
      	$AVGA2 = ($avgtimeA2 + $avA2);
      	if ($AVGA2 > 0){
         	$avgA2 = ($AVGA2 / $countA2);
      	} else {
         	$avgA2 = 0;
      	}
      	$processingtimeA2 = ($outputA2 * $avgA2)/60;  

      	$TimerunstopA2 = date('H:i:s',strtotime('08:00:00'));
      	$queryrunstopA2 = "SELECT Takt_time as tk,start_time as st,end_time as et FROM a2 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultrunstopA2 = $db->query($queryrunstopA2);
      	$FirstA2 = true;
      	$MinFirstA2 = 0;
      	$MaxFirstA2 = 0;
      	$MinttA2 = 0;
      	$MaxttA2 = 0;
      	while ($rowA2 = $resultrunstopA2->fetch_array(MYSQLI_ASSOC)) {
         	if ($FirstA2){
            	$FirstA2 = false;
            	$runstartFirstA2 = $rowA2['st'];
            	$timerunstopA2 = (strtotime($runstartFirstA2) - strtotime($Start));
            	if ($timerunstopA2 < 300){
               		$MinFirstA2 = ($MinFirstA2 + $timerunstopA2);
            	} else {
               		$MaxFirstA2 = ($MaxFirstA2 + $timerunstopA2);
            	}
         	} else {
            	$runstopFirstA2 = strtotime($rowA2['et']);
            	$runstopstarttimeA2 = strtotime($rowA2['st']);
            	$tkA2 = $rowA2['tk'];  
            	$ErunstopA2 = $runstopFirstA2 + $tkA2;
            	$timettA2 =  ($ErunstopA2 - $runstopstarttimeA2);
            	if ($timettA2 < 300){
               		$MinttA2 = ($MinttA2 + $timettA2);
            	} else {
               		$MaxttA2 = ($MaxttA2 + $timettA2);
            	}
         	}
      	}

      	$totalrunA2 = ($MinFirstA2 + $MinttA2)/60;
      	//$totalstop = ($MaxFirst + $Maxtt)/60;
      	$totalstopA2 = (round($timetotalA2) - round($totalrunA2));
   
      	if ($totalrunA2 > 0){
         	$pruntimeA2 = (round($totalrunA2)/round($timetotalA2))*100;
      	} else {
         	$pruntimeA2 = 0;   
      	}

      	if ($totalstopA2 > 0){
         	$pstoptimeA2 = (round($totalstopA2)/round($timetotalA2))*100;
      	} else {
         	$pstoptimeA2 = 0;   
      	}   
      	/* --------------------------- A-2 --------------------------- */

      	$outputA4 = 0;
      	$queryA4 = "SELECT count(*) AS total FROM a4 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultA4 = $db->query($queryA4);
      	while ($rowA4 = $resultA4->fetch_array(MYSQLI_ASSOC)) {
        	$outputA4 = $outputA4 + $rowA4['total'];
      	}
  
      	$timetotalA4 = 0;
      	$querytimeA4 = "SELECT Date_time AS t,Takt_time as tak FROM a4 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resulttimeA4 = $db->query($querytimeA4);
      	while ($rowA4 = $resulttimeA4->fetch_array(MYSQLI_ASSOC)) {
         	//$takt = $row['tak'];
         	$outputtimeA4 = strtotime($rowA4['t']);
         	//$out = $outputtime + $takt;
         	$timetotalA4 = ($outputtimeA4 - strtotime($Start))/60;
      	}

      	$avgtimeA4 = 0;
      	$timeSecondA4 = 0;
      	$avA4 = 0;
      	$TimeavgA4 = date('H:i:s',strtotime('08:00:00'));
      	$queryavgA4 = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a4 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultavgA4 = $db->query($queryavgA4);
      	$countA4 = mysqli_num_rows($resultavgA4);
      	$FirstRunA4 = true;
      	while ($rowA4 = $resultavgA4->fetch_array(MYSQLI_ASSOC)) {
         	if ($FirstRunA4){ 
            	$FirstRunA4 = false;
            	$starttimeFirstA4 = $rowA4['starttime'];
            	$timeFirstA4 = (strtotime($starttimeFirstA4) - strtotime($Start)); 
            	if($timeFirstA4 < 300) {
               		$avA4 = ($avA4 + $timeFirstA4);
            	}
         	} else { 
            	$endtimeSecondA4 = strtotime($rowA4['endtime']);
            	$starttimeSecondA4 = strtotime($rowA4['starttime']); 
            	$takttimeSecondA4 = $rowA4['takttime']; 
            	$EavgA4 = $endtimeSecondA4 + $takttimeSecondA4;
            	$timeSecondA4 = ($EavgA4 - $starttimeSecondA4);
            	if($timeSecondA4 < 300) {
               		$avgtimeA4 = ($avgtimeA4 + $timeSecondA4);
            	}
         	}    
      	}
      
      	$AVGA4 = ($avgtimeA4 + $avA4);
      	if ($AVGA4 > 0){
         	$avgA4 = ($AVGA4 / $countA4);
      	} else {
         	$avgA4 = 0;
      	}
      	$processingtimeA4 = ($outputA4 * $avgA4)/60;  

      	$TimerunstopA4 = date('H:i:s',strtotime('08:00:00'));
      	$queryrunstopA4 = "SELECT Takt_time as tk,start_time as st,end_time as et FROM a4 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultrunstopA4 = $db->query($queryrunstopA4);
      	$FirstA4 = true;
      	$MinFirstA4 = 0;
      	$MaxFirstA4 = 0;
      	$MinttA4 = 0;
      	$MaxttA4 = 0;
      	while ($rowA4 = $resultrunstopA4->fetch_array(MYSQLI_ASSOC)) {
         	if ($FirstA4){
            	$FirstA4 = false;
            	$runstartFirstA4 = $rowA4['st'];
            	$timerunstopA4 = (strtotime($runstartFirstA4) - strtotime($Start));
            	if ($timerunstopA4 < 300){
               		$MinFirstA4 = ($MinFirstA4 + $timerunstopA4);
            	} else {
               		$MaxFirstA4 = ($MaxFirstA4 + $timerunstopA4);
            	}
         	} else {
            	$runstopFirstA4 = strtotime($rowA4['et']);
            	$runstopstarttimeA4 = strtotime($rowA4['st']);
            	$tkA4 = $rowA4['tk'];  
            	$ErunstopA4 = $runstopFirstA4 + $tkA4;
            	$timettA4 =  ($ErunstopA4 - $runstopstarttimeA4);
            	if ($timettA4 < 300){
               		$MinttA4 = ($MinttA4 + $timettA4);
            	} else {
               		$MaxttA4 = ($MaxttA4 + $timettA4);
            	}
         	}
      	}

      	$totalrunA4 = ($MinFirstA4 + $MinttA4)/60;
      	//$totalstop = ($MaxFirst + $Maxtt)/60;
      	$totalstopA4 = (round($timetotalA4) - round($totalrunA4));
   
      	if ($totalrunA4 > 0){
         	$pruntimeA4 = (round($totalrunA4)/round($timetotalA4))*100;
      	} else {
         	$pruntimeA4 = 0;   
      	}

      	if ($totalstopA4 > 0){
         	$pstoptimeA4 = (round($totalstopA4)/round($timetotalA4))*100;
      	} else {
         	$pstoptimeA4 = 0;   
      	}   
      	/* --------------------------- A-4 --------------------------- */

      	$outputA5 = 0;
      	$queryA5 = "SELECT count(*) AS total FROM a5 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultA5 = $db->query($queryA5);
      	while ($rowA5 = $resultA5->fetch_array(MYSQLI_ASSOC)) {
        	$outputA5 = $outputA5 + $rowA5['total'];
      	}
  
      	$timetotalA5 = 0;
      	$querytimeA5 = "SELECT Date_time AS t,Takt_time as tak FROM a5 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resulttimeA5 = $db->query($querytimeA5);
      	while ($rowA5 = $resulttimeA5->fetch_array(MYSQLI_ASSOC)) {
         	//$takt = $row['tak'];
         	$outputtimeA5 = strtotime($rowA5['t']);
         	//$out = $outputtime + $takt;
         	$timetotalA5 = ($outputtimeA5 - strtotime($Start))/60;
      	}

      	$avgtimeA5 = 0;
      	$timeSecondA5 = 0;
      	$avA5 = 0;
      	$TimeavgA5 = date('H:i:s',strtotime('08:00:00'));
      	$queryavgA5 = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a5 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultavgA5 = $db->query($queryavgA5);
      	$countA5 = mysqli_num_rows($resultavgA5);
      	$FirstRunA5 = true;
      	while ($rowA5 = $resultavgA5->fetch_array(MYSQLI_ASSOC)) {
         	if ($FirstRunA5){ 
            	$FirstRunA5 = false;
            	$starttimeFirstA5 = $rowA5['starttime'];
            	$timeFirstA5 = (strtotime($starttimeFirstA5) - strtotime($Start)); 
            	if($timeFirstA5 < 300) {
               		$avA5 = ($avA5 + $timeFirstA5);
            	}
         	} else { 
            	$endtimeSecondA5 = strtotime($rowA5['endtime']);
            	$starttimeSecondA5 = strtotime($rowA5['starttime']); 
            	$takttimeSecondA5 = $rowA5['takttime']; 
            	$EavgA5 = $endtimeSecondA5 + $takttimeSecondA5;
            	$timeSecondA5 =  ($EavgA5 - $starttimeSecondA5);
            	if($timeSecondA5 < 300) {
               		$avgtimeA5 = ($avgtimeA5 + $timeSecondA5);
            	}
         	}    
      	}
      
      	$AVGA5 = ($avgtimeA5 + $avA5);
      	if ($AVGA5 > 0){
         	$avgA5 = ($AVGA5 / $countA5);
      	} else {
         	$avgA5 = 0;
      	}
      	$processingtimeA5 = ($outputA5 * $avgA5)/60;  

      	$TimerunstopA5 = date('H:i:s',strtotime('08:00:00'));
      	$queryrunstopA5 = "SELECT Takt_time as tk,start_time as st,end_time as et FROM a5 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultrunstopA5 = $db->query($queryrunstopA5);
      	$FirstA5 = true;
      	$MinFirstA5 = 0;
      	$MaxFirstA5 = 0;
      	$MinttA5 = 0;
      	$MaxttA5 = 0;
      	while ($rowA5 = $resultrunstopA5->fetch_array(MYSQLI_ASSOC)) {
         	if ($FirstA5){
            	$FirstA5 = false;
            	$runstartFirstA5 = $rowA5['st'];
            	$timerunstopA5 = (strtotime($runstartFirstA5) - strtotime($Start));
            	if ($timerunstopA5 < 300){
               		$MinFirstA5 = ($MinFirstA5 + $timerunstopA5);
            	} else {
               		$MaxFirstA5 = ($MaxFirstA5 + $timerunstopA5);
            	}
         	} else {
            	$runstopFirstA5 = strtotime($rowA5['et']);
            	$runstopstarttimeA5 = strtotime($rowA5['st']);
            	$tkA5 = $rowA5['tk'];  
            	$ErunstopA5 = $runstopFirstA5 + $tkA5;
            	$timettA5 =  ($ErunstopA5 - $runstopstarttimeA5);
            	if ($timettA5 < 300){
               		$MinttA5 = ($MinttA5 + $timettA5);
            	} else {
               		$MaxttA5 = ($MaxttA5 + $timettA5);
            	}
         	}
      	}

      	$totalrunA5 = ($MinFirstA5 + $MinttA5)/60;
      	//$totalstop = ($MaxFirst + $Maxtt)/60;
      	$totalstopA5 = (round($timetotalA5) - round($totalrunA5));
   
      	if ($totalrunA5 > 0){
         	$pruntimeA5 = (round($totalrunA5)/round($timetotalA5))*100;
      	} else {
         	$pruntimeA5 = 0;   
      	}

      	if ($totalstopA5 > 0){
         	$pstoptimeA5 = (round($totalstopA5)/round($timetotalA5))*100;
      	} else {
         	$pstoptimeA5 = 0;   
      	}   
      	/* --------------------------- A-5 --------------------------- */

		$outputA6 = 0;
      	$queryA6 = "SELECT count(*) AS total FROM a6 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultA6 = $db->query($queryA6);
      	while ($rowA6 = $resultA6->fetch_array(MYSQLI_ASSOC)) {
        	$outputA6 = $outputA6 + $rowA6['total'];
      	}
  
      	$timetotalA6 = 0;
      	$querytimeA6 = "SELECT Date_time AS t,Takt_time as tak FROM a6 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resulttimeA6 = $db->query($querytimeA6);
      	while ($rowA6 = $resulttimeA6->fetch_array(MYSQLI_ASSOC)) {
         	//$takt = $row['tak'];
         	$outputtimeA6 = strtotime($rowA6['t']);
         	//$out = $outputtime + $takt;
         	$timetotalA6 = ($outputtimeA6 - strtotime($Start))/60;
      	}

      	$avgtimeA6 = 0;
      	$timeSecondA6 = 0;
      	$avA6 = 0;
      	$TimeavgA6 = date('H:i:s',strtotime('08:00:00'));
      	$queryavgA6 = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a6 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultavgA6 = $db->query($queryavgA6);
      	$countA6 = mysqli_num_rows($resultavgA6);
      	$FirstRunA6 = true;
      	while ($rowA6 = $resultavgA6->fetch_array(MYSQLI_ASSOC)) {
         	if ($FirstRunA6){ 
            	$FirstRunA6 = false;
            	$starttimeFirstA6 = $rowA6['starttime'];
            	$timeFirstA6 = (strtotime($starttimeFirstA6) - strtotime($Start)); 
            	if($timeFirstA6 < 300) {
               		$avA6 = ($avA6 + $timeFirstA6);
            	}
         	} else { 
            	$endtimeSecondA6 = strtotime($rowA6['endtime']);
            	$starttimeSecondA6 = strtotime($rowA6['starttime']); 
            	$takttimeSecondA6 = $rowA6['takttime']; 
            	$EavgA6 = $endtimeSecondA6 + $takttimeSecondA6;
            	$timeSecondA6 =  ($EavgA6 - $starttimeSecondA6);
            	if($timeSecondA6 < 300) {
               		$avgtimeA6 = ($avgtimeA6 + $timeSecondA6);
            	}
         	}    
      	}
      
      	$AVGA6 = ($avgtimeA6 + $avA6);
      	if ($AVGA6 > 0){
         	$avgA6 = ($AVGA6 / $countA6);
      	} else {
         	$avgA6 = 0;
      	}
      	$processingtimeA6 = ($outputA6 * $avgA6)/60;  

      	$TimerunstopA6 = date('H:i:s',strtotime('08:00:00'));
      	$queryrunstopA6 = "SELECT Takt_time as tk,start_time as st,end_time as et FROM a6 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultrunstopA6 = $db->query($queryrunstopA6);
      	$FirstA6 = true;
      	$MinFirstA6 = 0;
      	$MaxFirstA6 = 0;
      	$MinttA6 = 0;
      	$MaxttA6 = 0;
      	while ($rowA6 = $resultrunstopA6->fetch_array(MYSQLI_ASSOC)) {
         	if ($FirstA6){
            	$FirstA6 = false;
            	$runstartFirstA6 = $rowA6['st'];
            	$timerunstopA6 = (strtotime($runstartFirstA6) - strtotime($Start));
            	if ($timerunstopA6 < 300){
               		$MinFirstA6 = ($MinFirstA6 + $timerunstopA6);
            	} else {
               		$MaxFirstA6 = ($MaxFirstA6 + $timerunstopA6);
            	}
         	} else {
            	$runstopFirstA6 = strtotime($rowA6['et']);
            	$runstopstarttimeA6 = strtotime($rowA6['st']);
            	$tkA6 = $rowA6['tk'];  
            	$ErunstopA6 = $runstopFirstA6 + $tkA6;
            	$timettA6 =  ($ErunstopA6 - $runstopstarttimeA6);
            	if ($timettA6 < 300){
               		$MinttA6 = ($MinttA6 + $timettA6);
            	} else {
               		$MaxttA6 = ($MaxttA6 + $timettA6);
            	}
         	}
      	}

      	$totalrunA6 = ($MinFirstA6 + $MinttA6)/60;
      	//$totalstop = ($MaxFirst + $Maxtt)/60;
      	$totalstopA6 = (round($timetotalA6) - round($totalrunA6));
   
      	if ($totalrunA6 > 0){
         	$pruntimeA6 = (round($totalrunA6)/round($timetotalA6))*100;
      	} else {
         	$pruntimeA6 = 0;   
      	}

      	if ($totalstopA6 > 0){
         	$pstoptimeA6 = (round($totalstopA6)/round($timetotalA6))*100;
      	} else {
         	$pstoptimeA6 = 0;   
      	}   
      	/* --------------------------- A-6 --------------------------- */

      	$outputA7 = 0;
      	$queryA7 = "SELECT count(*) AS total FROM a7 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultA7 = $db->query($queryA7);
      	while ($rowA7 = $resultA7->fetch_array(MYSQLI_ASSOC)) {
        	$outputA7 = $outputA7 + $rowA7['total'];
      	}
  
      	$timetotalA7 = 0;
      	$querytimeA7 = "SELECT Date_time AS t,Takt_time as tak FROM a7 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resulttimeA7 = $db->query($querytimeA7);
      	while ($rowA7 = $resulttimeA7->fetch_array(MYSQLI_ASSOC)) {
         	//$takt = $row['tak'];
         	$outputtimeA7 = strtotime($rowA7['t']);
         	//$out = $outputtime + $takt;
         	$timetotalA7 = ($outputtimeA7 - strtotime($Start))/60;
      	}

      	$avgtimeA7 = 0;
      	$timeSecondA7 = 0;
      	$avA7 = 0;
      	$TimeavgA7 = date('H:i:s',strtotime('08:00:00'));
      	$queryavgA7 = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a7 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultavgA7 = $db->query($queryavgA7);
      	$countA7 = mysqli_num_rows($resultavgA7);
      	$FirstRunA7 = true;
      	while ($rowA7 = $resultavgA7->fetch_array(MYSQLI_ASSOC)) {
         	if ($FirstRunA7){ 
            	$FirstRunA7 = false;
            	$starttimeFirstA7 = $rowA7['starttime'];
            	$timeFirstA7 = (strtotime($starttimeFirstA7) - strtotime($Start)); 
            	if($timeFirstA7 < 300) {
               		$avA7 = ($avA7 + $timeFirstA7);
            	}
         	} else { 
            	$endtimeSecondA7 = strtotime($rowA7['endtime']);
            	$starttimeSecondA7 = strtotime($rowA7['starttime']); 
            	$takttimeSecondA7 = $rowA7['takttime']; 
            	$EavgA7 = $endtimeSecondA7 + $takttimeSecondA7;
            	$timeSecondA7 =  ($EavgA7 - $starttimeSecondA7);
            	if($timeSecondA7 < 300) {
               		$avgtimeA7 = ($avgtimeA7 + $timeSecondA7);
            	}
         	}    
      	}
      
      	$AVGA7 = ($avgtimeA7 + $avA7);
      	if ($AVGA7 > 0){
         	$avgA7 = ($AVGA7 / $countA7);
      	} else {
         	$avgA7 = 0;
      	}
      	$processingtimeA7 = ($outputA7 * $avgA7)/60;  

      	$TimerunstopA7 = date('H:i:s',strtotime('08:00:00'));
      	$queryrunstopA7 = "SELECT Takt_time as tk,start_time as st,end_time as et FROM a7 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultrunstopA7 = $db->query($queryrunstopA7);
      	$FirstA7 = true;
      	$MinFirstA7 = 0;
      	$MaxFirstA7 = 0;
      	$MinttA7 = 0;
      	$MaxttA7 = 0;
      	while ($rowA7 = $resultrunstopA7->fetch_array(MYSQLI_ASSOC)) {
         	if ($FirstA7){
            	$FirstA7 = false;
            	$runstartFirstA7 = $rowA7['st'];
            	$timerunstopA7 = (strtotime($runstartFirstA7) - strtotime($Start));
            	if ($timerunstopA7 < 300){
               		$MinFirstA7 = ($MinFirstA7 + $timerunstopA7);
            	} else {
               		$MaxFirstA7 = ($MaxFirstA7 + $timerunstopA7);
            	}
         	} else {
            	$runstopFirstA7 = strtotime($rowA7['et']);
            	$runstopstarttimeA7 = strtotime($rowA7['st']);
            	$tkA7 = $rowA7['tk'];  
            	$ErunstopA7 = $runstopFirstA7 + $tkA7;
            	$timettA7 =  ($ErunstopA7 - $runstopstarttimeA7);
            	if ($timettA7 < 300){
               		$MinttA7 = ($MinttA7 + $timettA7);
            	} else {
               		$MaxttA7 = ($MaxttA7 + $timettA7);
            	}
         	}
      	}

      	$totalrunA7 = ($MinFirstA7 + $MinttA7)/60;
      	//$totalstop = ($MaxFirst + $Maxtt)/60;
      	$totalstopA7 = (round($timetotalA7) - round($totalrunA7));
   
      	if ($totalrunA7 > 0){
         	$pruntimeA7 = (round($totalrunA7)/round($timetotalA7))*100;
      	} else {
         	$pruntimeA7 = 0;   
      	}

      	if ($totalstopA7 > 0){
         	$pstoptimeA7 = (round($totalstopA7)/round($timetotalA7))*100;
      	} else {
         	$pstoptimeA7 = 0;   
      	}   
      	/* --------------------------- A-7 --------------------------- */

		$outputA8 = 0;
      	$queryA8 = "SELECT count(*) AS total FROM a8 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultA8 = $db->query($queryA8);
      	while ($rowA8 = $resultA8->fetch_array(MYSQLI_ASSOC)) {
        	$outputA8 = $outputA8 + $rowA8['total'];
      	}
  
      	$timetotalA8 = 0;
      	$querytimeA8 = "SELECT Date_time AS t,Takt_time as tak FROM a8 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resulttimeA8 = $db->query($querytimeA8);
      	while ($rowA8 = $resulttimeA8->fetch_array(MYSQLI_ASSOC)) {
         	//$takt = $row['tak'];
         	$outputtimeA8 = strtotime($rowA8['t']);
         	//$out = $outputtime + $takt;
         	$timetotalA8 = ($outputtimeA8 - strtotime($Start))/60;
      	}

      	$avgtimeA8 = 0;
      	$timeSecondA8 = 0;
      	$avA8 = 0;
      	$TimeavgA8 = date('H:i:s',strtotime('08:00:00'));
      	$queryavgA8 = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a8 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultavgA8 = $db->query($queryavgA8);
      	$countA8 = mysqli_num_rows($resultavgA8);
      	$FirstRunA8 = true;
      	while ($rowA8 = $resultavgA8->fetch_array(MYSQLI_ASSOC)) {
         	if ($FirstRunA8){ 
            	$FirstRunA8 = false;
            	$starttimeFirstA8 = $rowA8['starttime'];
            	$timeFirstA8 = (strtotime($starttimeFirstA8) - strtotime($Start)); 
            	if($timeFirstA8 < 300) {
               		$avA8 = ($avA8 + $timeFirstA8);
            	}
         	} else { 
            	$endtimeSecondA8 = strtotime($rowA8['endtime']);
            	$starttimeSecondA8 = strtotime($rowA8['starttime']); 
            	$takttimeSecondA8 = $rowA8['takttime']; 
            	$EavgA8 = $endtimeSecondA8 + $takttimeSecondA8;
            	$timeSecondA8 =  ($EavgA8 - $starttimeSecondA8);
            	if($timeSecondA8 < 300) {
               		$avgtimeA8 = ($avgtimeA8 + $timeSecondA8);
            	}
         	}    
      	}
      
      	$AVGA8 = ($avgtimeA8 + $avA8);
      	if ($AVGA8 > 0){
         	$avgA8 = ($AVGA8 / $countA8);
      	} else {
         	$avgA8 = 0;
      	}
      	$processingtimeA8 = ($outputA8 * $avgA8)/60;  

      	$TimerunstopA8 = date('H:i:s',strtotime('08:00:00'));
      	$queryrunstopA8 = "SELECT Takt_time as tk,start_time as st,end_time as et FROM a8 WHERE Date_Time BETWEEN '$Start' AND '$End'";
      	$resultrunstopA8 = $db->query($queryrunstopA8);
      	$FirstA8 = true;
      	$MinFirstA8 = 0;
      	$MaxFirstA8 = 0;
      	$MinttA8 = 0;
      	$MaxttA8 = 0;
      	while ($rowA8 = $resultrunstopA8->fetch_array(MYSQLI_ASSOC)) {
         	if ($FirstA8){
            	$FirstA8 = false;
            	$runstartFirstA8 = $rowA8['st'];
            	$timerunstopA8 = (strtotime($runstartFirstA8) - strtotime($Start));
            	if ($timerunstopA8 < 300){
               		$MinFirstA8 = ($MinFirstA8 + $timerunstopA8);
            	} else {
               		$MaxFirstA8 = ($MaxFirstA8 + $timerunstopA8);
            	}
         	} else {
            	$runstopFirstA8 = strtotime($rowA8['et']);
            	$runstopstarttimeA8 = strtotime($rowA8['st']);
            	$tkA8 = $rowA8['tk'];  
            	$ErunstopA8 = $runstopFirstA8 + $tkA8;
            	$timettA8 =  ($ErunstopA8 - $runstopstarttimeA8);
            	if ($timettA8 < 300){
               		$MinttA8 = ($MinttA8 + $timettA8);
            	} else {
               		$MaxttA8 = ($MaxttA8 + $timettA8);
            	}
         	}
      	}

      	$totalrunA8 = ($MinFirstA8 + $MinttA8)/60;
      	//$totalstop = ($MaxFirst + $Maxtt)/60;
      	$totalstopA8 = (round($timetotalA8) - round($totalrunA8));
   
      	if ($totalrunA8 > 0){
         	$pruntimeA8 = (round($totalrunA8)/round($timetotalA8))*100;
      	} else {
         	$pruntimeA8 = 0;   
      	}

      	if ($totalstopA8 > 0){
         	$pstoptimeA8 = (round($totalstopA8)/round($timetotalA8))*100;
      	} else {
         	$pstoptimeA8 = 0;   
      	}   
      	/* --------------------------- A-8 --------------------------- */

      	$jsonObj = '{'
      	. '"output":"' . $output . ' "' . ', '
      	. '"timetotal":"' . round($timetotal) . ' "' . ', '
      	. '"second":"' . date('Y-m-d H:i:s') . ' "' . ', '
      	. '"avg":"' . round($avg) . ' "'. ', '
      	. '"processingtime":"' . round($processingtime) . ' "'. ', '
      	. '"totalrun":"' . round($totalrun) . ' "'. ', '
      	. '"totalstop":"' . round($totalstop) . ' "'. ', '
      	. '"pruntime":"' . round($pruntime) . ' "'. ', '
      	. '"pstoptime":"' . round($pstoptime) . ' "'. ', '
      	/* --------------------------- A-3 --------------------------- */ 

      	. '"outputA1":"' . $outputA1 . ' "' . ', '
      	. '"timetotalA1":"' . round($timetotalA1) . ' "' . ', '
      	. '"avgA1":"' . round($avgA1) . ' "'. ', '
      	. '"processingtimeA1":"' . round($processingtimeA1) . ' "'. ', '
      	. '"totalrunA1":"' . round($totalrunA1) . ' "'. ', '
      	. '"totalstopA1":"' . round($totalstopA1) . ' "'. ', '
      	. '"pruntimeA1":"' . round($pruntimeA1) . ' "'. ', '
      	. '"pstoptimeA1":"' . round($pstoptimeA1) . ' "' . ', '    
      	/* --------------------------- A-1 --------------------------- */ 

      	. '"outputA2":"' . $outputA2 . ' "' . ', '
      	. '"timetotalA2":"' . round($timetotalA2) . ' "' . ', '
      	. '"avgA2":"' . round($avgA2) . ' "'. ', '
      	. '"processingtimeA2":"' . round($processingtimeA2) . ' "'. ', '
      	. '"totalrunA2":"' . round($totalrunA2) . ' "'. ', '
      	. '"totalstopA2":"' . round($totalstopA2) . ' "'. ', '
      	. '"pruntimeA2":"' . round($pruntimeA2) . ' "'. ', '
      	. '"pstoptimeA2":"' . round($pstoptimeA2) . ' "' . ', '
      	/* --------------------------- A-2 --------------------------- */ 

      	. '"outputA4":"' . $outputA4 . ' "' . ', '
      	. '"timetotalA4":"' . round($timetotalA4) . ' "' . ', '
      	. '"avgA4":"' . round($avgA4) . ' "'. ', '
      	. '"processingtimeA4":"' . round($processingtimeA4) . ' "'. ', '
      	. '"totalrunA4":"' . round($totalrunA4) . ' "'. ', '
      	. '"totalstopA4":"' . round($totalstopA4) . ' "'. ', '
      	. '"pruntimeA4":"' . round($pruntimeA4) . ' "'. ', '
      	. '"pstoptimeA4":"' . round($pstoptimeA4) . ' "' . ', '
	  	/* --------------------------- A-4 --------------------------- */ 

      	. '"outputA5":"' . $outputA5 . ' "' . ', '
      	. '"timetotalA5":"' . round($timetotalA5) . ' "' . ', '
      	. '"avgA5":"' . round($avgA5) . ' "'. ', '
      	. '"processingtimeA5":"' . round($processingtimeA5) . ' "'. ', '
      	. '"totalrunA5":"' . round($totalrunA5) . ' "'. ', '
      	. '"totalstopA5":"' . round($totalstopA5) . ' "'. ', '
      	. '"pruntimeA5":"' . round($pruntimeA5) . ' "'. ', '
      	. '"pstoptimeA5":"' . round($pstoptimeA5) . ' "' . ', '
       	/* --------------------------- A-5 --------------------------- */ 

      	. '"outputA6":"' . $outputA6 . ' "' . ', '
      	. '"timetotalA6":"' . round($timetotalA6) . ' "' . ', '
      	. '"avgA6":"' . round($avgA6) . ' "'. ', '
      	. '"processingtimeA6":"' . round($processingtimeA6) . ' "'. ', '
      	. '"totalrunA6":"' . round($totalrunA6) . ' "'. ', '
      	. '"totalstopA6":"' . round($totalstopA6) . ' "'. ', '
      	. '"pruntimeA6":"' . round($pruntimeA6) . ' "'. ', '
      	. '"pstoptimeA6":"' . round($pstoptimeA6) . ' "' . ', '
	  	/* --------------------------- A-6 --------------------------- */ 

	  	. '"outputA7":"' . $outputA7 . ' "' . ', '
      	. '"timetotalA7":"' . round($timetotalA7) . ' "' . ', '
      	. '"avgA7":"' . round($avgA7) . ' "'. ', '
      	. '"processingtimeA7":"' . round($processingtimeA7) . ' "'. ', '
      	. '"totalrunA7":"' . round($totalrunA7) . ' "'. ', '
      	. '"totalstopA7":"' . round($totalstopA7) . ' "'. ', '
      	. '"pruntimeA7":"' . round($pruntimeA7) . ' "'. ', '
      	. '"pstoptimeA7":"' . round($pstoptimeA7) . ' "' . ', '
       	/* --------------------------- A-7 --------------------------- */ 

      	. '"outputA8":"' . $outputA8 . ' "' . ', '
      	. '"timetotalA8":"' . round($timetotalA8) . ' "' . ', '
      	. '"avgA8":"' . round($avgA8) . ' "'. ', '
      	. '"processingtimeA8":"' . round($processingtimeA8) . ' "'. ', '
      	. '"totalrunA8":"' . round($totalrunA8) . ' "'. ', '
      	. '"totalstopA8":"' . round($totalstopA8) . ' "'. ', '
      	. '"pruntimeA8":"' . round($pruntimeA8) . ' "'. ', '
      	. '"pstoptimeA8":"' . round($pstoptimeA8) . ' "'
        . '}' ;  
	  	/* --------------------------- A-8 --------------------------- */  	
      	echo $jsonObj;
	    exit();
    }
?>

<?php include_once('layouts/header.php');?> 

<head>
	<script src="jquery-latest.js"></script>
	<script type="text/javascript" src="assets/js/mdb.min.js"></script> 
	<link rel="stylesheet" href="css/AdminLTE.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Asap&family=Roboto:ital,wght@0,500;0,900;1,500&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">
	<script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
	
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 	<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
 	<script src="http://code.jquery.com/jquery-latest.js"></script>
</head>

<style>
	h1 {
		text-align: center;
		font-size: 40px;
  		font-weight: 800;
  		font-family: 'Roboto', sans-serif;
  		color: #7D3C98;
  		margin-top: -3px;
  		text-transform: uppercase;
  		text-shadow: 1px 1px 0px #5B2C6F,
               		 1px 2px 0px #5B2C6F,
               		 1px 3px 0px #5B2C6F,
	               	 1px 4px 0px #5B2C6F,
	                 1px 5px 0px #5B2C6F,
	                 1px 6px 0px #5B2C6F,
	                 1px 10px 5px rgba(16, 16, 16, 0.5),
	                 1px 15px 10px rgba(16, 16, 16, 0.4),
	                 1px 20px 30px rgba(16, 16, 16, 0.3),
	                 1px 25px 50px rgba(16, 16, 16, 0.2);
	}

	h3 {
		text-align: center;
		font-family: 'Asap', sans-serif;
		font-size: 24px;
		font-weight: 800;
		line-height: 7px;
		color: #1C2833;
		text-transform: uppercase;
		text-shadow: 2px 2px 4px #ABB2B9,
					 3px 4px 4px #ABB2B9,
					 4px 6px 4px #ABB2B9,
					 5px 8px 4px #ABB2B9;
	}

	/*.table-wrapper {
		margin: 10px 70px 70px;
		box-shadow: 0px 35px 50px rgba(0, 0, 0, 0.15);
	}*/

	.fl-table-01 {
		border-radius: 5px 5px 0 0;
		margin: 25px 0;
		overflow: hidden;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.35);
		font-size: 18px;
		font-weight: normal;
		border: none;
		border-collapse: collapse;
		background-color: #FFFFFF;	
		/*margin-left: 50px;*/
	}

	.fl-table-01 th, 
	.fl-table-01 td {
		/*border: 1px solid white;*/
		border-collapse: collapse;
		padding: 8px;
		text-align: center;
	} 

	.fl-table-01 td{
		width: 190px;
		font-size: 18px;
		font-weight: bold;
	}

	.fl-table-01 tbody th {
		color: #FFFFFF;
		background-color: #0B9B55;
	}

	/*.fl-table-01 tr:nth-child(odd) {
        background-color: #CFE8DC;
    }*/
    /* ----------------------- A-1 -----------------------*/

	.fl-table-03 {
		border-radius: 5px 5px 0 0;
		margin: 25px 0;
		overflow: hidden;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.35);
		font-size: 18px;
		font-weight: normal;
		border: none;
		border-collapse: collapse;
		background-color: #FFFFFF;
	}

	.fl-table-03 th, 
	.fl-table-03 td {
		border-collapse: collapse;
		padding: 8px;
		text-align: center;
	} 

	.fl-table-03 td{
		width: 190px;
		font-size: 18px;
		font-weight: bold;
	}

	.fl-table-03 tbody th {
		color: #FFFFFF;
		background-color: #4169E1;
	}
	/* ----------------------- A-3 -----------------------*/

	.fl-table-02 {
		border-radius: 5px 5px 0 0;
		margin: 25px 0;
		overflow: hidden;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.35);
		font-size: 18px;
		font-weight: normal;
		border: none;
		border-collapse: collapse;
		background-color: #FFFFFF;
	}

	.fl-table-02 th, 
	.fl-table-02 td {
		border-collapse: collapse;
		padding: 8px;
		text-align: center;
	} 

	.fl-table-02 td{
		width: 190px;
		font-size: 18px;
		font-weight: bold;
	}

	.fl-table-02 tbody th {
		color: #FFFFFF;
		background-color: #7B68EE;
	}
	/* ----------------------- A-2 -----------------------*/

	.fl-table-04 {
		border-radius: 5px 5px 0 0;
		margin: 25px 0;
		overflow: hidden;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.35);
		font-size: 18px;
		font-weight: normal;
		border: none;
		border-collapse: collapse;
		background-color: #FFFFFF;
	}

	.fl-table-04 th, 
	.fl-table-04 td {
		border-collapse: collapse;
		padding: 8px;
		text-align: center;
	} 

	.fl-table-04 td{
		width: 190px;
		font-size: 18px;
		font-weight: bold;
	}

	.fl-table-04 tbody th {
		color: #FFFFFF;
		background-color: #CD5C5C;
	}
	/* ----------------------- A-4 -----------------------*/

	.fl-table-05 {
		border-radius: 5px 5px 0 0;
		margin: 25px 0;
		overflow: hidden;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.35);
		font-size: 18px;
		font-weight: normal;
		border: none;
		border-collapse: collapse;
		background-color: #FFFFFF;
	}

	.fl-table-05 th, 
	.fl-table-05 td {
		border-collapse: collapse;
		padding: 8px;
		text-align: center;
	} 

	.fl-table-05 td{
		width: 190px;
		font-size: 18px;
		font-weight: bold;
	}

	.fl-table-05 tbody th {
		color: #FFFFFF;
		background-color: #6A1B9A;
	}
	/* ----------------------- A-5 -----------------------*/

	.fl-table-06 {
		border-radius: 5px 5px 0 0;
		margin: 25px 0;
		overflow: hidden;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.35);
		font-size: 18px;
		font-weight: normal;
		border: none;
		border-collapse: collapse;
		background-color: #FFFFFF;
	}

	.fl-table-06 th, 
	.fl-table-06 td {
		border-collapse: collapse;
		padding: 8px;
		text-align: center;
	} 

	.fl-table-06 td{
		width: 190px;
		font-size: 18px;
		font-weight: bold;
	}

	.fl-table-06 tbody th {
		color: #FFFFFF;
		background-color: #0097A7;
	}
	/* ----------------------- A-6 -----------------------*/

	.fl-table-07 {
		border-radius: 5px 5px 0 0;
		margin: 25px 0;
		overflow: hidden;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.35);
		font-size: 18px;
		font-weight: normal;
		border: none;
		border-collapse: collapse;
		background-color: #FFFFFF;
	}

	.fl-table-07 th, 
	.fl-table-07 td {
		border-collapse: collapse;
		padding: 8px;
		text-align: center;
	} 

	.fl-table-07 td{
		width: 190px;
		font-size: 18px;
		font-weight: bold;
	}

	.fl-table-07 tbody th {
		color: #FFFFFF;
		background-color: #558B2F;
	}
	/* ----------------------- A-7 -----------------------*/

	.fl-table-08 {
		border-radius: 5px 5px 0 0;
		margin: 25px 0;
		overflow: hidden;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.35);
		font-size: 18px;
		font-weight: normal;
		border: none;
		border-collapse: collapse;
		background-color: #FFFFFF;
	}

	.fl-table-08 th, 
	.fl-table-08 td {
		border-collapse: collapse;
		padding: 8px;
		text-align: center;
	} 

	.fl-table-08 td{
		width: 190px;
		font-size: 18px;
		font-weight: bold;
	}

	.fl-table-08 tbody th {
		color: #FFFFFF;
		background-color: #C55300;
	}
	/* ----------------------- A-8 -----------------------*/
</style>

<body>
	<h1>SMT-MOT DASHBOARD</h1>
	<br/>
	<div class="table-wrapper">
		<div class="row">
			<div class="col-sm-3 col-lg-3">
				<h3>MOT B-A1</h3>
				<table class="fl-table-01">
					<tbody>
						<tr>
							<th>Output (Board)</th>
							<td id="outputA1"></td> 
						</tr>

						<tr>
							<th>Total Time (Min)</th>
							<td id="timetotalA1"></td>
						</tr>

						<tr>
							<th>AVG Cycle Time (Sec/Board)</th>
							<td id="avgA1"></td> 
						</tr>

						<tr>
							<th>Processing Time (Min)</th>
							<td id="processingtimeA1"></td>
						</tr>

						<tr>
							<th>Total Runtime (Min)</th>
							<td id="totalrunA1"></td> 
						</tr>

						<tr>
							<th>Total Stoptime (Min)</th>
							<td id="totalstopA1"></td>
						</tr>

						<tr>
							<th>% RUNTIME</th>
							<td id="pruntimeA1" style="color: #1DC100;"></td> 
						</tr>

						<tr>
							<th>% STOPTIME</th>
							<td id="pstoptimeA1" style="color: #FF0000;"></td> 
						</tr>
					</tbody>
				</table>
			</div>
			<!--------------------------- A-1 --------------------------->

			<div class="col-sm-3 col-lg-3">
				<h3>MOT B-A2</h3>
				<table class="fl-table-02">
					<tbody>
						<tr>
							<th>Output (Board)</th>
							<td id="outputA2"></td>
						</tr>

						<tr>
							<th>Total Time (Min)</th>
							<td id="timetotalA2"></td>
						</tr>

						<tr>
							<th>AVG Cycle Time (Sec/Board)</th>
							<td id="avgA2"></td>
						</tr>

						<tr>
							<th>Processing Time (Min)</th>
							<td id="processingtimeA2"></td>
						</tr>

						<tr>
							<th>Total Runtime (Min)</th>
							<td id="totalrunA2"></td>
						</tr>

						<tr>
							<th>Total Stoptime (Min)</th>
							<td id="totalstopA2"></td>
						</tr>

						<tr>
							<th>% RUNTIME</th>
							<td id="pruntimeA2" style="color: #1DC100;"></td>
						</tr>

						<tr>
							<th>% STOPTIME</th>
							<td id="pstoptimeA2" style="color: #FF0000;"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<!--------------------------- A-2 --------------------------->

			<div class="col-sm-3 col-lg-3">
				<h3>MOT B-A3</h3>
				<table class="fl-table-03">
					<tbody>
						<tr>
							<th>Output (Board)</th>
							<td id="output"></td>
						</tr>

						<tr>
							<th>Total Time (Min)</th>
							<td id="timetotal"></td>
						</tr>

						<tr>
							<th>AVG Cycle Time (Sec/Board)</th>
							<td id="avg"></td>
						</tr>

						<tr>
							<th>Processing Time (Min)</th>
							<td id="processingtime"></td>
						</tr>

						<tr>
							<th>Total Runtime (Min)</th>
							<td id="totalrun"></td>
						</tr>

						<tr>
							<th>Total Stoptime (Min)</th>
							<td id="totalstop"></td>
						</tr>

						<tr>
							<th>% RUNTIME</th>
							<td id="pruntime" style="color: #1DC100;"></td>
						</tr>

						<tr>
							<th>% STOPTIME</th>
							<td id="pstoptime" style="color: #FF0000;"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<!--------------------------- A-3 --------------------------->

			<div class="col-sm-3 col-lg-3">
				<h3>MOT B-A4</h3>
				<table class="fl-table-04">
					<tbody>
						<tr>
							<th>Output (Board)</th>
							<td id="outputA4"></td>
						</tr>

						<tr>
							<th>Total Time (Min)</th>
							<td id="timetotalA4"></td>
						</tr>

						<tr>
							<th>AVG Cycle Time (Sec/Board)</th>
							<td id="avgA4"></td>
						</tr>

						<tr>
							<th>Processing Time (Min)</th>
							<td id="processingtimeA4"></td>
						</tr>

						<tr>
							<th>Total Runtime (Min)</th>
							<td id="totalrunA4"></td>
						</tr>

						<tr>
							<th>Total Stoptime (Min)</th>
							<td id="totalstopA4"></td>
						</tr>

						<tr>
							<th>% RUNTIME</th>
							<td id="pruntimeA4" style="color: #1DC100;"></td>
						</tr>

						<tr>
							<th>% STOPTIME</th>
							<td id="pstoptimeA4" style="color: #FF0000;"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!--------------------------- A-4 --------------------------->

		<div class="row">
			<div class="col-sm-3 col-lg-3">
				<h3>MOT A-A5</h3>
				<table class="fl-table-05">
					<tbody>
						<tr>
							<th>Output (Board)</th>
							<td id="outputA5"></td>
						</tr>

						<tr>
							<th>Total Time (Min)</th>
							<td id="timetotalA5"></td>
						</tr>

						<tr>
							<th>AVG Cycle Time (Sec/Board)</th>
							<td id="avgA5"></td>
						</tr>

						<tr>
							<th>Processing Time (Min)</th>
							<td id="processingtimeA5"></td>
						</tr>

						<tr>
							<th>Total Runtime (Min)</th>
							<td id="totalrunA5"></td>
						</tr>

						<tr>
							<th>Total Stoptime (Min)</th>
							<td id="totalstopA5"></td>
						</tr>

						<tr>
							<th>% RUNTIME</th>
							<td id="pruntimeA5" style="color: #1DC100;"></td>
						</tr>

						<tr>
							<th>% STOPTIME</th>
							<td id="pstoptimeA5" style="color: #FF0000;"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<!--------------------------- A-5 --------------------------->

			<div class="col-sm-3 col-lg-3">
				<h3>MOT A-A6</h3>
				<table class="fl-table-06">
					<tbody>
						<tr>
							<th>Output</th>
							<td id="outputA6"></td>
						</tr>

						<tr>
							<th>Total Time (Min)</th>
							<td id="timetotalA6"></td>
						</tr>

						<tr>
							<th>AVG Cycle Time (Sec/Board)</th>
							<td id="avgA6"></td>
						</tr>

						<tr>
							<th>Processing Time (Min)</th>
							<td id="processingtimeA6"></td>
						</tr>

						<tr>
							<th>Total Runtime (Min)</th>
							<td id="totalrunA6"></td>
						</tr>

						<tr>
							<th>Total Stoptime (Min)</th>
							<td id="totalstopA6"></td>
						</tr>

						<tr>
							<th>% RUNTIME</th>
							<td id="pruntimeA6" style="color: #1DC100;"></td>
						</tr>

						<tr>
							<th>% STOPTIME</th>
							<td id="pstoptimeA6" style="color: #FF0000;"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<!--------------------------- A-6 --------------------------->

			<div class="col-sm-3 col-lg-3">
				<h3>MOT A-A7</h3>
				<table class="fl-table-07">
					<tbody>
						<tr>
							<th>Output (Board)</th>
							<td id="outputA7"></td>
						</tr>

						<tr>
							<th>Total Time (Min)</th>
							<td id="timetotalA7"></td>
						</tr>

						<tr>
							<th>AVG Cycle Time (Sec/Board)</th>
							<td id="avgA7"></td>
						</tr>

						<tr>
							<th>Processing Time (Min)</th>
							<td id="processingtimeA7"></td>
						</tr>

						<tr>
							<th>Total Runtime (Min)</th>
							<td id="totalrunA7"></td>
						</tr>

						<tr>
							<th>Total Stoptime (Min)</th>
							<td id="totalstopA7"></td>
						</tr>

						<tr>
							<th>% RUNTIME</th>
							<td id="pruntimeA7" style="color: #1DC100;"></td>
						</tr>

						<tr>
							<th>% STOPTIME</th>
							<td id="pstoptimeA7" style="color: #FF0000;"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<!--------------------------- A-7 --------------------------->

			<div class="col-sm-3 col-lg-3">
				<h3>MOT A-A8</h3>
				<table class="fl-table-08">
					<tbody>
						<tr>
							<th>Output (Board)</th>
							<td id="outputA8"></td>
						</tr>

						<tr>
							<th>Total Time (Min)</th>
							<td id="timetotalA8"></td>
						</tr>

						<tr>
							<th>AVG Cycle Time (Sec/Board)</th>
							<td id="avgA8"></td>
						</tr>

						<tr>
							<th>Processing Time (Min)</th>
							<td id="processingtimeA8"></td>
						</tr>

						<tr>
							<th>Total Runtime (Min)</th>
							<td id="totalrunA8"></td>
						</tr>

						<tr>
							<th>Total Stoptime (Min)</th>
							<td id="totalstopA8"></td>
						</tr>

						<tr>
							<th>% RUNTIME</th>
							<td id="pruntimeA8" style="color: #1DC100;"></td>
						</tr>

						<tr>
							<th>% STOPTIME</th>
							<td id="pstoptimeA8" style="color: #FF0000;"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<!--------------------------- A-8 --------------------------->
		</div> 
	</div>
</body>

<script>
$(function() {
   	function realTime() {
      	setTimeout(function(){ 
         	$.ajax({    
            	method: "POST",   
            	data: { rev: 1 },
            	dataType: "json"     
         	}).done(function( data ) {
         		$("#time").html(data.second);  
            	$("#time").addClass("realtime"); 

            	$("#output").html(data.output);  
            	$("#output").addClass("realtime"); 

           		$("#timetotal").html(data.timetotal); 
            	$("#timetotal").addClass("realtime");

            	$("#avg").html(data.avg);  
            	$("#avg").addClass("realtime");

            	$("#processingtime").html(data.processingtime);  
            	$("#processingtime").addClass("realtime"); 
            	$("#totalrun").html(data.totalrun);  
            	$("#totalrun").addClass("realtime");

            	$("#totalstop").html(data.totalstop);  
            	$("#totalstop").addClass("realtime"); 

            	$("#pruntime").html(data.pruntime);  
            	$("#pruntime").addClass("realtime");

            	$("#pstoptime").html(data.pstoptime);  
            	$("#pstoptime").addClass("realtime"); 
            	/* --------------------- A3 --------------------- */

            	$("#outputA1").html(data.outputA1);  
            	$("#outputA1").addClass("realtime"); 

           		$("#timetotalA1").html(data.timetotalA1); 
            	$("#timetotalA1").addClass("realtime");

            	$("#avgA1").html(data.avgA1);  
            	$("#avgA1").addClass("realtime");

            	$("#processingtimeA1").html(data.processingtimeA1);  
            	$("#processingtimeA1").addClass("realtime"); 
            	$("#totalrunA1").html(data.totalrunA1);  
            	$("#totalrunA1").addClass("realtime");

            	$("#totalstopA1").html(data.totalstopA1);  
            	$("#totalstopA1").addClass("realtime"); 

            	$("#pruntimeA1").html(data.pruntimeA1);  
            	$("#pruntimeA1").addClass("realtime");

            	$("#pstoptimeA1").html(data.pstoptimeA1);  
            	$("#pstoptimeA1").addClass("realtime"); 
            	/* --------------------- A1 --------------------- */

            	$("#outputA2").html(data.outputA2);  
            	$("#outputA2").addClass("realtime"); 

           		$("#timetotalA2").html(data.timetotalA2); 
            	$("#timetotalA2").addClass("realtime");

            	$("#avgA2").html(data.avgA2);  
            	$("#avgA2").addClass("realtime");

            	$("#processingtimeA2").html(data.processingtimeA2);  
            	$("#processingtimeA2").addClass("realtime"); 
            	$("#totalrunA2").html(data.totalrunA2);  
            	$("#totalrunA2").addClass("realtime");

            	$("#totalstopA2").html(data.totalstopA2);  
            	$("#totalstopA2").addClass("realtime"); 

            	$("#pruntimeA2").html(data.pruntimeA2);  
            	$("#pruntimeA2").addClass("realtime");

            	$("#pstoptimeA2").html(data.pstoptimeA2);  
            	$("#pstoptimeA2").addClass("realtime"); 
            	/* --------------------- A2 --------------------- */

            	$("#outputA4").html(data.outputA4);  
            	$("#outputA4").addClass("realtime"); 

           		$("#timetotalA4").html(data.timetotalA4); 
            	$("#timetotalA4").addClass("realtime");

            	$("#avgA4").html(data.avgA4);  
            	$("#avgA4").addClass("realtime");

            	$("#processingtimeA4").html(data.processingtimeA4);  
            	$("#processingtimeA4").addClass("realtime"); 
            	
            	$("#totalrunA4").html(data.totalrunA4);  
            	$("#totalrunA4").addClass("realtime");

            	$("#totalstopA4").html(data.totalstopA4);  
            	$("#totalstopA4").addClass("realtime"); 

            	$("#pruntimeA4").html(data.pruntimeA4);  
            	$("#pruntimeA4").addClass("realtime");

            	$("#pstoptimeA4").html(data.pstoptimeA4);  
            	$("#pstoptimeA4").addClass("realtime"); 
            	/* --------------------- A4 --------------------- */

            	$("#outputA5").html(data.outputA5);  
            	$("#outputA5").addClass("realtime"); 

           		$("#timetotalA5").html(data.timetotalA5); 
            	$("#timetotalA5").addClass("realtime");

            	$("#avgA5").html(data.avgA5);  
            	$("#avgA5").addClass("realtime");

            	$("#processingtimeA5").html(data.processingtimeA5);  
            	$("#processingtimeA5").addClass("realtime"); 
            	$("#totalrunA5").html(data.totalrunA5);  
            	$("#totalrunA5").addClass("realtime");

            	$("#totalstopA5").html(data.totalstopA5);  
            	$("#totalstopA5").addClass("realtime"); 

            	$("#pruntimeA5").html(data.pruntimeA5);  
            	$("#pruntimeA5").addClass("realtime");

            	$("#pstoptimeA5").html(data.pstoptimeA5);  
            	$("#pstoptimeA5").addClass("realtime"); 
            	/* --------------------- A5 --------------------- */

            	$("#outputA6").html(data.outputA6);  
            	$("#outputA6").addClass("realtime"); 

           		$("#timetotalA6").html(data.timetotalA6); 
            	$("#timetotalA6").addClass("realtime");

            	$("#avgA6").html(data.avgA6);  
            	$("#avgA6").addClass("realtime");

            	$("#processingtimeA6").html(data.processingtimeA6);  
            	$("#processingtimeA6").addClass("realtime"); 
            	$("#totalrunA6").html(data.totalrunA6);  
            	$("#totalrunA6").addClass("realtime");

            	$("#totalstopA6").html(data.totalstopA6);  
            	$("#totalstopA6").addClass("realtime"); 

            	$("#pruntimeA6").html(data.pruntimeA6);  
            	$("#pruntimeA6").addClass("realtime");

            	$("#pstoptimeA6").html(data.pstoptimeA6);  
            	$("#pstoptimeA6").addClass("realtime"); 
            	/* --------------------- A6 --------------------- */

            	$("#outputA7").html(data.outputA7);  
            	$("#outputA7").addClass("realtime"); 

           		$("#timetotalA7").html(data.timetotalA7); 
            	$("#timetotalA7").addClass("realtime");

            	$("#avgA7").html(data.avgA7);  
            	$("#avgA7").addClass("realtime");

            	$("#processingtimeA7").html(data.processingtimeA7);  
            	$("#processingtimeA7").addClass("realtime"); 
            	$("#totalrunA7").html(data.totalrunA7);  
            	$("#totalrunA7").addClass("realtime");

            	$("#totalstopA7").html(data.totalstopA7);  
            	$("#totalstopA7").addClass("realtime"); 

            	$("#pruntimeA7").html(data.pruntimeA7);  
            	$("#pruntimeA7").addClass("realtime");

            	$("#pstoptimeA7").html(data.pstoptimeA7);  
            	$("#pstoptimeA7").addClass("realtime"); 
            	/* --------------------- A7 --------------------- */

            	$("#outputA8").html(data.outputA8);  
            	$("#outputA8").addClass("realtime"); 

           		$("#timetotalA8").html(data.timetotalA8); 
            	$("#timetotalA8").addClass("realtime");

            	$("#avgA8").html(data.avgA8);  
            	$("#avgA8").addClass("realtime");

            	$("#processingtimeA8").html(data.processingtimeA8);  
            	$("#processingtimeA8").addClass("realtime"); 
            	$("#totalrunA8").html(data.totalrunA8);  
            	$("#totalrunA8").addClass("realtime");

            	$("#totalstopA8").html(data.totalstopA8);  
            	$("#totalstopA8").addClass("realtime"); 

            	$("#pruntimeA8").html(data.pruntimeA8);  
            	$("#pruntimeA8").addClass("realtime");

            	$("#pstoptimeA8").html(data.pstoptimeA8);  
            	$("#pstoptimeA8").addClass("realtime"); 
            	/* --------------------- A8 --------------------- */
         	});
      	realTime();  
      	}, 1000);  
   	}
   	realTime();
});
</script>

<?php include_once('layouts/footer.php'); ?>