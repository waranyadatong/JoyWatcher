<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_pi";
$port = "3306";

$conn = mysqli_connect($servername, $username, $password, $dbname, $port) or die("Connection failed: " . mysqli_connect_error());

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
//$a = $_POST['a']; 
//isset( $_POST['a'] ) ? $a = $_POST['a'] : $a = "";

$columns = array( 
// datatable column index  => database column name
	0 =>'id', 
	1 =>'Date_Time',
	2 =>'Product_Name',
    3 =>'Count',
    4 =>'Takt_time'
);

// getting total number records without any search
$sql = "SELECT id, Date_Time, Product_Name, Count, Takt_time ";
$sql.= "FROM a3";
$query=mysqli_query($conn, $sql) or die("table.php: get a3");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = " SELECT id, Date_Time, Product_Name, Count, Takt_time ";
$sql.= " FROM a3 ";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter

	$sql.=" WHERE Product_Name LIKE '%".$requestData['search']['value']."%' ";

}
$query=mysqli_query($conn, $sql) or die("table.php: get a3");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("table.php: get a3");

$data = array();
while( $row = mysqli_fetch_assoc($query) ) {  // preparing an array
	$nestedData=array(); 
	$nestedData[] = $row["id"];
	$nestedData[] = $row["Date_Time"];
	$nestedData[] = $row["Product_Name"];
    $nestedData[] = $row["Count"];
    $nestedData[] = $row["Takt_time"];
	
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>

