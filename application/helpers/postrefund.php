<?php 
include realpath(".") . "/mydb.php";

// Include Required Classes
$Db = new Db();

	 $Db->insertnew("refunds", array (
		"patient_reg_no" 	=> 	$_POST['post_reg_no'],
		"refund" 		=> 	$_POST['post_refund_amount'],
		"datetime" 			=> 	date('Y-m-d H:i', strtotime($_POST['post_refund_date'])),
	));
?>