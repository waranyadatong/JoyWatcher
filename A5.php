<?php  
  setcookie("PHPSESSID", "", time() - 3600); 
  date_default_timezone_set('Asia/Bangkok');
  $page_title = 'Joy Watcher';
  require_once('includes/load.php');
  //page_require_level(1); 
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
  /*$the_now = date('H:i:s');
  $the_time = date('H:i:s',date(strtotime('08:00:00')));*/
  $the_now = strtotime(date('H:i:s'));
  $the_time = strtotime(date('H:i:s',strtotime('08:00:00')));

  if (isset($_POST['rev']) && $_POST['rev'] == 1) {
    if ($the_time < $the_now) {
      $Start = date('Y-m-d H:i:s',date(strtotime("+0 day", mktime(8,0,0))));
      $End = date('Y-m-d H:i:s',date(strtotime("+1 day", mktime(8,0,0))));
    } else {
      $Start = date('Y-m-d H:i:s',date(strtotime("-1 day", mktime(8,0,0))));
      $End = date('Y-m-d H:i:s',date(strtotime("+0 day", mktime(8,0,0)))); 
    }
    global $db;
    $output = 0;
    $query = "SELECT count(*) AS total FROM a5 WHERE Date_Time BETWEEN '$Start' AND '$End'";
    $result = $db->query($query);
    $rowsOutput = mysqli_num_rows($result);
    if ($rowsOutput > 0) {  
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
          $output = $output + $row['total'];
        }
     }else{
        $output = 0;
     }
    $divProduct = "NO Plan/No Run";
    $productresult = "";
    $queryproduct = "SELECT Product_Name FROM a5 WHERE Date_Time BETWEEN '$Start' AND '$End'";
    $product = $db->query($queryproduct);
    $rowsProduct = mysqli_num_rows($product);
    if ($rowsProduct > 0) { 
      while ($row = $product->fetch_array(MYSQLI_ASSOC)) {
        $productresult = $row['Product_Name'];
      }
     }else{
     $productresult = "No Plan/No Run"; 
        /*echo '<script>';
        echo 'var div = document.getElementById("product");';
        echo 'div.innerHTML += "No Plan/No Run";';
        echo '</script>';*/
     }
    
    $pcsresult = "";
    $pcstotal = 0;
    $querypcs = "SELECT pcs FROM program WHERE Program_Name = '$productresult'";
    $pcs = $db->query($querypcs);
    $rowsPcs= mysqli_num_rows($pcs);
    if ($rowsPcs > 0){
    while ($row = $pcs->fetch_array(MYSQLI_ASSOC)) {
      $pcsresult = $row['pcs'];
      }
    }else{
      $pcsresult = 0;
     }
    $pcsday = $output*$pcsresult;
    $pcshour = $pcsday;

    $targetresult = "";
    $targettotal = 0;
    $hourtarget = 0;
    $querytarget = "SELECT target FROM target_a5 WHERE datetime BETWEEN '$Start' AND '$End'";
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
    
    /*$target8 = $hourtarget*1;
    $target9 = $hourtarget*2;
    $target10 = $hourtarget*3;
    $target11 = $hourtarget*4;
    $target12 = $hourtarget*5;
    $target13 = $hourtarget*6;
    $target14 = $hourtarget*7;
    $target15 = $hourtarget*8;
    $target16 = $hourtarget*9;
    $target17 = $hourtarget*10;
    $target18 = $hourtarget*11;
    $target19 = $hourtarget*12;
    $target20 = $hourtarget*13;
    $target21 = $hourtarget*14;
    $target22 = $hourtarget*15;
    $target23 = $hourtarget*16;
    $target0 = $hourtarget*17;
    $target1 = $hourtarget*18;
    $target2 = $hourtarget*19;
    $target3 = $hourtarget*20;
    $target4 = $hourtarget*21;
    $target5 = $hourtarget*22;
    $target6 = $hourtarget*23;
    $target7 = $hourtarget*24;*/

    $now = date('Y-m-d H:i:s');
    $hour = date_parse($now)['hour']; 
    if ($hour ==8) {
      $targethr = $pcshour - ($hourtarget*1);
      $barlanceHr = $hourtarget*1;
    }elseif ($hour ==9) {
      $targethr = $pcshour - ($hourtarget*2);
      $barlanceHr = $hourtarget*2;
    }elseif ($hour ==10) {
      $targethr = $pcshour - ($hourtarget*3);
      $barlanceHr = $hourtarget*3;
    }elseif ($hour ==11) {
      $targethr = $pcshour - ($hourtarget*4);
      $barlanceHr = $hourtarget*4;
    }elseif ($hour ==12) {
      $targethr = $pcshour - ($hourtarget*5);
      $barlanceHr = $hourtarget*5;
    }elseif ($hour ==13) {
      $targethr = $pcshour - ($hourtarget*6);
      $barlanceHr = $hourtarget*6;
    }elseif ($hour ==14) {
      $targethr = $pcshour - ($hourtarget*7);
      $barlanceHr = $hourtarget*7;
    }elseif ($hour ==15) {
      $targethr = $pcshour - ($hourtarget*8);
      $barlanceHr = $hourtarget*8;
    }elseif ($hour ==16) {
      $targethr = $pcshour - ($hourtarget*9);
      $barlanceHr = $hourtarget*9;
    }elseif ($hour ==17) {
      $targethr = $pcshour - ($hourtarget*10);
      $barlanceHr = $hourtarget*10;
    }elseif ($hour ==18) {
      $targethr = $pcshour -($hourtarget*11);
      $barlanceHr = $hourtarget*11;
    }elseif ($hour ==19) {
      $targethr = $pcshour - ($hourtarget*12);
      $barlanceHr = $hourtarget*12;
    }elseif ($hour ==20) {
      $targethr = $pcshour - ($hourtarget*13);
      $barlanceHr = $hourtarget*13;
    }elseif ($hour ==21) {
      $targethr = $pcshour - ($hourtarget*14);
      $barlanceHr = $hourtarget*14;
    }elseif ($hour ==22) {
      $targethr = $pcshour - ($hourtarget*15);
      $barlanceHr = $hourtarget*15;
    }elseif ($hour ==23) {
      $targethr = $pcshour - ($hourtarget*16);
      $barlanceHr = $hourtarget*16;
    }elseif ($hour ==0) {
      $targethr = $pcshour - ($hourtarget*17);
      $barlanceHr = $hourtarget*17;
    }elseif ($hour ==1) {
      $targethr = $pcshour - ($hourtarget*18);
      $barlanceHr = $hourtarget*18;
    }elseif ($hour ==2) {
      $targethr = $pcshour - ($hourtarget*19);
      $barlanceHr = $hourtarget*19;
    }elseif ($hour ==3) {
      $targethr = $pcshour - ($hourtarget*20);
      $barlanceHr = $hourtarget*20;
    }elseif ($hour ==4) {
      $targethr = $pcshour - ($hourtarget*21);
      $barlanceHr = $hourtarget*21;
    }elseif ($hour ==5) {
      $targethr = $pcshour - ($hourtarget*22);
      $barlanceHr = $hourtarget*22;
    }elseif ($hour ==6) {
      $targethr = $pcshour - ($hourtarget*23);
      $barlanceHr = $hourtarget*23;
    }elseif ($hour ==7) {
      $targethr = $pcshour - ($hourtarget*24);
      $barlanceHr = $hourtarget*24;
    }

    /*$targethr8 = $pcshour-$target8;
    $targethr9 = $pcshour-$target9;
    $targethr10 = $pcshour-$target10;
    $targethr11 = $pcshour-$target11;
    $targethr12 = $pcshour-$target12;
    $targethr13 = $pcshour-$target13;
    $targethr14 = $pcshour-$target14;
    $targethr15 = $pcshour-$target15;
    $targethr16 = $pcshour-$target16;
    $targethr17 = $pcshour-$target17;
    $targethr18 = $pcshour-$target18;
    $targethr19 = $pcshour-$target19;
    $targethr20 = $pcshour-$target20;
    $targethr21 = $pcshour-$target21;
    $targethr22 = $pcshour-$target22;
    $targethr23 = $pcshour-$target23;
    $targethr0 = $pcshour-$target0;
    $targethr1 = $pcshour-$target1;
    $targethr2 = $pcshour-$target2;
    $targethr3 = $pcshour-$target3;
    $targethr4 = $pcshour-$target4;
    $targethr5 = $pcshour-$target5;
    $targethr6 = $pcshour-$target6;
    $targethr7 = $pcshour-$target7;*/
     
    $timetotal = 0;
    $querytime = "SELECT Date_time AS t,Takt_time as tak FROM a5 WHERE Date_Time BETWEEN '$Start' AND '$End'";
    $resulttime = $db->query($querytime);
    while ($row = $resulttime->fetch_array(MYSQLI_ASSOC)) {
      //$takt = $row['tak'];
      $outputtime = strtotime($row['t']);
      //$out = $outputtime + $takt;
      $timetotal =  ($outputtime - strtotime($Start))/60;
    }

    $avgtime = 0;
    $timeSecond = 0;
    $av = 0;
    $Timeavg = date('H:i:s',strtotime('08:00:00'));
    $queryavg = "SELECT Takt_time as takttime,start_time as starttime,end_time as endtime FROM a5 WHERE Date_Time BETWEEN '$Start' AND '$End'";
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
    $queryrunstop = "SELECT Takt_time as tk,start_time as st,end_time as et FROM a5 WHERE Date_Time BETWEEN '$Start' AND '$End'";
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
    $zero = 0; 

    $jsonObj = '{'
    . '"output":"' . $output . ' "' . ', '
    . '"timetotal":"' . round($timetotal) . ' "' . ', '
    . '"s0":"' . date('Y-m-d H:i:s') . ' "' . ', '
    . '"t":"' . date('H:i:s') . ' "' . ', '
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
    /*. '"t8":"' . number_format($target8) . ' "' . ', '
    . '"t9":"' . number_format($target9) . ' "' . ', '
    . '"t10":"' . number_format($target10) . ' "' . ', '
    . '"t11":"' . number_format($target11) . ' "' . ', '
    . '"t12":"' . number_format($target12) . ' "' . ', '
    . '"t13":"' . number_format($target13) . ' "' . ', '
    . '"t14":"' . number_format($target14) . ' "' . ', '
    . '"t15":"' . number_format($target15) . ' "' . ', '
    . '"t16":"' . number_format($target16) . ' "' . ', '
    . '"t17":"' . number_format($target17) . ' "' . ', '
    . '"t18":"' . number_format($target18) . ' "' . ', '
    . '"t19":"' . number_format($target19) . ' "' . ', '
    . '"t20":"' . number_format($target20) . ' "' . ', '
    . '"t21":"' . number_format($target21) . ' "' . ', '
    . '"t22":"' . number_format($target22) . ' "' . ', '
    . '"t23":"' . number_format($target23) . ' "' . ', '
    . '"t0":"' . number_format($target0) . ' "' . ', '
    . '"t1":"' . number_format($target1) . ' "' . ', '
    . '"t2":"' . number_format($target2) . ' "' . ', '
    . '"t3":"' . number_format($target3) . ' "' . ', '
    . '"t4":"' . number_format($target4) . ' "' . ', '
    . '"t5":"' . number_format($target5) . ' "' . ', '
    . '"t6":"' . number_format($target6) . ' "' . ', '
    . '"t7":"' . number_format($target7) . ' "' . ', '
    . '"thr8":"' . number_format($targethr8) . ' "' . ', '
    . '"thr9":"' . number_format($targethr9) . ' "' . ', '
    . '"thr10":"' . number_format($targethr10) . ' "' . ', '
    . '"thr11":"' . number_format($targethr11) . ' "' . ', '
    . '"thr12":"' . number_format($targethr12) . ' "' . ', '
    . '"thr13":"' . number_format($targethr13) . ' "' . ', '
    . '"thr14":"' . number_format($targethr14) . ' "' . ', '
    . '"thr15":"' . number_format($targethr15) . ' "' . ', '
    . '"thr16":"' . number_format($targethr16) . ' "' . ', '
    . '"thr17":"' . number_format($targethr17) . ' "' . ', '
    . '"thr18":"' . number_format($targethr18) . ' "' . ', '
    . '"thr19":"' . number_format($targethr19) . ' "' . ', '
    . '"thr20":"' . number_format($targethr20) . ' "' . ', '
    . '"thr21":"' . number_format($targethr21) . ' "' . ', '
    . '"thr22":"' . number_format($targethr22) . ' "' . ', '
    . '"thr23":"' . number_format($targethr23) . ' "' . ', '
    . '"thr0":"' . number_format($targethr0) . ' "' . ', '
    . '"thr1":"' . number_format($targethr1) . ' "' . ', '
    . '"thr2":"' . number_format($targethr2) . ' "' . ', '
    . '"thr3":"' . number_format($targethr3) . ' "' . ', '
    . '"thr4":"' . number_format($targethr4) . ' "' . ', '
    . '"thr5":"' . number_format($targethr5) . ' "' . ', '
    . '"thr6":"' . number_format($targethr6) . ' "' . ', '
    . '"thr7":"' . number_format($targethr7) . ' "' . ', '*/
    . '"barlanceHr":"' . number_format($barlanceHr) . ' "' . ', '
    . '"targetHr":"' . number_format($targethr) . ' "' . ', '
    . '"zero":"' . number_format($zero) . ' "' . ', '
    . '"pstoptime":"' . round($pstoptime) . ' "'
    . '}' ;  
    echo $jsonObj;  // ถ้า $jsonObj เป็นอาร์เรย์ สามารถใช้ฟังก์ชัน json_encode() เพื่อส่งกลับข้อมูลแบบ JSON
    exit();
    //$db->close();
  }
?>                 
<?php include_once('layouts/header.php');?>  

<head>
  <script src="jquery-latest.js"></script> 
  <script type="text/javascript" src="assets/js/jquery-3.4.0.min.js"></script>
  <script type="text/javascript" src="assets/js/mdb.min.js"></script> 
  <link rel="stylesheet" href="css/AdminLTE.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="css/bootstrap.datetimepicker.css">-->
  <link rel="stylesheet" href="css/bootstrap.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <!--<link href="library/daterangepicker.css" rel="stylesheet"/>-->
  <!--<script src="library/daterangepicker.min.js"></script>-->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
  <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="dist/jquery.canvasjs.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha584-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
  <style>
    /*row-1 : input target and m/c*/
    .button {
      color: #FFFFFF;
      padding: 8px;
      border: none;
      border-radius: 4px;
    }
    .button1 {
      background-color: #122E94;
      border-color: #122E94;
      margin-left: 10px;
      font-size:16px;
      width: 75px;
      height: 35px;
    }
    .button2 {
      background-color: #F75206;
      border-color: #F75206;
      margin-left: 8px;
      font-size:16px;
      width: 75px;
      height: 35px;
    }
    #target {
      width: 150px;
      height: 34px;
      margin-left: 5px;
    }
    .boxmachine {
      background-color: #F1948A;
      color: #000000;
      /*width: 335px;
      height: 85px;*/
      border-style: dotted; /* solid dotted */
      border-color: #C01400;
    }

    /*row-2 : product target output barlance (pcs/day)*/
    .boxproduct {
      background-color: #D1D1D1;
      color: #000000;
      /*width: 335px;
      height: 115px;*/
      border-style: dotted; /* solid dotted */
      border-color: #000000;
    }
    .boxtarget-day {
      color: #FFFFFF;
      background-color: #272727;
      /*width: 220px;
      height: 115px;*/
    }
    .boxoutput-day {
      color: #FFFFFF;
      background-color: #000595;
      /*width: 220px;
      height: 115px;*/
    }
    .boxbarlance-day {
      color: #FFFFFF;
      /*background-color: #B60000;
      width: 220px;
      height: 115px;*/
    }

    /*row-3 : time target output barlance (pcs/hr)*/
    .boxtime {
      background-color: #D2B4DE;
      color: #FF0000;
      /*width: 335px;
      height: 115px;*/
      border-style: dotted; /* solid dotted */
      border-color: #5B2C6F;
    }
    .boxtarget-hr {
      color: #000000;
      background-color: #9FE2BF;
      /*width: 220px;
      height: 115px;*/
    }
    .boxoutput-hr {
      color: #000000;
      background-color: #40E0D0;
      /*width: 220px;
      height: 115px;*/
    }
    .boxbarlance-hr {
      color: #FFFFFF;
      /*background-color: #6495ED;
      width: 220px;
      height: 115px;*/
    }

    /*row-4 : chart*/
    .panel-actions {
      margin-top: 0;
      margin-bottom: 0;
    }
    .panel-title {
      display: inline-block;
      width: 100%;
      font-size: 20px;
    }
    .panel-custom-horrible-purple {
      border-color: #03308B;
    }
    .panel-custom-horrible-purple > .panel-heading {
      color: #FFFFFF;
      background: #03308B;
      border-color: #03308B;
      text-align: center;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- row-1 : input target and m/c  -->
    <section class="content">
      <div class="row">
        <div class="col-md-9 col-lg-9">
          <form class="form-inline" name="inputtar" id="inputtar" action="" method="post">
            <label id="tg" for="target" style="font-size: 18px;">Target Plan: </label>
            <input type="text" id="target" name="target" value="" placeholder="Enter Target" />
            <input type="button" id="submit" name="save_contact" value="Submit" class="button button1" onclick="submitForm();"/>
            <input type="reset" id="reset" name="reset" value="Reset" class="button button2" onclick="clearform();"/>
          </form>
        </div>
        <div class="col-md-3 col-lg-3">
          <div class="boxmachine">
            <div class="inner">
              <h3 style="font-size: 38px; text-align: center; font-weight: bold;">M/C: MOT-A5</h3>
            </div>
          </div>
        </div>
      </div>

      <br/>

      <!-- row-2 : product target output barlance (pcs/day)  -->
      <div class="row">
        <!--<div class="row justify-content-end">-->
          <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="boxproduct">
              <div class="inner">
                <p style="font-size: 22px; margin-left: 10px;">Product: 
                  <!--<span class="iconify" data-icon="openmoji:construction-worker-medium-skin-tone" style="margin-left: 206px;" data-width="55"></span>-->
                </p>
                <h3 id="product" style="font-size: 32px; text-align: center; font-weight: bold;"></h3>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="boxtarget-day">
              <div class="inner">
                <p style="font-size: 22px; margin-left: 10px;">Target Plan: 
                  <!--<span class="iconify" data-icon="bi:pin-angle-fill" style="color: #FFFFFF; margin-left: 47px; margin-top: 5px;" data-width="28"></span>-->
                </p>
                <p style="font-size: 16px; margin-left: 10px; margin-top: -15px;">(Pcs/Day)</p>
                <h3 id="targetresult" style="font-size: 52px; text-align: center; margin-top: -5px; font-weight: bold;"></h3>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="boxoutput-day">
              <div class="inner">
                <p style="font-size: 22px; margin-left: 10px;">Actual Output: 
                  <!--<span class="iconify" data-icon="ic:baseline-manage-history" style="color: #FFFFFF; margin-left: 20px; margin-top: 3px;" data-width="32"></span>-->
                </p>
                <p style="font-size: 16px; margin-left: 10px; margin-top: -15px;">(Pcs/Day)</p>
                <h3 id="pcsday" style="font-size: 52px; text-align: center; margin-top: -5px; font-weight: bold;"></h3>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="boxbarlance-day">
              <div class="inner">
                <p style="font-size: 22px; margin-left: 10px;">Balance: 
                  <!--<span class="iconify" data-icon="material-symbols:auto-graph" style="color: #FFFFFF; margin-left: 72px; margin-top: 3px;" data-width="32"></span>-->
                </p>
                <p style="font-size: 16px; margin-left: 10px; margin-top: -15px;">(Pcs/Day)</p>
                <h3 id="barlance" style="font-size: 52px; text-align: center; margin-top: -5px; font-weight: bold;"></h3>
              </div>
            </div>
          </div>
        <!--</div>-->
      </div>

      <br/>

      <!-- row-3 : time target output barlance (pcs/hr)  -->
      <div class="row">
        <!--<div class="row justify-content-end">-->
          <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="boxtime">
              <div class="inner">
                <p style="font-size: 22px; margin-left: 10px; color: #000000;">Time: 
                  <!--<span class="iconify" data-icon="twemoji:alarm-clock" style="margin-left: 245px; margin-top: 7px;" data-width="36"></span>-->
                </p>
                <h3 id="t" style="font-size: 50px; text-align: center; margin-top: -2px; font-weight: bold;"><?php echo date('H:i:s'); ?></h3>
              </div>
            </div>
          </div>

          <?php 
            /*$now = date('Y-m-d H:i:s');
            $hour = date_parse($now)['hour']; 
            echo $hour;*/
          ?>

          <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="boxtarget-hr"> 
              <div class="inner">
                <p style="font-size: 22px; margin-left: 10px;">Target Plan: 
                  <!--<span class="iconify" data-icon="bi:pin-angle-fill" style="color: #FFFFFF; margin-left: 47px; margin-top: 5px;" data-width="28"></span>-->
                </p>
                <p style="font-size: 16px; margin-left: 10px; margin-top: -15px;">(Pcs/Hr)</p>
                <h3 id="barlanceHr" style="font-size: 52px; text-align: center; margin-top: -5px; font-weight: bold;"></h3>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="boxoutput-hr">
              <div class="inner">
                <p style="font-size: 22px; margin-left: 10px;">Actual Output: 
                  <!--<span class="iconify" data-icon="ic:baseline-manage-history" style="color: #FFFFFF; margin-left: 20px; margin-top: 3px;" data-width="32"></span>-->
                </p>
                <p style="font-size: 16px; margin-left: 10px; margin-top: -15px;">(Pcs/Hr)</p>
                <h3 id="pcshour" style="font-size: 52px; text-align: center; margin-top: -5px; font-weight: bold;"></h3>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="boxbarlance-hr">
              <div class="inner">
                <p style="font-size: 22px; margin-left: 10px;">Balance: 
                  <!--<span class="iconify" data-icon="material-symbols:auto-graph" style="color: #FFFFFF; margin-left: 72px; margin-top: 3px;" data-width="32"></span>-->
                </p>
                <p style="font-size: 16px; margin-left: 10px; margin-top: -15px;">(Pcs/Hr)</p>
                 <h3 id="targetHr" style="font-size: 52px; text-align: center; margin-top: -5px; font-weight: bold;"></h3>
              </div>
            </div>
          </div>
        <!--</div>-->
      </div>

      <!-- row-4 : chart  -->
      <div class="row">
        <div class="col-md-2 col-lg-12">
          <div class="panel-group" style="margin-top: 20px;">
            <div class="panel panel-custom-horrible-purple">
              <div class="panel-heading">
                <h3 class="panel-title">Daily Target Plan & Output Overall of Joy Watcher</h3>
                <ul class="list-inline panel-actions"></ul>
              </div>
              <div class="panel-body">
                <div id="chartProduction" style="height: 370px; width: 100%; display: inline-block; margin-top: 20px; margin-left: -10px;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <!--</div>-->
  <!--<script>
    $(document).ready(function() {
      $('#send').click(function(e) {
        e.preventDefault();
        var input = $('#input').val();
        $.ajax({
          type: 'POST',
          url: 'serverproduction.php',//'service.php',//serverproduction.php,
          data: { input: input},
          success: function(data){
            $("#content").html(data);
          }
        });
      });
    });
  </script>-->
  <script>
    function submitForm() {
      var target = $('input[name=target]').val();
      if(target != '') {
        var formData = {target: target};
        $('#message').html('<span style="color: #FFFFFF">Processing form. . . please wait. . .</span>');
        $.ajax({
          url: "submit_a5.php",
          type: 'POST',
          data: formData,
          success: function(response) {
            $('#content').html(response)
            var res = JSON.parse(response);
            console.log(res); 
            if(res.success == true)
              $('#message').html('<span style="color: #FFFFFF">Form submitted successfully</span>');
            else
              $('#message').html('<span style="color: #FFFFFF">Form not submitted. Some error in running the database query.</span>');
          }
        });
      } else {
        $('#message').html('<span style="color: #FFFFFF">Please fill all the fields</span>');
      }
    }
  </script>

  <script>
    function clearform() {
      document.getElementById("target").value="";
      document.getElementById("target").focus();
    }
  </script>

  <script>
    window.onload = function() {
      var chart = new CanvasJS.Chart("chartProduction",
      {
        animationEnabled: true,
        title:{
          fontFamily: "Arial",
          fontColor: "#202020",
          fontWeight: "bold",
          fontSize: 20,
          margin: 30,
          padding: 13
        },
        axisY:{
          title: "Output (Pcs/Hour)",
          titleFontSize: 20,
          titleFontFamily: "sans-serif",
          labelFontFamily: "sans-serif",
          labelFontWeight: "bold",
          labelFontSize: 16,
          margin: 5
        },
        axisY2:{
          title: "Acc Master&Output",
          titleFontSize: 20,
          titleFontFamily: "sans-serif",
          labelFontFamily: "sans-serif",
          labelFontWeight: "bold",
          labelFontSize: 16,
          margin: 5
        },
        axisX:{
          interval: 1,
          labelAngle: -60,
          labelFontFamily: "sans-serif",
          labelFontWeight: "bold"
        },
        data:[{
          color: "#6495ED",//"#FFA240",
          type: "column",
          indexLabel: "{y}",
          indexLabelPlacement: "outside",
          indexLabelOrientation: "horizontal",
          indexLabelFontSize: 16,
          showInLegend: true,
          name: "Output",
          datapoints: []
        },
        {
          axisYType: "secondary",
          color: "#006A20",
          type: "line",
          showInLegend: true,
          name: "Acc Output",
          markerType: "square",
          //yValueFormatString: "#,##0.##",
          datapoints: [] 
        },
        {
          axisYType: "secondary",
          color: "#B51717",
          type: "line",
          showInLegend: true,
          name: "Master Plan",
          lineDashType: "dash",
          //yValueFormatString: "#,##0.##",
          datapoints: []
        },
        {
          axisYType: "primary",
          color: "#4201B4",
          type: "line",
          showInLegend: true,
          name: "Target Plan",
          markerType: "none",
          dataPoints: []
        }
        ]
      });
      $.getJSON("process_data_a5.php", function(data) {
        chart.options.data[0].dataPoints = [];
        chart.options.data[1].dataPoints = [];
        chart.options.data[2].dataPoints = [];
        chart.options.data[3].dataPoints = [];
        $.each((data), function(key, value) {
          chart.options.data[0].dataPoints.push({label: ['8:00'], y: parseInt(value[0])});
          chart.options.data[0].dataPoints.push({label: ['9:00'], y: parseInt(value[1])});
          chart.options.data[0].dataPoints.push({label: ['10:00'], y: parseInt(value[2])});
          chart.options.data[0].dataPoints.push({label: ['11:00'], y: parseInt(value[3])});
          chart.options.data[0].dataPoints.push({label: ['12:00'], y: parseInt(value[4])});
          chart.options.data[0].dataPoints.push({label: ['13:00'], y: parseInt(value[5])});
          chart.options.data[0].dataPoints.push({label: ['14:00'], y: parseInt(value[6])});
          chart.options.data[0].dataPoints.push({label: ['15:00'], y: parseInt(value[7])});
          chart.options.data[0].dataPoints.push({label: ['16:00'], y: parseInt(value[8])});
          chart.options.data[0].dataPoints.push({label: ['17:00'], y: parseInt(value[9])});
          chart.options.data[0].dataPoints.push({label: ['18:00'], y: parseInt(value[10])});
          chart.options.data[0].dataPoints.push({label: ['19:00'], y: parseInt(value[11])});
          chart.options.data[0].dataPoints.push({label: ['20:00'], y: parseInt(value[12])});
          chart.options.data[0].dataPoints.push({label: ['21:00'], y: parseInt(value[13])});
          chart.options.data[0].dataPoints.push({label: ['22:00'], y: parseInt(value[14])});
          chart.options.data[0].dataPoints.push({label: ['23:00'], y: parseInt(value[15])});
          chart.options.data[0].dataPoints.push({label: ['0:00'], y: parseInt(value[16])});
          chart.options.data[0].dataPoints.push({label: ['1:00'], y: parseInt(value[17])});
          chart.options.data[0].dataPoints.push({label: ['2:00'], y: parseInt(value[18])});
          chart.options.data[0].dataPoints.push({label: ['3:00'], y: parseInt(value[19])});
          chart.options.data[0].dataPoints.push({label: ['4:00'], y: parseInt(value[20])});
          chart.options.data[0].dataPoints.push({label: ['5:00'], y: parseInt(value[21])});
          chart.options.data[0].dataPoints.push({label: ['6:00'], y: parseInt(value[22])});
          chart.options.data[0].dataPoints.push({label: ['7:00'], y: parseInt(value[23])});

          chart.options.data[1].dataPoints.push({label: ['8:00'], y: parseInt(value[24])});
          chart.options.data[1].dataPoints.push({label: ['9:00'], y: parseInt(value[25])});
          chart.options.data[1].dataPoints.push({label: ['10:00'], y: parseInt(value[26])});
          chart.options.data[1].dataPoints.push({label: ['11:00'], y: parseInt(value[27])});
          chart.options.data[1].dataPoints.push({label: ['12:00'], y: parseInt(value[28])});
          chart.options.data[1].dataPoints.push({label: ['13:00'], y: parseInt(value[29])});
          chart.options.data[1].dataPoints.push({label: ['14:00'], y: parseInt(value[30])});
          chart.options.data[1].dataPoints.push({label: ['15:00'], y: parseInt(value[31])});
          chart.options.data[1].dataPoints.push({label: ['16:00'], y: parseInt(value[32])});
          chart.options.data[1].dataPoints.push({label: ['17:00'], y: parseInt(value[33])});
          chart.options.data[1].dataPoints.push({label: ['18:00'], y: parseInt(value[34])});
          chart.options.data[1].dataPoints.push({label: ['19:00'], y: parseInt(value[35])});
          chart.options.data[1].dataPoints.push({label: ['20:00'], y: parseInt(value[36])});
          chart.options.data[1].dataPoints.push({label: ['21:00'], y: parseInt(value[37])});
          chart.options.data[1].dataPoints.push({label: ['22:00'], y: parseInt(value[38])});
          chart.options.data[1].dataPoints.push({label: ['23:00'], y: parseInt(value[39])});
          chart.options.data[1].dataPoints.push({label: ['0:00'], y: parseInt(value[40])});
          chart.options.data[1].dataPoints.push({label: ['1:00'], y: parseInt(value[41])});
          chart.options.data[1].dataPoints.push({label: ['2:00'], y: parseInt(value[42])});
          chart.options.data[1].dataPoints.push({label: ['3:00'], y: parseInt(value[43])});
          chart.options.data[1].dataPoints.push({label: ['4:00'], y: parseInt(value[44])});
          chart.options.data[1].dataPoints.push({label: ['5:00'], y: parseInt(value[45])});
          chart.options.data[1].dataPoints.push({label: ['6:00'], y: parseInt(value[46])});
          chart.options.data[1].dataPoints.push({label: ['7:00'], y: parseInt(value[47])});

          chart.options.data[2].dataPoints.push({label: ['8:00'], y: parseInt(value[48])});
          chart.options.data[2].dataPoints.push({label: ['9:00'], y: parseInt(value[49])});
          chart.options.data[2].dataPoints.push({label: ['10:00'], y: parseInt(value[50])});
          chart.options.data[2].dataPoints.push({label: ['11:00'], y: parseInt(value[51])});
          chart.options.data[2].dataPoints.push({label: ['12:00'], y: parseInt(value[52])});
          chart.options.data[2].dataPoints.push({label: ['13:00'], y: parseInt(value[53])});
          chart.options.data[2].dataPoints.push({label: ['14:00'], y: parseInt(value[54])});
          chart.options.data[2].dataPoints.push({label: ['15:00'], y: parseInt(value[55])});
          chart.options.data[2].dataPoints.push({label: ['16:00'], y: parseInt(value[56])});
          chart.options.data[2].dataPoints.push({label: ['17:00'], y: parseInt(value[57])});
          chart.options.data[2].dataPoints.push({label: ['18:00'], y: parseInt(value[58])});
          chart.options.data[2].dataPoints.push({label: ['19:00'], y: parseInt(value[59])});
          chart.options.data[2].dataPoints.push({label: ['20:00'], y: parseInt(value[60])});
          chart.options.data[2].dataPoints.push({label: ['21:00'], y: parseInt(value[61])});
          chart.options.data[2].dataPoints.push({label: ['22:00'], y: parseInt(value[62])});
          chart.options.data[2].dataPoints.push({label: ['23:00'], y: parseInt(value[63])});
          chart.options.data[2].dataPoints.push({label: ['0:00'], y: parseInt(value[64])});
          chart.options.data[2].dataPoints.push({label: ['1:00'], y: parseInt(value[65])});
          chart.options.data[2].dataPoints.push({label: ['2:00'], y: parseInt(value[66])});
          chart.options.data[2].dataPoints.push({label: ['3:00'], y: parseInt(value[67])});
          chart.options.data[2].dataPoints.push({label: ['4:00'], y: parseInt(value[68])});
          chart.options.data[2].dataPoints.push({label: ['5:00'], y: parseInt(value[69])});
          chart.options.data[2].dataPoints.push({label: ['6:00'], y: parseInt(value[70])});
          chart.options.data[2].dataPoints.push({label: ['7:00'], y: parseInt(value[71])});

          chart.options.data[3].dataPoints.push({label: ['8:00'], y: parseInt(value[72])});
          chart.options.data[3].dataPoints.push({label: ['9:00'], y: parseInt(value[73])});
          chart.options.data[3].dataPoints.push({label: ['10:00'], y: parseInt(value[74])});
          chart.options.data[3].dataPoints.push({label: ['11:00'], y: parseInt(value[75])});
          chart.options.data[3].dataPoints.push({label: ['12:00'], y: parseInt(value[76])});
          chart.options.data[3].dataPoints.push({label: ['13:00'], y: parseInt(value[77])});
          chart.options.data[3].dataPoints.push({label: ['14:00'], y: parseInt(value[78])});
          chart.options.data[3].dataPoints.push({label: ['15:00'], y: parseInt(value[79])});
          chart.options.data[3].dataPoints.push({label: ['16:00'], y: parseInt(value[80])});
          chart.options.data[3].dataPoints.push({label: ['17:00'], y: parseInt(value[81])});
          chart.options.data[3].dataPoints.push({label: ['18:00'], y: parseInt(value[82])});
          chart.options.data[3].dataPoints.push({label: ['19:00'], y: parseInt(value[83])});
          chart.options.data[3].dataPoints.push({label: ['20:00'], y: parseInt(value[84])});
          chart.options.data[3].dataPoints.push({label: ['21:00'], y: parseInt(value[85])});
          chart.options.data[3].dataPoints.push({label: ['22:00'], y: parseInt(value[86])});
          chart.options.data[3].dataPoints.push({label: ['23:00'], y: parseInt(value[87])});
          chart.options.data[3].dataPoints.push({label: ['0:00'], y: parseInt(value[88])});
          chart.options.data[3].dataPoints.push({label: ['1:00'], y: parseInt(value[89])});
          chart.options.data[3].dataPoints.push({label: ['2:00'], y: parseInt(value[90])});
          chart.options.data[3].dataPoints.push({label: ['3:00'], y: parseInt(value[91])});
          chart.options.data[3].dataPoints.push({label: ['4:00'], y: parseInt(value[92])});
          chart.options.data[3].dataPoints.push({label: ['5:00'], y: parseInt(value[93])});
          chart.options.data[3].dataPoints.push({label: ['6:00'], y: parseInt(value[94])});
          chart.options.data[3].dataPoints.push({label: ['7:00'], y: parseInt(value[95])});
        });
        chart.render();
        updateChart();
      });

      function updateChart() {
        $.getJSON("process_data_a5.php", function(data) {
          chart.options.data[0].dataPoints = [];
          chart.options.data[1].dataPoints = [];
          chart.options.data[2].dataPoints = [];
          chart.options.data[3].dataPoints = [];
          $.each((data), function(key, value) {
            chart.options.data[0].dataPoints.push({label: ['8:00'], y: parseInt(value[0])});
            chart.options.data[0].dataPoints.push({label: ['9:00'], y: parseInt(value[1])});
            chart.options.data[0].dataPoints.push({label: ['10:00'], y: parseInt(value[2])});
            chart.options.data[0].dataPoints.push({label: ['11:00'], y: parseInt(value[3])});
            chart.options.data[0].dataPoints.push({label: ['12:00'], y: parseInt(value[4])});
            chart.options.data[0].dataPoints.push({label: ['13:00'], y: parseInt(value[5])});
            chart.options.data[0].dataPoints.push({label: ['14:00'], y: parseInt(value[6])});
            chart.options.data[0].dataPoints.push({label: ['15:00'], y: parseInt(value[7])});
            chart.options.data[0].dataPoints.push({label: ['16:00'], y: parseInt(value[8])});
            chart.options.data[0].dataPoints.push({label: ['17:00'], y: parseInt(value[9])});
            chart.options.data[0].dataPoints.push({label: ['18:00'], y: parseInt(value[10])});
            chart.options.data[0].dataPoints.push({label: ['19:00'], y: parseInt(value[11])});
            chart.options.data[0].dataPoints.push({label: ['20:00'], y: parseInt(value[12])});
            chart.options.data[0].dataPoints.push({label: ['21:00'], y: parseInt(value[13])});
            chart.options.data[0].dataPoints.push({label: ['22:00'], y: parseInt(value[14])});
            chart.options.data[0].dataPoints.push({label: ['23:00'], y: parseInt(value[15])});
            chart.options.data[0].dataPoints.push({label: ['0:00'], y: parseInt(value[16])});
            chart.options.data[0].dataPoints.push({label: ['1:00'], y: parseInt(value[17])});
            chart.options.data[0].dataPoints.push({label: ['2:00'], y: parseInt(value[18])});
            chart.options.data[0].dataPoints.push({label: ['3:00'], y: parseInt(value[19])});
            chart.options.data[0].dataPoints.push({label: ['4:00'], y: parseInt(value[20])});
            chart.options.data[0].dataPoints.push({label: ['5:00'], y: parseInt(value[21])});
            chart.options.data[0].dataPoints.push({label: ['6:00'], y: parseInt(value[22])});
            chart.options.data[0].dataPoints.push({label: ['7:00'], y: parseInt(value[23])});

            chart.options.data[1].dataPoints.push({label: ['8:00'], y: parseInt(value[24])});
            chart.options.data[1].dataPoints.push({label: ['9:00'], y: parseInt(value[25])});
            chart.options.data[1].dataPoints.push({label: ['10:00'], y: parseInt(value[26])});
            chart.options.data[1].dataPoints.push({label: ['11:00'], y: parseInt(value[27])});
            chart.options.data[1].dataPoints.push({label: ['12:00'], y: parseInt(value[28])});
            chart.options.data[1].dataPoints.push({label: ['13:00'], y: parseInt(value[29])});
            chart.options.data[1].dataPoints.push({label: ['14:00'], y: parseInt(value[30])});
            chart.options.data[1].dataPoints.push({label: ['15:00'], y: parseInt(value[31])});
            chart.options.data[1].dataPoints.push({label: ['16:00'], y: parseInt(value[32])});
            chart.options.data[1].dataPoints.push({label: ['17:00'], y: parseInt(value[33])});
            chart.options.data[1].dataPoints.push({label: ['18:00'], y: parseInt(value[34])});
            chart.options.data[1].dataPoints.push({label: ['19:00'], y: parseInt(value[35])});
            chart.options.data[1].dataPoints.push({label: ['20:00'], y: parseInt(value[36])});
            chart.options.data[1].dataPoints.push({label: ['21:00'], y: parseInt(value[37])});
            chart.options.data[1].dataPoints.push({label: ['22:00'], y: parseInt(value[38])});
            chart.options.data[1].dataPoints.push({label: ['23:00'], y: parseInt(value[39])});
            chart.options.data[1].dataPoints.push({label: ['0:00'], y: parseInt(value[40])});
            chart.options.data[1].dataPoints.push({label: ['1:00'], y: parseInt(value[41])});
            chart.options.data[1].dataPoints.push({label: ['2:00'], y: parseInt(value[42])});
            chart.options.data[1].dataPoints.push({label: ['3:00'], y: parseInt(value[43])});
            chart.options.data[1].dataPoints.push({label: ['4:00'], y: parseInt(value[44])});
            chart.options.data[1].dataPoints.push({label: ['5:00'], y: parseInt(value[45])});
            chart.options.data[1].dataPoints.push({label: ['6:00'], y: parseInt(value[46])});
            chart.options.data[1].dataPoints.push({label: ['7:00'], y: parseInt(value[47])});

            chart.options.data[2].dataPoints.push({label: ['8:00'], y: parseInt(value[48])});
            chart.options.data[2].dataPoints.push({label: ['9:00'], y: parseInt(value[49])});
            chart.options.data[2].dataPoints.push({label: ['10:00'], y: parseInt(value[50])});
            chart.options.data[2].dataPoints.push({label: ['11:00'], y: parseInt(value[51])});
            chart.options.data[2].dataPoints.push({label: ['12:00'], y: parseInt(value[52])});
            chart.options.data[2].dataPoints.push({label: ['13:00'], y: parseInt(value[53])});
            chart.options.data[2].dataPoints.push({label: ['14:00'], y: parseInt(value[54])});
            chart.options.data[2].dataPoints.push({label: ['15:00'], y: parseInt(value[55])});
            chart.options.data[2].dataPoints.push({label: ['16:00'], y: parseInt(value[56])});
            chart.options.data[2].dataPoints.push({label: ['17:00'], y: parseInt(value[57])});
            chart.options.data[2].dataPoints.push({label: ['18:00'], y: parseInt(value[58])});
            chart.options.data[2].dataPoints.push({label: ['19:00'], y: parseInt(value[59])});
            chart.options.data[2].dataPoints.push({label: ['20:00'], y: parseInt(value[60])});
            chart.options.data[2].dataPoints.push({label: ['21:00'], y: parseInt(value[61])});
            chart.options.data[2].dataPoints.push({label: ['22:00'], y: parseInt(value[62])});
            chart.options.data[2].dataPoints.push({label: ['23:00'], y: parseInt(value[63])});
            chart.options.data[2].dataPoints.push({label: ['0:00'], y: parseInt(value[64])});
            chart.options.data[2].dataPoints.push({label: ['1:00'], y: parseInt(value[65])});
            chart.options.data[2].dataPoints.push({label: ['2:00'], y: parseInt(value[66])});
            chart.options.data[2].dataPoints.push({label: ['3:00'], y: parseInt(value[67])});
            chart.options.data[2].dataPoints.push({label: ['4:00'], y: parseInt(value[68])});
            chart.options.data[2].dataPoints.push({label: ['5:00'], y: parseInt(value[69])});
            chart.options.data[2].dataPoints.push({label: ['6:00'], y: parseInt(value[70])});
            chart.options.data[2].dataPoints.push({label: ['7:00'], y: parseInt(value[71])});

            chart.options.data[3].dataPoints.push({label: ['8:00'], y: parseInt(value[72])});
            chart.options.data[3].dataPoints.push({label: ['9:00'], y: parseInt(value[73])});
            chart.options.data[3].dataPoints.push({label: ['10:00'], y: parseInt(value[74])});
            chart.options.data[3].dataPoints.push({label: ['11:00'], y: parseInt(value[75])});
            chart.options.data[3].dataPoints.push({label: ['12:00'], y: parseInt(value[76])});
            chart.options.data[3].dataPoints.push({label: ['13:00'], y: parseInt(value[77])});
            chart.options.data[3].dataPoints.push({label: ['14:00'], y: parseInt(value[78])});
            chart.options.data[3].dataPoints.push({label: ['15:00'], y: parseInt(value[79])});
            chart.options.data[3].dataPoints.push({label: ['16:00'], y: parseInt(value[80])});
            chart.options.data[3].dataPoints.push({label: ['17:00'], y: parseInt(value[81])});
            chart.options.data[3].dataPoints.push({label: ['18:00'], y: parseInt(value[82])});
            chart.options.data[3].dataPoints.push({label: ['19:00'], y: parseInt(value[83])});
            chart.options.data[3].dataPoints.push({label: ['20:00'], y: parseInt(value[84])});
            chart.options.data[3].dataPoints.push({label: ['21:00'], y: parseInt(value[85])});
            chart.options.data[3].dataPoints.push({label: ['22:00'], y: parseInt(value[86])});
            chart.options.data[3].dataPoints.push({label: ['23:00'], y: parseInt(value[87])});
            chart.options.data[3].dataPoints.push({label: ['0:00'], y: parseInt(value[88])});
            chart.options.data[3].dataPoints.push({label: ['1:00'], y: parseInt(value[89])});
            chart.options.data[3].dataPoints.push({label: ['2:00'], y: parseInt(value[90])});
            chart.options.data[3].dataPoints.push({label: ['3:00'], y: parseInt(value[91])});
            chart.options.data[3].dataPoints.push({label: ['4:00'], y: parseInt(value[92])});
            chart.options.data[3].dataPoints.push({label: ['5:00'], y: parseInt(value[93])});
            chart.options.data[3].dataPoints.push({label: ['6:00'], y: parseInt(value[94])});
            chart.options.data[3].dataPoints.push({label: ['7:00'], y: parseInt(value[95])});
          });
          chart.render();
        });
      }
      setInterval(function(){updateChart()}, 1000);
    }
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
            //console.log(data);
            $("#output").html(data.output);  
            $("#output").addClass("realtime");

            $("#zreo").html(data.zero);  
            $("#zero").addClass("realtime");

            $("#timetotal").html(data.timetotal);  
            $("#timetotal").addClass("realtime");

            $("#time").html(data.s0);  
            $("#time").addClass("realtime");

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

            $("#product").html(data.product);  
            $("#product").addClass("realtime"); 

            $("#pcsday").html(data.pcsday);  
            $("#pcsday").addClass("realtime");

            $("#pcshour").html(data.pcshour);  
            $("#pcshour").addClass("realtime");

            $("#barlance").html(data.barlance);  
            $("#barlance").addClass("realtime"); 

            $("#barlanceHr").html(data.barlanceHr);  
            $("#barlanceHr").addClass("realtime"); 

            $("#targetHr").html(data.targetHr);  
            $("#targetHr").addClass("realtime"); 

            $("#t").html(data.t);  
            $("#t").addClass("realtime"); 

            $("#targetresult").html(data.targetresult);  
            $("#targetresult").addClass("realtime"); 

            /*$("#t8").html(data.t8);  
            $("#t8").addClass("realtime"); 

            $("#t9").html(data.t9);  
            $("#t9").addClass("realtime"); 

            $("#t10").html(data.t10);  
            $("#t10").addClass("realtime"); 

            $("#t11").html(data.t11);  
            $("#t11").addClass("realtime"); 

            $("#t12").html(data.t12);  
            $("#t12").addClass("realtime"); 

            $("#t13").html(data.t13);  
            $("#t13").addClass("realtime");

            $("#t14").html(data.t14);  
            $("#t14").addClass("realtime");

            $("#t15").html(data.t15);  
            $("#t15").addClass("realtime");

            $("#t16").html(data.t16);  
            $("#t16").addClass("realtime");

            $("#t17").html(data.t17);  
            $("#t17").addClass("realtime"); 

            $("#t18").html(data.t18);  
            $("#t18").addClass("realtime");

            $("#t19").html(data.t19);  
            $("#t19").addClass("realtime"); 

            $("#t20").html(data.t20);  
            $("#t20").addClass("realtime"); 

            $("#t21").html(data.t21);  
            $("#t21").addClass("realtime"); 

            $("#t22").html(data.t22);  
            $("#t22").addClass("realtime"); 

            $("#t23").html(data.t23);  
            $("#t23").addClass("realtime"); 

            $("#t0").html(data.t0);  
            $("#t0").addClass("realtime"); 

            $("#t1").html(data.t1);  
            $("#t1").addClass("realtime"); 

            $("#t2").html(data.t2);  
            $("#t2").addClass("realtime"); 

            $("#t3").html(data.t3);  
            $("#t3").addClass("realtime"); 

            $("#t4").html(data.t4);  
            $("#t4").addClass("realtime"); 

            $("#t5").html(data.t5);  
            $("#t5").addClass("realtime"); 

            $("#t6").html(data.t6);  
            $("#t6").addClass("realtime"); 

            $("#t7").html(data.t7);  
            $("#t7").addClass("realtime"); 

            $("#thr8").html(data.thr8);  
            $("#thr8").addClass("realtime");

            $("#thr9").html(data.thr9);  
            $("#thr9").addClass("realtime");

            $("#thr10").html(data.thr10);  
            $("#thr10").addClass("realtime");

            $("#thr11").html(data.thr11);  
            $("#thr11").addClass("realtime");

            $("#thr12").html(data.thr12);  
            $("#thr12").addClass("realtime");

            $("#thr13").html(data.thr13);  
            $("#thr13").addClass("realtime");

            $("#thr14").html(data.thr14);  
            $("#thr14").addClass("realtime");

            $("#thr15").html(data.thr15);  
            $("#thr15").addClass("realtime");

            $("#thr16").html(data.thr16);  
            $("#thr16").addClass("realtime");

            $("#thr17").html(data.thr17);  
            $("#thr17").addClass("realtime");

            $("#thr18").html(data.thr18);  
            $("#thr18").addClass("realtime");

            $("#thr19").html(data.thr19);  
            $("#thr19").addClass("realtime");

            $("#thr20").html(data.thr20);  
            $("#thr20").addClass("realtime");

            $("#thr21").html(data.thr21);  
            $("#thr21").addClass("realtime");

            $("#thr22").html(data.thr22);  
            $("#thr22").addClass("realtime");

            $("#thr23").html(data.thr23);  
            $("#thr23").addClass("realtime");

            $("#thr0").html(data.thr0);  
            $("#thr0").addClass("realtime");

            $("#thr1").html(data.thr1);  
            $("#thr1").addClass("realtime");

            $("#thr2").html(data.thr2);  
            $("#thr2").addClass("realtime");

            $("#thr3").html(data.thr3);  
            $("#thr3").addClass("realtime");

            $("#thr4").html(data.thr4);  
            $("#thr4").addClass("realtime");

            $("#thr5").html(data.thr5);  
            $("#thr5").addClass("realtime");

            $("#thr6").html(data.thr6);  
            $("#thr6").addClass("realtime");

            $("#thr7").html(data.thr7);  
            $("#thr7").addClass("realtime");*/


            var barlanceDay = parseInt(document.getElementById("barlance").innerHTML,10);
              if(barlanceDay < 0) {
                $("div.boxbarlance-day").css("background-color", "#FF0000");//red
              } else {
                $("div.boxbarlance-day").css("background-color", "#00CC00");//green
              }
            var barlanceHr = parseInt(document.getElementById("targetHr").innerHTML,10);
              if(barlanceHr < 0) {
                $("div.boxbarlance-hr").css("background-color", "#FF0000");//red
              } else {
                $("div.boxbarlance-hr").css("background-color", "#00CC00");//green
              }

          });
          realTime(); 
        }, 1000);  
      }
      realTime();
    });
  </script>
</body>
<?php include_once('layouts/footer.php'); ?>
