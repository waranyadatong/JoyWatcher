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
    	. '"pstoptimeA1":"' . round($pstoptimeA1) . ' "'
    	. '}' ;
	    /* --------------------------- A-1 --------------------------- */
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
		font-size: 45px;
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

	h2 {
		text-align: center;
		font-family: 'Asap', sans-serif;
		font-size: 42;
		font-weight: 800;
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
		font-size: 20px;
		font-weight: normal;
		border: none;
		border-collapse: collapse;
		background-color: #FFFFFF;	
		margin-left: 110px;
	}

	.fl-table-01 th, 
	.fl-table-01 td {
		/*border: 1px solid white;*/
		border-collapse: collapse;
		padding: 25px;
		text-align: center;
	} 

	.fl-table-01 td{
		width: 290px;
		font-size: 20px;
		font-weight: bold;
	}

	.fl-table-01 tbody th {
		color: #FFFFFF;
		background-color: #0B9B55;
	}

	/*.fl-table-01 tr:nth-child(odd) {
        background-color: #CFE8DC;
    }*/

	.fl-table-03 {
		border-radius: 5px 5px 0 0;
		margin: 25px 0;
		overflow: hidden;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.35);
		font-size: 20px;
		font-weight: normal;
		border: none;
		border-collapse: collapse;
		background-color: #FFFFFF;
		margin-left: 110px;
	}

	.fl-table-03 th, 
	.fl-table-03 td {
		/*border: 1px solid black;*/
		border-collapse: collapse;
		padding: 25px;
		text-align: center;
	} 

	.fl-table-03 td{
		width: 290px;
		font-size: 20px;
		font-weight: bold;
	}

	.fl-table-03 tbody th {
		color: #FFFFFF;
		background-color: #0015C9;
	}

	/*.fl-table-03 tr:nth-child(odd) {
        background-color: #E5E8FF;
    }*/

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
		<div class="col-sm-6 col-lg-6">
			<h2>MOT B-A1</h2>
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

		<div class="col-sm-6 col-lg-6">
			<h2>MOT B-A3</h2>
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
         });
      realTime(); 
      }, 1000);  
   }
   realTime();
});
</script>

<?php include_once('layouts/footer.php'); ?>