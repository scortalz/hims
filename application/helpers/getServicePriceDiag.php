<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
	$Db = new Db();
	$service_id = $_POST['post_service_id'];
	// Check Posted Data Has Value In It
	if(isset($service_id))
	{
		$arrServiceRate = $Db->getServicePriceDiag($service_id);
		
		//echo $arrServiceRate['rate'];
		echo $arrServiceRate['corporatecharges'];
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>	