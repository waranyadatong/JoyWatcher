<?php
  $servername = "localhost";
  $username = "root";
  $password = ""; 
  $port = "3308";

try {
  $db = new PDO("mysql:host=$servername;dbname=database_pi;port=$port", $username, $password);
  // set the PDO error mode to exception
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
  //Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
  date_default_timezone_set('Asia/Bangkok');
?>