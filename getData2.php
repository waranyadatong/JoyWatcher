<?php

  require_once('includes/load.php');
 ?>
<?php
 global $db;
   $avgtime = 0;
   $Timeavg = date('H:i:s',strtotime('08:00:00'));
   $queryavg = "SELECT end_time as endtime,start_time as starttime FROM a3 WHERE Date_Time BETWEEN '2022-06-29 08:00' AND '2022-06-30 08:00'";
   $resultavg = $db->query($queryavg);
   $count = mysqli_num_rows($resultavg);
   $FirstRun=true;
   while ($row = $resultavg->fetch_array(MYSQLI_ASSOC)) {
      if ($FirstRun){
      $FirstRun = false;
      $endtimeFirst = $row['endtime'];
      $timeFirst = (strtotime($endtimeFirst) - strtotime($Timeavg));
      echo $endtimeFirst."</br>";
      echo $timeFirst."</br>";
      echo "<hr>";
       }else {
      $outputendtime = $row['endtime'];
      $outputstarttime = $row['starttime'];
      $timetotal =  (strtotime($outputendtime) - strtotime($outputstarttime));
      $avgtime = ($avgtime + $timetotal);
      echo $outputendtime."</br>";
      echo $timetotal."</br>";
    }
   }
   $avg = (($timeFirst + $avgtime)/$count);
   echo $avg."</br>";
?>