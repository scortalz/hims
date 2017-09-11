<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
	$Db = new Db();
	// Check Posted Data Has Value In It
	/*if(isset($_POST['doctor_id']))*/
	if(isset($_POST['bed_id']))
	{
		$datas = $Db->getbedallotment($_POST['bed_id']);
		//print_r($datas);exit;

		foreach($datas as $data)
		{
			print_r($data);exit;
			
			$pat=$data['patient_id'];
			
			$a=str_replace('"'.$pat.'"','"'.$pat.'" disabled',$pat);

			}
			
			 //echo  $b;
			}
			echo $a;

	}

catch(Exception $e)
{
  echo $e->getMessage();
}
?>	



