<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
	$Db = new Db();
	$pat_id = $_POST['post_pat_id'];
	// Check Posted Data Has Value In It
	if(isset($pat_id ))
	{
		$arrreservedbed = $Db->getreservedbed($pat_id);
		//print_r($arrreservedbed);
		echo $arrreservedbed[0]['bed_id']."-".$arrreservedbed[0]['bed_number'].'-'.$arrreservedbed[0]['type'];
		
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>	