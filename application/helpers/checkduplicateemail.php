<?php

	// Include Required Classes
	include realpath(".") . "/mydb.php";
	
	$Db = new Db();
	if (isset($_POST['post_email_id']) )
	{
		$arrCE = $Db->CheckDuplicatePatientEmail($_POST['post_email_id']);
		if (count($arrCE) > 0 )
			echo 1;
		else
			echo 0;	
	}
	else if (isset($_POST['post_email_id1']) )
	{
		$arrCE = $Db->CheckDuplicateDoctorEmail($_POST['post_email_id1']);
		//print_r($arrCE);
		
		if (count($arrCE) > 0 )
			echo 1;
		else
			echo 0;	
	}
	else if (isset($_POST['post_email_id2']) )
	{
		$arrCE = $Db->CheckDuplicateNurseEmail($_POST['post_email_id2']);
		if (count($arrCE) > 0 )
			echo 1;
		else
			echo 0;	
	}
	else if (isset($_POST['post_email_id3']) )
	{
		$arrCE = $Db->CheckDuplicatereceptionEmail($_POST['post_email_id3']);
		if (count($arrCE) > 0 )
			echo 1;
		else
			echo 0;	
	}
	
	else
	
	{
		//do nothing
		}
	
	
?>