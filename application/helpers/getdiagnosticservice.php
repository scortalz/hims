<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
	$Db = new Db();
	$diagnosticservice_id = $_POST['post_did'];
	// Check Posted Data Has Value In It
	if(isset($diagnosticservice_id))
	{
		$arrServiceRate = $Db->getdiagnosticservice($diagnosticservice_id);
		
		echo $arrServiceRate['corporatecharges'];
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>	