<?php
// Start Session
session_start();
try
{
	// Include Required Classes
	require_once realpath(dirname(__FILE__) . "/../classes/db.php");

	// Create Objects Of Required Classes
	$Db = new Db();

	// Check Posted Data Has Value In It
	if(isset($_POST['post_service_id']))
	{
		$arr_new_id = $Db->getServicePrice($_POST['post_service_id']);
		echo $arr_new_id[0]['totalamount'];
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>	