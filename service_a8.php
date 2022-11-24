<?php
  date_default_timezone_set('Asia/Bangkok');
  $page_title = 'Joy Watcher';
  require_once('includes/load.php');
  //page_require_level(1); 
  $page = $_SERVER['PHP_SELF'];
  $now = time();
  $today = strtotime('8:00');
  $tomorrow = strtotime('tomorrow 8:00');
  if(($today - $now) > 0) {
    $refreshTime = $today - $now;
  } else {
    $refreshTime = $tomorrow - $now;
  }
  header("Refresh: $refreshTime; url=$page");
?> 

<?php  
  $the_now = strtotime(date('H:i:s'));
  $the_time = strtotime(date('H:i:s',strtotime('08:00:00')));

  if($the_time < $the_now) {
    $Start = date('Y-m-d H:i:s',date(strtotime("+0 day", mktime(8,0,0))));
    $End = date('Y-m-d H:i:s',date(strtotime("+1 day", mktime(8,0,0))));
  } else {
    $Start = date('Y-m-d H:i:s',date(strtotime("-1 day", mktime(8,0,0))));
    $End = date('Y-m-d H:i:s',date(strtotime("+0 day", mktime(8,0,0)))); 
  }
   
  $productresult = "";
  $queryproduct = "SELECT Product_Name FROM a8 WHERE Date_Time BETWEEN '$Start' AND '$End'";
  $product = $db->query($queryproduct);
  while ($row = $product->fetch_array(MYSQLI_ASSOC)) {
    $productresult = $row['Product_Name'];
  }

  $pcsresult = "";
  $querypcs = "SELECT pcs FROM program WHERE Program_Name = '$productresult'";
  $pcs = $db->query($querypcs);
  while ($row = $pcs->fetch_array(MYSQLI_ASSOC)) {
    $pcsresult = $row['pcs'];
  }

  global $db;
  $sql = "
  SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 8 THEN 1 END) AS h8,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 9 THEN 1 END) AS h9,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 10 THEN 1 END) AS h10,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 11 THEN 1 END) AS h11,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 12 THEN 1 END) AS h12,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 13 THEN 1 END) AS h13,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 14 THEN 1 END) AS h14,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 15 THEN 1 END) AS h15,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 16 THEN 1 END) AS h16,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 17 THEN 1 END) AS h17,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 18 THEN 1 END) AS h18,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 19 THEN 1 END) AS h19,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 20 THEN 1 END) AS h20,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 21 THEN 1 END) AS h21,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 22 THEN 1 END) AS h22,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 23 THEN 1 END) AS h23,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 0 THEN 1 END) AS h0,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 1 THEN 1 END) AS h1,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 2 THEN 1 END) AS h2,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 3 THEN 1 END) AS h3,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 4 THEN 1 END) AS h4,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 5 THEN 1 END) AS h5,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 6 THEN 1 END) AS h6,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 7 THEN 1 END) AS h7 FROM a8 WHERE Date_Time BETWEEN '$Start' AND '$End'";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
    $obj = array();
    while($row = $result->fetch_assoc()) {
      //acc output
      $h8 = $row["h8"];
      $h9 = $h8 + ($row["h9"]);
      $h10 = $h9 + ($row["h10"]);
      $h11 = $h10 + ($row["h11"]);
      $h12 = $h11 + ($row["h12"]);
      $h13 = $h12 + ($row["h13"]);
      $h14 = $h13 + ($row["h14"]);
      $h15 = $h14 + ($row["h15"]);
      $h16 = $h15 + ($row["h16"]);
      $h17 = $h16 + ($row["h17"]);
      $h18 = $h17 + ($row["h18"]);
      $h19 = $h18 + ($row["h19"]);
      $h20 = $h19 + ($row["h20"]);
      $h21 = $h20 + ($row["h21"]);
      $h22 = $h21 + ($row["h22"]);
      $h23 = $h22 + ($row["h23"]);
      $h0 = $h23 + ($row["h0"]);
      $h1 = $h0 + ($row["h1"]);
      $h2 = $h1 + ($row["h2"]);
      $h3 = $h2 + ($row["h3"]);
      $h4 = $h3 + ($row["h4"]);
      $h5 = $h4 + ($row["h5"]);
      $h6 = $h5 + ($row["h6"]);
      $h7 = $h6 + ($row["h7"]);

      //acc target (master plan)
      /*$ac8 = $acctarget;
      $ac9 = $acctarget + $ac8;
      $ac10 = $acctarget + $ac9;
      $ac11 = $acctarget + $ac10;
      $ac12 = $acctarget + $ac11;
      $ac13 = $acctarget + $ac12;
      $ac14 = $acctarget + $ac13;
      $ac15 = $acctarget + $ac14;
      $ac16 = $acctarget + $ac15;
      $ac17 = $acctarget + $ac16;
      $ac18 = $acctarget + $ac17;
      $ac19 = $acctarget + $ac18;
      $ac20 = $acctarget + $ac19;
      $ac21 = $acctarget + $ac20;
      $ac22 = $acctarget + $ac21;
      $ac23 = $acctarget + $ac22;
      $ac0 = $acctarget + $ac23;
      $ac1 = $acctarget + $ac0;
      $ac2 = $acctarget + $ac1;
      $ac3 = $acctarget + $ac2;
      $ac4 = $acctarget + $ac3;
      $ac5 = $acctarget + $ac4;
      $ac6 = $acctarget + $ac5;
      $ac7 = $acctarget + $ac6;

      //target plan
      $tar8 = $tarpln;
      $tar9 = $tarpln;
      $tar10 = $tarpln;
      $tar11 = $tarpln;
      $tar12 = $tarpln;
      $tar13 = $tarpln;
      $tar14 = $tarpln;
      $tar15 = $tarpln;
      $tar16 = $tarpln;
      $tar17 = $tarpln;
      $tar18 = $tarpln;
      $tar19 = $tarpln;
      $tar20 = $tarpln;
      $tar21 = $tarpln;
      $tar22 = $tarpln;
      $tar23 = $tarpln;
      $tar0 = $tarpln; 
      $tar1 = $tarpln;
      $tar2 = $tarpln;
      $tar3 = $tarpln;
      $tar3 = $tarpln;
      $tar4 = $tarpln; 
      $tar5 = $tarpln;
      $tar6 = $tarpln;
      $tar7 = $tarpln;*/

      $element = array($row["h8"],$row["h9"],$row["h10"],$row["h11"],$row["h12"],$row["h13"],$row["h14"],$row["h15"],$row["h16"],$row["h17"],$row["h18"],$row["h19"],$row["h20"],$row["h21"],$row["h22"],$row["h23"],$row["h0"],$row["h1"],$row["h2"],$row["h3"],$row["h4"],$row["h5"],$row["h6"],$row["h7"],$h8,$h9,$h10,$h11,$h12,$h13,$h14,$h15,$h16,$h17,$h18,$h19,$h20,$h21,$h22,$h23,$h0,$h1,$h2,$h3,$h4,$h5,$h6,$h7);
      /*$element = array($row["h8"],$row["h9"],$row["h10"],$row["h11"],$row["h12"],$row["h13"],$row["h14"],$row["h15"],$row["h16"],$row["h17"],$row["h18"],$row["h19"],$row["h20"],$row["h21"],$row["h22"],$row["h23"],$row["h0"],$row["h1"],$row["h2"],$row["h3"],$row["h4"],$row["h5"],$row["h6"],$row["h7"],$h8,$h9,$h10,$h11,$h12,$h13,$h14,$h15,$h16,$h17,$h18,$h19,$h20,$h21,$h22,$h23,$h0,$h1,$h2,$h3,$h4,$h5,$h6,$h7,$ac8,$ac9,$ac10,$ac11,$ac12,$ac13,$ac14,$ac15,$ac16,$ac17,$ac18,$ac19,$ac20,$ac21,$ac22,$ac23,$ac0,$ac1,$ac2,$ac3,$ac4,$ac5,$ac6,$ac7,$tar8,$tar9,$tar10,$tar11,$tar12,$tar13,$tar14,$tar15,$tar16,$tar17,$tar18,$tar19,$tar20,$tar21,$tar22,$tar23,$tar0,$tar1,$tar2,$tar3,$tar4,$tar5,$tar6,$tar7);*/
      array_push($obj,$element);
    }
    echo json_encode($obj);
  }else{
    echo "0 results";
  }
  exit();
?>