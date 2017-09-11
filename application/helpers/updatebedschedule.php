<?php
 include realpath(".") . "/mydb.php";
 $Db = new Db();
	$Today = date('Y-m-d', time());
	$CurrentDate = date('Y-m-d',strtotime('-1 day',strtotime($Today)));
	$arrUDS=$Db->UpdateBedSchedule($CurrentDate);

	if (count($arrUDS) > 0 )
	{
		for ($i=0;$i<count($arrUDS);$i++)
		{
			$pat_id = $arrUDS[$i]['patient_id'];
			$bed_id = $arrUDS[$i]['bed_id'];
			
			$sql = "";
			$sql = "UPDATE patient_bed_mapping set status = 0 where patient_id = $pat_id and bed_id = $bed_id and status = 1";
			
			$arrUP = mysql_query ($sql);
			
			$sql = "Insert into patient_bed_mapping (patient_id, bed_id, transferdate, status) values ($pat_id, $bed_id, '$Today', 1)";
			$arrUP = mysql_query ($sql);
			
		}
	}
?>