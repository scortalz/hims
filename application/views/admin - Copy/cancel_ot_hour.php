<?php
	print_r ($_POST);
	exit;
	/*
	include   realpath(".") . "/application/helpers/mydb.php";
	$db = NULL;
	$db = new DB();
	// Get Values
	$ot_id = $_POST['ot_detail_id'];
	
	// Revoke all menuitems
	$Db->Cancel_OT_Hours($ot_id);
	echo "done";
	/*
	$Db->insert("event", array (
		"description" => "Menu links are granted to system role.",
		"pagename" => "assignrole.php",	
		"creation_date_time" => date('Y-m-d H:i:s',time()),	
		"userid" => $_SESSION['AdminUserValues']['userid'],
		"eventtypeid" => ADMINISTRATION_EVENT,
	));	*/
	
?>