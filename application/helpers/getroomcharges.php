<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
	$Db = new Db();
	$roomtype_id = $_POST['post_roomtype_id'];
	// Check Posted Data Has Value In It
	if(isset($roomtype_id))
	{
		$arrRoomCharge = $Db->getRoomCharges($roomtype_id);
		//print_r($arrRoomCharge);
		echo $arrRoomCharge[0]['charges'];
		
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>	