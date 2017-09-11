<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
	$Db = new Db();
	$bedidd = $_POST['post_bed_id'];
	// Check Posted Data Has Value In It
	if(isset($bedidd ))
	{
		$arravailablebed = $Db->getavailablebedcharges($bedidd);
		//print_r($arrRoomCharge);
		echo $arravailablebed[0]['charges'];
		
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>	