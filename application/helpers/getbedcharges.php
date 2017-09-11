<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
	$Db = new Db();
	$bed_id = $_POST['post_bed_id'];
	// Check Posted Data Has Value In It
	if(isset($bed_id ))
	{
		$arrBedCharge = $Db->getBedCharges($bed_id);
		//print_r($arrRoomCharge);
		echo $arrBedCharge[0]['charges'];
		
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>	