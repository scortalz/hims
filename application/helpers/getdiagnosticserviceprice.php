<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
	$Db = new Db();
	$diagnosticserviceid = $_POST['post_service_id'];
	// Check Posted Data Has Value In It
	if(isset($service_id))
	{
		$arrdiagnosticServiceRate = $Db->getServicePriceDiag($service_id);
		
		echo $arrdiagnosticServiceRate['corporatecharges'];
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>	