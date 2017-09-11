<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
	$Db = new Db();
	$doctor_id = $_POST['post_doctor_id'];
	// Check Posted Data Has Value In It
	if(isset($doctor_id))
	{
		$arrServiceRate = $Db->getDoctorRate($doctor_id);
		
		echo $arrServiceRate['rate'];
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>	