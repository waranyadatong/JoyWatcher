<?php
  require_once('includes/load.php');
 ?>
<?php
$result8 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 8 THEN 1 END) AS hour8 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result9 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 9 THEN 1 END) AS hour9 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result10 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 10 THEN 1 END) AS hour10 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result11 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 11 THEN 1 END) AS hour11 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result12 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 12 THEN 1 END) AS hour12 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result13 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 13 THEN 1 END) AS hour13 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result14 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 14 THEN 1 END) AS hour14 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result15 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 15 THEN 1 END) AS hour15 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result16 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 16 THEN 1 END) AS hour16 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result17 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 17 THEN 1 END) AS hour17 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result18 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 18 THEN 1 END) AS hour18 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result19 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 19 THEN 1 END) AS hour19 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result20 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 20 THEN 1 END) AS hour20 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result21 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 21 THEN 1 END) AS hour21 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result22 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 22 THEN 1 END) AS hour22 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result23 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 23 THEN 1 END) AS hour23 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result0 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 0 THEN 1 END) AS hour0 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result1 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 1 THEN 1 END) AS hour1 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result2 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 2 THEN 1 END) AS hour2 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result3 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 3 THEN 1 END) AS hour3 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result4 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 4 THEN 1 END) AS hour4 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result5 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 5 THEN 1 END) AS hour5 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result6 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 6 THEN 1 END) AS hour6 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
$result7 = $db->query("SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 7 THEN 1 END) AS hour7 FROM a3 WHERE Date_Time BETWEEN '2022-06-09 08:00' AND '2022-06-10 08:00'");
  ?>
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><center>Chart Joy Watcher</h3>
    </div>
    <div class="panel-body">
      <canvas id="myChart" style="width:100%;height:300px"></canvas>
      <script>
       var canvas = document.getElementById('myChart');
      var data = {
             labels: ['8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00', '0:00', '1:00', '2:00', '3:00', '4:00', '5:00', '6:00', '7:00'],

            datasets: [
            {
                label: "Output",
              backgroundColor: [
              "#f38b4a",
              "#56d798",
              "#ff8397",
              "#6970d5",
               "#f38b4a",
              "#56d798",
              "#ff8397",
              "#6970d5",
              "#f38b4a",
              "#56d798",
              "#ff8397",
              "#6970d5",
              "#f38b4a",
              "#56d798",
              "#ff8397",
              "#6970d5",
              "#f38b4a",
              "#56d798",
              "#ff8397",
              "#6970d5",
              "#f38b4a",
              "#56d798",
              "#ff8397",
              "#6970d5",
              ],
              borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
               'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
               'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
               'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
              ],

                data: [<?php while($row = $result8->fetch_array(MYSQLI_ASSOC))  {echo  $row['hour8'] . ',';}
                             while($row = $result9->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour9'] . ',';}
                             while($row = $result10->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour10'] . ',';}
                             while($row = $result11->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour11'] . ',';}
                             while($row = $result12->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour12'] . ',';}
                             while($row = $result13->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour13'] . ',';}
                             while($row = $result14->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour14'] . ',';}
                             while($row = $result15->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour15'] . ',';}
                             while($row = $result16->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour16'] . ',';}
                             while($row = $result17->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour17'] . ',';}
                             while($row = $result18->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour18'] . ',';}
                             while($row = $result19->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour19'] . ',';}
                             while($row = $result20->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour20'] . ',';}
                             while($row = $result21->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour21'] . ',';}
                             while($row = $result22->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour22'] . ',';}
                             while($row = $result23->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour23'] . ',';}
                             while($row = $result0->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour0'] . ',';}
                             while($row = $result1->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour1'] . ',';}
                             while($row = $result2->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour2'] . ',';}
                             while($row = $result3->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour3'] . ',';}
                             while($row = $result4->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour4'] . ',';}
                             while($row = $result5->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour5'] . ',';}
                             while($row = $result6->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour6'] . ',';}
                             while($row = $result7->fetch_array(MYSQLI_ASSOC)) {echo  $row['hour7'] . ',';}
                             ?>],
                             borderWidth: 1,


            },

            ]

        };

        
        var option = 

        {
          showLines: false,
          animation: {duration: 0},
          headerFormat:'<span style="font-size:11px">{series.name}</span><br>',
          pointFormat:'<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f} </b> Borad<br/>'
 


        };
        
        var myLineChart = Chart.Bar(canvas,{

          data:data,
          options:option
        });


      </script>

