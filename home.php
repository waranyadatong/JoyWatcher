<?php
  $page_title = 'Home Page';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>
<?php include_once('layouts/header.php'); ?>

<head>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
   <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
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
   </style>
</head>

<form class="form-inline" action="#">
   <label for="From Date">From Date</label> 
   <input type="date" id="fromdate" name="from_date"value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control">

   <label for="To Date">To Date</label> 
   <input type="date" id="todate" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">

   <button onclick="submit" class="button button1"><span class="glyphicon glyphicon-search"></span>Search</button>

   <button onclick="ExportToExcel('xlsx')" class="button button2"><span class="glyphicon glyphicon-download-alt"></span>Export to Excel</button>
</form>
<br/>

<!--<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card mt-6">
            <div class="card-body">                    
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>From Date</label>
                                <input type="date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>To Date</label>
                                <input type="date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <br>
                                <button onclick="submit" class="button button1"><span class="glyphicon glyphicon-search"></span>Search</button>
                                <button onclick="ExportToExcel('xlsx')" class="button button2"><span class="glyphicon glyphicon-download-alt"></span>Export to Excel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>-->

<?php
//$con = mysqli_connect("localhost","root","","database_pi");
global $db;
if(isset($_GET['from_date']) && isset($_GET['to_date']))
    {
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date']; 

        $hour8 = 0;
        $Time8 = date('H:i:s',strtotime('08:00:00'));
        $query8 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 8 THEN 1 END) AS 'hour8' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time8' AND '$to_date $Time8'";
        $result8 = $db->query($query8);
        while ($row = $result8->fetch_array(MYSQLI_ASSOC)) {
            $hour8 = $hour8 + $row['hour8'];
        }

        $hour9 = 0;
        $Time9 = date('H:i:s',strtotime('08:00:00'));
        $query9 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 9 THEN 1 END) AS 'hour9' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time9' AND '$to_date $Time9'";
        $result9 = $db->query($query9);
        while ($row = $result9->fetch_array(MYSQLI_ASSOC)) {
            $hour9 = $hour9 + $row['hour9'];
        }

        $hour10 = 0;
        $Time10 = date('H:i:s',strtotime('08:00:00'));              
        $query10 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 10 THEN 1 END) AS 'hour10' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time10' AND '$to_date $Time10'";
        $result10 = $db->query($query10);
        while ($row = $result10->fetch_array(MYSQLI_ASSOC)) {
            $hour10 = $hour10 + $row['hour10'];
        }

        $hour11 = 0;
        $Time11 = date('H:i:s',strtotime('08:00:00'));                
        $query11 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 11 THEN 1 END) AS 'hour11' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time11' AND '$to_date $Time11'";
        $result11 = $db->query($query11);
        while ($row = $result11->fetch_array(MYSQLI_ASSOC)) {
            $hour11 = $hour11 + $row['hour11'];
        }

        $hour12 = 0;
        $Time12 = date('H:i:s',strtotime('08:00:00'));                 
        $query12 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 12 THEN 1 END) AS 'hour12' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time12' AND '$to_date $Time12'";
        $result12 = $db->query($query12);
        while ($row = $result12->fetch_array(MYSQLI_ASSOC)) {
            $hour12 = $hour12 + $row['hour12']; 
        }

        $hour13 = 0;
        $Time13 = date('H:i:s',strtotime('08:00:00'));                          
        $query13 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 13 THEN 1 END) AS 'hour13' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time13' AND '$to_date $Time13'";
        $result13 = $db->query($query13);
        while ($row = $result13->fetch_array(MYSQLI_ASSOC)) {
            $hour13 = $hour13 + $row['hour13']; 
        }

        $hour14 = 0;
        $Time14 = date('H:i:s',strtotime('08:00:00')); 
        $query14 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 14 THEN 1 END) AS 'hour14' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time14' AND '$to_date $Time14'";
        $result14 = $db->query($query14);
        while ($row = $result14->fetch_array(MYSQLI_ASSOC)) {
            $hour14 = $hour14 + $row['hour14'];  
        }

        $hour15 = 0;
        $Time15 = date('H:i:s',strtotime('08:00:00'));                           
        $query15 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 15 THEN 1 END) AS 'hour15' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time15' AND '$to_date $Time15'";
        $result15 = $db->query($query15);
        while ($row = $result15->fetch_array(MYSQLI_ASSOC)) {
            $hour15 = $hour15 + $row['hour15'];  
        } 

        $hour16 = 0;
        $Time16 = date('H:i:s',strtotime('08:00:00'));   
        $query16 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 16 THEN 1 END) AS 'hour16' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time16' AND '$to_date $Time16'";
        $result16 = $db->query($query16);
        while ($row = $result16->fetch_array(MYSQLI_ASSOC)) {
            $hour16 = $hour16 + $row['hour16'];  
        } 
        $hour17 = 0;
        $Time17 = date('H:i:s',strtotime('08:00:00'));               
        $query17 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 17 THEN 1 END) AS 'hour17' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time17' AND '$to_date $Time17'";
        $result17 = $db->query($query17);
        while ($row = $result17->fetch_array(MYSQLI_ASSOC)) {
            $hour17 = $hour17 + $row['hour17']; 
        }

        $hour18 = 0;
        $Time18 = date('H:i:s',strtotime('08:00:00'));  
        $query18 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 18 THEN 1 END) AS 'hour18' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time18' AND '$to_date $Time18'";
        $result18 = $db->query($query18);
        while ($row = $result18->fetch_array(MYSQLI_ASSOC)) {
            $hour18 = $hour18 + $row['hour18']; 
        }

        $hour19 = 0;
        $Time19 = date('H:i:s',strtotime('08:00:00'));  
        $query19 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 19 THEN 1 END) AS 'hour19' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time19' AND '$to_date $Time19'";
        $result19 = $db->query($query19);
        while ($row = $result19->fetch_array(MYSQLI_ASSOC)) {
            $hour19 = $hour19 + $row['hour19']; 
        }

        $hour20 = 0;
        $Time20 = date('H:i:s',strtotime('08:00:00'));               
        $query20 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 20 THEN 1 END) AS 'hour20' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time20' AND '$to_date $Time20'";
        $result20 = $db->query($query20);
        while ($row = $result20->fetch_array(MYSQLI_ASSOC)) {
            $hour20 = $hour20 + $row['hour20']; 
        }

        $hour21 = 0;
        $Time21 = date('H:i:s',strtotime('08:00:00')); 
        $query21 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 21 THEN 1 END) AS 'hour21' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time21' AND '$to_date $Time21'";
        $result21 = $db->query($query21);
        while ($row = $result21->fetch_array(MYSQLI_ASSOC)) {
            $hour21 = $hour21 + $row['hour21']; 
        }

        $hour22 = 0;
        $Time22 = date('H:i:s',strtotime('08:00:00'));                         
        $query22 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 22 THEN 1 END) AS 'hour22' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time22' AND '$to_date $Time22'";
        $result22 = $db->query($query22);
        while ($row = $result22->fetch_array(MYSQLI_ASSOC)) {
            $hour22 = $hour22 + $row['hour22']; 
        }

        $hour23 = 0;
        $Time23 = date('H:i:s',strtotime('08:00:00'));   
        $query23 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 23 THEN 1 END) AS 'hour23' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time23' AND '$to_date $Time23'";
        $result23 = $db->query($query23);
        while ($row = $result23->fetch_array(MYSQLI_ASSOC)) {
            $hour23 = $hour23 + $row['hour23']; 
        }

        $hour0 = 0;
        $Time0 = date('H:i:s',strtotime('08:00:00')); 
        $query0 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 0 THEN 1 END) AS 'hour0' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time0' AND '$to_date $Time0'";
        $result0 = $db->query($query0);
        while ($row = $result0->fetch_array(MYSQLI_ASSOC)) {
            $hour0 = $hour0 + $row['hour0']; 
        }

        $hour1 = 0;
        $Time1 = date('H:i:s',strtotime('08:00:00'));                         
        $query1 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 1 THEN 1 END) AS 'hour1' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time1' AND '$to_date $Time1'";
        $result1 = $db->query($query1);
        while ($row = $result1->fetch_array(MYSQLI_ASSOC)) {
            $hour1 = $hour1 + $row['hour1']; 
        }

        $hour2 = 0;
        $Time2 = date('H:i:s',strtotime('08:00:00'));  
        $query2 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 2 THEN 1 END) AS 'hour2' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time2' AND '$to_date $Time2'";
        $result2 = $db->query($query2);
        while ($row = $result2->fetch_array(MYSQLI_ASSOC)) {
            $hour2 = $hour2 + $row['hour2']; 
        }

        $hour3 = 0;
        $Time3 = date('H:i:s',strtotime('08:00:00'));  
        $query3 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 3 THEN 1 END) AS 'hour3' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time3' AND '$to_date $Time3'";
        $result3 = $db->query($query3);
        while ($row = $result3->fetch_array(MYSQLI_ASSOC)) {
            $hour3 = $hour3 + $row['hour3']; 
        } 

        $hour4 = 0;
        $Time4 = date('H:i:s',strtotime('08:00:00'));                        
        $query4 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 4 THEN 1 END) AS 'hour4' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time4' AND '$to_date $Time4'";
        $result4 = $db->query($query4);
        while ($row = $result4->fetch_array(MYSQLI_ASSOC)) {
            $hour4 = $hour4 + $row['hour4']; 
        }

        $hour5 = 0;
        $Time5 = date('H:i:s',strtotime('08:00:00'));  
        $query5 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 5 THEN 1 END) AS 'hour5' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time5' AND '$to_date $Time5'";
        $result5 = $db->query($query5);
        while ($row = $result5->fetch_array(MYSQLI_ASSOC)) {
            $hour5 = $hour5 + $row['hour5']; 
        }

        $hour6 = 0;
        $Time6 = date('H:i:s',strtotime('08:00:00'));                         
        $query6 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 6 THEN 1 END) AS 'hour6' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time6' AND '$to_date $Time6'";
        $result6 = $db->query($query6);
        while ($row = $result6->fetch_array(MYSQLI_ASSOC)) {
            $hour6 = $hour6 + $row['hour6']; 
        }

        $hour7 = 0;
        $Time7 = date('H:i:s',strtotime('08:00:00'));    
        $query7 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 7 THEN 1 END) AS 'hour7' FROM a3 WHERE Date_Time BETWEEN '$from_date $Time7' AND '$to_date $Time7'";
        $result7 = $db->query($query7);
        while ($row = $result7->fetch_array(MYSQLI_ASSOC)) {
            $hour7 = $hour7 + $row['hour7']; 
        }
    } 
?>

<div class="row">
    <div class="col-sm-2"> 
        <div class="form-group">
            <table id="tbl_exporttable_to_xls_1" class="table  table-striped" border="1" cellpadding="0" cellspacing="0" style="width:100px;"align="center" >
                <thead>          
                    <tr>
                        <th>Hr.</th>
                        <th>08:00-09:00</th>
                        <th>09:00-10:00</th>
                        <th>10:00-11:00</th>
                        <th>11:00-12:00</th>
                        <th>12:00-13:00</th>
                        <th>13:00-14:00</th>
                        <th>14:00-15:00</th>
                        <th>15:00-16:00</th>
                        <th>16:00-17:00</th>
                        <th>17:00-18:00</th>
                        <th>18:00-19:00</th>
                        <th>19:00-20:00</th>
                        <th>20:00-21:00</th>
                        <th>21:00-22:00</th>
                        <th>22:00-23:00</th>
                        <th>23:00-00:00</th>
                        <th>00:00-01:00</th>
                        <th>01:00-02:00</th>
                        <th>02:00-03:00</th>
                        <th>03:00-04:00</th>
                        <th>04:00-05:00</th>
                        <th>05:00-06:00</th>
                        <th>06:00-07:00</th>
                        <th>07:00-08:00</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Output</td>
                        <td><?php if(isset($_GET['from_date']) && isset($_GET['to_date'])) { echo $hour8;}?></td>
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
        </div>
    </div>
</div>


<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_exporttable_to_xls_1');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "Output" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fn || ('Output_JoyWatcher.' + (type || 'xlsx')));
    }
</script>

<?php include_once('layouts/footer.php'); ?>
