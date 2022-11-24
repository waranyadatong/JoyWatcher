<?php

  require_once('includes/load.php');
 ?>
<?php
 global $db;
   $output = 0;
   $query = "SELECT count(*) AS total FROM a3 WHERE Date_Time BETWEEN '2022-10-17 08:00:00' AND '2022-10-18 08:00:00'";
   $result = $db->query($query);
   while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $output = $output + $row['total'];
   }
  
   $timetotal = 0;
   $querytime = "SELECT start_time AS t FROM a3 WHERE Date_Time BETWEEN '2022-10-17 08:00:00' AND '2022-10-18 08:00:00'";
   $resulttime = $db->query($querytime);
   while ($row = $resulttime->fetch_array(MYSQLI_ASSOC)) {
      $outputtime = $row['t'];
      $timetotal =  (strtotime($outputtime) - strtotime('2022-10-17 08:00'))/60;
   }

   $avgtime = 0;
   $timeSecond = 0;
   $av = 0;
   $Timeavg = date('H:i:s',strtotime('08:00:00'));
   $queryavg = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a3 WHERE Date_Time BETWEEN '2022-10-17 08:00:00' AND '2022-10-18 08:00:00'";
   $resultavg = $db->query($queryavg);
   $count = mysqli_num_rows($resultavg);
   $FirstRun = true;
   while ($row = $resultavg->fetch_array(MYSQLI_ASSOC)) {
      if ($FirstRun){ 
         $FirstRun = false;
         $starttimeFirst = $row['starttime'];
         $timeFirst = (strtotime($starttimeFirst) - strtotime('2022-10-17 08:00')); 
         if($timeFirst < 300) {
            $av = ($av + $timeFirst);
         }
      }else{
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
      }else{
       $avg = 0;
      }
      $processingtime = ($output * $avg)/60;  

   $Timerunstop = date('H:i:s',strtotime('08:00:00'));
   $queryrunstop = "SELECT Takt_time as tk,start_time as st,end_time as et FROM a3 WHERE Date_Time BETWEEN '2022-10-17 08:00:00' AND '2022-10-18 08:00:00'";
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
          $timerunstop = (strtotime($runstartFirst) - strtotime('2022-10-17 08:00'));
          if ($timerunstop < 300){
              $MinFirst = ($MinFirst + $timerunstop);
          }else {
              $MaxFirst = ($MaxFirst + $timerunstop);
          }
      }else {
          $runstopFirst = strtotime($row['et']);
          $runstopstarttime = strtotime($row['st']);
          $tk = $row['tk'];  
          $Erunstop = $runstopFirst + $tk;
          $timett =  ($Erunstop - $runstopstarttime);

          if ($timett < 300){
              $Mintt = ($Mintt + $timett);
          }else {
              $Maxtt = ($Maxtt + $timett);
          }
     }
   $totalrun = ($MinFirst + $Mintt)/60;
   $totalstop = ($MaxFirst + $Maxtt)/60;
      if ($totalrun > 0){
      $pruntime = ($totalrun/$timetotal)*100;
   }else {
      $pruntime = 0;   
   }

   if ($totalstop > 0){
      $pstoptime = ($totalstop/$timetotal)*100;
   }else {
      $pstoptime = 0;   
   } 
   }

  echo round($timett)."<br>";
echo round($MinFirst)."<br>";
echo round($Mintt)."<br>";
?>