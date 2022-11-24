<?php
   date_default_timezone_set('Asia/Bangkok');
   $page_title = 'Joy Watcher';
   require_once('includes/load.php');
   //page_require_level(1);  
?>
<?php
   $the_now = strtotime(date('H:i:s'));
   $the_time = strtotime(date('H:i:s',strtotime('08:00:00')));
   if ($the_time < $the_now) {
      $Start = date('Y-m-d H:i',date(strtotime("+0 day", mktime(8,0,0))));
      $End = date('Y-m-d H:i',date(strtotime("+1day", mktime(8,0,0))));
   } else {
      $Start = date('Y-m-d H:i',date(strtotime("-1 day", mktime(8,0,0))));
      $End = date('Y-m-d H:i',date(strtotime("+0 day", mktime(8,0,0))));
   }
   global $db;
   $output = 0;
   $query = "SELECT count(*) AS total FROM a6 WHERE Date_Time BETWEEN '$Start' AND '$End'";
   $result = $db->query($query);
   while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $output = $output + $row['total'];
   }
   $timetotal = 0;
   $querytime = "SELECT end_time AS t FROM a6 WHERE Date_Time BETWEEN '$Start' AND '$End'";
   $resulttime = $db->query($querytime);
   while ($row = $resulttime->fetch_array(MYSQLI_ASSOC)) {
      $outputtime = $row['t'];
      $timetotal =  (strtotime($outputtime) - strtotime($Start))/60;
   }
   $avgtime = 0;
   $timeSecond = 0;
   $av = 0;
   $Timeavg = date('H:i:s',strtotime('08:00:00'));
   $queryavg = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a6 WHERE Date_Time BETWEEN '$Start' AND '$End'";
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
   $queryrunstop = "SELECT Takt_time as tk,start_time as st,end_time as et FROM a6 WHERE Date_Time BETWEEN '$Start' AND '$End'";
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

   //$dataPointrun= array(round($pruntime));
   //$dataPointstop= array(round($pstoptime));

   //array_push($jsRun, $dataPointrun);
   //array_push($jsStop, $dataPointstop);

   $j = array();
   $data = [round($pruntime), round($pstoptime)];
   array_push($j, $data);

   /*$dataPoints1 = array(
      array("y" => round($pruntime), "label" => "MOT A6")
   );
   $dataPoints2 = array(
      array("y" => round($pstoptime), "label" => "MOT A6")
   );

   $j = '{'
   . '"pruntime":"' . round($pruntime) . ' "'. ', '
   . '"pstoptime":"' . round($pstoptime) . ' "'
   . '}' ; */

   echo json_encode($j);

   //echo json_encode($dataPoints2, JSON_NUMERIC_CHECK);
   //echo json_encode($arr);
   //exit();
?>