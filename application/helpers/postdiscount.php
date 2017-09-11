<?php 
include realpath(".") . "/mydb.php";

// Include Required Classes
$Db = new Db();

	 $Db->insertnew("discounts", array (
		"patient_reg_no" 	=> 	$_POST['post_reg_no'],
		"discount" 		=> 	$_POST['post_discount_amount'],
		"datetime" 			=> 	date('Y-m-d H:i', strtotime($_POST['post_discount_date'])),
	));
?>