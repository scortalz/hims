<?php 
include realpath(".") . "/mydb.php";

// Include Required Classes
$Db = new Db();

	 $Db->insertnew("zakaat", array (
		"patient_reg_no" 	=> 	$_POST['post_reg_no'],
		"zakaat" 		=> 	$_POST['post_zakaat_amount'],
		"datetime" 			=> 	date('Y-m-d H:i', strtotime($_POST['post_zakaat_date'])),
	));
?>