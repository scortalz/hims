<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
	$Db = new Db();
	$pat_id = $_POST['post_pat_id'];
	// Check Posted Data Has Value In It
	$first_bed_day = 0;
	if(isset($pat_id))
	{
		$arrPatInvoiceRate = $Db->getTotalAmount($pat_id);
		
		//echo number_format($arrPatInvoiceRate['total_amount']);
		$remamt =  $arrPatInvoiceRate['total_amount'];
		$grand_bed_charges = 0;
		//$arrbed = $Db->getPatientBedCharges($pat_id);
		$arrbed = $Db->admittedbedreport($pat_id);
		
		// --------------
		
		$Rs = $Db->getPatientProfile($pat_id);

		$admit_date = date('d-m-Y', strtotime($Rs[0]['admission_date']));
		//echo $admit_date;
		//exit;
		// ----------------
		
		
		
		
		if (count($arrbed) > 0 )
		{
			for($i=0;$i<count($arrbed);$i++)
			{
			/*
			$trans_date = $arrbed[$i]['transferdate'];
			
			$date1 = new DateTime(date('d-m-Y', strtotime($admit_date)));
			$date2 = new DateTime(date('d-m-Y', strtotime($trans_date)));

			if (count($arrbed) > 1)
			{
				if (($i + 1) == count($arrbed) )
				//if ($i == 0)
				{
					$first_bed_day = 1;	
				}
				else
				{
					$first_bed_day = 0;	
				}
			}
			$diff = $date2->diff($date1)->format("%a");
			$diff = $diff + $first_bed_day;
			$bed_charges = $arrbed[$i]['charges'] * ($diff);// + $first_bed_day);
			$grand_bed_charges = $grand_bed_charges + $bed_charges;
			$admit_date = $arrbed[$i]['transferdate'];
			//echo $diff;
			*/
			$count = $i + 1;
			
			$trans_date = $arrbed[$i]['transferdate'];
			// echo $admit_date. " - ".$trans_date;
			$date1 = new DateTime(date('d-m-Y', strtotime($trans_date)));
			$date2 = new DateTime(date('d-m-Y', strtotime($trans_date)));
/*
			if (count($arrbed) == 1)
			{
				if (($i + 1) == count($arrbed) )
				
				//if ($i == 0)
				{
					$first_bed_day = 1;	
				}
				else
				{
					$first_bed_day = 0;	
				}
			}
			if ($i  == 0)
			{
				$diff = $date2->diff($date1)->format("%a");
			}
			else
			{
				$diff = $date2->diff($date1)->format("%a");
			}
			//echo "days...".$diff."<br />";
			$diff = $diff + $first_bed_day;
			$bed_charges = $arrbed[$i]['charges'] * ($diff); // + $first_bed_day;
			*/
			
			
			$diff = $date2->diff($date1)->format("%a") + 1;
			$bed_charges = $arrbed[$i]['charges'];
			$grand_bed_charges = $grand_bed_charges + $bed_charges;
			   /////////////////$grand_bed_charges = $arrbed[0]['charges'];
		}
		
		
		$arrTD = $Db->getTotalDiscounts($pat_id);
	
		$count = 0;
		$grand_discount_amount = 0;
		if (count($arrTD) > 0)
		{
			for($i=0;$i<count($arrTD);$i++)
			{
				$grand_discount_amount = $grand_discount_amount + $arrTD[$i]['discount'];
			}
		}
		
		
		
		
		
			//echo $grand_bed_charges;
			echo ($remamt + $grand_bed_charges) - $grand_discount_amount;
		}
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>	