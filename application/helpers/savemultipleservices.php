<?php 

include realpath(".") . "/mydb.php";

// Include Required Classes
$Db = new Db();

	if (empty($_POST['post_p_id'])) {

		$patientid = 0;

	}
	else {

		$patientid		= $_POST['post_p_id'];

	}
		$serviceid		= $_POST['post_service_id'];
		$categoryid	 	= $_POST['p_sercatid'];
		$serviceqty 	= $_POST['p_qty'];
		$servicedis		= $_POST['p_disamt'];
		$serviceactamt	= $_POST['post_service_price'];
		$serviceprice	= $_POST['post_service_price'];
		$serviceramt	= $_POST['p_rcv_amt'];
		$servicedamt	= $_POST['p_dueamt'];

	$datasent = $Db->Insertpatientservice($patientid,$serviceid,$categoryid,$serviceqty,$servicedis,$serviceactamt,$serviceprice,$serviceramt,$servicedamt);




	$inserted_id = $Db->insertnew("invoice_service_mapping", array (
		"invoice_no" 				=> 	$_POST['post_invoice_no'],
		"service_id" 				=> 	$_POST['post_service_id'],
		"service_amount" 			=> 	$_POST['post_service_price'],
	));


?>