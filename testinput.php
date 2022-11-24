<?php
   date_default_timezone_set('Asia/Bangkok');
   $page_title = 'Admin Home Page';
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
      $query = "SELECT count(*) AS total FROM a3 WHERE Date_Time BETWEEN '2022-07-26 08:00:00' AND '2022-07-27 08:00:00'";
      $result = $db->query($query);
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
         $output = $output + $row['total'];
      }

      $productresult = "";
      $queryproduct = "SELECT Product_Name FROM a3 WHERE Date_Time BETWEEN '2022-07-26 08:00:00' AND '2022-07-27 08:00:00'";
      $product = $db->query($queryproduct);
      while ($row = $product->fetch_array(MYSQLI_ASSOC)) {
         $productresult = $row['Product_Name'];
      }
     
      $timetotal = 0;
      $querytime = "SELECT Date_time AS t,Takt_time as tak FROM a3 WHERE Date_Time BETWEEN '$Start' AND '$End'";
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

      $jsonObj = '{'
      . '"output":"' . $output . ' "' . ', '
      . '"timetotal":"' . round($timetotal) . ' "' . ', '
      . '"second":"' . date('Y-m-d H:i:s') . ' "' . ', '
      . '"avg":"' . round($avg) . ' "'. ', '
      . '"processingtime":"' . round($processingtime) . ' "'. ', '
      . '"totalrun":"' . round($totalrun) . ' "'. ', '
      . '"totalstop":"' . round($totalstop) . ' "'. ', '
      . '"pruntime":"' . round($pruntime) . ' "'. ', '
      . '"product":"' . $productresult . ' "'. ', '
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
  <link rel="stylesheet" href="css/bootstrap.datetimepicker.css">
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
</head>

<body>
  <style>
    .button {
      color: #FFFFFF;
      padding: 8px;
      border: none;
      font-size: 15px;
      border-radius: 4px;
      width: 70px;
      height: 35px;
    }
    .button1 {
      background-color: #122E94;
      border-color: #122E94;
      margin-left: 10px;
      font-size:16px;
    }
    .button2 {
      background-color: #F75206;
      border-color: #F75206;
      margin-left: 12px;
      font-size:16px;
    }
    #target {
      width: 145px;
      height: 34px;
      margin-left: 5px;
    }
    .boxtar {
      color: #FFFFFF;
      background-color: #272727;
      width: 210px;
      height: 95px;
    }
    .boxout {
      color: #FFFFFF;
      background-color: #000595;
      width: 210px;
      height: 95px;
    }
    .boxproduct {
      background-color: #FFFFFF;
      color: #000000;
      width: 390px;
      height: 95px;
      border-style: dotted; /* solid dotted */
      border-color: #AB0C0C;
      margin-left: 90px;
    }
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
   
  <!--<script>
    $(document).ready(function() {
      $('#submit').click(function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'serverproduction.php',
          data: {target: $('#target').val()},
          datatype: 'JSON',
          success: function(data){
            $("#content").html(data);
          }
        });
      });
    });
  </script>-->

  <div class="row">
    <div class="col-md-4">
      <form class="form-inline" name="input" id="input" action="" method="post">
        <label id="tg" for="target" style="font-size: 18px;">Target Plan (Pcs/day): </label>
        <input type="text" id="target" name="target" value="" placeholder="Enter Target" />
        <input type="submit" id="submit" name="submit" value="Submit" class="button button1" />
        <!--<input type="reset" id="reset" name="reset" value="Reset" class="button button2" onclick="clearform()"/>-->
      </form>
    </div>

    <div class="col-md-4">
      <div class="boxproduct">
        <div class="inner">
          <p style="font-size: 20px; margin-left: 10px;">Product : 
            <span class="iconify" data-icon="eos-icons:rotating-gear" style="margin-left: 245px; margin-top: 4px;" data-width="35"></span>
          </p>
          <h3 id="product" style="font-size: 40px; text-align: center; margin-top: -5px; font-weight: bold;"></h3>
        </div>
      </div>
    </div>

    <div class="col-md-2">
      <div class="boxout">
        <div class="inner">
          <p style="font-size: 20px; margin-left: 10px;">Actual Output : 
            <span class="iconify" data-icon="ic:baseline-manage-history" style="color: #FFFFFF; margin-left: 25px; margin-top: 3px;" data-width="32"></span>
          </p>
          <h3 id="output" style="font-size: 48px; text-align: center; margin-top: -5px; font-weight: bold;"></h3>
        </div>
      </div>
    </div>

    <div class="col-md-2">
      <div class="boxtar">
        <div class="inner">
          <p style="font-size: 20px; margin-left: 10px;">Target Plan: 
            <span class="iconify" data-icon="bi:pin-angle-fill" style="color: #FFFFFF; margin-left: 47px; margin-top: 5px;" data-width="28"></span>
          </p>
          <h3 style="font-size: 48px; text-align: center; margin-top: -5px; font-weight: bold;"><?php if(isset($_POST['submit'])){echo $_POST['target'];}else{ echo 0;}?></h3>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel-group" style="margin-top: 50px;">
        <div class="panel panel-custom-horrible-purple">
          <div class="panel-heading">
            <h3 class="panel-title">Daily TargetPlan & Output Overall of Joy Watcher</h3>
            <ul class="list-inline panel-actions"></ul>
          </div>
          <div class="panel-body">
            <div id="chartProduction" style="height: 400px; width: 100%; display: inline-block; margin-top: 20px; margin-left: -10px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--<script>
    function clearform() {
      //$('form[name="input"]').submit();
      //$('input[type="text"], textarea').val('');
      document.getElementById("target").value="";
    }
  </script>-->

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
          title: "Output (Pcs/day)",
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
        /*legend:{
          cursor: "pointer",
          verticalAlign: "bottom",
          horizontalAlign: "left",
          dockInsidePlotArea: true
        },*/
        data:[{
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
          type: "line",
          axisYType: "secondary",
          showInLegend: true,
          name: "Acc Output",
          lineDashType: "dash",
          //yValueFormatString: "#,##0.##",
          datapoints: [] 
        }/*,
        {
          type: "line",
          showInLegend: true,
          name: "Target Plan",
          markerType: "square",
          color: "#F08080",
          yValueFormatString: "#,##0.##",
          datapoints: []
        }*/
        ]
      });
      //$("chartProduction").CanvasJSChart(chart);
      $.getJSON("process_data.php", function(data) {
        chart.options.data[0].dataPoints = [];
        chart.options.data[1].dataPoints = [];
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

        });
        chart.render();
        updateChart();
      });

      function updateChart() {
        $.getJSON("process_data.php", function(data) {
          chart.options.data[0].dataPoints = [];
          chart.options.data[1].dataPoints = [];
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
            //alert(data.first);
            //console.log(data);
            $("#output").html(data.output);  
            $("#output").addClass("realtime"); 
            $("#timetotal").html(data.timetotal);  
            $("#timetotal").addClass("realtime"); 
            $("#time").html(data.second);  
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
            //$("#responsecontainer").load('data.php');  
            //$("#responsecontainer").addClass("realtime"); 
          });
          realTime(); 
        }, 1000);  
      }
      realTime();
    });
  </script>
</body>
<?php include_once('layouts/footer.php'); ?>