<?php
   date_default_timezone_set('Asia/Bangkok');
   if (isset($_POST['rev']) && $_POST['rev'] == 1) {
      $j1 = '{'
      . '"s1":"' . date('Y-m-d H:i:s') . ' "'
      . '}' ; 
      echo $j1;
      exit();
   }
?>
<?php
   $page_title = 'Joy Watcher';
   require_once('includes/load.php');
   if (!$session->isUserLoggedIn(true)) {redirect('index.php', false);}
?>
<?php include_once('layouts/header.php');?>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="css/AdminLTE.css">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/bootstrap.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
   <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Asap&family=Roboto:ital,wght@0,500;0,900;1,500&display=swap">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">

   <style>
      #fromdate {
         width: 180px;
         margin-left: 7px;
         margin-right: 25px;
      }
      #todate {
         width: 180px;
         margin-left: 7px;
      }
      #tbl_exporttable_to_xls_1 {
         font-family: Trebuchet MS, Arial, Helvetica, "sans-serif";
         border-collapse: collapse;
         width: 100%;
      }
      #tbl_exporttable_to_xls_1, #tbl_exporttable_to_xls_2 {
         table-layout: fixed;
      }
      #tbl_exporttable_to_xls_1 td, #tbl_exporttable_to_xls_1 th {
         border: 2px solid #ddd;
         padding: 8px;
         text-align: center;
         font-weight: bold;
         font-family: Arial;
         height: 40px;
      }
      #tbl_exporttable_to_xls_1 tr:nth-child(even){background-color: #F2F2F2;}
      #tbl_exporttable_to_xls_1 tr:hover{background-color: #ddd;}
      #tbl_exporttable_to_xls_1 th {
         padding-top: 9px;
         padding-bottom: 9px;
         text-align: center;
         background-color: #294C67; /* orangered */ 
         font-size: 16px;
      }
      #tbl_exporttable_to_xls_2 {
         font-family: Trebuchet MS, Arial, Helvetica, "sans-serif";
         border-collapse: collapse;
    
      }
      #tbl_exporttable_to_xls_2 td {
         border: 2px solid #ddd;
         padding: 8px;
         text-align: center;
         font-weight: bold;
         font-family: Arial;
         height: 40px; 
         color: black;
      }
      #tbl_exporttable_to_xls_1 th {
         color:  white;
      }
      #tbl_exporttable_to_xls_2 tr:nth-child(even){background-color: #F2F2F2;}
      #tbl_exporttable_to_xls_2 tr:hover{background-color: #ddd;}
      #tbl_exporttable_to_xls_2 th {
         padding-top: 9px;
         padding-bottom: 9px;
         text-align: center;
         background-color: #294C67; /* blueviolet */
         color: white;
         font-size: 13px;
      }
      .button {
         color: #FFFFFF; 
         padding: 8px; 
         border: none;
         font-size: 14px;
         border-radius: 4px;
      }
      .button1 {
         background-color: #004080; 
         border-color: #004080; 
         margin-left: 20px;
      }
      .button2 {
         background-color: #1D8348; 
         border-color: #1D8348; 
         margin-left: 13px;
      }
      .button3 {
         background-color: #1D8348;
         border-color: #1D8348;
         display: inline-block;
      }
      .button4 {
         background-color: #1D8348;
         border-color: #1D8348;
         display: inline-block;
         cursor: pointer;
      }
      .panel-actions {
         margin-top: 0;
         margin-bottom: 0;
      }
      .panel-title {
         display: inline-block;
         width: 100%;
      }
      .panel-custom-horrible-purple {
         border-color: #294C67;
      }
      .panel-custom-horrible-purple > .panel-heading {
         color: #FFFFFF;
         background: #294C67;
         border-color: #294C67;
         text-align: center;
      }
      h1 {
      text-align: center;
      font-family: 'Roboto', sans-serif;
      font-size: 40px;
      font-weight: 800;
      color: #160a5c;
      text-transform: uppercase;
      text-shadow: 2px 2px 4px #a29eb7,
                3px 4px 4px #a29eb7,
                4px 6px 4px #a29eb7,
                5px 8px 4px #a29eb7;
      }
   </style>
   <?php
      $the_now = strtotime(date('H:i:s'));
      $the_time = strtotime(date('H:i:s',strtotime('08:00:00')));

      if ($the_time < $the_now) {
         $Start = date('Y-m-d',date(strtotime("+0 day")));
         $End = date('Y-m-d',date(strtotime("+1 day")));
      } else {
         $Start = date('Y-m-d',date(strtotime("-1 day")));
         $End = date('Y-m-d',date(strtotime("+0 day"))); 
      }
   ?>
   <h1>MOT A-A5</h1>
   <form class="form-inline" action="#">
      <label for="From Date">From Date</label> 
      <input type="date" id="fromdate" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date'];}?>" class="form-control" required>  
      <label for="To Date">To Date</label> 
      <input type="date" id="todate" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date'];}?>" class="form-control" required>
      <button onclick="submit" class="button button1"><span class="glyphicon glyphicon-search"></span> Search</button>
      <?php if (isset($_GET['from_date']) && isset($_GET['to_date'])) { ?>
      <button  onclick="tablesToExcel( [{ 'sheet': 'Overview','tables' : ['tbl_exporttable_to_xls_1','tbl_exporttable_to_xls_2']}], 'Analytics_JoyWatcher_A5.xls', 'Excel')"class="button button2" class="form-control" name="excel"><span class="glyphicon glyphicon-floppy-save"></span> Export to Excel</button>
      <?php } ?>   
   </form>
   <br/>
   <?php
      global $db;
      if(isset($_GET['from_date']) && isset($_GET['to_date'])) {      
         $from_date = $_GET['from_date']; 
         $to_date = $_GET['to_date'];   
         $output = 0;
         $Timeoutput = date('H:i:s',strtotime('08:00:00'));
         $query = "SELECT count(*) AS total FROM a5 WHERE Date_Time BETWEEN '$from_date $Timeoutput' AND '$to_date $Timeoutput'";
         $result = $db->query($query);
         while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $output = $output + $row['total'];
         }
         $timetotal = 0;
         $timestart = date('H:i:s',strtotime('08:00:00'));
         $TimeStart = $from_date.' '.$timestart;
         $querytime = "SELECT Date_time AS t FROM a5 WHERE Date_Time BETWEEN '$from_date $timestart' AND '$to_date $timestart'";
         $resulttime = $db->query($querytime);
         while ($row = $resulttime->fetch_array(MYSQLI_ASSOC)) {
            $outputtime = $row['t'];
            $timetotal =  (strtotime($outputtime) - strtotime($TimeStart))/60;
         }
     
         $avgtime = 0;
         $timeSecond = 0;
         $av = 0;
         $timeavg = date('H:i:s',strtotime('08:00:00'));
         $Timeavg = $from_date.' '.$timeavg;
         $queryavg = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a5 WHERE Date_Time BETWEEN '$from_date $timeavg' AND '$to_date $timeavg'";
         $resultavg = $db->query($queryavg);
         $count = mysqli_num_rows($resultavg);
         $FirstRun = true;
         while ($row = $resultavg->fetch_array(MYSQLI_ASSOC)) {
            if ($FirstRun){ 
               $FirstRun = false;
               $starttimeFirst = $row['starttime'];
               $timeFirst = (strtotime($starttimeFirst) - strtotime($Timeavg)); 
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
         $timerunstop = date('H:i:s',strtotime('08:00:00'));
         $Timerunstop = $from_date.' '.$timerunstop;
         $queryrunstop = "SELECT Takt_time as tk,start_time as st,end_time as et FROM a5 WHERE Date_Time BETWEEN '$from_date $timerunstop' AND '$to_date $timerunstop'";
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
               $timerunstop = (strtotime($runstartFirst) - strtotime($Timerunstop));
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
         $totalstop = $timetotal - $totalrun;
         if ($totalrun > 0){
            $pruntime = ($totalrun/$timetotal)*100;
         } else {
            $pruntime = 0;   
         }
         if ($totalstop > 0){
            $pstoptime = ($totalstop/$timetotal)*100;
         } else {
            $pstoptime = 0;   
         }   

         $hour8 = 0;
         $Time8 = date('H:i:s',strtotime('08:00:00'));
         $query8 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 8 THEN 1 END) AS 'hour8' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time8' AND '$to_date $Time8'";
         $result8 = $db->query($query8);
         while ($row = $result8->fetch_array(MYSQLI_ASSOC)) {
            $hour8 = $hour8 + $row['hour8'];
         }

         $hour9 = 0;
         $Time9 = date('H:i:s',strtotime('08:00:00'));
         $query9 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 9 THEN 1 END) AS 'hour9' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time9' AND '$to_date $Time9'";
         $result9 = $db->query($query9);
         while ($row = $result9->fetch_array(MYSQLI_ASSOC)) {
            $hour9 = $hour9 + $row['hour9'];
         }

         $hour10 = 0;
         $Time10 = date('H:i:s',strtotime('08:00:00'));              
         $query10 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 10 THEN 1 END) AS 'hour10' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time10' AND '$to_date $Time10'";
         $result10 = $db->query($query10);
         while ($row = $result10->fetch_array(MYSQLI_ASSOC)) {
            $hour10 = $hour10 + $row['hour10'];
         }

         $hour11 = 0;
         $Time11 = date('H:i:s',strtotime('08:00:00'));                
         $query11 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 11 THEN 1 END) AS 'hour11' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time11' AND '$to_date $Time11'";
         $result11 = $db->query($query11);
         while ($row = $result11->fetch_array(MYSQLI_ASSOC)) {
            $hour11 = $hour11 + $row['hour11'];
         }

         $hour12 = 0;
         $Time12 = date('H:i:s',strtotime('08:00:00'));                 
         $query12 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 12 THEN 1 END) AS 'hour12' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time12' AND '$to_date $Time12'";
         $result12 = $db->query($query12);
         while ($row = $result12->fetch_array(MYSQLI_ASSOC)) {
            $hour12 = $hour12 + $row['hour12']; 
         }

         $hour13 = 0;
         $Time13 = date('H:i:s',strtotime('08:00:00'));                          
         $query13 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 13 THEN 1 END) AS 'hour13' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time13' AND '$to_date $Time13'";
         $result13 = $db->query($query13);
         while ($row = $result13->fetch_array(MYSQLI_ASSOC)) {
            $hour13 = $hour13 + $row['hour13']; 
         }

         $hour14 = 0;
         $Time14 = date('H:i:s',strtotime('08:00:00')); 
         $query14 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 14 THEN 1 END) AS 'hour14' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time14' AND '$to_date $Time14'";
         $result14 = $db->query($query14);
         while ($row = $result14->fetch_array(MYSQLI_ASSOC)) {
            $hour14 = $hour14 + $row['hour14'];  
         }

         $hour15 = 0;
         $Time15 = date('H:i:s',strtotime('08:00:00'));                           
         $query15 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 15 THEN 1 END) AS 'hour15' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time15' AND '$to_date $Time15'";
         $result15 = $db->query($query15);
         while ($row = $result15->fetch_array(MYSQLI_ASSOC)) {
            $hour15 = $hour15 + $row['hour15'];  
         } 

         $hour16 = 0;
         $Time16 = date('H:i:s',strtotime('08:00:00'));   
         $query16 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 16 THEN 1 END) AS 'hour16' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time16' AND '$to_date $Time16'";
         $result16 = $db->query($query16);
         while ($row = $result16->fetch_array(MYSQLI_ASSOC)) {
            $hour16 = $hour16 + $row['hour16'];  
         } 

         $hour17 = 0;
         $Time17 = date('H:i:s',strtotime('08:00:00'));               
         $query17 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 17 THEN 1 END) AS 'hour17' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time17' AND '$to_date $Time17'";
         $result17 = $db->query($query17);
         while ($row = $result17->fetch_array(MYSQLI_ASSOC)) {
            $hour17 = $hour17 + $row['hour17']; 
         }

         $hour18 = 0;
         $Time18 = date('H:i:s',strtotime('08:00:00'));  
         $query18 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 18 THEN 1 END) AS 'hour18' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time18' AND '$to_date $Time18'";
         $result18 = $db->query($query18);
         while ($row = $result18->fetch_array(MYSQLI_ASSOC)) {
            $hour18 = $hour18 + $row['hour18']; 
         }

         $hour19 = 0;
         $Time19 = date('H:i:s',strtotime('08:00:00'));  
         $query19 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 19 THEN 1 END) AS 'hour19' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time19' AND '$to_date $Time19'";
         $result19 = $db->query($query19);
         while ($row = $result19->fetch_array(MYSQLI_ASSOC)) {
            $hour19 = $hour19 + $row['hour19']; 
         }

         $hour20 = 0;
         $Time20 = date('H:i:s',strtotime('08:00:00'));               
         $query20 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 20 THEN 1 END) AS 'hour20' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time20' AND '$to_date $Time20'";
         $result20 = $db->query($query20);
         while ($row = $result20->fetch_array(MYSQLI_ASSOC)) {
            $hour20 = $hour20 + $row['hour20']; 
         }

         $hour21 = 0;
         $Time21 = date('H:i:s',strtotime('08:00:00')); 
         $query21 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 21 THEN 1 END) AS 'hour21' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time21' AND '$to_date $Time21'";
         $result21 = $db->query($query21);
         while ($row = $result21->fetch_array(MYSQLI_ASSOC)) {
            $hour21 = $hour21 + $row['hour21']; 
         }

         $hour22 = 0;
         $Time22 = date('H:i:s',strtotime('08:00:00'));                         
         $query22 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 22 THEN 1 END) AS 'hour22' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time22' AND '$to_date $Time22'";
         $result22 = $db->query($query22);
         while ($row = $result22->fetch_array(MYSQLI_ASSOC)) {
            $hour22 = $hour22 + $row['hour22']; 
         }

         $hour23 = 0;
         $Time23 = date('H:i:s',strtotime('08:00:00'));   
         $query23 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 23 THEN 1 END) AS 'hour23' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time23' AND '$to_date $Time23'";
         $result23 = $db->query($query23);
         while ($row = $result23->fetch_array(MYSQLI_ASSOC)) {
            $hour23 = $hour23 + $row['hour23']; 
         }

         $hour0 = 0;
         $Time0 = date('H:i:s',strtotime('08:00:00')); 
         $query0 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 0 THEN 1 END) AS 'hour0' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time0' AND '$to_date $Time0'";
         $result0 = $db->query($query0);
         while ($row = $result0->fetch_array(MYSQLI_ASSOC)) {
            $hour0 = $hour0 + $row['hour0']; 
         }

         $hour1 = 0;
         $Time1 = date('H:i:s',strtotime('08:00:00'));                         
         $query1 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 1 THEN 1 END) AS 'hour1' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time1' AND '$to_date $Time1'";
         $result1 = $db->query($query1);
         while ($row = $result1->fetch_array(MYSQLI_ASSOC)) {
            $hour1 = $hour1 + $row['hour1']; 
         }

         $hour2 = 0;
         $Time2 = date('H:i:s',strtotime('08:00:00'));  
         $query2 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 2 THEN 1 END) AS 'hour2' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time2' AND '$to_date $Time2'";
         $result2 = $db->query($query2);
         while ($row = $result2->fetch_array(MYSQLI_ASSOC)) {
            $hour2 = $hour2 + $row['hour2']; 
         }

         $hour3 = 0;
         $Time3 = date('H:i:s',strtotime('08:00:00'));  
         $query3 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 3 THEN 1 END) AS 'hour3' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time3' AND '$to_date $Time3'";
         $result3 = $db->query($query3);
         while ($row = $result3->fetch_array(MYSQLI_ASSOC)) {
            $hour3 = $hour3 + $row['hour3']; 
         } 

         $hour4 = 0;
         $Time4 = date('H:i:s',strtotime('08:00:00'));                        
         $query4 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 4 THEN 1 END) AS 'hour4' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time4' AND '$to_date $Time4'";
         $result4 = $db->query($query4);
         while ($row = $result4->fetch_array(MYSQLI_ASSOC)) {
            $hour4 = $hour4 + $row['hour4']; 
         }

         $hour5 = 0;
         $Time5 = date('H:i:s',strtotime('08:00:00'));  
         $query5 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 5 THEN 1 END) AS 'hour5' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time5' AND '$to_date $Time5'";
         $result5 = $db->query($query5);
         while ($row = $result5->fetch_array(MYSQLI_ASSOC)) {
            $hour5 = $hour5 + $row['hour5']; 
         }

         $hour6 = 0;
         $Time6 = date('H:i:s',strtotime('08:00:00'));                         
         $query6 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 6 THEN 1 END) AS 'hour6' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time6' AND '$to_date $Time6'";
         $result6 = $db->query($query6);
         while ($row = $result6->fetch_array(MYSQLI_ASSOC)) {
            $hour6 = $hour6 + $row['hour6']; 
         }

         $hour7 = 0;
         $Time7 = date('H:i:s',strtotime('08:00:00'));    
         $query7 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 7 THEN 1 END) AS 'hour7' FROM a5 WHERE Date_Time BETWEEN '$from_date $Time7' AND '$to_date $Time7'";
         $result7 = $db->query($query7);
         while ($row = $result7->fetch_array(MYSQLI_ASSOC)) {
            $hour7 = $hour7 + $row['hour7']; 
         }

         $dataPoints1 = array(
            array("y" => $pruntime, "label" => "MOT A5")
         );
         $dataPoints2 = array(
            array("y" => $pstoptime, "label" => "MOT A5")
         ); 
   }else{
         $dataP1 = 0;
         $dataP2 = 0;
         $dataPoints1 = array(
            array("y" => $dataP1, "label" => "MOT A5")
         );

         $dataPoints2 = array(
            array("y" => $dataP2, "label" => "MOT A5")
         );

      }

?>
   <!-- CSS only -->

   <table id="tbl_exporttable_to_xls_1" border="1" class="table  table-striped">
      <thead>
         <th>Output</th>
         <th>Total Time</th>
         <th>AVG Cycle Time</th>
         <th>Processing Time</th>
         <th>Total Runtime</th>
         <th>Total Stoptime</th>
         <th>% RUNTIME</th>
         <th>% STOPTIME</th>
      </thead>
      <tbody>
         <tr>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $output;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo round($timetotal);}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo round($avg);}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo round($processingtime);}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo round($totalrun);}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo round($totalstop);}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo round($pruntime);}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo round($pstoptime);}?></td>
         </tr>
      </tbody>
   </table>
   <br />

   <div class="col-md-8"></div>
   <table id="tbl_exporttable_to_xls_2" border="1" class="table  table-striped">
      <thead>          
         <tr>
            <th>Hr.</th>
            <th>08:00</th>
            <th>09:00</th>
            <th>10:00</th>
            <th>11:00</th>
            <th>12:00</th>
            <th>13:00</th>
            <th>14:00</th>
            <th>15:00</th>
            <th>16:00</th>
            <th>17:00</th>
            <th>18:00</th>
            <th>19:00</th>
            <th>20:00</th>
            <th>21:00</th>
            <th>22:00</th>
            <th>23:00</th>
            <th>00:00</th>
            <th>01:00</th>
            <th>02:00</th>
            <th>03:00</th>
            <th>04:00</th>
            <th>05:00</th>
            <th>06:00</th>
            <th>07:00</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>Output</td>
            <td ><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour8;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour9;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour10;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour11;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour12;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour13;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour14;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour15;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour16;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour17;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour18;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour19;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour20;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour21;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour22;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour23;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour0;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour1;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour2;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour3;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour4;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour5;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour6;}?></td>
            <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour7;}?></td>
         </tr>
      </tbody>
   </table>
   <!--<script>
      function ExportToExcel(type, fn, dl) {
         var elt = document.getElementById('tbl_exporttable_to_xls_1');
         var wb = XLSX.utils.table_to_book(elt, { sheet: "Data" });
         return dl ?
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
            XLSX.writeFile(wb, fn || ('Data_JoyWatcher.' + (type || 'xlsx')));
      }
   </script>-->
   <script>
      var tablesToExcel = (function() {
         var uri = 'data:application/vnd.ms-excel;base64,'
         , tmplWorkbookXML = '<?xml version="1.0"?><?mso-application progid="Excel.Sheet"?><Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">'
         + '<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office"><Author>Axel Richter</Author><Created>{created}</Created></DocumentProperties>'
         + '<Styles>'
         + '<Style ss:ID="Currency"><NumberFormat ss:Format="Currency"></NumberFormat></Style>'
         + '<Style ss:ID="Date"><NumberFormat ss:Format="Medium Date"></NumberFormat></Style>'
         + '</Styles>' 
         + '{worksheets}</Workbook>'
         , tmplWorksheetXML = '<Worksheet ss:Name="{nameWS}"><Table>{rows}</Table></Worksheet>'
         , tmplCellXML = '<Cell{attributeStyleID}{attributeFormula}><Data ss:Type="{nameType}">{data}</Data></Cell>'
         , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
         , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
         return function(data, wbname, appname) {
            var ctx = "";
            var workbookXML = "";
            var worksheetsXML = "";
            var rowsXML = "";
            for (var x = 0; x < data.length; x++) {
               console.log(data[x]["sheet"]);
               tables = data[x]["tables"]; 
               for (var i = 0; i < tables.length; i++) {
                  if (!tables[i].nodeType) tables[i] = document.getElementById(tables[i]);
                  for (var j = 0; j < tables[i].rows.length; j++) {
                     rowsXML += '<Row>'
                     for (var k = 0; k < tables[i].rows[j].cells.length; k++) {
                        var dataType = tables[i].rows[j].cells[k].getAttribute("data-type");
                        var dataStyle = tables[i].rows[j].cells[k].getAttribute("data-style");
                        var dataValue = tables[i].rows[j].cells[k].getAttribute("data-value");
                        dataValue = (dataValue)?dataValue:tables[i].rows[j].cells[k].innerHTML;
                        var dataFormula = tables[i].rows[j].cells[k].getAttribute("data-formula");
                        dataFormula = (dataFormula)?dataFormula:(appname=='Calc' && dataType=='DateTime')?dataValue:null;
                        ctx = {  attributeStyleID: (dataStyle=='Currency' || dataStyle=='Date')?' ss:StyleID="'+dataStyle+'"':''
                           , nameType: (dataType=='Number' || dataType=='DateTime' || dataType=='Boolean' || dataType=='Error')?dataType:'String'
                           , data: (dataFormula)?'':dataValue
                           , attributeFormula: (dataFormula)?' ss:Formula="'+dataFormula+'"':''
                        };
                        rowsXML += format(tmplCellXML, ctx);
                     }
                     rowsXML += '</Row>'
                  }
               }         
               ctx = {rows: rowsXML, nameWS: data[x]["sheet"] || 'Sheet' + i};
               worksheetsXML += format(tmplWorksheetXML, ctx);
               rowsXML = "";
            }
            ctx = {created: (new Date()).getTime(), worksheets: worksheetsXML};
            workbookXML = format(tmplWorkbookXML, ctx);
            console.log(workbookXML);
            var link = document.createElement("A");
            link.href = uri + base64(workbookXML);
            link.download = wbname || 'Workbook.xls';
            link.target = '_blank';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
         }
      })();
   
   </script>


<!------------------------------------------------------>
<!--<table class="table table-bordered border-primary">
 <table style="width: 750px" class="table table-success table-striped">
   <tr> #90CAF9 #CBB1DF
      <th>Output</th>
      <td></td>
      <td>Board</td>
   </tr>

   <tr> #F0E68C
      <th>Total Time</th>
      <td></td>
      <td>Min</td>
   </tr>

   <tr> #c3baf7
      <th>Processing Time</th>
      <td></td>
      <td>Min</td>
   </tr>

   <tr> #bfbfbf
      <th>AVG Cycle Time</th>
      <td></td>
      <td>Sec/Sheet</td>
   </tr>

   <tr> #AED581
      <th>Total Runtime</th>
      <td></td>
      <td>Min</td>
   </tr>

   <tr> #FF8A65
      <th>Total Stoptime</th>
      <td></td>
      <td>Min</td>
   </tr>

   <tr> #66BB6A
      <th>% RUNTIME</th>
      <td></td>
      <td></td>
   </tr>

   <tr> #ff9999
      <th>% STOPTIME</th>
      <td></td>
      <td></td>
   </tr>
</table>-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="dist/jquery.canvasjs.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js" integrity="sha512-hZf9Qhp3rlDJBvAKvmiG+goaaKRZA6LKUO35oK6EsM0/kjPK32Yw7URqrq3Q+Nvbbt8Usss+IekL7CRn83dYmw==" crossorigin="anonymous"></script>

   <div class="row">
      <div class="col-md-8">
         <div class="panel-group">
            <div class="panel panel-custom-horrible-purple" style="margin-top: 25px;">
               <div class="panel-heading" style="height: 49px;">
                  <h3 class="panel-title" style="margin-top: 4px; font-size: 19px; text-align: center;">Data Output of Joy Watcher
                     <form class="pull-right" action="" enctype="multipart/form-data">
                        <!--<button onclick="downloadImage1();" class="button button3" style="margin-top: -10px; margin-right: -5px; font-weight: normal;"><span class="glyphicon glyphicon-floppy-save"></span>Export File</button>-->
                            <a data-name="myChart" id="downloadavg" download="ChartOutput_A5.jpg" href="" class="download button button3"class="download glyphicon glyphicon-floppy-save"style="margin-top: -10px; margin-right: -5px; font-weight: normal;">Export File</a>
                     </form>
                  <ul class="list-inline panel-actions"></ul>
               </div>
               <div class="panel-body fixed-panel" style="height: 360px;">
                  <div class="chartCard">
                     <div class="chartBox">
                        <canvas id="myChart" style="height: 358px; width:100%; display: inline-block; margin-top: -15px; position: relative;"></canvas>     
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>      
                                       
      <div class="col-md-4">
         <div class="panel-group">
            <div class="panel panel-custom-horrible-purple" style="margin-top: 25px;">
               <div class="panel-heading" style="height: 49px;">
                  <h3 class="panel-title" style="margin-top: 4px; font-size: 19px; text-align: center;">Machine Runtime
                     <form class="pull-right" action="" enctype="multipart/form-data">
                        <button id="exportButton" type="button" class="button button4" style="margin-top: -10px; margin-right: -5px; font-weight: normal;"><span class="glyphicon glyphicon-floppy-save"></span> Export File</button>
                     </form>
                  <ul class="list-inline panel-actions"></ul>
               </div>
               <div class="panel-body fixed-panel" style="height: 360px;">
                  <div id="chartMachineRuntime" style="height: 340px; width: 100%; display: inline-block; margin-top: -5px;"></div>
               </div>
            </div>
         </div>
      </div>

   </div>

<!-- Chart Data Output of Joy Watcher -->
<script>
<?php
   if(isset($_GET['from_date']) && isset($_GET['to_date'])) { 
      $arr=[$hour8,$hour9,$hour10,$hour11,$hour12,$hour13,$hour14,$hour15,$hour16,$hour17,$hour18,$hour19,$hour20,$hour21,$hour22,$hour23,$hour0,$hour1,$hour2,$hour3,$hour4,$hour5,$hour6,$hour7];
   }else{
      $arr = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
   }   
?>
   
   var ctx = document.getElementById("myChart").getContext('2d');
   var dataArray = [<?php echo join(',',$arr);?>];
   var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
         labels: ['8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00', '0:00', '1:00', '2:00', '3:00', '4:00', '5:00', '6:00', '7:00'  ],
         datasets: [{
            label: 'Output',
            data: dataArray,
            backgroundColor: ['#000066','#002266', '#003366', '#005566', '#007766','#009966', '#000066','#002266', '#003366', '#005566', '#007766','#009966', '#000066','#002266', '#003366', '#005566', '#007766','#009966', '#000066','#002266', '#003366', '#005566', '#007766','#009966'],
            borderWidth: 1
         }]
      },
      options: {
         title: {
            display: true,
            /*text: 'Data Output of Joy Watcher',*/
            fontSize: 20,
            fontColor: "black",
         },
         "hover": {
            "animationDuration": 0
         },
         "animation": {
            "duration": 1,
            "onComplete": function () {
               var chartInstance = this.chart,
                  ctx = chartInstance.ctx;

               ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
               ctx.textAlign = 'center';
               ctx.textBaseline = 'bottom';

               this.data.datasets.forEach(function (dataset, i) {
                  var meta = chartInstance.controller.getDatasetMeta(i);
                  meta.data.forEach(function (bar, index) {
                     var data = dataset.data[index];
                     ctx.fillText(data, bar._model.x, bar._model.y -5);
                  });
               });
            }
         },
         legend: {
            "display": true,
            position: "bottom", // "bottom" "top"
            labels: {
               fontColor: "black",
               fontSize: 12,
               fontStyle: "bold"
            }
         },
         tooltips: {
            "enabled": true
         },
         scales: {
            yAxes: [{
               //display: false,
               /*gridLines: {
                  display: false
               },*/
               ticks: {
                  beginAtZero: true,
                  fontSize: 15,
                  fontColor: "black",
                  fontStyle: "bold",
                  display: true
               }
            }],
            xAxes: [{
               /*gridLines: {
                  display: false
               },*/
               ticks: {
                  beginAtZero: true,
                  fontSize: 15,
                  fontColor: "black",
                  fontStyle: "bold"
               }
            }]
         }
      },
      plugins: [{
         id: 'custom_canvas_background_color',
         beforeDraw: (chart) => {
            const ctx = chart.canvas.getContext('2d');
            ctx.save();
            ctx.globalCompositeOperation = 'destination-over';
            ctx.fillStyle = 'white';
            ctx.fillRect(0, 0, chart.canvas.width, chart.canvas.height);
            ctx.restore();
         }
      }]
   });
   function downloadImage1() {
      myChart.options.title.text = 'Data Output of Joy Watcher';
      myChart.update({
         duration: 0
      });
      var link = document.createElement('a');
      link.href = myChart.toBase64Image();
      link.download = 'ChartOutput_A5.jpg';
      link.click();
      myChart.options.title.text = 'Data Output of Joy Watcher';
      myChart.update({
         duration: 0
      });
   }
   function downloadImage(name, id) {
  setTimeout(() => {
    const a = $(id)[0];
    a.href = $(name)[0].toDataURL("image/jpg");
    a.click();
  }, 321)
}
$('.download').on('click', function(e) {
  const name = '#' + $(this).data('name');
  const id = '#' + this.id;
  const parent = $(name).parent();
  if (!$(this).attr('href')) {
    parent.css({ width: Math.max(1200, parent.width()) });
    downloadImage(name, id);
    e.preventDefault();
  } else {
    parent.css({ width: '' });
    setTimeout(() => $(id).attr('href', ''));
  }
});
</script>
</script>

<!-- Chart Machine Runtime of Joy Watcher -->
<script>
   var chart1 = new CanvasJS.Chart("chartMachineRuntime",
      {
         animationEnabled: true,
         title:{
            //text: "Machine Runtime",
            padding: 10,
            //borderThickness: 2,
            //cornerRadius: 4,
            //backgroundColor: "#F5DEB3", // "#f4d5a6" #F5DEB3
            fontFamily: "Arial", // "Arial" "impact"
            fontColor: "#202020",
            fontSize: 22,
            margin: 30
         },
         //exportEnabled: true,
         axisX:{
            text: "MOT A5",
            labelFontSize: 15,
            labelFontWeight: "bold",
            labelFontFamily: "sans-serif"
         },
         axisY:{
            suffix: "%",
            labelFontSize: 15,
            labelFontWeight: "bold",
            labelFontFamily: "sans-serif"
         },
         legend:{
            verticalAlign: "bottom", // "top", "bottom"
            horizontalAlign: "center" // "center" "right" "left"
         },
         toolTip: {
            shared: true
         },
         data: [
         {
            type: "stackedColumn100",
            name: "%RUNTIME",
            //legendText: "% RUNTIME",
            showInLegend: "true",
            indexLabel: "{y}",
            indexLabelPlacement: "inside",
            indexLabelOrientation: "horizontal", // "horizontal", "vertical"
            indexLabelFontFamily: "sans-serif", 
            indexLabelFontColor: "white",
            indexLabelFontSize: 22,
            indexLabelFontWeight: "bold",
            color: "green",
            yValueFormatString: "#,##0\"%\"",
            dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
               //{ y:'pruntime' , label: "MOT A2", indexLabel: "pruntime" }
            
         },  

         {
            type: "stackedColumn100",
            name: "%STOPTIME",
            //legendText: "% STOPTIME",
            showInLegend: "true",
            indexLabel: "{y}",
            indexLabelPlacement: "inside",
            indexLabelOrientation: "horizontal", // "horizontal", "vertical"
            indexLabelFontFamily: "sans-serif", 
            indexLabelFontColor: "white",
            indexLabelFontSize: 22,
            indexLabelFontWeight: "bold",
            color: "red",
            yValueFormatString: "#,##0\"%\"",
            dataPoints:  <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
               //{ y: 'pstoptime' , label: "MOT A2", indexLabel: "pstoptime" }          
         }
         ]
      });
      chart1.render();
      /*$("#exportButton").click(function(){
         html2canvas(document.querySelector("#chartMachineRuntime")).then(canvas => {  
            var dataURL = canvas.toDataURL();
            var pdf = new jsPDF();
            pdf.addImage(dataURL, 'JPEG', 20, 20, 170, 120); //addImage(image, format, x-coordinate, y-coordinate, width, height)
            pdf.save("CanvasJS Charts.pdf");
         });
      });*/

      $("#exportButton").click(function(){
         html2canvas(document.querySelector("#chartMachineRuntime")).then(canvas => { 
            let downloadLink = document.createElement('a');
            downloadLink.setAttribute('download', 'MachineRuntime_A5.png');
            let dataURL = canvas.toDataURL('image/png');
            console.log("done");
            let url = dataURL.replace(/^data:image\/png/,'data:application/octet-stream');
            downloadLink.setAttribute('href',url);
            downloadLink.click();
         });     
      });
</script>
<script>
$(function() {
   function realTime() {
      setTimeout(function(){
         $.ajax({    
            method: "POST",   
            data: { rev: 1 },
            dataType: "json"   
         }).done(function( data ) {
            $("#time").html(data.s1); 
            $("#time").addClass("realtime");
         });
      realTime(); 
      }, 1000);  
   }
   realTime();
});
</script>
<?php include_once('layouts/footer.php'); ?>