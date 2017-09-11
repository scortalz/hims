<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
		$Db = new Db();

		// getting value from post and file is ipdadservice.php
		$patientid		= $_POST['post_p_id'];
		$serviceid		= $_POST['post_service_id'];
		$categoryid	 	= $_POST['p_sercatid'];
		$serviceqty 	= $_POST['p_qty'];
		$servicedis		= $_POST['p_disamt'];
		$serviceactamt	= $_POST['p_service_amt'];
		$serviceprice	= $_POST['post_service_price'];
		$serviceramt	= $_POST['p_rcv_amt'];
		$servicedamt	= $_POST['p_dueamt'];

	$datasent = $Db->Insertpatientservice($patientid,$serviceid,$categoryid,$serviceqty,$servicedis,$serviceactamt,$serviceprice,$serviceramt,$servicedamt);
		
		if ($datasent ==  true) { // in the above variable if the query runs it will return true you can check by going in that function which is mydb.php

			$data['message'] = true; //in ipdadservice.php ajax is waiting for response to be true or false which deliver the status of above query that is it inserting or not

		}
		else {

			$data['message'] = false; //it will turn the message to false if query of database won't run

		}

		echo json_encode($data['message']); // true or false it will show to ajax response then it ajax will run it statement depend on true or false

		
	
}

catch(Exception $e)
{
   echo $e->getMessage();
}
     
?>	
