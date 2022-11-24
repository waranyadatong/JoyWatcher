<?php
  date_default_timezone_set('Asia/Bangkok');
  $page_title = 'Admin Home Page';
  require_once('includes/load.php');
  page_require_level(1); 
// 
?>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="dist/jquery.canvasjs.min.js"></script>
<h1>Stacked Column 100% Chart</h1>


<?php
$the_now = date('H:i:s');
$the_time = date('H:i:s',date(strtotime('08:00:00')));
 if ($the_time < $the_now) {
      $Start = date('Y-m-d H:i',date(strtotime("+0 day", mktime(8,0,0))));
      $End = date('Y-m-d H:i',date(strtotime("+1 day", mktime(8,0,0))));
   } else {
    $Start = date('Y-m-d H:i',date(strtotime("-1 day", mktime(8,0,0))));
    $End = date('Y-m-d H:i',date(strtotime("+0 day", mktime(8,0,0))));
   }
global $db;
    $timetotal = 0;
   $querytime = "SELECT Date_Time AS t FROM a3 WHERE Date_Time BETWEEN '$Start' AND '$End'";
   $resulttime = $db->query($querytime);
   while ($row = $resulttime->fetch_array(MYSQLI_ASSOC)) {
      $outputtime = $row['t'];
      $timetotal =  (strtotime($outputtime) - strtotime($Start))/60;
   }

   $Timerunstop = date('H:i:s',strtotime('08:00:00'));
   $queryrunstop = "SELECT end_time as endtime,start_time as starttime FROM a3 WHERE Date_Time BETWEEN '2022-07-01 08:00' AND '2022-07-02 08:00'";
   $resultrunstop = $db->query($queryrunstop);
   $First=true;
   $MinFirst = 0;
   $MaxFirst = 0;
   $Mintt = 0;
   $Maxtt = 0;
   $jsonrun = array();
   $jsonstop = array();
   $js= array();
   while ($row = $resultrunstop->fetch_array(MYSQLI_ASSOC)) {
      if ($First){
          $First = false;
          $runstopFirst = $row['endtime'];
          $timerunstop = (strtotime($runstopFirst) - strtotime($Timerunstop));
          if ($timerunstop < 300){
              $MinFirst = $MinFirst + $timerunstop;
             }else {
              $MaxFirst = $MaxFirst + $timerunstop;
           }
      }else {
          $runstopFirst = $row['endtime'];
          $runstopstarttime = $row['starttime'];
          $timett =  (strtotime($runstopFirst) - strtotime($runstopstarttime));
          if ($timett < 300){
              $Mintt = $Mintt + $timett;
             }else {
              $Maxtt = $Maxtt + $timett;
           }
     }
   }
   $totalrun = ($MinFirst + $Mintt)/60;
   $totalstop = ($MaxFirst + $Maxtt)/60;
   $pruntime = ($totalrun/$timetotal)*100;
   $pstoptime = ($totalstop/$timetotal)*100;


  $dataPoints1 = array(
  array("y" => round($pruntime), "label" => "MOT A3"),//
    );
  $dataPoints2 = array(
  array("y" => round($pstoptime), "label" => "MOT A3"),
    );
?>

<script type="text/javascript">
window.onload = function () {
    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "Number of Students in Each Room"
            },
            axisX: {
                title: "Rooms"
            },
            axisY: {
                title: "percentage"
            },
            data: [
            {
                type: "stackedColumn100",
                legendText: "Boys",
                showInLegend: "true",
                indexLabel: "#percent %",
                indexLabelPlacement: "inside",
                indexLabelFontColor: "white",
                dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
            },
            {
                type: "stackedColumn100",
                legendText: "Girls",
                showInLegend: "true",
                indexLabel: "#percent %",
                indexLabelPlacement: "inside",
                indexLabelFontColor: "white",
                dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });
        chart.render();
    });
}
</script>
<center><div id="chartContainer" style="height:360px; width:100%;"></div></center>

