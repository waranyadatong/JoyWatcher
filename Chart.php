<?php
date_default_timezone_set('Asia/Bangkok');
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "database_pi";
  $dbport = "3306";
  $conn = mysqli_connect($servername, $username, $password, $dbname, $dbport);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $hour = 0;
  $Time = date('H:i:s',strtotime('08:00:00'));
  $query = "SELECT HOUR(Date_Time) AS Hour,COUNT(*) AS Cnt FROM a3 WHERE Date_Time BETWEEN '2022-05-02 08:00:00' AND '2022-05-03 08:00:00' GROUP BY HOUR(Date_Time)";

  $result = $conn->query($query);
  $hours = array("8:00", "9:00", "10:00", "11:00", "12:00", "13:00", "14:00","15:00","16:00", "17:00", "18:00", "19:00","20:00","21:00","22:00","23:00","0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00");  
  $data = array();
  foreach($result as $row)
    {
      $data[] = array(
        //'Hour'    =>  $row["Hour"],
        'Cnt'     =>  $row["Cnt"]
      );
    }

    echo json_encode($data);
    //exit();
        //$Cnt[] = "\"".$row['Cnt']."\"";
        //$hour_label[] = "\"".$row['Hour']."\"";
        //echo "<tr><td>" . $hour_label . "</td><td>" . $Cnt . "</td></tr>";     
    

    //$data = implode(",",$data);
    //$hour_label = implode(",",$hour_label);
  

  //$conn->close();

  //set the response content type as JSON
  //header('Content-type: application/json');
  //output the return value of json encode using the echo function. 
  
//}
?>

              <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
              <script src="https://code.highcharts.com/highcharts.js"></script>
              <script src="https://code.highcharts.com/modules/data.js"></script>
              <script src="https://code.highcharts.com/modules/drilldown.js"></script>
              <script src="https://code.highcharts.com/modules/exporting.js"></script>
              <script src="https://code.highcharts.com/modules/export-data.js"></script>
              <script src="https://code.highcharts.com/modules/accessibility.js"></script>

              <canvas id="myChart" height="100px"></canvas>      
              <script>

              var ctx = document.getElementById("myChart").getContext('2d');
              var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
              labels: ['8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00', '0:00', '1:00', '2:00', '3:00', '4:00', '5:00', '6:00', '7:00'  ],
              datasets: [{
              label: 'Output(Board)/Hr.',
              //data: ['hour8', 'hour9', 'hour10', 'hour11', 'hour12', 'hour13', 'hour14', 'hour15', 'hour16', 'hour17', 'hour18', 'hour19', 'hour20', 'hour21', 'hour22', 'hour23', 'hour0', 'hour1', 'hour2', 'hour3', 'hour4', 'hour5', 'hour6', 'hour7'  ],
              data:[<?=$data;?>],
              backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
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
              borderWidth: 1
              }]
              },
              options: {
              scales: {
              yAxes: [{
              ticks: {
              beginAtZero:true
              }
              }]
              }
              }
              });
              </script>
  </body>
</html>