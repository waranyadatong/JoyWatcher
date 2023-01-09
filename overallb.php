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
    	. '"pstoptimeA4":"' . round($pstoptimeA4) . ' "'
    	. '}' ;
	    /* --------------------------- A-4 --------------------------- */
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
		font-size: 42px;
  		font-weight: 800;
  		font-family: 'Roboto', sans-serif;
  		color: #7D3C98;
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
		font-size: 32px;
		font-weight: 800;
		line-height: 35px;
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
		padding: 17px;
		text-align: center;
	} 

	.fl-table-01 td{
		width: 250px;
		font-size: 17px;
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
		padding: 17px;
		text-align: center;
	} 

	.fl-table-03 td{
		width: 250px;
		font-size: 17px;
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
		padding: 17px;
		text-align: center;
	} 

	.fl-table-02 td{
		width: 250px;
		font-size: 17px;
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
		padding: 17px;
		text-align: center;
	} 

	.fl-table-04 td{
		width: 250px;
		font-size: 17px;
		font-weight: bold;
	}

	.fl-table-04 tbody th {
		color: #FFFFFF;
		background-color: #CD5C5C;
	}

	/*.blinking {
		animation: mymove 2s infinite alternate;
	}

	@keyframes mymove {
		from {opacity: 0;}
		to {opacity: 1;}
	}*/

	.flash {
		-webkit-animation-name:flash;
		-webkit-animation-duration:1s;
		-webkit-animation-iteration-count:infinite;
		-webkit-animation-timing-function:ease-in-out;
		-webkit-animation-direction:alternate;
	}

	@-webkit-keyframes flash {
		from {
			color:Chartreuse;
		}

		to {
			color:black;
		}
	}

	.flashred {
		-webkit-animation-name:flashred;
		-webkit-animation-duration:1s;
		-webkit-animation-iteration-count:infinite;
		-webkit-animation-timing-function:ease-in-out;
		-webkit-animation-direction:alternate;
	}

	@-webkit-keyframes flashred {
		from {
			color:red;
		}

		to {
			color:black;
		}
	}
	/* ----------------------- A-4 -----------------------*/
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
	<!--<style type="text/css">
		#productA1 .realtime{
			color: green;
		}

	</style>-->
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
				<table class="fl-table-03" id="aa3">
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

            	var pA1 = document.getElementById("productA1").innerText;
            	if (pA1 =='No Plan/No Run') { 
            		//$("#productA1").css("color", "#D80000"); // Red Color
            		$("#productA1").addClass("flashred"); // Red Color
            	} else {
            		//$("#productA1").css("color", "#08DB0B"); // Green Color
            		$("#productA1").addClass("flash");
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

            	var pA2 = document.getElementById("productA2").innerText;
            	if (pA2 ==='No Plan/No Run') { 
            		//$("#productA2").css("color", "#D80000"); // Red Color
            		$("#productA2").addClass("flashred"); // Red Color
            	} else {
            		//$("#productA2").css("color", "#08DB0B"); // Green Color
            		$("#productA2").addClass("flash");
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

            	var pA3 = document.getElementById("product").innerText;
            	if (pA3 =='No Plan/No Run') { 
            		//$("#productA1").css("color", "#D80000"); // Red Color
            		$("#product").addClass("flashred"); // Red Color
            	} else {
            		//$("#productA1").css("color", "#08DB0B"); // Green Color
            		$("#product").addClass("flash");
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

            	var pA4 = document.getElementById("productA4").innerText;
            	if (pA4 =='No Plan/No Run') { 
            		//$("#productA1").css("color", "#D80000"); // Red Color
            		$("#productA4").addClass("flashred"); // Red Color
            	} else {
            		//$("#productA1").css("color", "#08DB0B"); // Green Color
            		$("#productA4").addClass("flash");
            	}
            	/* --------------------- A4 --------------------- */
        	});
      		realTime(); 
      	}, 1000);  
   	}
   	realTime();
});
</script>

<?php include_once('layouts/footer.php'); ?>