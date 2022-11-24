<?php
  date_default_timezone_set('Asia/Bangkok');
  $page_title = 'Admin Home Page';
  require_once('includes/load.php');
  page_require_level(1); 
  /*$page = $_SERVER['PHP_SELF'];
  $now = time();
  $today = strtotime('8:00');
  $tomorrow = strtotime('tomorrow 8:00');
  if (($today - $now) > 0) {
      $refreshTime = $today - $now;
    } else {
      $refreshTime = $tomorrow - $now;
    }
  header("Refresh: $refreshTime; url=$page"); */ 
?>
<?php
   $the_now = strtotime(date('H:i:s'));
   $the_time = strtotime(date('H:i:s',strtotime('08:00:00')));

if (isset($_POST['rev']) && $_POST['rev'] == 1) {
   if ($the_time < $the_now) {
      $Start = date('Y-m-d H:i:s',date(strtotime("-1 day", mktime(8,0,0))));
      $End = date('Y-m-d H:i:s',date(strtotime("+0 day", mktime(8,0,0))));
   } else {
      $Start = date('Y-m-d H:i:s',date(strtotime("-1 day", mktime(8,0,0))));
      $End = date('Y-m-d H:i:s',date(strtotime("+0 day", mktime(8,0,0)))); 
   }
   global $db;
   $output = 0;
   $query = "SELECT count(*) AS total FROM a3 WHERE Date_Time BETWEEN '$Start' AND '$End'";
   $result = $db->query($query);
   while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $output = $output + $row['total'];
   }
  
   $timetotal = 0;
   $querytime = "SELECT Date_Time AS t FROM a3 WHERE Date_Time BETWEEN '$Start' AND '$End'";
   $resulttime = $db->query($querytime);
   while ($row = $resulttime->fetch_array(MYSQLI_ASSOC)) {
      $outputtime = $row['t'];
      $timetotal =  (strtotime($outputtime) - strtotime($Start))/60;
   }

   $avgtime = 0;
   $av = 0;
   $Timeavg = date('H:i:s',strtotime('08:00:00'));
   $queryavg = "SELECT end_time as endtime,start_time as starttime FROM a3 WHERE Date_Time BETWEEN '$Start' AND '$End'";
   $resultavg = $db->query($queryavg);
   $count = mysqli_num_rows($resultavg);
   $FirstRun = true;
   while ($row = $resultavg->fetch_array(MYSQLI_ASSOC)) {
      if ($FirstRun){
         $FirstRun = false;
         $endtimeFirst = $row['endtime'];
         $starttimeFirst = $row['starttime'];
         $timeFirst = (strtotime($endtimeFirst) - strtotime($Start));
         if($timeFirst < 300) {
            $av = ($av+$timeFirst);
         }
      }else {
         $outputendtime = $row['endtime'];
         $outputstarttime = $row['starttime'];
         $timet =  (strtotime($outputendtime) - strtotime($outputstarttime));
         if($timet < 300) {
            $avgtime = ($avgtime + $timet);
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
   $queryrunstop = "SELECT end_time as endtime,start_time as starttime FROM a3 WHERE Date_Time BETWEEN '$Start' AND '$End'";
   $resultrunstop = $db->query($queryrunstop);
   $First=true;
   $MinFirst = 0;
   $MaxFirst = 0;
   $Mintt = 0;
   $Maxtt = 0;
   while ($row = $resultrunstop->fetch_array(MYSQLI_ASSOC)) {
      if ($First){
          $First = false;
          $runstopFirst = $row['endtime'];
          $runstartFirst = $row['starttime'];
          $timerunstop = (strtotime($runstopFirst) - strtotime($Start));
          if ($timerunstop < 300){
              $MinFirst = ($MinFirst + $timerunstop);
          }else {
              $MaxFirst = ($MaxFirst + $timerunstop);
          }
      }else {
          $runstopFirst = $row['endtime'];
          $runstopstarttime = $row['starttime'];
          $timett =  (strtotime($runstopFirst) - strtotime($runstopstarttime));
          if ($timett < 300){
              $Mintt = ($Mintt + $timett);
          }else {
              $Maxtt = ($Maxtt + $timett);
          }
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

   // ขั้นตอน 3, 4 จากแผนผัง - ถ้ามีการคิวรีจากฐานข้อมูลวางไว้ตรงนี้ ก่อนทำ JSON
   // สร้าง string ให้อยู่ในรูปแบบของ JSON $totalrun

   $jsonObj = '{'
  . '"output":"' . $output . ' "' . ', '
  . '"timetotal":"' . round($timetotal) . ' "' . ', '
  . '"second":"' . date('Y-m-d H:i:s') . ' "' . ', '
  . '"avg":"' . round($avg) . ' "'. ', '
  . '"processingtime":"' . round($processingtime) . ' "'. ', '
  . '"totalrun":"' . round($totalrun) . ' "'. ', '
  . '"totalstop":"' . round($totalstop) . ' "'. ', '
  . '"pruntime":"' . round($pruntime) . ' "'. ', '
  . '"pstoptime":"' . round($pstoptime) . ' "'

  . '}' ;  
   echo $jsonObj;  // ถ้า $jsonObj เป็นอาร์เรย์ สามารถใช้ฟังก์ชัน json_encode() เพื่อส่งกลับข้อมูลแบบ JSON

   exit();
}
?>                 
<?php include_once('layouts/header.php');?>
  
<!--<script>
var refreshId = setInterval(function()
{
    $('#responsecontainer').load('data.php');
}, 1000);
</script>-->

<script src="jquery-latest.js"></script> 
<script type="text/javascript" src="assets/js/jquery-3.4.0.min.js"></script>
<script type="text/javascript" src="assets/js/mdb.min.js"></script> 
<link rel="stylesheet" href="css/AdminLTE.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.datetimepicker.css">
<link rel="stylesheet" href="css/bootstrap.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<link href="library/daterangepicker.css" rel="stylesheet"/>
<script src="library/daterangepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>

<style>
   .panel-actions {
      margin-top: 0;
      margin-bottom: 0;
   }
   .panel-title {
      display: inline-block;
      width: 100%;
      font-size: 18px;
   }
   .panel-custom-horrible-purple {
      border-color: #03308b; 
   }
   .panel-custom-horrible-purple > .panel-heading {
      color: #FFFFFF;
      background: #03308b; 
      border-color: #03308b; 
      text-align: center;
   }
</style>

<section class="content">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>

<div class="row">
   <div class="col-sm-6 col-lg-3">
      <div class="small-box" style="background-color: #0D47A1; color: white;"> <!-- #0D47A1 -->
         <div class="inner" >
            <h3 id="output"></h3> 
            <p>Output (Board)</p>
         </div>
         <div class="icon">
            <span class="iconify" data-icon="ion:stats-chart" style="color: white;" data-width="35"></span>
         </div>          
      </div>
   </div>  

   <div class="col-sm-6 col-lg-3">
      <div class="small-box" style="background-color: #D81B60; color: white;"> <!-- #D81B60 -->
         <div class="inner">
            <h3 id="timetotal"></h3>
            <p>Total Time (Min)</p>
         </div>
         <div class="icon">
            <span class="iconify" data-icon="ion:time" style="color: white;" data-width="35"></span>
         </div>
      </div>
   </div> 

   <div class="col-sm-6 col-lg-3">
      <div class="small-box" style="background-color: #6A1B9A; color: white;"> <!-- #6A1B9A -->
         <div class="inner">
            <h3 id="avg"></h3>
            <p>AVG Cycle Time (Sec/Sheet)</p>
         </div>
         <div class="icon">
            <span class="iconify" data-icon="ion:timer-outline" style="color: white;" data-width="35"></span>
         </div>
      </div>
   </div>

   <div class="col-sm-6 col-lg-3">
      <div class="small-box" style="background-color: #424242; color: white;"> <!-- #424242 -->
         <div class="inner">
            <h3 id="processingtime"></h3>
            <p>Processing Time (Min)</p>
         </div>
         <div class="icon">
            <span class="iconify" data-icon="ion:cog" style="color: white;" data-width="35"></span>
         </div>
      </div>
   </div>

</div>

<div class="row">
   <div class="col-sm-6 col-lg-3">
      <div class="small-box" style="background-color: #331a00; color: white;"> <!-- #331a00 -->
         <div class="inner">
            <h3 id="totalrun"></h3>
            <p>Total Runtime (Min)</p>
         </div>
         <div class="icon">
            <span class="iconify" data-icon="ion:trending-up" style="color: white;" data-width="35"></span>
         </div>
      </div>
   </div>

   <div class="col-sm-6 col-lg-3">
      <div class="small-box" style="background-color: #E65100; color: white;"> <!-- #E65100 -->
         <div class="inner">
            <h3 id="totalstop"></h3>
            <p>Total Stoptime (Min)</p>
         </div>
         <div class="icon">
            <span class="iconify" data-icon="ion:trending-down" style="color: white;" data-width="35"></span>
         </div>
      </div>
   </div>

   <div class="col-sm-6 col-lg-3">
      <div class="small-box" style="background-color: #00802b; color: white;"> <!-- #00802b -->
         <div class="inner">
            <h3 id="pruntime"></h3>
            <p>% RUNTIME</p>
         </div>
         <div class="icon">
            <span class="iconify" data-icon="ion:build" style="color: white;" data-width="35"></span>
         </div>
      </div>
   </div>

   <div class="col-sm-6 col-lg-3">
      <div class="small-box" style="background-color: #F44336; color: white;"> <!-- #F44336 -->
         <div class="inner">
            <h3 id="pstoptime"></h3>
            <p>% STOPTIME</p>
         </div>
         <div class="icon">
            <span class="iconify" data-icon="ion:build" style="color: white;" data-width="35"></span>
         </div>
      </div>
   </div>
</div>
</section>

<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="dist/jquery.canvasjs.min.js"></script>

   <div class="container-fluid">

      <div class="row">

            <div class="col-md-8">
               <div class="panel-group">
                  <div class="panel panel-custom-horrible-purple">
                     <div class="panel-heading">
                        <h3 class="panel-title">Real Time Chart Joy Watcher</h3>
                        <ul class="list-inline panel-actions"></ul>
                     </div>
                     <div class="panel-body">
                        <div id="chartRealTime" style="height: 340px; width: 100%; display: inline-block; margin-top: 20px; margin-left: -10px;"></div>
                     </div>
                  </div>
               </div>
            </div>         
                                       
            <div class="col-md-4">
               <div class="panel-group">
                  <div class="panel panel-custom-horrible-purple">
                     <div class="panel-heading">
                        <h3 class="panel-title">Machine Runtime</h3>
                        <ul class="list-inline panel-actions"></ul>
                     </div>
                     <div class="panel-body">
                        <div id="chartMachineRuntime" style="height: 340px; width: 100%; display: inline-block; margin-top: 20px;"></div>
                     </div>
                  </div>
               </div>
            </div>


      </div>

      <div class="row">

         <div class="col-md-12">
            <div class="panel panel-custom-horrible-purple">
               <div class="panel-heading">
                  <h3 class="panel-title"><center>Real Time Database</h3>
               </div>
               <div class="panel-body">
                  <table class="table table-bordered table-striped"id="myTable">
                     <thead>                        
                        <tr >
                           <th class='text-center'>Date Time</th>
                           <th class='text-center'>Product Name</th>
                           <th class='text-center'>Count</th>
                           <th class='text-center'>Start time</th>
                           <th class='text-center'>End time</th>
                        </tr>
                     </thead>
                     <tbody id="myBody"></tbody>
                  </table>   
               </div>
            </div>
         </div>

      </div>

   </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
window.onload = function () {
   CanvasJS.addColorSet("GreenShades",
      [//colorSet Array
      "#2F4F4F",
      "#008080",
      "#2E8B57",
      "#3CB371",
      "#90EE90"   
      ]);
   CanvasJS.addColorSet("PurpleShades",
      [//colorSet Array
      "#2C1D6C",
      "#533180",
      "#7D4A95",
      "#A468A9",
      "#BE8AB6"   
      ]);
   CanvasJS.addColorSet("Custom1Shades",
      [//colorSet Array
      "#071E22",
      "#1D7874",
      "#679289",
      "#F3C677",
      "#EE2E31"   
      ]);
   CanvasJS.addColorSet("Custom2Shades",
      [//colorSet Array
      "#0C0A3E",
      "#7B1E7A",
      "#B33F62",
      "#F9564F",
      "#F3C677"   
      ]);
   CanvasJS.addColorSet("Custom3Shades",
      [//colorSet Array
      "#000137",
      "#02055A",
      "#02198B",
      "#253DA1",
      "#6EC1FF"   
      ]);
   var chart = new CanvasJS.Chart("chartRealTime",
   {
      //Enable animation
      animationEnabled: true,
      //To save the chart as image
      exportEnabled: true,
      //colorSet: "PurpleShades",
      title:{
         //text:"Real Time Chart Joy Watcher",
         fontFamily: "Arial", // "Courier New" "impact" "sans-serif" "Franklin Gothic Heavy"
         fontColor: "#202020", // "#3A3B3C" "#0C090A" 
         fontWeight: "bold", // "normal" "bold"
         fontSize: 28,
         margin: 30,
         padding: 13,
         //borderThickness: 2,
         //cornerRadius: 4,
         //backgroundColor: "#F5DEB3" // "#F5DEB3" "#FFE5B4" "#f4d5a6"
      },

      /*toolbar: {
         buttonBorderColor: "#000000"
      },*/
      axisY:{
         title: "Output (Board)",
         labelFontFamily: "sans-serif",
         labelFontWeight: "bold",
         margin: 12
      },
      axisX:{
         interval: 1,
         labelAngle: -60,
         labelFontFamily: "sans-serif",
         labelFontWeight: "bold"
      },
      data: [{
         type: "column",
         //color: "Teal",
         indexLabel: "{y}",
         indexLabelPlacement: "outside", // "inside" "outside"
         indexLabelOrientation: "horizontal", // "horizontal"
         indexLabelFontSize: 16,
         //indexLabelFontWeight: "bold",
         dataPoints : []
      }]
      /*,{
         type: "line",
         dataPoints: []
      }
      ]*/
   });
      
   $.getJSON("service.php", function(data) {  
      chart.options.data[0].dataPoints = [];
      //chart.options.data[1].dataPoints = [];
      $.each((data), function(key, value){
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

         /*chart.options.data[1].dataPoints.push({label: ['8:00'], y: parseInt(value[0])});
         chart.options.data[1].dataPoints.push({label: ['9:00'], y: parseInt(value[1])});
         chart.options.data[1].dataPoints.push({label: ['10:00'], y: parseInt(value[2])});
         chart.options.data[1].dataPoints.push({label: ['11:00'], y: parseInt(value[3])});
         chart.options.data[1].dataPoints.push({label: ['12:00'], y: parseInt(value[4])});
         chart.options.data[1].dataPoints.push({label: ['13:00'], y: parseInt(value[5])});
         chart.options.data[1].dataPoints.push({label: ['14:00'], y: parseInt(value[6])});
         chart.options.data[1].dataPoints.push({label: ['15:00'], y: parseInt(value[7])});
         chart.options.data[1].dataPoints.push({label: ['16:00'], y: parseInt(value[8])});
         chart.options.data[1].dataPoints.push({label: ['17:00'], y: parseInt(value[9])});
         chart.options.data[1].dataPoints.push({label: ['18:00'], y: parseInt(value[10])});
         chart.options.data[1].dataPoints.push({label: ['19:00'], y: parseInt(value[11])});
         chart.options.data[1].dataPoints.push({label: ['20:00'], y: parseInt(value[12])});
         chart.options.data[1].dataPoints.push({label: ['21:00'], y: parseInt(value[13])});
         chart.options.data[1].dataPoints.push({label: ['22:00'], y: parseInt(value[14])});
         chart.options.data[1].dataPoints.push({label: ['23:00'], y: parseInt(value[15])});
         chart.options.data[1].dataPoints.push({label: ['0:00'], y: parseInt(value[16])});
         chart.options.data[1].dataPoints.push({label: ['1:00'], y: parseInt(value[17])});
         chart.options.data[1].dataPoints.push({label: ['2:00'], y: parseInt(value[18])});
         chart.options.data[1].dataPoints.push({label: ['3:00'], y: parseInt(value[19])});
         chart.options.data[1].dataPoints.push({label: ['4:00'], y: parseInt(value[20])});
         chart.options.data[1].dataPoints.push({label: ['5:00'], y: parseInt(value[21])});
         chart.options.data[1].dataPoints.push({label: ['6:00'], y: parseInt(value[22])});
         chart.options.data[1].dataPoints.push({label: ['7:00'], y: parseInt(value[23])});*/     
      });
      chart.render();
      updateChart();
   });

   function updateChart() {
      $.getJSON("service.php", function(data) {      
         chart.options.data[0].dataPoints = [];
         //chart.options.data[1].dataPoints = [];
         $.each((data), function(key, value){
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

            /*chart.options.data[1].dataPoints.push({label: ['8:00'], y: parseInt(value[0])});
            chart.options.data[1].dataPoints.push({label: ['9:00'], y: parseInt(value[1])});
            chart.options.data[1].dataPoints.push({label: ['10:00'], y: parseInt(value[2])});
            chart.options.data[1].dataPoints.push({label: ['11:00'], y: parseInt(value[3])});
            chart.options.data[1].dataPoints.push({label: ['12:00'], y: parseInt(value[4])});
            chart.options.data[1].dataPoints.push({label: ['13:00'], y: parseInt(value[5])});
            chart.options.data[1].dataPoints.push({label: ['14:00'], y: parseInt(value[6])});
            chart.options.data[1].dataPoints.push({label: ['15:00'], y: parseInt(value[7])});
            chart.options.data[1].dataPoints.push({label: ['16:00'], y: parseInt(value[8])});
            chart.options.data[1].dataPoints.push({label: ['17:00'], y: parseInt(value[9])});
            chart.options.data[1].dataPoints.push({label: ['18:00'], y: parseInt(value[10])});
            chart.options.data[1].dataPoints.push({label: ['19:00'], y: parseInt(value[11])});
            chart.options.data[1].dataPoints.push({label: ['20:00'], y: parseInt(value[12])});
            chart.options.data[1].dataPoints.push({label: ['21:00'], y: parseInt(value[13])});
            chart.options.data[1].dataPoints.push({label: ['22:00'], y: parseInt(value[14])});
            chart.options.data[1].dataPoints.push({label: ['23:00'], y: parseInt(value[15])});
            chart.options.data[1].dataPoints.push({label: ['0:00'], y: parseInt(value[16])});
            chart.options.data[1].dataPoints.push({label: ['1:00'], y: parseInt(value[17])});
            chart.options.data[1].dataPoints.push({label: ['2:00'], y: parseInt(value[18])});
            chart.options.data[1].dataPoints.push({label: ['3:00'], y: parseInt(value[19])});
            chart.options.data[1].dataPoints.push({label: ['4:00'], y: parseInt(value[20])});
            chart.options.data[1].dataPoints.push({label: ['5:00'], y: parseInt(value[21])});
            chart.options.data[1].dataPoints.push({label: ['6:00'], y: parseInt(value[22])});
            chart.options.data[1].dataPoints.push({label: ['7:00'], y: parseInt(value[23])});*/     
         });
         
         chart.render();
      });
   }
   
setInterval(function(){updateChart()}, 1000);

var chart1 = new CanvasJS.Chart("chartMachineRuntime", 
       {
         title:{
            padding: 10,
            fontFamily: "Arial", 
            fontColor: "#202020",
            fontSize: 22,
            margin: 30
         },
         exportEnabled: true,
         axisX:{
            text: "MOT A3",
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
            verticalAlign: "top", 
            horizontalAlign: "center" 
         },
         toolTip: {
            shared: true
         },
    data: [{
           type: "stackedColumn100",
            name: "%RUNTIME",
            showInLegend: "true",
            indexLabel: "{y}",
            indexLabelPlacement: "inside",
            indexLabelOrientation: "horizontal", 
            indexLabelFontFamily: "sans-serif", 
            indexLabelFontColor: "white",
            indexLabelFontSize: 22,
            indexLabelFontWeight: "bold",
            color: "green",
            yValueFormatString: "#,##0\"%\"",
           dataPoints: []
        },
         {
            type: "stackedColumn100",
            name: "%STOPTIME",
            showInLegend: "true",
            indexLabel: "{y}",
            indexLabelPlacement: "inside",
            indexLabelOrientation: "horizontal", 
            indexLabelFontFamily: "sans-serif", 
            indexLabelFontColor: "white",
            indexLabelFontSize: 22,
            indexLabelFontWeight: "bold",
            color: "red",
            yValueFormatString: "#,##0\"%\"",
            dataPoints: []
               //{ y: 'pstoptime' , label: "MOT A3", indexLabel: "pstoptime" }          
         }]        
      });

      $.getJSON("servicerunstop.php", function(result) {  
      chart1.options.data[0].result.dataPoints = [];
      chart1.options.data[1].result.dataPoints = [];
      $.each((result), function(key, value){
         chart1.options.data[0].dataPoints.push({label: ['MOT A3'],  y: parseInt(value[0])});
         chart1.options.data[1].dataPoints.push({label: ['MOT A3'],  y: parseInt(value[1])});
    
      });
      chart1.render();
      updateChart1();
   });

   function updateChart1() {
      $.getJSON("servicerunstop.php", function(result) {     
         chart1.options.data[0].dataPoints = [];
         chart1.options.data[1].dataPoints = [];
         $.each((result), function(key, value){

         chart1.options.data[0].dataPoints.push({label: ['MOT A3'],  y: parseInt(value[0])});
         chart1.options.data[1].dataPoints.push({label: ['MOT A3'],  y: parseInt(value[1])});
 
      });
         
         chart1.render();
      });
   }
    setInterval(function(){updateChart1()}, 1000);
}
</script>    
      <center><div id="chartMachineRuntime"></div></center>
   </div>
</div>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script> 
function getDataFromDb()
{
  $.ajax({ 
        url: "getData.php" ,
        type: "POST",
        data: ''
      })
      .success(function(result) { 
        var obj = jQuery.parseJSON(result);
          if(obj != '')
          {
               //$("#myTable tbody tr:not(:first-child)").remove();
               $("#myBody").empty();
               $.each(obj, function(key, val) {
                  var tr = "<tr>";
                  tr = tr + "<td class='text-center'>" + val["Date_Time"] + "</td>";
                  tr = tr + "<td class='text-center'>" + val["Product_Name"] + "</td>";
                  tr = tr + "<td class='text-center'>" + val["Count"] + "</td>";
                  tr = tr + "<td class='text-center'>" + val["start_time"] + "</td>";
                  tr = tr + "<td class='text-center'>" + val["end_time"] + "</td>";
                  tr = tr + "</tr>";
               $('#myTable > tbody:last').append(tr);
               });
          }

      });
}

setInterval(getDataFromDb, 10000);   // 1000 = 1 second
</script>          

<script>
$(function() {
   function realTime() {
      setTimeout(function(){  // ถ้าจะใช้  alert, console ให้คอมเมนต์บรรทัดนี้เพื่อปิด realtime ก่อน
         $.ajax({    
            method: "POST",   
            data: { rev: 1 },
            dataType: "json"  // ส่วนที่เพิ่มเข้ามาในตัวอย่างนี้    
         }).done(function( data ) {
            //alert(data.first);
            //console.log(data);
            $("#output").html(data.output);  // อัปเดต html สำหรับ date ที่มีคำว่า first
            $("#output").addClass("realtime"); // เพิ่มคลาส realtime เพื่อเปลี่ยนสีตัวหนังสือ
            $("#timetotal").html(data.timetotal);  // อัปเดต html สำหรับ date ที่มีคำว่า first
            $("#timetotal").addClass("realtime"); // เพิ่มคลาส realtime เพื่อเปลี่ยนสีตัวหนังสือ
            $("#time").html(data.second);  // อัปเดต html สำหรับ date ที่มีคำว่า second
            $("#time").addClass("realtime"); // เพิ่มคลาส realtime เพื่อเปลี่ยนสีตัวหนังสือ
            $("#avg").html(data.avg);  // อัปเดต html สำหรับ date ที่มีคำว่า last
            $("#avg").addClass("realtime"); // เพิ่มคลาส realtime เพื่อเปลี่ยนสีตัวหนังสือ
            $("#processingtime").html(data.processingtime);  // อัปเดต html สำหรับ date ที่มีคำว่า last
            $("#processingtime").addClass("realtime"); // เพิ่มคลาส realtime เพื่อเปลี่ยนสีตัวหนังสือ
            $("#totalrun").html(data.totalrun);  // อัปเดต html สำหรับ date ที่มีคำว่า last
            $("#totalrun").addClass("realtime"); // เพิ่มคลาส realtime เพื่อเปลี่ยนสีตัวหนังสือ
            $("#totalstop").html(data.totalstop);  // อัปเดต html สำหรับ date ที่มีคำว่า last
            $("#totalstop").addClass("realtime"); // เพิ่มคลาส realtime เพื่อเปลี่ยนสีตัวหนังสือ
            $("#pruntime").html(data.pruntime);  // อัปเดต html สำหรับ date ที่มีคำว่า last
            $("#pruntime").addClass("realtime"); // เพิ่มคลาส realtime เพื่อเปลี่ยนสีตัวหนังสือ
            $("#pstoptime").html(data.pstoptime);  // อัปเดต html สำหรับ date ที่มีคำว่า last
            $("#pstoptime").addClass("realtime"); // เพิ่มคลาส realtime เพื่อเปลี่ยนสีตัวหนังสือ
            //$("#responsecontainer").load('data.php');  // อัปเดต html สำหรับ date ที่มีคำว่า last
            //$("#responsecontainer").addClass("realtime"); // เพิ่มคลาส realtime เพื่อเปลี่ยนสีตัวหนังสือ
         });
      realTime();  // ถ้าจะใช้  alert, console ให้คอมเมนต์บรรทัดนี้เพื่อปิด realtime ก่อน
      }, 1000);  // ถ้าจะใช้  alert, console ให้คอมเมนต์บรรทัดนี้เพื่อปิด realtime ก่อน responsecontainer
   }
   realTime();
});

</script>

<?php include_once('layouts/footer.php'); ?>
