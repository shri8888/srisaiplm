<?php

//header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT items, table_number FROM orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	$rows = array();
	$outp = "";
    while($row = $result->fetch_assoc()) {
       // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
	   //$rows[] = $row;
	   if ($outp != "") {$outp .= ",";}
    $outp .= '{"items":"'  . $row["items"] . '",';
   
    $outp .= '"table_number":"'. $row["table_number"]     . '"}'; 
    }
	$outp ='{"records":['.$outp.']}';
//	$rows[] = json_encode($rows);
	//$outp ='{"records":['.$rows.']}';
	echo($outp);
} else {
    echo "0 results";
}
$conn->close();
?>