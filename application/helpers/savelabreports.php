<?php

	include realpath(".") . "/mydb.php";

	$Db = new Db(); 

$test 		= $_POST['p_test'];
$result 	= $_POST['p_result'];
$interval 	= $_POST['p_interval'];
$serviceid 	= $_POST['p_serviceid'];
$repsession = $_POST['p_repsession'];
$mrnum 		= $_POST['p_mrnum'];

$inserted 	= $Db->insertservices($mrnum,$serviceid,$repsession,$test,$result,$interval);

if($inserted == true){
	echo "done";

}
else {
	print_r($_POST);

}

?>