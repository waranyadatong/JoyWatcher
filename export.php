
<?php   
 //if(isset($_POST['Export'])){  
  
 
   
    //session_start();
    //require_once('includes/load.php');
    $conn = new mysqli('localhost','root','','database_pi','3306'); 
    mysqli_select_db($conn, 'database_pi');   
    //$sdate = $_GET['sdate'];
    //$edate = $_GET['edate'];
    $time = date('H:i:s',strtotime('08:00:00'));   
    $query = "SELECT Date_Time,Product_Name,Count,Takt_time,start_time,end_time from a3 WHERE Date_Time BETWEEN '2022-07-06 08:00' AND '2022-07-07 08:00'";  
    $result =  mysqli_query($conn, $query); 
    $columnHeader = '';  
    $columnHeader = "Date_Time" . "\t" . "Product_Name" . "\t" . "Count" . "\t" . "Takt_time" . "\t". "start_time" . "\t". "end_time" . "\t";  
    $setData = ''; 
    while($row=mysqli_fetch_row($result)){     
        $rowData = '';
        foreach ($row as $value) {
           $value = '"' . $value . '"' . "\t";  
           $rowData .= $value;  
        }  
       $setData .= trim($rowData) . "\n";  
    }
  


/*$conn = new mysqli('localhost', 'root', '');  
mysqli_select_db($conn, 'database_pi');  
$sql = "SELECT Date_Time,Product_Name,Count,Takt_time from a3 WHERE Date_Time BETWEEN '2022-05-02 08:00' AND '2022-05-03 08:00'"; 
$setRec = mysqli_query($conn, $sql);  
$columnHeader = '';  
$columnHeader = "Date_Time" . "\t" . "Product_Name" . "\t" . "Count" . "\t" . "Takt_time" . "\t"; 
$setData = '';  
  while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
    } */
    header('Content-Description: File Transfer');
    header('Cache-Control: must-revalidate');
    header('Pragma: public'); 
    header("Content-type: application/xlsx");  
    header("Content-Disposition: attachment; filename=Export_Database.xlsx");  
    header("Pragma: no-cache");  
    header("Expires: 0"); 

    echo ucwords($columnHeader) . "\n" . $setData . "\n"; 

//}  
 ?>

