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
		$arrPD = $Db->getPatientProfile($reg_no);
		//print_r($arrPD);
		//echo $arrServiceRate['rate'];

echo $arrPD[0]['patient_reg_no']."|||".$arrPD[0]['refferedby']."|||".$arrPD[0]['phone']."|||".$arrPD[0]['sex']."|||".$arrPD[0]['birth_date']."|||".$arrPD[0]['admission_date']."|||".$arrPD[0]['med_card_no'];
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>	