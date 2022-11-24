<?php
    date_default_timezone_set('Asia/Bangkok');
    $page_title = 'Admin Home Page';
    require_once('includes/load.php');
    //page_require_level(2); 
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
    $the_now = strtotime(date('H:i:s'));
    $the_time = strtotime(date('H:i:s',strtotime('08:00:00')));

    if ($the_time < $the_now) {
      $Start = date('Y-m-d H:i:s',date(strtotime("+0 day", mktime(8,0,0))));
      $End = date('Y-m-d H:i:s',date(strtotime("+1 day", mktime(8,0,0))));
    } else {
      $Start = date('Y-m-d H:i:s',date(strtotime("-1 day", mktime(8,0,0))));
      $End = date('Y-m-d H:i:s',date(strtotime("+0 day", mktime(8,0,0)))); 
    }

    $targetresult = 0;
    $querytarget = "SELECT target FROM target_a7 WHERE datetime BETWEEN '$Start' AND '$End'";
    $target = $db->query($querytarget);
    if ($target->num_rows > 0) {
        while ($row = $target->fetch_array(MYSQLI_ASSOC)) {
            $targetresult = $row['target'];
        }       
        $acctarget = $targetresult/24;
    } else {
        $acctarget = 0;
    }

    $productresult = "";
    $queryproduct = "SELECT Product_Name FROM a7 WHERE Date_Time BETWEEN '$Start' AND '$End'";
    $product = $db->query($queryproduct);
    while ($row = $product->fetch_array(MYSQLI_ASSOC)) {
        $productresult = $row['Product_Name'];
    }

    $pcsresult = 0;
    $querypcs = "SELECT pcs FROM program WHERE Program_Name = '$productresult'";
    $pcs = $db->query($querypcs);
    while ($row = $pcs->fetch_array(MYSQLI_ASSOC)) {
        $pcsresult = $row['pcs'];
    }

    global $db;
    $sql = "SELECT COUNT(CASE WHEN HOUR(TIME(Date_Time))= 8 THEN 1 END) AS h8,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 9 THEN 1 END) AS h9,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 10 THEN 1 END) AS h10,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 11 THEN 1 END) AS h11,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 12 THEN 1 END) AS h12,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 13 THEN 1 END) AS h13,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 14 THEN 1 END) AS h14,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 15 THEN 1 END) AS h15,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 16 THEN 1 END) AS h16,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 17 THEN 1 END) AS h17,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 18 THEN 1 END) AS h18,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 19 THEN 1 END) AS h19,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 20 THEN 1 END) AS h20,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 21 THEN 1 END) AS h21,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 22 THEN 1 END) AS h22,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 23 THEN 1 END) AS h23,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 0 THEN 1 END) AS h0,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 1 THEN 1 END) AS h1,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 2 THEN 1 END) AS h2,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 3 THEN 1 END) AS h3,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 4 THEN 1 END) AS h4,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 5 THEN 1 END) AS h5,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 6 THEN 1 END) AS h6,COUNT(CASE WHEN HOUR(TIME(Date_Time))= 7 THEN 1 END) AS h7 FROM a7 WHERE Date_Time BETWEEN '$Start' AND '$End'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $obj = array();
        while($row = $result->fetch_assoc()) {
            $h8 = $row["h8"]*$pcsresult;
            $h9 = $h8 + ($row["h9"]*$pcsresult);
            $h10 = $h9 + ($row["h10"]*$pcsresult);
            $h11 = $h10 + ($row["h11"]*$pcsresult);
            $h12 = $h11 + ($row["h12"]*$pcsresult);
            $h13 = $h12 + ($row["h13"]*$pcsresult);
            $h14 = $h13 + ($row["h14"]*$pcsresult);
            $h15 = $h14 + ($row["h15"]*$pcsresult); 
            $h16 = $h15 + ($row["h16"]*$pcsresult);
            $h17 = $h16 + ($row["h17"]*$pcsresult);
            $h18 = $h17 + ($row["h18"]*$pcsresult);
            $h19 = $h18 + ($row["h19"]*$pcsresult);
            $h20 = $h19 + ($row["h20"]*$pcsresult);
            $h21 = $h20 + ($row["h21"]*$pcsresult);
            $h22 = $h21 + ($row["h22"]*$pcsresult);
            $h23 = $h22 + ($row["h23"]*$pcsresult);
            $h0 = $h23 + ($row["h0"]*$pcsresult);
            $h1 = $h0 + ($row["h1"]*$pcsresult);
            $h2 = $h1 + ($row["h2"]*$pcsresult);
            $h3 = $h2 + ($row["h3"]*$pcsresult);
            $h4 = $h3 + ($row["h4"]*$pcsresult);
            $h5 = $h4 + ($row["h5"]*$pcsresult);
            $h6 = $h5 + ($row["h6"]*$pcsresult);
            $h7 = $h6 + ($row["h7"]*$pcsresult);

            //master plan
            $ac8 = $acctarget; 
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
            $tar8 = $acctarget;
            $tar9 = $acctarget;
            $tar10 = $acctarget;
            $tar11 = $acctarget;
            $tar12 = $acctarget;
            $tar13 = $acctarget;
            $tar14 = $acctarget;
            $tar15 = $acctarget;
            $tar16 = $acctarget;
            $tar17 = $acctarget;
            $tar18 = $acctarget;
            $tar19 = $acctarget;
            $tar20 = $acctarget;
            $tar21 = $acctarget;
            $tar22 = $acctarget;
            $tar23 = $acctarget;
            $tar0 = $acctarget;
            $tar1 = $acctarget;
            $tar2 = $acctarget;
            $tar3 = $acctarget;
            $tar4 = $acctarget;
            $tar5 = $acctarget;
            $tar6 = $acctarget;
            $tar7 = $acctarget;

            $element = array($row["h8"]*$pcsresult,$row["h9"]*$pcsresult,$row["h10"]*$pcsresult,$row["h11"]*$pcsresult,$row["h12"]*$pcsresult,$row["h13"]*$pcsresult,$row["h14"]*$pcsresult,$row["h15"]*$pcsresult,$row["h16"]*$pcsresult,$row["h17"]*$pcsresult,$row["h18"]*$pcsresult,$row["h19"]*$pcsresult,$row["h20"]*$pcsresult,$row["h21"]*$pcsresult,$row["h22"]*$pcsresult,$row["h23"]*$pcsresult,$row["h0"]*$pcsresult,$row["h1"]*$pcsresult,$row["h2"]*$pcsresult,$row["h3"]*$pcsresult,$row["h4"]*$pcsresult,$row["h5"]*$pcsresult,$row["h6"]*$pcsresult,$row["h7"]*$pcsresult,$h8,$h9,$h10,$h11,$h12,$h13,$h14,$h15,$h16,$h17,$h18,$h19,$h20,$h21,$h22,$h23,$h0,$h1,$h2,$h3,$h4,$h5,$h6,$h7,$ac8,$ac9,$ac10,$ac11,$ac12,$ac13,$ac14,$ac15,$ac16,$ac17,$ac18,$ac19,$ac20,$ac21,$ac22,$ac23,$ac0,$ac1,$ac2,$ac3,$ac4,$ac5,$ac6,$ac7,$tar8,$tar9,$tar10,$tar11,$tar12,$tar13,$tar14,$tar15,$tar16,$tar17,$tar18,$tar19,$tar20,$tar21,$tar22,$tar23,$tar0,$tar1,$tar2,$tar3,$tar4,$tar5,$tar6,$tar7);
            array_push($obj,$element);
        }
        echo json_encode($obj);
    } else {
        echo "0 results";
    }
    exit();
?>