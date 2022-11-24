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
		$rowsOutput = mysqli_num_rows($result);
		if ($rowsOutput > 0) {
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$output = $output + $row['total'];
			}
		} else {
			$output = 0;
		}

		$divProduct = "No Plan/No Run";
		$productresult = "";
		$queryproduct = "SELECT Product_Name FROM a3 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$product = $db->query($queryproduct);
		$rowsProduct = mysqli_num_rows($product);
		if ($rowsProduct > 0) {
			while ($row = $product->fetch_array(MYSQLI_ASSOC)) {
				$productresult = $row['Product_Name'];
			}
		} else {
			$productresult = "No Plan/No Run";
		}

		$pcsresult = "";
		$pcstotal = 0;
		$querypcs = "SELECT pcs FROM program WHERE Program_Name = '$productresult'";
		$pcs = $db->query($querypcs);
		$rowsPcs = mysqli_num_rows($pcs);
		if ($rowsPcs > 0) {
			while ($row = $pcs->fetch_array(MYSQLI_ASSOC)) {
				$pcsresult = $row['pcs'];
			}
		} else {
			$pcsresult = 0;
		}
		$pcsday = $output*$pcsresult;
		$pcshour = $pcsday;

		$targetresult = "";
		$targettotal = 0;
		$hourtarget = 0;
		$querytarget = "SELECT target FROM target WHERE datetime BETWEEN '$Start' AND '$End'";
		$target = $db->query($querytarget);
		$rows = mysqli_num_rows($target);
		if ($rows > 0) {
			while ($row = $target->fetch_array(MYSQLI_ASSOC)) {
				$targetresult = $row['target'];
			}
		} else {
			$targetresult = 0;
		}

		$barlanceresult = $pcsday - $targetresult;
		$hourtarget = $targetresult/24;

		$now = date('Y-m-d H:i:s');
		$hour = date_parse($now)['hour'];
		if ($hour == 8) {
			$targethr = $pcshour - ($hourtarget*1);
			$barlanceHr = $hourtarget*1;
		} elseif ($hour == 9) {
			$targethr = $pcshour - ($hourtarget*2);
			$barlanceHr = $hourtarget*2;
		} elseif ($hour == 10) {
			$targethr = $pcshour - ($hourtarget*3);
			$barlanceHr = $hourtarget*3;
		} elseif ($hour == 11) {
			$targethr = $pcshour - ($hourtarget*4);
			$barlanceHr = $hourtarget*4;
		} elseif ($hour == 12) {
			$targethr = $pcshour - ($hourtarget*5);
			$barlanceHr = $hourtarget*5;
		} elseif ($hour == 13) {
			$targethr = $pcshour - ($hourtarget*6);
			$barlanceHr = $hourtarget*6;
		} elseif ($hour == 14) {
			$targethr = $pcshour - ($hourtarget*7);
			$barlanceHr = $hourtarget*7;
		} elseif ($hour == 15) {
			$targethr = $pcshour - ($hourtarget*8);
			$barlanceHr = $hourtarget*8;
		} elseif ($hour == 16) {
			$targethr = $pcshour - ($hourtarget*9);
			$barlanceHr = $hourtarget*9;
		} elseif ($hour == 17) {
			$targethr = $pcshour - ($hourtarget*10);
			$barlanceHr = $hourtarget*10;
		} elseif ($hour == 18) {
			$targethr = $pcshour - ($hourtarget*11);
			$barlanceHr = $hourtarget*11;
		} elseif ($hour == 19) {
			$targethr = $pcshour - ($hourtarget*12);
			$barlanceHr = $hourtarget*12;
		} elseif ($hour == 20) {
			$targethr = $pcshour - ($hourtarget*13);
			$barlanceHr = $hourtarget*13;
		} elseif ($hour == 21) {
			$targethr = $pcshour - ($hourtarget*14);
			$barlanceHr = $hourtarget*14;
		} elseif ($hour == 22) {
			$targethr = $pcshour - ($hourtarget*15);
			$barlanceHr = $hourtarget*15;
		} elseif ($hour == 23) {
			$targethr = $pcshour - ($hourtarget*16);
			$barlanceHr = $hourtarget*16;
		} elseif ($hour == 0) {
			$targethr = $pcshour - ($hourtarget*17);
			$barlanceHr = $hourtarget*17;
		} elseif ($hour == 1) {
			$targethr = $pcshour - ($hourtarget*18);
			$barlanceHr = $hourtarget*18;
		} elseif ($hour == 2) {
			$targethr = $pcshour - ($hourtarget*19);
			$barlanceHr = $hourtarget*19;
		} elseif ($hour == 3) {
			$targethr = $pcshour - ($hourtarget*20);
			$barlanceHr = $hourtarget*20;
		} elseif ($hour == 4) {
			$targethr = $pcshour - ($hourtarget*21);
			$barlanceHr = $hourtarget*21;
		} elseif ($hour == 5) {
			$targethr = $pcshour - ($hourtarget*22);
			$barlanceHr = $hourtarget*22;
		} elseif ($hour == 6) {
			$targethr = $pcshour - ($hourtarget*23);
			$barlanceHr = $hourtarget*23;
		} elseif ($hour == 7) {
			$targethr = $pcshour - ($hourtarget*24);
			$barlanceHr = $hourtarget*24;
		}

		$timetotal = 0;
		$querytime = "SELECT Date_time AS t,Takt_time as tak FROM a3 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resulttime = $db->query($querytime);
		while ($row = $resulttime->fetch_array(MYSQLI_ASSOC)) {
			$outputtime = strtotime($row['t']);
			$timetotal = ($outputtime - strtotime('$Start'))/60;
		}

		$avgtime = 0;
		$timeSecond = 0;
		$av = 0;
		$Timeavg = date('H:i:s', strtotime('08:00:00'));
		$queryavg = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a3 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resultavg = $db->query($queryavg);
		$count = mysqli_num_rows($resultavg);
		$FirstRun = true;
		while ($row = $resultavg->fetch_array(MYSQLI_ASSOC)) {
			if ($FirstRun) {
				$FirstRun = false;
				$starttimeFirst = $row['starttime'];
				$timeFirst = (strtotime($starttimeFirst) - strtotime('$Start'));
				if ($timeFirst < 300) {
					$av = ($av + $timeFirst);
				}
			} else {
				$endtimeSecond = strtotime($row['endtime']);
				$starttimeSecond = strtotime($row['starttime']);
				$takttimeSecond = $row['takttime'];
				$Eavg = $endtimeSecond + $takttimeSecond;
				$timeSecond = ($Eavg - $starttimeSecond);
				if ($timeSecond < 300) {
					$avgtime = ($avgtime + $timeSecond);
				}
			}
		}

		$AVG = ($avgtime + $av);
		if ($AVG > 0) {
			$avg = ($AVG/$count);
		} else {
			$avg = 0;
		}
		$processingtime = ($output*$avg)/60;

		$Timerunstop = date('H:i:s',strtotime('08:00:00'));
		$queryrunstop = "SELECT Takt_time as tk,start_time as st,end_time as et FROM a3 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resultrunstop = $db->query($queryrunstop);
		$First = true;
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
    	$zero = 0; 
    	/* --------------------------- A-3 --------------------------- */

		$outputA1 = 0;
		$queryA1 = "SELECT count(*) AS total FROM a1 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resultA1 = $db->query($queryA1);
		$rowsOutputA1 = mysqli_num_rows($resultA1);
		if ($rowsOutputA1 > 0) {
			while ($rowA1 = $resultA1->fetch_array(MYSQLI_ASSOC)) {
				$outputA1 = $outputA1 + $rowA1['total'];
			}
		} else {
			$outputA1 = 0;
		}

		$divProductA1 = "No Plan/No Run";
		$productresultA1 = "";
		$queryproductA1 = "SELECT Product_Name FROM a1 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$productA1 = $db->query($queryproductA1);
		$rowsProductA1 = mysqli_num_rows($productA1);
		if ($rowsProductA1 > 0) {
			while ($rowA1 = $productA1->fetch_array(MYSQLI_ASSOC)) {
				$productresultA1 = $rowA1['Product_Name'];
			}
		} else {
			$productresultA1 = "No Plan/No Run";
		}

		$pcsresultA1 = "";
		$pcstotalA1 = 0;
		$querypcsA1 = "SELECT pcs FROM program WHERE Program_Name = '$productresultA1'";
		$pcsA1 = $db->query($querypcsA1);
		$rowsPcsA1 = mysqli_num_rows($pcsA1);
		if ($rowsPcsA1 > 0) {
			while ($rowA1 = $pcsA1->fetch_array(MYSQLI_ASSOC)) {
				$pcsresultA1 = $rowA1['pcs'];
			}
		} else {
			$pcsresultA1 = 0;
		}
		$pcsdayA1 = $outputA1*$pcsresultA1;
		$pcshourA1 = $pcsdayA1;

		$targetresultA1 = "";
		$targettotalA1 = 0;
		$hourtargetA1 = 0;
		$querytargetA1 = "SELECT target FROM target_a1 WHERE datetime BETWEEN '$Start' AND '$End'";
		$targetA1 = $db->query($querytargetA1);
		$rowsA1 = mysqli_num_rows($targetA1);
		if ($rowsA1 > 0) {
			while ($rowA1 = $targetA1->fetch_array(MYSQLI_ASSOC)) {
				$targetresultA1 = $rowA1['target'];
			}
		} else {
			$targetresultA1 = 0;
		}

		$barlanceresultA1 = $pcsdayA1 - $targetresultA1;
		$hourtargetA1 = $targetresultA1/24;

		$now = date('Y-m-d H:i:s');
		$hour = date_parse($now)['hour'];
		if ($hour == 8) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*1);
			$barlanceHrA1 = $hourtargetA1*1;
		} elseif ($hour == 9) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*2);
			$barlanceHrA1 = $hourtargetA1*2;
		} elseif ($hour == 10) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*3);
			$barlanceHrA1 = $hourtargetA1*3;
		} elseif ($hour == 11) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*4);
			$barlanceHrA1 = $hourtargetA1*4;
		} elseif ($hour == 12) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*5);
			$barlanceHrA1 = $hourtargetA1*5;
		} elseif ($hour == 13) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*6);
			$barlanceHrA1 = $hourtargetA1*6;
		} elseif ($hour == 14) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*7);
			$barlanceHrA1 = $hourtargetA1*7;
		} elseif ($hour == 15) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*8);
			$barlanceHrA1 = $hourtargetA1*8;
		} elseif ($hour == 16) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*9);
			$barlanceHrA1 = $hourtargetA1*9;
		} elseif ($hour == 17) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*10);
			$barlanceHrA1 = $hourtargetA1*10;
		} elseif ($hour == 18) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*11);
			$barlanceHrA1 = $hourtargetA1*11;
		} elseif ($hour == 19) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*12);
			$barlanceHrA1 = $hourtargetA1*12;
		} elseif ($hour == 20) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*13);
			$barlanceHrA1 = $hourtargetA1*13;
		} elseif ($hour == 21) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*14);
			$barlanceHrA1 = $hourtargetA1*14;
		} elseif ($hour == 22) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*15);
			$barlanceHrA1 = $hourtargetA1*15;
		} elseif ($hour == 23) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*16);
			$barlanceHrA1 = $hourtargetA1*16;
		} elseif ($hour == 0) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*17);
			$barlanceHrA1 = $hourtargetA1*17;
		} elseif ($hour == 1) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*18);
			$barlanceHrA1 = $hourtargetA1*18;
		} elseif ($hour == 2) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*19);
			$barlanceHrA1 = $hourtargetA1*19;
		} elseif ($hour == 3) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*20);
			$barlanceHrA1 = $hourtargetA1*20;
		} elseif ($hour == 4) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*21);
			$barlanceHrA1 = $hourtargetA1*21;
		} elseif ($hour == 5) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*22);
			$barlanceHrA1 = $hourtargetA1*22;
		} elseif ($hour == 6) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*23);
			$barlanceHrA1 = $hourtargetA1*23;
		} elseif ($hour == 7) {
			$targethrA1 = $pcshourA1 - ($hourtargetA1*24);
			$barlanceHrA1 = $hourtargetA1*24;
		}

		$timetotalA1 = 0;
		$querytimeA1 = "SELECT Date_time AS t,Takt_time as tak FROM a1 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resulttimeA1 = $db->query($querytimeA1);
		while ($rowA1 = $resulttimeA1->fetch_array(MYSQLI_ASSOC)) {
			$outputtimeA1 = strtotime($rowA1['t']);
			$timetotalA1 = ($outputtimeA1 - strtotime('$Start'))/60;
		}

		$avgtimeA1 = 0;
		$timeSecondA1 = 0;
		$avA1 = 0;
		$TimeavgA1 = date('H:i:s', strtotime('08:00:00'));
		$queryavgA1 = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a1 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resultavgA1 = $db->query($queryavgA1);
		$countA1 = mysqli_num_rows($resultavgA1);
		$FirstRunA1 = true;
		while ($rowA1 = $resultavgA1->fetch_array(MYSQLI_ASSOC)) {
			if ($FirstRunA1) {
				$FirstRunA1 = false;
				$starttimeFirstA1 = $rowA1['starttime'];
				$timeFirstA1 = (strtotime($starttimeFirstA1) - strtotime('$Start'));
				if ($timeFirstA1 < 300) {
					$avA1 = ($avA1 + $timeFirstA1);
				}
			} else {
				$endtimeSecondA1 = strtotime($rowA1['endtime']);
				$starttimeSecondA1 = strtotime($rowA1['starttime']);
				$takttimeSecondA1 = $rowA1['takttime'];
				$EavgA1 = $endtimeSecondA1 + $takttimeSecondA1;
				$timeSecondA1 = ($EavgA1 - $starttimeSecondA1);
				if ($timeSecondA1 < 300) {
					$avgtimeA1 = ($avgtimeA1 + $timeSecondA1);
				}
			}
		}

		$AVGA1 = ($avgtimeA1 + $avA1);
		if ($AVGA1 > 0) {
			$avgA1 = ($AVGA1/$countA1);
		} else {
			$avgA1 = 0;
		}
		$processingtimeA1 = ($outputA1*$avgA1)/60;

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
        		$timerunstopA1 = (strtotime($runstartFirstA1) - strtotime('$Start'));
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
    	$zeroA1 = 0;
    	/* --------------------------- A-1 --------------------------- */

    	$outputA2 = 0;
		$queryA2 = "SELECT count(*) AS total FROM a2 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resultA2 = $db->query($queryA2);
		$rowsOutputA2 = mysqli_num_rows($resultA2);
		if ($rowsOutputA2 > 0) {
			while ($rowA2 = $resultA2->fetch_array(MYSQLI_ASSOC)) {
				$outputA2 = $outputA2 + $rowA2['total'];
			}
		} else {
			$outputA2 = 0;
		}

		$divProductA2 = "No Plan/No Run";
		$productresultA2 = "";
		$queryproductA2 = "SELECT Product_Name FROM a2 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$productA2 = $db->query($queryproductA2);
		$rowsProductA2 = mysqli_num_rows($productA2);
		if ($rowsProductA2 > 0) {
			while ($rowA2 = $productA2->fetch_array(MYSQLI_ASSOC)) {
				$productresultA2 = $rowA2['Product_Name'];
			}
		} else {
			$productresultA2 = "No Plan/No Run";
		}

		$pcsresultA2 = "";
		$pcstotalA2 = 0;
		$querypcsA2 = "SELECT pcs FROM program WHERE Program_Name = '$productresultA2'";
		$pcsA2 = $db->query($querypcsA2);
		$rowsPcsA2 = mysqli_num_rows($pcsA2);
		if ($rowsPcsA2 > 0) {
			while ($rowA2 = $pcsA2->fetch_array(MYSQLI_ASSOC)) {
				$pcsresultA2 = $rowA2['pcs'];
			}
		} else {
			$pcsresultA2 = 0;
		}
		$pcsdayA2 = $outputA2*$pcsresultA2;
		$pcshourA2 = $pcsdayA2;

		$targetresultA2 = "";
		$targettotalA2 = 0;
		$hourtargetA2 = 0;
		$querytargetA2 = "SELECT target FROM target_a2 WHERE datetime BETWEEN '$Start' AND '$End'";
		$targetA2 = $db->query($querytargetA2);
		$rowsA2 = mysqli_num_rows($targetA2);
		if ($rowsA2 > 0) {
			while ($rowA2 = $targetA2->fetch_array(MYSQLI_ASSOC)) {
				$targetresultA2 = $rowA2['target'];
			}
		} else {
			$targetresultA2 = 0;
		}

		$barlanceresultA2 = $pcsdayA2 - $targetresultA2;
		$hourtargetA2 = $targetresultA2/24;

		$now = date('Y-m-d H:i:s');
		$hour = date_parse($now)['hour'];
		if ($hour == 8) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*1);
			$barlanceHrA2 = $hourtargetA2*1;
		} elseif ($hour == 9) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*2);
			$barlanceHrA2 = $hourtargetA2*2;
		} elseif ($hour == 10) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*3);
			$barlanceHrA2 = $hourtargetA2*3;
		} elseif ($hour == 11) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*4);
			$barlanceHrA2 = $hourtargetA2*4;
		} elseif ($hour == 12) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*5);
			$barlanceHrA2 = $hourtargetA2*5;
		} elseif ($hour == 13) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*6);
			$barlanceHrA2 = $hourtargetA2*6;
		} elseif ($hour == 14) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*7);
			$barlanceHrA2 = $hourtargetA2*7;
		} elseif ($hour == 15) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*8);
			$barlanceHrA2 = $hourtargetA2*8;
		} elseif ($hour == 16) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*9);
			$barlanceHrA2 = $hourtargetA2*9;
		} elseif ($hour == 17) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*10);
			$barlanceHrA2 = $hourtargetA2*10;
		} elseif ($hour == 18) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*11);
			$barlanceHrA2 = $hourtargetA2*11;
		} elseif ($hour == 19) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*12);
			$barlanceHrA2 = $hourtargetA2*12;
		} elseif ($hour == 20) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*13);
			$barlanceHrA2 = $hourtargetA2*13;
		} elseif ($hour == 21) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*14);
			$barlanceHrA2 = $hourtargetA2*14;
		} elseif ($hour == 22) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*15);
			$barlanceHrA2 = $hourtargetA2*15;
		} elseif ($hour == 23) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*16);
			$barlanceHrA2 = $hourtargetA2*16;
		} elseif ($hour == 0) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*17);
			$barlanceHrA2 = $hourtargetA2*17;
		} elseif ($hour == 1) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*18);
			$barlanceHrA2 = $hourtargetA2*18;
		} elseif ($hour == 2) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*19);
			$barlanceHrA2 = $hourtargetA2*19;
		} elseif ($hour == 3) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*20);
			$barlanceHrA2 = $hourtargetA2*20;
		} elseif ($hour == 4) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*21);
			$barlanceHrA2 = $hourtargetA2*21;
		} elseif ($hour == 5) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*22);
			$barlanceHrA2 = $hourtargetA2*22;
		} elseif ($hour == 6) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*23);
			$barlanceHrA2 = $hourtargetA2*23;
		} elseif ($hour == 7) {
			$targethrA2 = $pcshourA2 - ($hourtargetA2*24);
			$barlanceHrA2 = $hourtargetA2*24;
		}

		$timetotalA2 = 0;
		$querytimeA2 = "SELECT Date_time AS t,Takt_time as tak FROM a2 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resulttimeA2 = $db->query($querytimeA2);
		while ($rowA2 = $resulttimeA2->fetch_array(MYSQLI_ASSOC)) {
			$outputtimeA2 = strtotime($rowA2['t']);
			$timetotalA2 = ($outputtimeA2 - strtotime('$Start'))/60;
		}

		$avgtimeA2 = 0;
		$timeSecondA2 = 0;
		$avA2 = 0;
		$TimeavgA2 = date('H:i:s', strtotime('08:00:00'));
		$queryavgA2 = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a2 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resultavgA2 = $db->query($queryavgA2);
		$countA2 = mysqli_num_rows($resultavgA2);
		$FirstRunA2 = true;
		while ($rowA2 = $resultavgA2->fetch_array(MYSQLI_ASSOC)) {
			if ($FirstRunA2) {
				$FirstRunA2 = false;
				$starttimeFirstA2 = $rowA2['starttime'];
				$timeFirstA2 = (strtotime($starttimeFirstA2) - strtotime('$Start'));
				if ($timeFirstA2 < 300) {
					$avA2 = ($avA2 + $timeFirstA2);
				}
			} else {
				$endtimeSecondA2 = strtotime($rowA2['endtime']);
				$starttimeSecondA2 = strtotime($rowA2['starttime']);
				$takttimeSecondA2 = $rowA2['takttime'];
				$EavgA2 = $endtimeSecondA2 + $takttimeSecondA2;
				$timeSecondA2 = ($EavgA2 - $starttimeSecondA2);
				if ($timeSecondA2 < 300) {
					$avgtimeA2 = ($avgtimeA2 + $timeSecondA2);
				}
			}
		}

		$AVGA2 = ($avgtimeA2 + $avA2);
		if ($AVGA2 > 0) {
			$avgA2 = ($AVGA2/$countA2);
		} else {
			$avgA2 = 0;
		}
		$processingtimeA2 = ($outputA2*$avgA2)/60;

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
        		$timerunstopA2 = (strtotime($runstartFirstA2) - strtotime('$Start'));
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
    	$zeroA2 = 0;
    	/* --------------------------- A-2 --------------------------- */

    	$outputA4 = 0;
		$queryA4 = "SELECT count(*) AS total FROM a4 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resultA4 = $db->query($queryA4);
		$rowsOutputA4 = mysqli_num_rows($resultA4);
		if ($rowsOutputA4 > 0) {
			while ($rowA4 = $resultA4->fetch_array(MYSQLI_ASSOC)) {
				$outputA4 = $outputA4 + $rowA4['total'];
			}
		} else {
			$outputA4 = 0;
		}

		$divProductA4 = "No Plan/No Run";
		$productresultA4 = "";
		$queryproductA4 = "SELECT Product_Name FROM a4 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$productA4 = $db->query($queryproductA4);
		$rowsProductA4 = mysqli_num_rows($productA4);
		if ($rowsProductA4 > 0) {
			while ($rowA4 = $productA4->fetch_array(MYSQLI_ASSOC)) {
				$productresultA4 = $rowA4['Product_Name'];
			}
		} else {
			$productresultA4 = "No Plan/No Run";
		}

		$pcsresultA4 = "";
		$pcstotalA4 = 0;
		$querypcsA4 = "SELECT pcs FROM program WHERE Program_Name = '$productresultA4'";
		$pcsA4 = $db->query($querypcsA4);
		$rowsPcsA4 = mysqli_num_rows($pcsA4);
		if ($rowsPcsA4 > 0) {
			while ($rowA4 = $pcsA4->fetch_array(MYSQLI_ASSOC)) {
				$pcsresultA4 = $rowA4['pcs'];
			}
		} else {
			$pcsresultA4 = 0;
		}
		$pcsdayA4 = $outputA4*$pcsresultA4;
		$pcshourA4 = $pcsdayA4;

		$targetresultA4 = "";
		$targettotalA4 = 0;
		$hourtargetA4 = 0;
		$querytargetA4 = "SELECT target FROM target_a4 WHERE datetime BETWEEN '$Start' AND '$End'";
		$targetA4 = $db->query($querytargetA4);
		$rowsA4 = mysqli_num_rows($targetA4);
		if ($rowsA4 > 0) {
			while ($rowA4 = $targetA4->fetch_array(MYSQLI_ASSOC)) {
				$targetresultA4 = $rowA4['target'];
			}
		} else {
			$targetresultA4 = 0;
		}

		$barlanceresultA4 = $pcsdayA4 - $targetresultA4;
		$hourtargetA4 = $targetresultA4/24;

		$now = date('Y-m-d H:i:s');
		$hour = date_parse($now)['hour'];
		if ($hour == 8) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*1);
			$barlanceHrA4 = $hourtargetA4*1;
		} elseif ($hour == 9) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*2);
			$barlanceHrA4 = $hourtargetA4*2;
		} elseif ($hour == 10) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*3);
			$barlanceHrA4 = $hourtargetA4*3;
		} elseif ($hour == 11) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*4);
			$barlanceHrA4 = $hourtargetA4*4;
		} elseif ($hour == 12) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*5);
			$barlanceHrA4 = $hourtargetA4*5;
		} elseif ($hour == 13) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*6);
			$barlanceHrA4 = $hourtargetA4*6;
		} elseif ($hour == 14) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*7);
			$barlanceHrA4 = $hourtargetA4*7;
		} elseif ($hour == 15) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*8);
			$barlanceHrA4 = $hourtargetA4*8;
		} elseif ($hour == 16) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*9);
			$barlanceHrA4 = $hourtargetA4*9;
		} elseif ($hour == 17) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*10);
			$barlanceHrA4 = $hourtargetA4*10;
		} elseif ($hour == 18) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*11);
			$barlanceHrA4 = $hourtargetA4*11;
		} elseif ($hour == 19) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*12);
			$barlanceHrA4 = $hourtargetA4*12;
		} elseif ($hour == 20) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*13);
			$barlanceHrA4 = $hourtargetA4*13;
		} elseif ($hour == 21) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*14);
			$barlanceHrA4 = $hourtargetA4*14;
		} elseif ($hour == 22) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*15);
			$barlanceHrA4 = $hourtargetA4*15;
		} elseif ($hour == 23) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*16);
			$barlanceHrA4 = $hourtargetA4*16;
		} elseif ($hour == 0) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*17);
			$barlanceHrA4 = $hourtargetA4*17;
		} elseif ($hour == 1) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*18);
			$barlanceHrA4 = $hourtargetA4*18;
		} elseif ($hour == 2) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*19);
			$barlanceHrA4 = $hourtargetA4*19;
		} elseif ($hour == 3) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*20);
			$barlanceHrA4 = $hourtargetA4*20;
		} elseif ($hour == 4) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*21);
			$barlanceHrA4 = $hourtargetA4*21;
		} elseif ($hour == 5) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*22);
			$barlanceHrA4 = $hourtargetA4*22;
		} elseif ($hour == 6) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*23);
			$barlanceHrA4 = $hourtargetA4*23;
		} elseif ($hour == 7) {
			$targethrA4 = $pcshourA4 - ($hourtargetA4*24);
			$barlanceHrA4 = $hourtargetA4*24;
		}

		$timetotalA4 = 0;
		$querytimeA4 = "SELECT Date_time AS t,Takt_time as tak FROM a4 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resulttimeA4 = $db->query($querytimeA4);
		while ($rowA4 = $resulttimeA4->fetch_array(MYSQLI_ASSOC)) {
			$outputtimeA4 = strtotime($rowA4['t']);
			$timetotalA4 = ($outputtimeA4 - strtotime('$Start'))/60;
		}

		$avgtimeA4 = 0;
		$timeSecondA4 = 0;
		$avA4 = 0;
		$TimeavgA4 = date('H:i:s', strtotime('08:00:00'));
		$queryavgA4 = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a4 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resultavgA4 = $db->query($queryavgA4);
		$countA4 = mysqli_num_rows($resultavgA4);
		$FirstRunA4 = true;
		while ($rowA4 = $resultavgA4->fetch_array(MYSQLI_ASSOC)) {
			if ($FirstRunA4) {
				$FirstRunA4 = false;
				$starttimeFirstA4 = $rowA4['starttime'];
				$timeFirstA4 = (strtotime($starttimeFirstA4) - strtotime('$Start'));
				if ($timeFirstA4 < 300) {
					$avA4 = ($avA4 + $timeFirstA4);
				}
			} else {
				$endtimeSecondA4 = strtotime($rowA4['endtime']);
				$starttimeSecondA4 = strtotime($rowA4['starttime']);
				$takttimeSecondA4 = $rowA4['takttime'];
				$EavgA4 = $endtimeSecondA4 + $takttimeSecondA4;
				$timeSecondA4 = ($EavgA4 - $starttimeSecondA4);
				if ($timeSecondA4 < 300) {
					$avgtimeA4 = ($avgtimeA4 + $timeSecondA4);
				}
			}
		}

		$AVGA4 = ($avgtimeA4 + $avA4);
		if ($AVGA4 > 0) {
			$avgA4 = ($AVGA4/$countA4);
		} else {
			$avgA4 = 0;
		}
		$processingtimeA4 = ($outputA4*$avgA4)/60;

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
        		$timerunstopA4 = (strtotime($runstartFirstA4) - strtotime('$Start'));
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
    	$zeroA4 = 0;
    	/* --------------------------- A-4 --------------------------- */

    	$outputA5 = 0;
		$queryA5 = "SELECT count(*) AS total FROM a5 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resultA5 = $db->query($queryA5);
		$rowsOutputA5 = mysqli_num_rows($resultA5);
		if ($rowsOutputA5 > 0) {
			while ($rowA5 = $resultA5->fetch_array(MYSQLI_ASSOC)) {
				$outputA5 = $outputA5 + $rowA5['total'];
			}
		} else {
			$outputA5 = 0;
		}

		$divProductA5 = "No Plan/No Run";
		$productresultA5 = "";
		$queryproductA5 = "SELECT Product_Name FROM a5 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$productA5 = $db->query($queryproductA5);
		$rowsProductA5 = mysqli_num_rows($productA5);
		if ($rowsProductA5 > 0) {
			while ($rowA5 = $productA5->fetch_array(MYSQLI_ASSOC)) {
				$productresultA5 = $rowA5['Product_Name'];
			}
		} else {
			$productresultA5 = "No Plan/No Run";
		}

		$pcsresultA5 = "";
		$pcstotalA5 = 0;
		$querypcsA5 = "SELECT pcs FROM program WHERE Program_Name = '$productresultA5'";
		$pcsA5 = $db->query($querypcsA5);
		$rowsPcsA5 = mysqli_num_rows($pcsA5);
		if ($rowsPcsA5 > 0) {
			while ($rowA5 = $pcsA5->fetch_array(MYSQLI_ASSOC)) {
				$pcsresultA5 = $rowA5['pcs'];
			}
		} else {
			$pcsresultA5 = 0;
		}
		$pcsdayA5 = $outputA5*$pcsresultA5;
		$pcshourA5 = $pcsdayA5;

		$targetresultA5 = "";
		$targettotalA5 = 0;
		$hourtargetA5 = 0;
		$querytargetA5 = "SELECT target FROM target_a5 WHERE datetime BETWEEN '$Start' AND '$End'";
		$targetA5 = $db->query($querytargetA5);
		$rowsA5 = mysqli_num_rows($targetA5);
		if ($rowsA5 > 0) {
			while ($rowA5 = $targetA5->fetch_array(MYSQLI_ASSOC)) {
				$targetresultA5 = $rowA5['target'];
			}
		} else {
			$targetresultA5 = 0;
		}

		$barlanceresultA5 = $pcsdayA5 - $targetresultA5;
		$hourtargetA5 = $targetresultA5/24;

		$now = date('Y-m-d H:i:s');
		$hour = date_parse($now)['hour'];
		if ($hour == 8) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*1);
			$barlanceHrA5 = $hourtargetA5*1;
		} elseif ($hour == 9) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*2);
			$barlanceHrA5 = $hourtargetA5*2;
		} elseif ($hour == 10) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*3);
			$barlanceHrA5 = $hourtargetA5*3;
		} elseif ($hour == 11) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*4);
			$barlanceHrA5 = $hourtargetA5*4;
		} elseif ($hour == 12) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*5);
			$barlanceHrA5 = $hourtargetA5*5;
		} elseif ($hour == 13) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*6);
			$barlanceHrA5 = $hourtargetA5*6;
		} elseif ($hour == 14) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*7);
			$barlanceHrA5 = $hourtargetA5*7;
		} elseif ($hour == 15) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*8);
			$barlanceHrA5 = $hourtargetA5*8;
		} elseif ($hour == 16) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*9);
			$barlanceHrA5 = $hourtargetA5*9;
		} elseif ($hour == 17) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*10);
			$barlanceHrA5 = $hourtargetA5*10;
		} elseif ($hour == 18) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*11);
			$barlanceHrA5 = $hourtargetA5*11;
		} elseif ($hour == 19) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*12);
			$barlanceHrA5 = $hourtargetA5*12;
		} elseif ($hour == 20) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*13);
			$barlanceHrA5 = $hourtargetA5*13;
		} elseif ($hour == 21) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*14);
			$barlanceHrA5 = $hourtargetA5*14;
		} elseif ($hour == 22) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*15);
			$barlanceHrA5 = $hourtargetA5*15;
		} elseif ($hour == 23) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*16);
			$barlanceHrA5 = $hourtargetA5*16;
		} elseif ($hour == 0) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*17);
			$barlanceHrA5 = $hourtargetA5*17;
		} elseif ($hour == 1) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*18);
			$barlanceHrA5 = $hourtargetA5*18;
		} elseif ($hour == 2) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*19);
			$barlanceHrA5 = $hourtargetA5*19;
		} elseif ($hour == 3) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*20);
			$barlanceHrA5 = $hourtargetA5*20;
		} elseif ($hour == 4) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*21);
			$barlanceHrA5 = $hourtargetA5*21;
		} elseif ($hour == 5) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*22);
			$barlanceHrA5 = $hourtargetA5*22;
		} elseif ($hour == 6) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*23);
			$barlanceHrA5 = $hourtargetA5*23;
		} elseif ($hour == 7) {
			$targethrA5 = $pcshourA5 - ($hourtargetA5*24);
			$barlanceHrA5 = $hourtargetA5*24;
		}

		$timetotalA5 = 0;
		$querytimeA5 = "SELECT Date_time AS t,Takt_time as tak FROM a5 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resulttimeA5 = $db->query($querytimeA5);
		while ($rowA5 = $resulttimeA5->fetch_array(MYSQLI_ASSOC)) {
			$outputtimeA5 = strtotime($rowA5['t']);
			$timetotalA5 = ($outputtimeA5 - strtotime('$Start'))/60;
		}

		$avgtimeA5 = 0;
		$timeSecondA5 = 0;
		$avA5 = 0;
		$TimeavgA5 = date('H:i:s', strtotime('08:00:00'));
		$queryavgA5 = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a5 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resultavgA5 = $db->query($queryavgA5);
		$countA5 = mysqli_num_rows($resultavgA5);
		$FirstRunA5 = true;
		while ($rowA5 = $resultavgA5->fetch_array(MYSQLI_ASSOC)) {
			if ($FirstRunA5) {
				$FirstRunA5 = false;
				$starttimeFirstA5 = $rowA5['starttime'];
				$timeFirstA5 = (strtotime($starttimeFirstA5) - strtotime('$Start'));
				if ($timeFirstA5 < 300) {
					$avA5 = ($avA5 + $timeFirstA5);
				}
			} else {
				$endtimeSecondA5 = strtotime($rowA5['endtime']);
				$starttimeSecondA5 = strtotime($rowA5['starttime']);
				$takttimeSecondA5 = $rowA5['takttime'];
				$EavgA5 = $endtimeSecondA5 + $takttimeSecondA5;
				$timeSecondA5 = ($EavgA5 - $starttimeSecondA5);
				if ($timeSecondA5 < 300) {
					$avgtimeA5 = ($avgtimeA5 + $timeSecondA5);
				}
			}
		}

		$AVGA5 = ($avgtimeA5 + $avA5);
		if ($AVGA5 > 0) {
			$avgA5 = ($AVGA5/$countA5);
		} else {
			$avgA5 = 0;
		}
		$processingtimeA5 = ($outputA5*$avgA5)/60;

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
        		$timerunstopA5 = (strtotime($runstartFirstA5) - strtotime('$Start'));
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
    	$zeroA5 = 0;
    	/* --------------------------- A-5 --------------------------- */

    	$outputA6 = 0;
		$queryA6 = "SELECT count(*) AS total FROM a6 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resultA6 = $db->query($queryA6);
		$rowsOutputA6 = mysqli_num_rows($resultA6);
		if ($rowsOutputA6 > 0) {
			while ($rowA6 = $resultA6->fetch_array(MYSQLI_ASSOC)) {
				$outputA6 = $outputA6 + $rowA6['total'];
			}
		} else {
			$outputA6 = 0;
		}

		$divProductA6 = "No Plan/No Run";
		$productresultA6 = "";
		$queryproductA6 = "SELECT Product_Name FROM a6 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$productA6 = $db->query($queryproductA6);
		$rowsProductA6 = mysqli_num_rows($productA6);
		if ($rowsProductA6 > 0) {
			while ($rowA6 = $productA6->fetch_array(MYSQLI_ASSOC)) {
				$productresultA6 = $rowA6['Product_Name'];
			}
		} else {
			$productresultA6 = "No Plan/No Run";
		}

		$pcsresultA6 = "";
		$pcstotalA6 = 0;
		$querypcsA6 = "SELECT pcs FROM program WHERE Program_Name = '$productresultA6'";
		$pcsA6 = $db->query($querypcsA6);
		$rowsPcsA6 = mysqli_num_rows($pcsA6);
		if ($rowsPcsA6 > 0) {
			while ($rowA6 = $pcsA6->fetch_array(MYSQLI_ASSOC)) {
				$pcsresultA6 = $rowA6['pcs'];
			}
		} else {
			$pcsresultA6 = 0;
		}
		$pcsdayA6 = $outputA6*$pcsresultA6;
		$pcshourA6 = $pcsdayA6;

		$targetresultA6 = "";
		$targettotalA6 = 0;
		$hourtargetA6 = 0;
		$querytargetA6 = "SELECT target FROM target_a6 WHERE datetime BETWEEN '$Start' AND '$End'";
		$targetA6 = $db->query($querytargetA6);
		$rowsA6 = mysqli_num_rows($targetA6);
		if ($rowsA6 > 0) {
			while ($rowA6 = $targetA6->fetch_array(MYSQLI_ASSOC)) {
				$targetresultA6 = $rowA6['target'];
			}
		} else {
			$targetresultA6 = 0;
		}

		$barlanceresultA6 = $pcsdayA6 - $targetresultA6;
		$hourtargetA6 = $targetresultA6/24;

		$now = date('Y-m-d H:i:s');
		$hour = date_parse($now)['hour'];
		if ($hour == 8) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*1);
			$barlanceHrA6 = $hourtargetA6*1;
		} elseif ($hour == 9) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*2);
			$barlanceHrA6 = $hourtargetA6*2;
		} elseif ($hour == 10) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*3);
			$barlanceHrA6 = $hourtargetA6*3;
		} elseif ($hour == 11) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*4);
			$barlanceHrA6 = $hourtargetA6*4;
		} elseif ($hour == 12) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*5);
			$barlanceHrA6 = $hourtargetA6*5;
		} elseif ($hour == 13) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*6);
			$barlanceHrA6 = $hourtargetA6*6;
		} elseif ($hour == 14) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*7);
			$barlanceHrA6 = $hourtargetA6*7;
		} elseif ($hour == 15) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*8);
			$barlanceHrA6 = $hourtargetA6*8;
		} elseif ($hour == 16) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*9);
			$barlanceHrA6 = $hourtargetA6*9;
		} elseif ($hour == 17) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*10);
			$barlanceHrA6 = $hourtargetA6*10;
		} elseif ($hour == 18) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*11);
			$barlanceHrA6 = $hourtargetA6*11;
		} elseif ($hour == 19) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*12);
			$barlanceHrA6 = $hourtargetA6*12;
		} elseif ($hour == 20) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*13);
			$barlanceHrA6 = $hourtargetA6*13;
		} elseif ($hour == 21) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*14);
			$barlanceHrA6 = $hourtargetA6*14;
		} elseif ($hour == 22) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*15);
			$barlanceHrA6 = $hourtargetA6*15;
		} elseif ($hour == 23) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*16);
			$barlanceHrA6 = $hourtargetA6*16;
		} elseif ($hour == 0) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*17);
			$barlanceHrA6 = $hourtargetA6*17;
		} elseif ($hour == 1) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*18);
			$barlanceHrA6 = $hourtargetA6*18;
		} elseif ($hour == 2) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*19);
			$barlanceHrA6 = $hourtargetA6*19;
		} elseif ($hour == 3) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*20);
			$barlanceHrA6 = $hourtargetA6*20;
		} elseif ($hour == 4) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*21);
			$barlanceHrA6 = $hourtargetA6*21;
		} elseif ($hour == 5) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*22);
			$barlanceHrA6 = $hourtargetA6*22;
		} elseif ($hour == 6) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*23);
			$barlanceHrA6 = $hourtargetA6*23;
		} elseif ($hour == 7) {
			$targethrA6 = $pcshourA6 - ($hourtargetA6*24);
			$barlanceHrA6 = $hourtargetA6*24;
		}

		$timetotalA6 = 0;
		$querytimeA6 = "SELECT Date_time AS t,Takt_time as tak FROM a6 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resulttimeA6 = $db->query($querytimeA6);
		while ($rowA6 = $resulttimeA6->fetch_array(MYSQLI_ASSOC)) {
			$outputtimeA6 = strtotime($rowA6['t']);
			$timetotalA6 = ($outputtimeA6 - strtotime('$Start'))/60;
		}

		$avgtimeA6 = 0;
		$timeSecondA6 = 0;
		$avA6 = 0;
		$TimeavgA6 = date('H:i:s', strtotime('08:00:00'));
		$queryavgA6 = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a6 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resultavgA6 = $db->query($queryavgA6);
		$countA6 = mysqli_num_rows($resultavgA6);
		$FirstRunA6 = true;
		while ($rowA6 = $resultavgA6->fetch_array(MYSQLI_ASSOC)) {
			if ($FirstRunA6) {
				$FirstRunA6 = false;
				$starttimeFirstA6 = $rowA6['starttime'];
				$timeFirstA6 = (strtotime($starttimeFirstA6) - strtotime('$Start'));
				if ($timeFirstA6 < 300) {
					$avA6 = ($avA6 + $timeFirstA6);
				}
			} else {
				$endtimeSecondA6 = strtotime($rowA6['endtime']);
				$starttimeSecondA6 = strtotime($rowA6['starttime']);
				$takttimeSecondA6 = $rowA6['takttime'];
				$EavgA6 = $endtimeSecondA6 + $takttimeSecondA6;
				$timeSecondA6 = ($EavgA6 - $starttimeSecondA6);
				if ($timeSecondA6 < 300) {
					$avgtimeA6 = ($avgtimeA6 + $timeSecondA6);
				}
			}
		}

		$AVGA6 = ($avgtimeA6 + $avA6);
		if ($AVGA6 > 0) {
			$avgA6 = ($AVGA6/$countA6);
		} else {
			$avgA6 = 0;
		}
		$processingtimeA6 = ($outputA6*$avgA6)/60;

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
        		$timerunstopA6 = (strtotime($runstartFirstA6) - strtotime('$Start'));
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
    	$zeroA6 = 0;
    	/* --------------------------- A-6 --------------------------- */

    	$outputA7 = 0;
		$queryA7 = "SELECT count(*) AS total FROM a7 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resultA7 = $db->query($queryA7);
		$rowsOutputA7 = mysqli_num_rows($resultA7);
		if ($rowsOutputA7 > 0) {
			while ($rowA7 = $resultA7->fetch_array(MYSQLI_ASSOC)) {
				$outputA7 = $outputA7 + $rowA7['total'];
			}
		} else {
			$outputA7 = 0;
		}

		$divProductA7 = "No Plan/No Run";
		$productresultA7 = "";
		$queryproductA7 = "SELECT Product_Name FROM a7 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$productA7 = $db->query($queryproductA7);
		$rowsProductA7 = mysqli_num_rows($productA7);
		if ($rowsProductA7 > 0) {
			while ($rowA7 = $productA7->fetch_array(MYSQLI_ASSOC)) {
				$productresultA7 = $rowA7['Product_Name'];
			}
		} else {
			$productresultA7 = "No Plan/No Run";
		}

		$pcsresultA7 = "";
		$pcstotalA7 = 0;
		$querypcsA7 = "SELECT pcs FROM program WHERE Program_Name = '$productresultA7'";
		$pcsA7 = $db->query($querypcsA7);
		$rowsPcsA7 = mysqli_num_rows($pcsA7);
		if ($rowsPcsA7 > 0) {
			while ($rowA7 = $pcsA7->fetch_array(MYSQLI_ASSOC)) {
				$pcsresultA7 = $rowA7['pcs'];
			}
		} else {
			$pcsresultA7 = 0;
		}
		$pcsdayA7 = $outputA7*$pcsresultA7;
		$pcshourA7 = $pcsdayA7;

		$targetresultA7 = "";
		$targettotalA7 = 0;
		$hourtargetA7 = 0;
		$querytargetA7 = "SELECT target FROM target_a7 WHERE datetime BETWEEN '$Start' AND '$End'";
		$targetA7 = $db->query($querytargetA7);
		$rowsA7 = mysqli_num_rows($targetA7);
		if ($rowsA7 > 0) {
			while ($rowA7 = $targetA7->fetch_array(MYSQLI_ASSOC)) {
				$targetresultA7 = $rowA7['target'];
			}
		} else {
			$targetresultA7 = 0;
		}

		$barlanceresultA7 = $pcsdayA7 - $targetresultA7;
		$hourtargetA7 = $targetresultA7/24;

		$now = date('Y-m-d H:i:s');
		$hour = date_parse($now)['hour'];
		if ($hour == 8) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*1);
			$barlanceHrA7 = $hourtargetA7*1;
		} elseif ($hour == 9) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*2);
			$barlanceHrA7 = $hourtargetA7*2;
		} elseif ($hour == 10) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*3);
			$barlanceHrA7 = $hourtargetA7*3;
		} elseif ($hour == 11) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*4);
			$barlanceHrA7 = $hourtargetA7*4;
		} elseif ($hour == 12) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*5);
			$barlanceHrA7 = $hourtargetA7*5;
		} elseif ($hour == 13) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*6);
			$barlanceHrA7 = $hourtargetA7*6;
		} elseif ($hour == 14) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*7);
			$barlanceHrA7 = $hourtargetA7*7;
		} elseif ($hour == 15) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*8);
			$barlanceHrA7 = $hourtargetA7*8;
		} elseif ($hour == 16) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*9);
			$barlanceHrA7 = $hourtargetA7*9;
		} elseif ($hour == 17) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*10);
			$barlanceHrA7 = $hourtargetA7*10;
		} elseif ($hour == 18) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*11);
			$barlanceHrA7 = $hourtargetA7*11;
		} elseif ($hour == 19) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*12);
			$barlanceHrA7 = $hourtargetA7*12;
		} elseif ($hour == 20) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*13);
			$barlanceHrA7 = $hourtargetA7*13;
		} elseif ($hour == 21) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*14);
			$barlanceHrA7 = $hourtargetA7*14;
		} elseif ($hour == 22) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*15);
			$barlanceHrA7 = $hourtargetA7*15;
		} elseif ($hour == 23) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*16);
			$barlanceHrA7 = $hourtargetA7*16;
		} elseif ($hour == 0) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*17);
			$barlanceHrA7 = $hourtargetA7*17;
		} elseif ($hour == 1) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*18);
			$barlanceHrA7 = $hourtargetA7*18;
		} elseif ($hour == 2) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*19);
			$barlanceHrA7 = $hourtargetA7*19;
		} elseif ($hour == 3) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*20);
			$barlanceHrA7 = $hourtargetA7*20;
		} elseif ($hour == 4) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*21);
			$barlanceHrA7 = $hourtargetA7*21;
		} elseif ($hour == 5) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*22);
			$barlanceHrA7 = $hourtargetA7*22;
		} elseif ($hour == 6) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*23);
			$barlanceHrA7 = $hourtargetA7*23;
		} elseif ($hour == 7) {
			$targethrA7 = $pcshourA7 - ($hourtargetA7*24);
			$barlanceHrA7 = $hourtargetA7*24;
		}

		$timetotalA7 = 0;
		$querytimeA7 = "SELECT Date_time AS t,Takt_time as tak FROM a7 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resulttimeA7 = $db->query($querytimeA7);
		while ($rowA7 = $resulttimeA7->fetch_array(MYSQLI_ASSOC)) {
			$outputtimeA7 = strtotime($rowA7['t']);
			$timetotalA7 = ($outputtimeA7 - strtotime('$Start'))/60;
		}

		$avgtimeA7 = 0;
		$timeSecondA7 = 0;
		$avA7 = 0;
		$TimeavgA7 = date('H:i:s', strtotime('08:00:00'));
		$queryavgA7 = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a7 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resultavgA7 = $db->query($queryavgA7);
		$countA7 = mysqli_num_rows($resultavgA7);
		$FirstRunA7 = true;
		while ($rowA7 = $resultavgA7->fetch_array(MYSQLI_ASSOC)) {
			if ($FirstRunA7) {
				$FirstRunA7 = false;
				$starttimeFirstA7 = $rowA7['starttime'];
				$timeFirstA7 = (strtotime($starttimeFirstA7) - strtotime('$Start'));
				if ($timeFirstA7 < 300) {
					$avA7 = ($avA7 + $timeFirstA7);
				}
			} else {
				$endtimeSecondA7 = strtotime($rowA7['endtime']);
				$starttimeSecondA7 = strtotime($rowA7['starttime']);
				$takttimeSecondA7 = $rowA7['takttime'];
				$EavgA7 = $endtimeSecondA7 + $takttimeSecondA7;
				$timeSecondA7 = ($EavgA7 - $starttimeSecondA7);
				if ($timeSecondA7 < 300) {
					$avgtimeA7 = ($avgtimeA7 + $timeSecondA7);
				}
			}
		}

		$AVGA7 = ($avgtimeA7 + $avA7);
		if ($AVGA7 > 0) {
			$avgA7 = ($AVGA7/$countA7);
		} else {
			$avgA7 = 0;
		}
		$processingtimeA7 = ($outputA7*$avgA7)/60;

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
        		$timerunstopA7 = (strtotime($runstartFirstA7) - strtotime('$Start'));
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
    	$zeroA7 = 0;
    	/* --------------------------- A-7 --------------------------- */

    	$outputA8 = 0;
		$queryA8 = "SELECT count(*) AS total FROM a8 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resultA8 = $db->query($queryA8);
		$rowsOutputA8 = mysqli_num_rows($resultA8);
		if ($rowsOutputA8 > 0) {
			while ($rowA8 = $resultA8->fetch_array(MYSQLI_ASSOC)) {
				$outputA8 = $outputA8 + $rowA8['total'];
			}
		} else {
			$outputA8 = 0;
		}

		$divProductA8 = "No Plan/No Run";
		$productresultA8 = "";
		$queryproductA8 = "SELECT Product_Name FROM a8 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$productA8 = $db->query($queryproductA8);
		$rowsProductA8 = mysqli_num_rows($productA8);
		if ($rowsProductA8 > 0) {
			while ($rowA8 = $productA8->fetch_array(MYSQLI_ASSOC)) {
				$productresultA8 = $rowA8['Product_Name'];
			}
		} else {
			$productresultA8 = "No Plan/No Run";
		}

		$pcsresultA8 = "";
		$pcstotalA8 = 0;
		$querypcsA8 = "SELECT pcs FROM program WHERE Program_Name = '$productresultA8'";
		$pcsA8 = $db->query($querypcsA8);
		$rowsPcsA8 = mysqli_num_rows($pcsA8);
		if ($rowsPcsA8 > 0) {
			while ($rowA8 = $pcsA8->fetch_array(MYSQLI_ASSOC)) {
				$pcsresultA8 = $rowA8['pcs'];
			}
		} else {
			$pcsresultA8 = 0;
		}
		$pcsdayA8 = $outputA8*$pcsresultA8;
		$pcshourA8 = $pcsdayA8;

		$targetresultA8 = "";
		$targettotalA8 = 0;
		$hourtargetA8 = 0;
		$querytargetA8 = "SELECT target FROM target_a8 WHERE datetime BETWEEN '$Start' AND '$End'";
		$targetA8 = $db->query($querytargetA8);
		$rowsA8 = mysqli_num_rows($targetA8);
		if ($rowsA8 > 0) {
			while ($rowA8 = $targetA8->fetch_array(MYSQLI_ASSOC)) {
				$targetresultA8 = $rowA8['target'];
			}
		} else {
			$targetresultA8 = 0;
		}

		$barlanceresultA8 = $pcsdayA8 - $targetresultA8;
		$hourtargetA8 = $targetresultA8/24;

		$now = date('Y-m-d H:i:s');
		$hour = date_parse($now)['hour'];
		if ($hour == 8) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*1);
			$barlanceHrA8 = $hourtargetA8*1;
		} elseif ($hour == 9) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*2);
			$barlanceHrA8 = $hourtargetA8*2;
		} elseif ($hour == 10) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*3);
			$barlanceHrA8 = $hourtargetA8*3;
		} elseif ($hour == 11) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*4);
			$barlanceHrA8 = $hourtargetA8*4;
		} elseif ($hour == 12) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*5);
			$barlanceHrA8 = $hourtargetA8*5;
		} elseif ($hour == 13) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*6);
			$barlanceHrA8 = $hourtargetA8*6;
		} elseif ($hour == 14) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*7);
			$barlanceHrA8 = $hourtargetA8*7;
		} elseif ($hour == 15) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*8);
			$barlanceHrA8 = $hourtargetA8*8;
		} elseif ($hour == 16) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*9);
			$barlanceHrA8 = $hourtargetA8*9;
		} elseif ($hour == 17) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*10);
			$barlanceHrA8 = $hourtargetA8*10;
		} elseif ($hour == 18) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*11);
			$barlanceHrA8 = $hourtargetA8*11;
		} elseif ($hour == 19) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*12);
			$barlanceHrA8 = $hourtargetA8*12;
		} elseif ($hour == 20) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*13);
			$barlanceHrA8 = $hourtargetA8*13;
		} elseif ($hour == 21) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*14);
			$barlanceHrA8 = $hourtargetA8*14;
		} elseif ($hour == 22) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*15);
			$barlanceHrA8 = $hourtargetA8*15;
		} elseif ($hour == 23) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*16);
			$barlanceHrA8 = $hourtargetA8*16;
		} elseif ($hour == 0) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*17);
			$barlanceHrA8 = $hourtargetA8*17;
		} elseif ($hour == 1) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*18);
			$barlanceHrA8 = $hourtargetA8*18;
		} elseif ($hour == 2) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*19);
			$barlanceHrA8 = $hourtargetA8*19;
		} elseif ($hour == 3) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*20);
			$barlanceHrA8 = $hourtargetA8*20;
		} elseif ($hour == 4) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*21);
			$barlanceHrA8 = $hourtargetA8*21;
		} elseif ($hour == 5) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*22);
			$barlanceHrA8 = $hourtargetA8*22;
		} elseif ($hour == 6) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*23);
			$barlanceHrA8 = $hourtargetA8*23;
		} elseif ($hour == 7) {
			$targethrA8 = $pcshourA8 - ($hourtargetA8*24);
			$barlanceHrA8 = $hourtargetA8*24;
		}

		$timetotalA8 = 0;
		$querytimeA8 = "SELECT Date_time AS t,Takt_time as tak FROM a8 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resulttimeA8 = $db->query($querytimeA8);
		while ($rowA8 = $resulttimeA8->fetch_array(MYSQLI_ASSOC)) {
			$outputtimeA8 = strtotime($rowA8['t']);
			$timetotalA8 = ($outputtimeA8 - strtotime('$Start'))/60;
		}

		$avgtimeA8 = 0;
		$timeSecondA8 = 0;
		$avA8 = 0;
		$TimeavgA8 = date('H:i:s', strtotime('08:00:00'));
		$queryavgA8 = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a8 WHERE Date_Time BETWEEN '$Start' AND '$End'";
		$resultavgA8 = $db->query($queryavgA8);
		$countA8 = mysqli_num_rows($resultavgA8);
		$FirstRunA8 = true;
		while ($rowA8 = $resultavgA8->fetch_array(MYSQLI_ASSOC)) {
			if ($FirstRunA8) {
				$FirstRunA8 = false;
				$starttimeFirstA8 = $rowA8['starttime'];
				$timeFirstA8 = (strtotime($starttimeFirstA8) - strtotime('$Start'));
				if ($timeFirstA8 < 300) {
					$avA8 = ($avA8 + $timeFirstA8);
				}
			} else {
				$endtimeSecondA8 = strtotime($rowA8['endtime']);
				$starttimeSecondA8 = strtotime($rowA8['starttime']);
				$takttimeSecondA8 = $rowA8['takttime'];
				$EavgA8 = $endtimeSecondA8 + $takttimeSecondA8;
				$timeSecondA8 = ($EavgA8 - $starttimeSecondA8);
				if ($timeSecondA8 < 300) {
					$avgtimeA8 = ($avgtimeA8 + $timeSecondA8);
				}
			}
		}

		$AVGA8 = ($avgtimeA8 + $avA8);
		if ($AVGA8 > 0) {
			$avgA8 = ($AVGA8/$countA8);
		} else {
			$avgA8 = 0;
		}
		$processingtimeA8 = ($outputA8*$avgA8)/60;

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
        		$timerunstopA8 = (strtotime($runstartFirstA8) - strtotime('$Start'));
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
    	$zeroA8 = 0;
    	/* --------------------------- A-8 --------------------------- */

	    $jsonObj = '{'
	    . '"tm2":"' . date('Y-m-d H:i:s') . ' "' . ', '
	    . '"t":"' . date('H:i:s') . ' "' . ', '

	    . '"output":"' . $output . ' "' . ', '
	    . '"timetotal":"' . round($timetotal) . ' "' . ', '
	    . '"avg":"' . round($avg) . ' "'. ', '
	    . '"processingtime":"' . round($processingtime) . ' "'. ', '
	    . '"totalrun":"' . round($totalrun) . ' "'. ', '
	    . '"totalstop":"' . round($totalstop) . ' "'. ', '
	    . '"pruntime":"' . round($pruntime) . ' "'. ', '
	    . '"product":"' . $productresult . ' "'. ', '
	    . '"pcsday":"' . number_format($pcsday) . ' "'. ', '
	    . '"pcshour":"' . number_format($pcshour) . ' "'. ', '
	    . '"barlance":"' . number_format($barlanceresult) . ' "'. ', '
	    . '"targetresult":"' . number_format($targetresult) . ' "'. ', '
	    . '"barlanceHr":"' . number_format($barlanceHr) . ' "' . ', '
	    . '"targetHr":"' . number_format($targethr) . ' "' . ', '
	    . '"zero":"' . number_format($zero) . ' "' . ', '
    	. '"pstoptime":"' . round($pstoptime) . ' "'. ', '
	    /* --------------------------- A-3 --------------------------- */

	    . '"outputA1":"' . $outputA1 . ' "' . ', '
	    . '"timetotalA1":"' . round($timetotalA1) . ' "' . ', '
	    . '"avgA1":"' . round($avgA1) . ' "'. ', '
	    . '"processingtimeA1":"' . round($processingtimeA1) . ' "'. ', '
	    . '"totalrunA1":"' . round($totalrunA1) . ' "'. ', '
	    . '"totalstopA1":"' . round($totalstopA1) . ' "'. ', '
	    . '"pruntimeA1":"' . round($pruntimeA1) . ' "'. ', '
	    . '"productA1":"' . $productresultA1 . ' "'. ', '
	    . '"pcsdayA1":"' . number_format($pcsdayA1) . ' "'. ', '
	    . '"pcshourA1":"' . number_format($pcshourA1) . ' "'. ', '
	    . '"barlanceA1":"' . number_format($barlanceresultA1) . ' "'. ', '
	    . '"targetresultA1":"' . number_format($targetresultA1) . ' "'. ', '
	    . '"barlanceHrA1":"' . number_format($barlanceHrA1) . ' "' . ', '
	    . '"targetHrA1":"' . number_format($targethrA1) . ' "' . ', '
	    . '"zeroA1":"' . number_format($zeroA1) . ' "' . ', '
    	. '"pstoptimeA1":"' . round($pstoptimeA1) . ' "' . ', '
	    /* --------------------------- A-1 --------------------------- */

	    . '"outputA2":"' . $outputA2 . ' "' . ', '
	    . '"timetotalA2":"' . round($timetotalA2) . ' "' . ', '
	    . '"avgA2":"' . round($avgA2) . ' "'. ', '
	    . '"processingtimeA2":"' . round($processingtimeA2) . ' "'. ', '
	    . '"totalrunA2":"' . round($totalrunA2) . ' "'. ', '
	    . '"totalstopA2":"' . round($totalstopA2) . ' "'. ', '
	    . '"pruntimeA2":"' . round($pruntimeA2) . ' "'. ', '
	    . '"productA2":"' . $productresultA2 . ' "'. ', '
	    . '"pcsdayA2":"' . number_format($pcsdayA2) . ' "'. ', '
	    . '"pcshourA2":"' . number_format($pcshourA2) . ' "'. ', '
	    . '"barlanceA2":"' . number_format($barlanceresultA2) . ' "'. ', '
	    . '"targetresultA2":"' . number_format($targetresultA2) . ' "'. ', '
	    . '"barlanceHrA2":"' . number_format($barlanceHrA2) . ' "' . ', '
	    . '"targetHrA2":"' . number_format($targethrA2) . ' "' . ', '
	    . '"zeroA2":"' . number_format($zeroA2) . ' "' . ', '
    	. '"pstoptimeA2":"' . round($pstoptimeA2) . ' "' . ', '
	    /* --------------------------- A-2 --------------------------- */

		. '"outputA4":"' . $outputA4 . ' "' . ', '
	    . '"timetotalA4":"' . round($timetotalA4) . ' "' . ', '
	    . '"avgA4":"' . round($avgA4) . ' "'. ', '
	    . '"processingtimeA4":"' . round($processingtimeA4) . ' "'. ', '
	    . '"totalrunA4":"' . round($totalrunA4) . ' "'. ', '
	    . '"totalstopA4":"' . round($totalstopA4) . ' "'. ', '
	    . '"pruntimeA4":"' . round($pruntimeA4) . ' "'. ', '
	    . '"productA4":"' . $productresultA4 . ' "'. ', '
	    . '"pcsdayA4":"' . number_format($pcsdayA4) . ' "'. ', '
	    . '"pcshourA4":"' . number_format($pcshourA4) . ' "'. ', '
	    . '"barlanceA4":"' . number_format($barlanceresultA4) . ' "'. ', '
	    . '"targetresultA4":"' . number_format($targetresultA4) . ' "'. ', '
	    . '"barlanceHrA4":"' . number_format($barlanceHrA4) . ' "' . ', '
	    . '"targetHrA4":"' . number_format($targethrA4) . ' "' . ', '
	    . '"zeroA4":"' . number_format($zeroA4) . ' "' . ', '
    	. '"pstoptimeA4":"' . round($pstoptimeA4) . ' "' . ', '
	    /* --------------------------- A-4 --------------------------- */

	    . '"outputA5":"' . $outputA5 . ' "' . ', '
	    . '"timetotalA5":"' . round($timetotalA5) . ' "' . ', '
	    . '"avgA5":"' . round($avgA5) . ' "'. ', '
	    . '"processingtimeA5":"' . round($processingtimeA5) . ' "'. ', '
	    . '"totalrunA5":"' . round($totalrunA5) . ' "'. ', '
	    . '"totalstopA5":"' . round($totalstopA5) . ' "'. ', '
	    . '"pruntimeA5":"' . round($pruntimeA5) . ' "'. ', '
	    . '"productA5":"' . $productresultA5 . ' "'. ', '
	    . '"pcsdayA5":"' . number_format($pcsdayA5) . ' "'. ', '
	    . '"pcshourA5":"' . number_format($pcshourA5) . ' "'. ', '
	    . '"barlanceA5":"' . number_format($barlanceresultA5) . ' "'. ', '
	    . '"targetresultA5":"' . number_format($targetresultA5) . ' "'. ', '
	    . '"barlanceHrA5":"' . number_format($barlanceHrA5) . ' "' . ', '
	    . '"targetHrA5":"' . number_format($targethrA5) . ' "' . ', '
	    . '"zeroA5":"' . number_format($zeroA5) . ' "' . ', '
    	. '"pstoptimeA5":"' . round($pstoptimeA5) . ' "' . ', '
	    /* --------------------------- A-5 --------------------------- */

	    . '"outputA6":"' . $outputA6 . ' "' . ', '
	    . '"timetotalA6":"' . round($timetotalA6) . ' "' . ', '
	    . '"avgA6":"' . round($avgA6) . ' "'. ', '
	    . '"processingtimeA6":"' . round($processingtimeA6) . ' "'. ', '
	    . '"totalrunA6":"' . round($totalrunA6) . ' "'. ', '
	    . '"totalstopA6":"' . round($totalstopA6) . ' "'. ', '
	    . '"pruntimeA6":"' . round($pruntimeA6) . ' "'. ', '
	    . '"productA6":"' . $productresultA6 . ' "'. ', '
	    . '"pcsdayA6":"' . number_format($pcsdayA6) . ' "'. ', '
	    . '"pcshourA6":"' . number_format($pcshourA6) . ' "'. ', '
	    . '"barlanceA6":"' . number_format($barlanceresultA6) . ' "'. ', '
	    . '"targetresultA6":"' . number_format($targetresultA6) . ' "'. ', '
	    . '"barlanceHrA6":"' . number_format($barlanceHrA6) . ' "' . ', '
	    . '"targetHrA6":"' . number_format($targethrA6) . ' "' . ', '
	    . '"zeroA6":"' . number_format($zeroA6) . ' "' . ', '
    	. '"pstoptimeA6":"' . round($pstoptimeA6) . ' "' . ', '
	    /* --------------------------- A-6 --------------------------- */

	    . '"outputA7":"' . $outputA7 . ' "' . ', '
	    . '"timetotalA7":"' . round($timetotalA7) . ' "' . ', '
	    . '"avgA7":"' . round($avgA7) . ' "'. ', '
	    . '"processingtimeA7":"' . round($processingtimeA7) . ' "'. ', '
	    . '"totalrunA7":"' . round($totalrunA7) . ' "'. ', '
	    . '"totalstopA7":"' . round($totalstopA7) . ' "'. ', '
	    . '"pruntimeA7":"' . round($pruntimeA7) . ' "'. ', '
	    . '"productA7":"' . $productresultA7 . ' "'. ', '
	    . '"pcsdayA7":"' . number_format($pcsdayA7) . ' "'. ', '
	    . '"pcshourA7":"' . number_format($pcshourA7) . ' "'. ', '
	    . '"barlanceA7":"' . number_format($barlanceresultA7) . ' "'. ', '
	    . '"targetresultA7":"' . number_format($targetresultA7) . ' "'. ', '
	    . '"barlanceHrA7":"' . number_format($barlanceHrA7) . ' "' . ', '
	    . '"targetHrA7":"' . number_format($targethrA7) . ' "' . ', '
	    . '"zeroA7":"' . number_format($zeroA7) . ' "' . ', '
    	. '"pstoptimeA7":"' . round($pstoptimeA7) . ' "' . ', '
	    /* --------------------------- A-7 --------------------------- */

	    . '"outputA8":"' . $outputA8 . ' "' . ', '
	    . '"timetotalA8":"' . round($timetotalA8) . ' "' . ', '
	    . '"avgA8":"' . round($avgA8) . ' "'. ', '
	    . '"processingtimeA8":"' . round($processingtimeA8) . ' "'. ', '
	    . '"totalrunA8":"' . round($totalrunA8) . ' "'. ', '
	    . '"totalstopA8":"' . round($totalstopA8) . ' "'. ', '
	    . '"pruntimeA8":"' . round($pruntimeA8) . ' "'. ', '
	    . '"productA8":"' . $productresultA8 . ' "'. ', '
	    . '"pcsdayA8":"' . number_format($pcsdayA8) . ' "'. ', '
	    . '"pcshourA8":"' . number_format($pcshourA8) . ' "'. ', '
	    . '"barlanceA8":"' . number_format($barlanceresultA8) . ' "'. ', '
	    . '"targetresultA8":"' . number_format($targetresultA8) . ' "'. ', '
	    . '"barlanceHrA8":"' . number_format($barlanceHrA8) . ' "' . ', '
	    . '"targetHrA8":"' . number_format($targethrA8) . ' "' . ', '
	    . '"zeroA8":"' . number_format($zeroA8) . ' "' . ', '
    	. '"pstoptimeA8":"' . round($pstoptimeA8) . ' "'
    	. '}' ;
	    /* --------------------------- A-8 --------------------------- */
	    echo $jsonObj;
	    exit();
	}
?>

<?php include_once('layouts/header.php') ?>

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
	/*h1 {
		text-align: center;
		font-family: 'Asap', sans-serif;
		font-size: 45px;
		font-weight: 900;
		color: #000295;
		text-transform: uppercase;
		text-shadow: 2px 2px 4px #B4B5D7,
					 3px 4px 4px #B4B5D7,
					 4px 6px 4px #B4B5D7,
					 5px 8px 4px #B4B5D7;

	}*/

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
		font-size: 16px;
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
		font-size: 16px;
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
		font-size: 16px;
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
		font-size: 16px;
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
		font-size: 16px;
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
		font-size: 16px;
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
		font-size: 16px;
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
		font-size: 16px;
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

<!--<body>
	<h1>TOTAL DASHBOARD</h1>
	<div class="row">
		<div class="col-sm-6 col-lg-6">
			<table class="content-table-2">
				<thead>
					<tr>
						<th>Product</th>
						<th>Target Plan (Pcs/Day)</th>
						<th>Actual Output (Pcs/Day)</th>
						<th>Balance (Pcs/Day)</th>
						<th>Target Plan (Pcs/Hr)</th>
						<th>Actual Output (Pcs/Hr)</th>
						<th>Balance (Pcs/Hr)</th>
					</tr>
				</thead>
			</table>
		</div>

		<div class="col-sm-6 col-lg-6">
			<table class="content-table-3">
				<thead>
					<tr>
						<th>Product</th>
						<th>Target Plan (Pcs/Day)</th>
						<th>Actual Output (Pcs/Day)</th>
						<th>Balance (Pcs/Day)</th>
						<th>Target Plan (Pcs/Hr)</th>
						<th>Actual Output (Pcs/Hr)</th>
						<th>Balance (Pcs/Hr)</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</body>-->
<body>
	<h1>SMT-MOT MACHINE</h1>
	<br/>
	<div class="table-wrapper">
		<div class="row">
			<div class="col-sm-3 col-lg-3">
				<h3>MOT B-A1</h3>
				<table class="fl-table-01">
					<tbody>
						<tr>
							<th>Product</th>
							<td id="productA1"></td> <!-- id="productA1" -->
						</tr>

						<tr>
							<th>Target Plan (Pcs/Day)</th>
							<td id="targetresultA1"></td> <!-- id="targetresultA1" -->
						</tr>

						<tr>
							<th>Actual Output (Pcs/Day)</th>
							<td id="pcsdayA1"></td> <!-- id="pcsdayA1" -->
						</tr>

						<tr>
							<th>Balance (Pcs/Day)</th>
							<td id="barlanceA1" class="cell-day-A1"></td> <!-- id="barlanceA1" -->
						</tr>

						<tr>
							<th>Target Plan (Pcs/Hr)</th>
							<td id="barlanceHrA1"></td> <!-- id="barlanceHrA1" -->
						</tr>

						<tr>
							<th>Actual Output (Pcs/Hr)</th>
							<td id="pcshourA1"></td> <!-- id="pcshourA1" -->
						</tr>

						<tr>
							<th>Balance (Pcs/Hr)</th>
							<td id="targetHrA1" class="cell-hr-A1"></td> <!-- id="targetHrA1" -->
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
							<th>Product</th>
							<td id="productA2"></td>
						</tr>

						<tr>
							<th>Target Plan (Pcs/Day)</th>
							<td id="targetresultA2"></td>
						</tr>

						<tr>
							<th>Actual Output (Pcs/Day)</th>
							<td id="pcsdayA2"></td>
						</tr>

						<tr>
							<th>Balance (Pcs/Day)</th>
							<td id="barlanceA2" class="cell-day-A2"></td>
						</tr>

						<tr>
							<th>Target Plan (Pcs/Hr)</th>
							<td id="barlanceHrA2"></td>
						</tr>

						<tr>
							<th>Actual Output (Pcs/Hr)</th>
							<td id="pcshourA2"></td>
						</tr>

						<tr>
							<th>Balance (Pcs/Hr)</th>
							<td id="targetHrA2" class="cell-hr-A2"></td>
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
							<th>Product</th>
							<td id="product"></td>
						</tr>

						<tr>
							<th>Target Plan (Pcs/Day)</th>
							<td id="targetresult"></td>
						</tr>

						<tr>
							<th>Actual Output (Pcs/Day)</th>
							<td id="pcsday"></td>
						</tr>

						<tr>
							<th>Balance (Pcs/Day)</th>
							<td id="barlance" class="cell-day-A3"></td>
						</tr>

						<tr>
							<th>Target Plan (Pcs/Hr)</th>
							<td id="barlanceHr"></td>
						</tr>

						<tr>
							<th>Actual Output (Pcs/Hr)</th>
							<td id="pcshour"></td>
						</tr>

						<tr>
							<th>Balance (Pcs/Hr)</th>
							<td id="targetHr" class="cell-hr-A3"></td>
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
							<th>Product</th>
							<td id="productA4"></td>
						</tr>

						<tr>
							<th>Target Plan (Pcs/Day)</th>
							<td id="targetresultA4"></td>
						</tr>

						<tr>
							<th>Actual Output (Pcs/Day)</th>
							<td id="pcsdayA4"></td>
						</tr>

						<tr>
							<th>Balance (Pcs/Day)</th>
							<td id="barlanceA4" class="cell-day-A4"></td>
						</tr>

						<tr>
							<th>Target Plan (Pcs/Hr)</th>
							<td id="barlanceHrA4"></td>
						</tr>

						<tr>
							<th>Actual Output (Pcs/Hr)</th>
							<td id="pcshourA4"></td>
						</tr>

						<tr>
							<th>Balance (Pcs/Hr)</th>
							<td id="targetHrA4" class="cell-hr-A4"></td>
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
							<th>Product</th>
							<td id="productA5"></td>
						</tr>

						<tr>
							<th>Target Plan (Pcs/Day)</th>
							<td id="targetresultA5"></td>
						</tr>

						<tr>
							<th>Actual Output (Pcs/Day)</th>
							<td id="pcsdayA5"></td>
						</tr>

						<tr>
							<th>Balance (Pcs/Day)</th>
							<td id="barlanceA5" class="cell-day-A5"></td>
						</tr>

						<tr>
							<th>Target Plan (Pcs/Hr)</th>
							<td id="barlanceHrA5"></td>
						</tr>

						<tr>
							<th>Actual Output (Pcs/Hr)</th>
							<td id="pcshourA5"></td>
						</tr>

						<tr>
							<th>Balance (Pcs/Hr)</th>
							<td id="targetHrA5" class="cell-hr-A5"></td>
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
							<th>Product</th>
							<td id="productA6"></td>
						</tr>

						<tr>
							<th>Target Plan (Pcs/Day)</th>
							<td id="targetresultA6"></td>
						</tr>

						<tr>
							<th>Actual Output (Pcs/Day)</th>
							<td id="pcsdayA6"></td>
						</tr>

						<tr>
							<th>Balance (Pcs/Day)</th>
							<td id="barlanceA6" class="cell-day-A6"></td>
						</tr>

						<tr>
							<th>Target Plan (Pcs/Hr)</th>
							<td id="barlanceHrA6"></td>
						</tr>

						<tr>
							<th>Actual Output (Pcs/Hr)</th>
							<td id="pcshourA6"></td>
						</tr>

						<tr>
							<th>Balance (Pcs/Hr)</th>
							<td id="targetHrA6" class="cell-hr-A6"></td>
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
							<th>Product</th>
							<td id="productA7"></td>
						</tr>

						<tr>
							<th>Target Plan (Pcs/Day)</th>
							<td id="targetresultA7"></td>
						</tr>

						<tr>
							<th>Actual Output (Pcs/Day)</th>
							<td id="pcsdayA7"></td>
						</tr>

						<tr>
							<th>Balance (Pcs/Day)</th>
							<td id="barlanceA7" class="cell-day-A7"></td>
						</tr>

						<tr>
							<th>Target Plan (Pcs/Hr)</th>
							<td id="barlanceHrA7"></td>
						</tr>

						<tr>
							<th>Actual Output (Pcs/Hr)</th>
							<td id="pcshourA7"></td>
						</tr>

						<tr>
							<th>Balance (Pcs/Hr)</th>
							<td id="targetHrA7" class="cell-hr-A7"></td>
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
							<th>Product</th>
							<td id="productA8"></td>
						</tr>

						<tr>
							<th>Target Plan (Pcs/Day)</th>
							<td id="targetresultA8"></td>
						</tr>

						<tr>
							<th>Actual Output (Pcs/Day)</th>
							<td id="pcsdayA8"></td>
						</tr>

						<tr>
							<th>Balance (Pcs/Day)</th>
							<td id="barlanceA8" class="cell-day-A8"></td>
						</tr>

						<tr>
							<th>Target Plan (Pcs/Hr)</th>
							<td id="barlanceHrA8"></td>
						</tr>

						<tr>
							<th>Actual Output (Pcs/Hr)</th>
							<td id="pcshourA8"></td>
						</tr>

						<tr>
							<th>Balance (Pcs/Hr)</th>
							<td id="targetHrA8" class="cell-hr-A8"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!--------------------------- A-8 ---------------------------> 
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
	            $("#time").html(data.tm2); 
	            $("#time").addClass("realtime");

	            $("#product").html(data.product);  
	            $("#product").addClass("realtime"); 

	            $("#targetresult").html(data.targetresult);  
	            $("#targetresult").addClass("realtime");

	            $("#pcsday").html(data.pcsday);  
	            $("#pcsday").addClass("realtime");

	            $("#barlance").html(data.barlance);  
	            $("#barlance").addClass("realtime");

	            $("#barlanceHr").html(data.barlanceHr);  
	            $("#barlanceHr").addClass("realtime");

	            $("#pcshour").html(data.pcshour);  
	            $("#pcshour").addClass("realtime");

	            $("#targetHr").html(data.targetHr);  
	            $("#targetHr").addClass("realtime");
	            /* --------------------- A3 --------------------- */

	            $("#productA1").html(data.productA1);  
	            $("#productA1").addClass("realtime");

	            $("#targetresultA1").html(data.targetresultA1);  
	            $("#targetresultA1").addClass("realtime");

	            $("#pcsdayA1").html(data.pcsdayA1);  
	            $("#pcsdayA1").addClass("realtime");

	            $("#barlanceA1").html(data.barlanceA1);  
	            $("#barlanceA1").addClass("realtime");

	            $("#barlanceHrA1").html(data.barlanceHrA1);  
	            $("#barlanceHrA1").addClass("realtime");

	            $("#pcshourA1").html(data.pcshourA1);  
	            $("#pcshourA1").addClass("realtime");

	            $("#targetHrA1").html(data.targetHrA1);  
	            $("#targetHrA1").addClass("realtime");
	            /* --------------------- A1 --------------------- */

	            $("#productA2").html(data.productA2);  
	            $("#productA2").addClass("realtime");

	            $("#targetresultA2").html(data.targetresultA2);  
	            $("#targetresultA2").addClass("realtime");

	            $("#pcsdayA2").html(data.pcsdayA2);  
	            $("#pcsdayA2").addClass("realtime");

	            $("#barlanceA2").html(data.barlanceA2);  
	            $("#barlanceA2").addClass("realtime");

	            $("#barlanceHrA2").html(data.barlanceHrA2);  
	            $("#barlanceHrA2").addClass("realtime");

	            $("#pcshourA2").html(data.pcshourA2);  
	            $("#pcshourA2").addClass("realtime");

	            $("#targetHrA2").html(data.targetHrA2);  
	            $("#targetHrA2").addClass("realtime");
	            /* --------------------- A2 --------------------- */

	            $("#productA4").html(data.productA4);  
	            $("#productA4").addClass("realtime");

	            $("#targetresultA4").html(data.targetresultA4);  
	            $("#targetresultA4").addClass("realtime");

	            $("#pcsdayA4").html(data.pcsdayA4);  
	            $("#pcsdayA4").addClass("realtime");

	            $("#barlanceA4").html(data.barlanceA4);  
	            $("#barlanceA4").addClass("realtime");

	            $("#barlanceHrA4").html(data.barlanceHrA4);  
	            $("#barlanceHrA4").addClass("realtime");

	            $("#pcshourA4").html(data.pcshourA4);  
	            $("#pcshourA4").addClass("realtime");

	            $("#targetHrA4").html(data.targetHrA4);  
	            $("#targetHrA4").addClass("realtime");
	            /* --------------------- A4 --------------------- */

	            $("#productA5").html(data.productA5);  
	            $("#productA5").addClass("realtime");

	            $("#targetresultA5").html(data.targetresultA5);  
	            $("#targetresultA5").addClass("realtime");

	            $("#pcsdayA5").html(data.pcsdayA5);  
	            $("#pcsdayA5").addClass("realtime");

	            $("#barlanceA5").html(data.barlanceA5);  
	            $("#barlanceA5").addClass("realtime");

	            $("#barlanceHrA5").html(data.barlanceHrA5);  
	            $("#barlanceHrA5").addClass("realtime");

	            $("#pcshourA5").html(data.pcshourA5);  
	            $("#pcshourA5").addClass("realtime");

	            $("#targetHrA5").html(data.targetHrA5);  
	            $("#targetHrA5").addClass("realtime");
	            /* --------------------- A5 --------------------- */

	            $("#productA6").html(data.productA6);  
	            $("#productA6").addClass("realtime");

	            $("#targetresultA6").html(data.targetresultA6);  
	            $("#targetresultA6").addClass("realtime");

	            $("#pcsdayA6").html(data.pcsdayA6);  
	            $("#pcsdayA6").addClass("realtime");

	            $("#barlanceA6").html(data.barlanceA6);  
	            $("#barlanceA6").addClass("realtime");

	            $("#barlanceHrA6").html(data.barlanceHrA6);  
	            $("#barlanceHrA6").addClass("realtime");

	            $("#pcshourA6").html(data.pcshourA6);  
	            $("#pcshourA6").addClass("realtime");

	            $("#targetHrA6").html(data.targetHrA6);  
	            $("#targetHrA6").addClass("realtime");
	            /* --------------------- A6 --------------------- */

	            $("#productA7").html(data.productA7);  
	            $("#productA7").addClass("realtime");

	            $("#targetresultA7").html(data.targetresultA7);  
	            $("#targetresultA7").addClass("realtime");

	            $("#pcsdayA7").html(data.pcsdayA7);  
	            $("#pcsdayA7").addClass("realtime");

	            $("#barlanceA7").html(data.barlanceA7);  
	            $("#barlanceA7").addClass("realtime");

	            $("#barlanceHrA7").html(data.barlanceHrA7);  
	            $("#barlanceHrA7").addClass("realtime");

	            $("#pcshourA7").html(data.pcshourA7);  
	            $("#pcshourA7").addClass("realtime");

	            $("#targetHrA7").html(data.targetHrA7);  
	            $("#targetHrA7").addClass("realtime");
	            /* --------------------- A7 --------------------- */

	            $("#productA8").html(data.productA8);  
	            $("#productA8").addClass("realtime");

	            $("#targetresultA8").html(data.targetresultA8);  
	            $("#targetresultA8").addClass("realtime");

	            $("#pcsdayA8").html(data.pcsdayA8);  
	            $("#pcsdayA8").addClass("realtime");

	            $("#barlanceA8").html(data.barlanceA8);  
	            $("#barlanceA8").addClass("realtime");

	            $("#barlanceHrA8").html(data.barlanceHrA8);  
	            $("#barlanceHrA8").addClass("realtime");

	            $("#pcshourA8").html(data.pcshourA8);  
	            $("#pcshourA8").addClass("realtime");

	            $("#targetHrA8").html(data.targetHrA8);  
	            $("#targetHrA8").addClass("realtime");
	            /* --------------------- A8 --------------------- */

            	var balanceDayA1 = parseInt(document.getElementById("barlanceA1").innerHTML, 10);
            	if (balanceDayA1 < 0) { 
            		$("td.cell-day-A1").css("color", "#D80000"); // Red Color
            	} else {
            		$("td.cell-day-A1").css("color", "#08DB0B"); // Green Color
            	}

	            var balanceHrA1 = parseInt(document.getElementById("targetHrA1").innerHTML, 10);
	            if (balanceHrA1 < 0) { 
	            	$("td.cell-hr-A1").css("color", "#D80000"); // Red Color
	            } else {
	            	$("td.cell-hr-A1").css("color", "#08DB0B"); // Green Color
	            }
	            /* --------------------- A1 --------------------- */

	            var balanceDayA2 = parseInt(document.getElementById("barlanceA2").innerHTML, 10);
	            if (balanceDayA2 < 0) { 
	            	$("td.cell-day-A2").css("color", "#D80000"); // Red Color
	            } else {
	            	$("td.cell-day-A2").css("color", "#08DB0B"); // Green Color
	            }

	            var balanceHrA2 = parseInt(document.getElementById("targetHrA2").innerHTML, 10);
	            if (balanceHrA2 < 0) { 
	            	$("td.cell-hr-A2").css("color", "#D80000"); // Red Color
	            } else {
	            	$("td.cell-hr-A2").css("color", "#08DB0B"); // Green Color
	            }
	            /* --------------------- A2 --------------------- */

	            var balanceDayA3 = parseInt(document.getElementById("barlance").innerHTML, 10);
	            if (balanceDayA3 < 0) {
	            	$("td.cell-day-A3").css("color", "#D80000"); // Red Color
	            } else {
	            	$("td.cell-day-A3").css("color", "#08DB0B"); // Green Color
	            }

	            var balanceHrA3 = parseInt(document.getElementById("targetHr").innerHTML, 10);
	            if (balanceHrA3 < 0) {
	            	$("td.cell-hr-A3").css("color", "#D80000"); // Red Color
	            } else {
	            	$("td.cell-hr-A3").css("color", "#08DB0B"); // Green Color
	            }
	            /* --------------------- A3 --------------------- */

	            var balanceDayA4 = parseInt(document.getElementById("barlanceA4").innerHTML, 10);
	            if (balanceDayA4 < 0) { 
	            	$("td.cell-day-A4").css("color", "#D80000"); // Red Color
	            } else {
	            	$("td.cell-day-A4").css("color", "#08DB0B"); // Green Color
	            }

	            var balanceHrA4 = parseInt(document.getElementById("targetHrA4").innerHTML, 10);
	            if (balanceHrA4 < 0) { 
	            	$("td.cell-hr-A4").css("color", "#D80000"); // Red Color
	            } else {
	            	$("td.cell-hr-A4").css("color", "#08DB0B"); // Green Color
	            }
	            /* --------------------- A4 --------------------- */

	            var balanceDayA5 = parseInt(document.getElementById("barlanceA5").innerHTML, 10);
	            if (balanceDayA5 < 0) { 
	            	$("td.cell-day-A5").css("color", "#D80000"); // Red Color
	            } else {
	            	$("td.cell-day-A5").css("color", "#08DB0B"); // Green Color
	            }

	            var balanceHrA5 = parseInt(document.getElementById("targetHrA5").innerHTML, 10);
	            if (balanceHrA5 < 0) { 
	            	$("td.cell-hr-A5").css("color", "#D80000"); // Red Color
	            } else {
	            	$("td.cell-hr-A5").css("color", "#08DB0B"); // Green Color
	            }
	            /* --------------------- A5 --------------------- */

	            var balanceDayA6 = parseInt(document.getElementById("barlanceA6").innerHTML, 10);
	            if (balanceDayA6 < 0) { 
	            	$("td.cell-day-A6").css("color", "#D80000"); // Red Color
	            } else {
	            	$("td.cell-day-A6").css("color", "#08DB0B"); // Green Color
	            }

	            var balanceHrA6 = parseInt(document.getElementById("targetHrA6").innerHTML, 10);
	            if (balanceHrA6 < 0) { 
	            	$("td.cell-hr-A6").css("color", "#D80000"); // Red Color
	            } else {
	            	$("td.cell-hr-A6").css("color", "#08DB0B"); // Green Color
	            }
	            /* --------------------- A6 --------------------- */

	            var balanceDayA7 = parseInt(document.getElementById("barlanceA7").innerHTML, 10);
	            if (balanceDayA7 < 0) { 
	            	$("td.cell-day-A7").css("color", "#D80000"); // Red Color
	            } else {
	            	$("td.cell-day-A7").css("color", "#08DB0B"); // Green Color
	            }

	            var balanceHrA7 = parseInt(document.getElementById("targetHrA7").innerHTML, 10);
	            if (balanceHrA7 < 0) { 
	            	$("td.cell-hr-A7").css("color", "#D80000"); // Red Color
	            } else {
	            	$("td.cell-hr-A7").css("color", "#08DB0B"); // Green Color
	            }
	            /* --------------------- A7 --------------------- */

	            var balanceDayA8 = parseInt(document.getElementById("barlanceA8").innerHTML, 10);
	            if (balanceDayA8 < 0) { 
	            	$("td.cell-day-A8").css("color", "#D80000"); // Red Color
	            } else {
	            	$("td.cell-day-A8").css("color", "#08DB0B"); // Green Color
	            }

	            var balanceHrA8 = parseInt(document.getElementById("targetHrA8").innerHTML, 10);
	            if (balanceHrA8 < 0) { 
	            	$("td.cell-hr-A8").css("color", "#D80000"); // Red Color
	            } else {
	            	$("td.cell-hr-A8").css("color", "#08DB0B"); // Green Color
	            }
	            /* --------------------- A8 --------------------- */
         	});
      	realTime(); 
      	}, 1000);  
   	}
   	realTime();
});
</script>

<?php include_once('layouts/footer.php'); ?>