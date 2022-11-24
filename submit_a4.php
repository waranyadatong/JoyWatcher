<?php
date_default_timezone_set('Asia/Bangkok');
    $page_title = 'Admin Home Page';
    require_once('includes/load.php');
	/*$host =  "localhost";
	$username = "root";
	$password = "";

	try 
	{
	    $conn = new PDO("mysql:host=$host;dbname=database_pi", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
	    echo "Connection failed: " . $e->getMessage();
	}*/
    global $db;
	$response = array('success' => false);
    //$response=0;
	if(isset($_POST['target']) && $_POST['target']!='') {
		$timetarget = date("Y-m-d H:i:s");
		$sql = "INSERT INTO target_a4(target, datetime) VALUES('".addslashes($_POST['target'])."', '$timetarget')";

		if($db->query($sql)) {
			$response['success'] = true;
			$response = $_POST['target'];
			$res = array();
	        array_push($res, $response);
		}
	 	echo number_format($response);
	}   

	
?>