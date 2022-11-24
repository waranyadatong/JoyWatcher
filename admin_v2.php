<?php
  date_default_timezone_set('Asia/Bangkok');
  $page_title = 'Admin Home Page';
  require_once('includes/load.php');
   page_require_level(1);  
?>
<?php


            global $db;

            $hour8 = 0;
            $Time8 = date('H:i:s',strtotime('08:00:00'));
            $query8 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 8 THEN 1 END) AS hour8 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result8 = $db->query($query8);
            while ($row = $result8->fetch_array(MYSQLI_ASSOC)) {
               $hour8 = $hour8 + $row['hour8'];
            }
            $hour9 = 0;
            $Time9 = date('H:i:s',strtotime('08:00:00'));
            $query9 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 9 THEN 1 END) AS hour9 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result9 = $db->query($query9);
            while ($row = $result9->fetch_array(MYSQLI_ASSOC)) {
               $hour9 = $hour9 + $row['hour9'];
            }
            $hour10 = 0;
            $Time10 = date('H:i:s',strtotime('08:00:00'));              
            $query10 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 10 THEN 1 END) AS hour10 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result10 = $db->query($query10);
            while ($row = $result10->fetch_array(MYSQLI_ASSOC)) {
               $hour10 = $hour10 + $row['hour10'];
              }
            $hour11 = 0;
            $Time11 = date('H:i:s',strtotime('08:00:00'));                
            $query11 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 11 THEN 1 END) AS hour11 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result11 = $db->query($query11);
            while ($row = $result11->fetch_array(MYSQLI_ASSOC)) {
               $hour11 = $hour11 + $row['hour11'];
            }
            $hour12 = 0;
            $Time12 = date('H:i:s',strtotime('08:00:00'));                 
            $query12 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 12 THEN 1 END) AS hour12 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result12 = $db->query($query12);
            while ($row = $result12->fetch_array(MYSQLI_ASSOC)) {
               $hour12 = $hour12 + $row['hour12']; 
            }
            $hour13 = 0;
            $Time13 = date('H:i:s',strtotime('08:00:00'));                          
            $query13 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 13 THEN 1 END) AS hour13 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result13 = $db->query($query13);
            while ($row = $result13->fetch_array(MYSQLI_ASSOC)) {
               $hour13 = $hour13 + $row['hour13']; 
            }
            $hour14 = 0;
            $Time14 = date('H:i:s',strtotime('08:00:00')); 
            $query14 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 14 THEN 1 END) AS hour14 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result14 = $db->query($query14);
            while ($row = $result14->fetch_array(MYSQLI_ASSOC)) {
               $hour14 = $hour14 + $row['hour14'];  
            }
            $hour15 = 0;
            $Time15 = date('H:i:s',strtotime('08:00:00'));                           
            $query15 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 15 THEN 1 END) AS hour15 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result15 = $db->query($query15);
            while ($row = $result15->fetch_array(MYSQLI_ASSOC)) {
               $hour15 = $hour15 + $row['hour15'];  
            } 

            $hour16 = 0;
            $Time16 = date('H:i:s',strtotime('08:00:00'));   
            $query16 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 16 THEN 1 END) AS hour16 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result16 = $db->query($query16);
            while ($row = $result16->fetch_array(MYSQLI_ASSOC)) {
               $hour16 = $hour16 + $row['hour16'];  
            } 
            $hour17 = 0;
            $Time17 = date('H:i:s',strtotime('08:00:00'));               
            $query17 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 17 THEN 1 END) AS hour17 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result17 = $db->query($query17);
            while ($row = $result17->fetch_array(MYSQLI_ASSOC)) {
               $hour17 = $hour17 + $row['hour17']; 
            }

            $hour18 = 0;
            $Time18 = date('H:i:s',strtotime('08:00:00'));  
            $query18 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 18 THEN 1 END) AS hour18 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result18 = $db->query($query18);
            while ($row = $result18->fetch_array(MYSQLI_ASSOC)) {
               $hour18 = $hour18 + $row['hour18']; 
             }

            $hour19 = 0;
            $Time19 = date('H:i:s',strtotime('08:00:00'));  
            $query19 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 19 THEN 1 END) AS hour19 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result19 = $db->query($query19);
            while ($row = $result19->fetch_array(MYSQLI_ASSOC)) {
               $hour19 = $hour19 + $row['hour19']; 
             }

            $hour20 = 0;
            $Time20 = date('H:i:s',strtotime('08:00:00'));               
            $query20 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 20 THEN 1 END) AS hour20 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result20 = $db->query($query20);
            while ($row = $result20->fetch_array(MYSQLI_ASSOC)) {
               $hour20 = $hour20 + $row['hour20']; 
             }

            $hour21 = 0;
            $Time21 = date('H:i:s',strtotime('08:00:00')); 
            $query21 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 21 THEN 1 END) AS hour21 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result21 = $db->query($query21);
            while ($row = $result21->fetch_array(MYSQLI_ASSOC)) {
               $hour21 = $hour21 + $row['hour21']; 
             }

            $hour22 = 0;
            $Time22 = date('H:i:s',strtotime('08:00:00'));                         
            $query22 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 22 THEN 1 END) AS hour22 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result22 = $db->query($query22);
            while ($row = $result22->fetch_array(MYSQLI_ASSOC)) {
               $hour22 = $hour22 + $row['hour22']; 
             }

            $hour23 = 0;
            $Time23 = date('H:i:s',strtotime('08:00:00'));   
            $query23 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 23 THEN 1 END) AS hour23 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result23 = $db->query($query23);
            while ($row = $result23->fetch_array(MYSQLI_ASSOC)) {
               $hour23 = $hour23 + $row['hour23']; 
             }

            $hour0 = 0;
            $Time0 = date('H:i:s',strtotime('08:00:00')); 
            $query0 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 0 THEN 1 END) AS hour0 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
             $result0 = $db->query($query0);
            while ($row = $result0->fetch_array(MYSQLI_ASSOC)) {
               $hour0 = $hour0 + $row['hour0']; 
             }

            $hour1 = 0;
            $Time1 = date('H:i:s',strtotime('08:00:00'));                         
            $query1 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 1 THEN 1 END) AS hour1 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result1 = $db->query($query1);
            while ($row = $result1->fetch_array(MYSQLI_ASSOC)) {
               $hour1 = $hour1 + $row['hour1']; 
             }

            $hour2 = 0;
            $Time2 = date('H:i:s',strtotime('08:00:00'));  
            $query2 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 2 THEN 1 END) AS hour2 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result2 = $db->query($query2);
            while ($row = $result2->fetch_array(MYSQLI_ASSOC)) {
               $hour2 = $hour2 + $row['hour2']; 
             }

            $hour3 = 0;
            $Time3 = date('H:i:s',strtotime('08:00:00'));  
            $query3 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 3 THEN 1 END) AS hour3 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result3 = $db->query($query3);
            while ($row = $result3->fetch_array(MYSQLI_ASSOC)) {
               $hour3 = $hour3 + $row['hour3']; 
             } 

            $hour4 = 0;
            $Time4 = date('H:i:s',strtotime('08:00:00'));                        
            $query4 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 4 THEN 1 END) AS hour4 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result4 = $db->query($query4);
            while ($row = $result4->fetch_array(MYSQLI_ASSOC)) {
               $hour4 = $hour4 + $row['hour4']; 
             }

            $hour5 = 0;
            $Time5 = date('H:i:s',strtotime('08:00:00'));  
            $query5 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 5 THEN 1 END) AS hour5 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result5 = $db->query($query5);
            while ($row = $result5->fetch_array(MYSQLI_ASSOC)) {
               $hour5 = $hour5 + $row['hour5']; 
             }

            $hour6 = 0;
            $Time6 = date('H:i:s',strtotime('08:00:00'));                         
            $query6 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 6 THEN 1 END) AS hour6 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result6 = $db->query($query6);
            while ($row = $result6->fetch_array(MYSQLI_ASSOC)) {
               $hour6 = $hour6 + $row['hour6']; 
             }

            $hour7 = 0;
            $Time7 = date('H:i:s',strtotime('08:00:00'));    
            $query7 = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 7 THEN 1 END) AS hour7 FROM a3 WHERE Date_Time BETWEEN '2022-05-25 08:00' AND '2022-05-26 08:00'";
            $result7 = $db->query($query7);
            while ($row = $result7->fetch_array(MYSQLI_ASSOC)) {
               $hour7 = $hour7 + $row['hour7']; 
             }


    // ขั้นตอน 3, 4 จากแผนผัง - ถ้ามีการคิวรีจากฐานข้อมูลวางไว้ตรงนี้ ก่อนทำ JSON
    // ...
    // สร้าง string ให้อยู่ในรูปแบบของ JSON
  $jsonObj = '{'
  . '"hour8":"' . $hour8 . ' "'. ', '
  . '"hour9":"' . $hour9 . ' "'. ', '
  . '"hour10":"' . $hour10 . ' "'. ', '
  . '"hour11":"' . $hour11 . ' "'. ', '
  . '"hour12":"' . $hour12 . ' "'. ', '
  . '"hour13":"' . $hour13 . ' "'. ', '
  . '"hour14":"' . $hour14 . ' "'. ', '
  . '"hour15":"' . $hour15 . ' "'. ', '
  . '"hour16":"' . $hour16 . ' "'. ', '
  . '"hour17":"' . $hour17 . ' "'. ', '
  . '"hour18":"' . $hour18 . ' "'. ', '
  . '"hour19":"' . $hour19 . ' "'. ', '
  . '"hour20":"' . $hour20 . ' "'. ', '
  . '"hour21":"' . $hour21 . ' "'. ', '
  . '"hour22":"' . $hour22 . ' "'. ', '
  . '"hour23":"' . $hour23 . ' "'. ', '
  . '"hour0":"' . $hour0 . ' "'. ', '
  . '"hour1":"' . $hour1 . ' "'. ', '
  . '"hour2":"' . $hour2 . ' "'. ', '
  . '"hour3":"' . $hour3 . ' "'. ', '
  . '"hour4":"' . $hour4 . ' "'. ', '
  . '"hour5":"' . $hour5 . ' "'. ', '
  . '"hour6":"' . $hour6 . ' "'. ', '
  . '"hour7":"' . $hour7 . ' "'
  . '}' ;  
  echo $jsonObj;  // ถ้า $jsonObj เป็นอาร์เรย์ สามารถใช้ฟังก์ชัน json_encode() เพื่อส่งกลับข้อมูลแบบ JSON

  //exit();
  //close();

?>                 

