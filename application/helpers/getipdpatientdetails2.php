<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
	$Db = new Db();
	$reg_no = $_POST['post_reg_no'];
	// Check Posted Data Has Value In It
	if(isset($reg_no))
	{
		$arrPD = $Db->getPatientInvoice($reg_no);
		
		echo json_encode($arrPD,TRUE);

	}
}
catch(Exception $e)
{
   echo $e->getMessage();
}
     
?>	

