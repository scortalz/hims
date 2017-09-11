<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
	$Db = new Db();
	$pat_id = $_POST['post_pat_id'];
	// Check Posted Data Has Value In It
	if(isset($pat_id))
	{
		$arrPatInvoiceRate = $Db->getTotalRemainingAmount($pat_id);
		
		//echo number_format($arrPatInvoiceRate['total_remaining_amount']);
		
		$remamt = $arrPatInvoiceRate['total_remaining_amount'];
		$adv_payment = 0;
		$arrAdv = $Db->getPatientAllAdvancePayment($pat_id);
		if (count($arrAdv) > 0 )
		{
			$adv_payment = $arrAdv[0]['recievedamount'];
		}
		
		echo $remamt + $adv_payment;
		
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>	