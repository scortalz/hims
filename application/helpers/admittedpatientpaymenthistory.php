
	<style>
    
    body 
    {
        width:90%;
        margin:0px auto;
        padding:0;
    }
    div.life_logo
    {
    text-align: center;
    }
    th
    {
    border: 1px solid black;
    border-collapse: collapse;
    }
    .tbl tr
    {
       border:1px solid #000000;
    }
    
    </style>

 <?php
  
  include realpath(".") . "/mydb.php";
  include realpath(".") .  "/../dompdf/dompdf_config.inc.php";
 //include realpath(".") .  "/../dompdf/dompdf_config.inc.php";


 // Include Required Classes


 $Db = new Db();

 //$Email = new Email();
 $pno = $_GET['r'];

 $Rs = $Db->getPatientProfile($pno);
 $pid =$Rs[0]['patient_id'];
 $dr = $Db->getPatientDoctor($Rs[0]['doctor_id']);

 $regno = $Rs[0]['patient_reg_no'];
 $dr_name = $dr[0]['name'];

 if( $Rs[0]["discharge_date"]=="")
  {
		$discharge_date = "";
  }
  else
  {
		$discharge_date = 	date('d-m-Y H:i:s', strtotime($Rs[0]["discharge_date"]));
  }
   
  $admit_date = date('d-m-Y', strtotime($Rs[0]['admission_date']));
  $admit_date1 = date('d-m-Y', strtotime($Rs[0]['admission_date']));

  error_reporting(0);

  //$rno = $_GET['r'];
  //$arrRT = $Db->getRoomType($rno);

  /*echo "<pre>";
  print_r($Rs);
  echo "</pre>";*/
  //exit;

  //$invoice_id = $Rs[0]['invoice_id'];
 //$invoice_no = $Rs[0]['invoice_number'];
 //echo $Rs[0]['refferedby'];

 /*
 $AmountInWords="";
 $AmountInWords = convert_number($Rs[0]['recievedamount']);
 $rdate = date('D M d h:i:s Y', time());
 $lessdiscount = ( ( $Rs[0]['totalamount'] * $Rs[0]['discount'] ) / 100 ); 
 */

 $html='<body  style=" font-size: 11px;width:100%;padding-right:20px;">
 <table width="90%" style="padding: 0px 2px 1px 2px;" align="center" >
 <tr style="vertical-align:top;">
    <td><img class="hidedata" style="margin-left:0px;" src="../helpers/img/logo_only.PNG"></td><td><h3>INCISIVESOFT</td>
  </tr>
 <tr>
 <td colspan="2" style="text-align:center;padding: 0px 2px 1px 2px;font-weight:bold" >
 <u>DISCHARGED PATIENT BILL(IPD)</u>
 </td>
 </tr>
 </table>

   <table width="80%" style="text-align:center;margin:0px auto;padding: 0px 2px 1px 2px;border: 1px solid; border-color: #0000;border-radius:20px;">
   <tr>
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Patient Id: '.$regno.'</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Admission Date: '.date('d-m-Y', strtotime($Rs[0]['admission_date'])).'&nbsp;&nbsp;'.date('H:i', strtotime($Rs[0]['admission_date'])).'</td>
	</tr>
	<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">Patient Name:'.$Rs[0]['name'].'</td>
    <td style="text-align:left;padding: 0px 2px 1px 2px;">Discharge Date: '.$discharge_date.'
	 </td>
   	</tr>
	 <tr>	
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Contact No: '.$Rs[0]['phone'].'</td> 	  	
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Age: '.$Rs[0]['age'].'</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Sex: '.$Rs[0]['sex'].'</td>
   	</tr>
    <tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Physician:'.$dr_name.'</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >PVT/Company: Private</td>
	</tr>
		
   </table>
   
   <br>
   
 <table border="1"   align="center" cellpadding="0" cellspacing="0" width="80%" style="padding-right:2px;text-align:center;margin:0px auto;padding: 0px 2px 1px 2px;border: 1px solid; border-color: #0000;border-radius:20px;">
   <tr>		
    <td colspan="13" style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">DETAIL OF PAYMENT SCHEDULE </td> 
   		</tr>
		
		<tr>		
    <td style="text-align:left;padding-left:2px;">S.No.</td>
	<td style="text-align:left;padding-left:2px;">Receipt #:</td>
	<td style="text-align:left;padding-left:2px;">Recieved DDT:</td>
	<td  style="text-align:left;padding-left:2px;">Total Amount</td>
	<td style="text-align:left;padding-left:2px;">Discount%</td>
	<td style="text-align:left;padding-left:2px;">Discount Amount</td>
	<td style="text-align:left;padding-left:2px;">Grand Total</td>
	<td style="text-align:left;padding-left:2px;">Recieved Amount</td>
	<td colspan="5" style="text-align:right;padding-left:2px;">Amount</td>
		</tr>';
		
		//echo $html;
				
	$arrPR = $Db->getPatientReceipt($pid,$admit_date);
	/*
	echo "<pre>";
	print_r($arrPR);
	echo "</pre>";
	*/
	$count = 0;
	$grand_total_amount=0;
	$grand_received_amount=0;
	$grand_discount_amount=0;
	$grand_due_amount=0;
	$adv_received_amount=0;
	if (count($arrPR) > 0)
	{	
		for($i=0;$i<count($arrPR);$i++)
		{
			$count = $i + 1;			
			$grand_total_amount = $grand_total_amount + $arrPR[$i]['totalamount'];
			$grand_received_amount = $grand_received_amount + $arrPR[$i]['recievedamount'];
			$grand_discount_amount = $grand_discount_amount + $arrPR[$i]['discountamount'];
			$grand_due_amount = $grand_due_amount + $arrPR[$i]['dueamount'];
			
	$html .= '<tr>		
    <td style="text-align:left;padding: 0px 2px 1px 2px;border: 1px solid;">'.$count.'</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;border: 1px solid;">'.$arrPR[$i]['invoice_number'].'</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;border: 1px solid;">'.date('m/d/Y', strtotime($arrPR[$i]['creation_time'])).'&nbsp;'.date('H:i', strtotime($arrPR[$i]['creation_time'])).'</td>
	<!--<td style="text-align:left;padding: 0px 2px 1px 2px;border: 1px solid;">&nbsp;</td>-->
	<td style="text-align:right;padding: 0px 2px 1px 2px;border: 1px solid;">'.number_format($arrPR[$i]['totalamount']).'</td>
	<td style="text-align:right;padding: 0px 2px 1px 2px;border: 1px solid;">'.number_format($arrPR[$i]['discount']).'</td>
	<td style="text-align:right;padding: 0px 2px 1px 2px;border: 1px solid;">'.number_format($arrPR[$i]['discountamount']).'</td>
	<td style="text-align:right;padding: 0px 2px 1px 2px;border: 1px solid;">'.number_format($arrPR[$i]['totalamount'] - $arrPR[$i]['discountamount']).'</td>
	<td style="text-align:right;padding: 0px 2px 1px 2px;border: 1px solid;">'.number_format($arrPR[$i]['recievedamount']).'</td>
	<td colspan="5" style="text-align:right;padding: 0px 2px 1px 2px;border: 1px solid;">'.number_format($arrPR[$i]['dueamount']).'</td>
	</tr>';
	
	
		}
	}
	
	$html .='<tr>		
    <!--<td style="text-align:left;padding: 0px 2px 1px 2px;"></td>-->
	<td style="text-align:left;padding: 0px 2px 1px 2px;"></td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;"></td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;"> </td>
	<td style="text-align:right;padding: 0px 2px 1px 2px;">'.number_format($grand_total_amount).'</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;"> </td>
	<td style="text-align:right;padding: 0px 2px 1px 2px;">'.number_format($grand_discount_amount).'</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;"> </td>
	<td style="text-align:right;padding: 0px 2px 1px 2px;">'.number_format($grand_received_amount).' </td>
	<td colspan="5" style="text-align:right;padding: 0px 2px 1px 2px;">'.number_format($grand_due_amount).'</td>
	</tr>';
	$html .= '<tr  style="background:#3A6EA5; height:20px;color:white;font-weight:bold">
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>	
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>		
    <td colspan="3" style="text-align:left;padding: 0px 2px 1px 2px; ">Total Amount</td>
	<td colspan="4" style="text-align:right;padding: 0px 2px 1px 2px;">'.number_format(($grand_total_amount - $grand_discount_amount - $grand_received_amount)).'</td>
		</tr>';
		
		//echo $html;
		
		// Advance Payment working
		
	$html .= '<tr>		
    <td colspan="11" style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">DETAIL OF ADVANCE PAYMENT </td> 
   		</tr>
		
	<tr>		
    <td colspan="2" style="text-align:center;padding-left:4px;">S.No.</td>
	<td colspan="1" style="text-align:center;padding-left:4px;">Receipt #:</td>
	<td colspan="2" style="text-align:center;padding-left:4px;">Recieved DDT:</td>
	<td colspan="2" style="text-align:center;padding-left:4px;">Total Amount:</td>
	<td colspan="2" style="text-align:center;padding-left:4px;">Discount:</td>
	<td colspan="4" style="text-align:right;padding-left:4px;">Advance Amount</td>
	</tr>';
		
	$arrAdv = $Db->getPatientAdvancePayment($pid,$admit_date);

	$count = 0;
	$grand_total_amount="";
	$grand_received_amount="";
	$grand_discount_amount="";
	$grand_due_amount="";
	if (count($arrAdv) > 0)
	{
		for($i=0;$i<count($arrAdv);$i++)
		{
			$count = $i + 1;
			//$grand_discount_amount	= 0;
			//$grand_total_amount = $grand_total_amount + $arrPR[$i]['totalamount'];
			$grand_discount_amount = $arrAdv[$i]['discountamount'];
			$adv_received_amount = ($adv_received_amount + $arrAdv[$i]['recievedamount']); // + $grand_discount_amount;
			//$grand_discount_amount = $grand_discount_amount + $arrPR[$i]['discountamount'];
			//$grand_due_amount = $grand_due_amount + $arrPR[$i]['dueamount'];
			
	$html .='<tr>		
    <td colspan="2" style="text-align:center;padding: 0px 2px 1px 2px;border: 1px solid;">'.$count.'</td>
	<td colspan="1" style="text-align:center;padding: 0px 2px 1px 2px;border: 1px solid;">'.$arrAdv[$i]['invoice_number'].'</td>
	<td colspan="2" style="text-align:center;padding: 0px 2px 1px 2px;border: 1px solid;">'.date('m-d-Y', strtotime($arrAdv[$i]['creation_time'])).'&nbsp;'.date('H:i', strtotime($arrAdv[$i]['creation_time'])).'</td>
	<td colspan="2" style="text-align:center;padding: 0px 2px 1px 2px;border: 1px solid;">'.($arrAdv[$i]['discountamount'] + $arrAdv[$i]['recievedamount']).'</td>
	<td colspan="2" style="text-align:center;padding: 0px 2px 1px 2px;border: 1px solid;">'.$arrAdv[$i]['discountamount'].'</td>
	<td colspan="4" style="text-align:right;padding: 0px 2px 1px 2px;border: 1px solid;">'.number_format($arrAdv[$i]['recievedamount']).'</td>
	</tr>';
		}
	}
	$html .='<tr style="background:#3A6EA5; height:20px;color:white;font-weight:bold">		
	<td colspan="10" style="text-align:center;padding: 0px 2px 1px 2px;">Advance Payment - Grand Total</td>
	<td colspan="3" style="text-align:right;padding: 0px 2px 1px 2px;">'.number_format($adv_received_amount).' </td></tr>';
	$html .= '
		</tr>';
		
		// End Advance Payment Working
		
		$html .='<tr>		
    <td colspan="11" style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">BED CHARGES </td> 
   		</tr>';
		$html .='<tr>
    <td style="text-align:left;padding: 0px 2px 1px 2px;">S. No.</td>			
    <td  style="text-align:left;padding: 0px 2px 1px 2px;width:80px;">Patient Reg No.</td> 
	<td colspan="2" style="text-align:left;padding: 0px 2px 1px 2px;width:65px;">Patient Name</td> 
	<td style="text-align:left;padding: 0px 2px 1px 2px;width:80px;">Occupied Bed</td>
	<td style="text-align:center;padding: 0px 2px 1px 2px;min-width:80px;">Days Occupied</td>
	<!--<td  style="text-align:left;padding: 0px 2px 1px 2px;">Available Bed</td> -->
	<td colspan="2" style="text-align:left;padding: 0px 2px 1px 2px;">Bed Allotment Date/Time</td> 
	<td colspan="5"  style="text-align:right;padding: 0px 2px 1px 2px;">Charges</td> 
   		</tr>';
		
		$arrbed = $Db->admittedbedreport($regno,$admit_date);
	//echo "<pre>";
	//print_r($arrbed);
	//echo "</pre>";
	
     //	$count = 0;
	 $count = 0;
	 $grand_bed_charges = 0;
	 $today = date('d-m-Y', time());
	if (count($arrbed) > 0)
	{
		for($i=0;$i<count($arrbed);$i++)
		{
			//$grand_bed_charges = $grand_bed_charges + $arrbed[$i]['charges'];
			//$count = $i + 1;
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
			$html .='<tr>
    <td style="text-align:left;padding:0px 2px 1px 2px;font-weight:bold;">'.($count).'</td>			
    <td  style="text-align:left;padding:0px 2px 1px 2px;font-weight:bold;width:80px;">'.$arrbed[$i]['patient_reg_no'].'</td> 
	<td colspan="2" style="text-align:left;padding:0px 2px 1px 2px;font-weight:bold;width:65px;">'.$arrbed[$i]['name'].'</td> 
	<td style="text-align:left;padding:0px 2px 1px 2px;font-weight:bold;min-width:120px;">'.$arrbed[$i]['bed_number'].' '. $arrbed[$i]['type'].'</td>
	<td style="text-align:center;padding:0px 2px 1px 2px;font-weight:bold;">'.$diff.'</td> 
	<td colspan="2" style="text-align:left;padding:0px 2px 1px 2px;font-weight:bold;">'.$arrbed[$i]['transferdate'].'</td> 
	<td colspan="5" style="text-align:right;padding:0px 2px 1px 2px;font-weight:bold;">'.$bed_charges.'</td> 
   		</tr>';
		$admit_date = $arrbed[$i]['transferdate'];
		
		}
		}
		$html .= '<tr style="background:#3A6EA5; height:20px;color:white;font-weight:bold">
	<td colspan="10" style="text-align:left;padding: 0px 2px 1px 2px;">Grand Total:</td>
	<td colspan="3" style="text-align:right;padding: 0px 2px 1px 2px;">'.number_format($grand_bed_charges).'</td>
		</tr>';
		
		$arrTD = $Db->getTotalDiscounts($pno,$admit_date);
	//echo "<pre>";
	//print_r($arrTD);
	//echo "</pre>";
	
	$count = 0;
	$whole_grand_discount_amount = 0;
	if (count($arrTD) > 0)
	{
		$html .= '<tr>		
    <td colspan="12" style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">DETAILS OF DISCOUNT(s)</td> 
   		</tr>';
		
		$html .='<tr>
    <td colspan="4"  style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">S. No.</td>			
    <td  colspan="4"  style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;width:80px;">Discount Date</td> 
	<td colspan="5"  style="text-align:right;padding: 0px 2px 1px 2px;font-weight:bold;width:65px;">Discount Amount</td> </tr>';
		for($i=0;$i<count($arrTD);$i++)
		{
			
			$whole_grand_discount_amount = $whole_grand_discount_amount + $arrTD[$i]['discount'];
	
			$count = $i + 1;
	$html .= '<tr>
	<td colspan="4"  style="text-align:center;padding: 0px 2px 1px 2px;border 1px solid;">'.$count.'</td>
	<td colspan="4"  style="text-align:left;padding: 0px 2px 1px 2px;width:120px;border 1px solid;">'.date('d-m-Y', strtotime($arrTD[$i]['datetime'])).'</td>
	<td colspan="5"  style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;">'.$arrTD[$i]['discount'].'</td>
	
		</tr>';
	
		}
		$html .= '<tr style="background:#3A6EA5; height:20px;color:white;font-weight:bold">
	<td colspan="9" style="text-align:left;padding: 0px 2px 1px 2px;">Grand Total:</td>
	<td colspan="4" style="text-align:right;padding: 0px 2px 1px 2px;">'.number_format($whole_grand_discount_amount).'</td>
		</tr>';
	}
	
	// Refund Details
	
	$arrTR = $Db->getTotalRefunds($pno,$admit_date);
	//echo "<pre>";
	//print_r($arrTR);
	//echo "</pre>";
	
	$count = 0;
	if (count($arrTR) > 0)
	{
		$html .= '<tr>		
    <td colspan="12" style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">DETAILS OF REFUND(s)</td> 
   		</tr>';
		
		$html .='<tr>
    <td colspan="4"  style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">S. No.</td>			
    <td  colspan="4"  style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;width:80px;">Refund Date</td> 
	<td colspan="5"  style="text-align:right;padding: 0px 2px 1px 2px;font-weight:bold;width:65px;">Refund Amount</td> </tr>';
		for($i=0;$i<count($arrTR);$i++)
		{
			
			$grand_refund_amount = $grand_refund_amount + $arrTR[$i]['refund'];
	
			$count = $i + 1;
	$html .= '<tr>
	<td colspan="4"  style="text-align:center;padding: 0px 2px 1px 2px;border 1px solid;">'.$count.'</td>
	<td colspan="4"  style="text-align:left;padding: 0px 2px 1px 2px;width:120px;border 1px solid;">'.date('d-m-Y', strtotime($arrTR[$i]['datetime'])).'</td>
	<td colspan="5"  style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;">'.$arrTR[$i]['refund'].'</td>
	
		</tr>';
		}
		$html .= '<tr style="background:#3A6EA5; height:20px;color:white;font-weight:bold">
	<td colspan="9" style="text-align:left;padding: 0px 2px 1px 2px;">Grand Total:</td>
	<td colspan="4" style="text-align:right;padding: 0px 2px 1px 2px;">'.number_format($grand_refund_amount).'</td>
		</tr>';
	}

	// Refund Details
	
	$arrTZ = $Db->getTotalZakaats($pno,$admit_date);
	//echo "<pre>";
	//print_r($arrTZ);
	//echo "</pre>";
	
	$count = 0;
	if (count($arrTZ) > 0)
	{
		$html .= '<tr>		
    <td colspan="12" style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">DETAILS OF ZAKAAT(s)</td> 
   		</tr>';
		
		$html .='<tr>
    <td colspan="4"  style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">S. No.</td>			
    <td  colspan="4"  style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;width:80px;">Zakaat Date</td> 
	<td colspan="5"  style="text-align:right;padding: 0px 2px 1px 2px;font-weight:bold;width:65px;">Zakaat Amount</td> </tr>';
		for($i=0;$i<count($arrTZ);$i++)
		{
			
			$grand_zakaat_amount = $grand_zakaat_amount + $arrTZ[$i]['zakaat'];
	
			$count = $i + 1;
	$html .= '<tr>
	<td colspan="4"  style="text-align:center;padding: 0px 2px 1px 2px;border 1px solid;">'.$count.'</td>
	<td colspan="4"  style="text-align:left;padding: 0px 2px 1px 2px;width:120px;border 1px solid;">'.date('d-m-Y', strtotime($arrTZ[$i]['datetime'])).'</td>
	<td colspan="5"  style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;">'.$arrTZ[$i]['zakaat'].'</td>
	
		</tr>';

		}
		$html .= '<tr style="background:#3A6EA5; height:20px;color:white;font-weight:bold">
	<td colspan="9" style="text-align:left;padding: 0px 2px 1px 2px;">Grand Total:</td>
	<td colspan="4" style="text-align:right;padding: 0px 2px 1px 2px;">'.number_format($grand_zakaat_amount).'</td>
		</tr>';
	}

	// End Refund Details
		
	$html .='
		<tr>		
    <td colspan="12" style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">DETAIL OF SERVICE CHARGES</td> 
   		</tr>	
		
		<tr>
		<td style="text-align:left;padding: 0px 2px 1px 2px;border 1px solid;">S.No.</td>
	<td border="1" style="text-align:left;padding-left:4px;border 1px solid;">Service Category</td>
	<td style="text-align:left;padding-left:4px;border 1px solid;width:120px;">Description</td>
	<td style="text-align:left;padding-left:4px;border 1px solid;">Service Amount</td>
	<td style="text-align:left;padding-left:4px;border 1px solid;">Service Date</td>
	<td style="text-align:left;padding-left:4px;border 1px solid;">Qty</td>
	<td style="text-align:left;padding-left:4px;border 1px solid;">Discount%</td>
	<td style="text-align:left;padding-left:4px;border 1px solid;">Discount Amount</td>
	<td style="text-align:left;padding-left:4px;border 1px solid;">Service Charges</td>
	<td style="text-align:center;padding-left:4px;border 1px solid;">Adv. + Recvd. Amount</td>
	<td style="text-align:left;padding-left:4px;border 1px solid;" colspan="3">Due Amount</td>
		</tr>';
	
	$arrSV = $Db->getPatientServices($pno,$admit_date1);
	//echo "<pre>";
	//print_r($arrSV);
	//echo "</pre>";
	
	$count = 0;
	if (count($arrSV) > 0)
	{
		for($i=0;$i<count($arrSV);$i++)
		{
			$grand_service_discount_per = $grand_service_discount_per + $arrSV[$i]['service_discount_per'];
			$grand_service_discount_amount = $grand_service_discount_amount + $arrSV[$i]['service_discount_amount'];
			$grand_service_total_amount = $grand_service_total_amount + $arrSV[$i]['service_total_amount'];
			$grand_service_received_amount = $grand_service_received_amount + $arrSV[$i]['service_received_amount'];
			$grand_service_due_amount = $grand_service_due_amount + $arrSV[$i]['service_due_amount'];
			
		
			$count = $i + 1;
	$html .= '<tr>
	<td style="text-align:center;padding: 0px 2px 1px 2px;border 1px solid;">'.$count.'</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;border 1px solid;">'.$arrSV[$i]['cat_name'].'</td>	
	<td  style="text-align:left;padding: 0px 2px 1px 2px;width:120px;border 1px solid;">'.$arrSV[$i]['service_name'].'</td>
	<td  style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;">'.$arrSV[$i]['service_amount'].'</td>
	<td  style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;">'.$arrSV[$i]['service_start_date'].'&nbsp;</td>
	<td  style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;">'.$arrSV[$i]['service_qty'].'</td>	
	<td  style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;">'.$arrSV[$i]['service_discount_per'].'</td>	
	<td  style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;">'.$arrSV[$i]['service_discount_amount'].'</td>	
	<td  style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;">'.$arrSV[$i]['service_total_amount'].'</td>	
	<td style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;">'.$arrSV[$i]['service_received_amount'].'</td>	
	<td style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;" colspan="3">'.$arrSV[$i]['service_due_amount'].'</td>	
		</tr>';
		}
	}
	else
	{
		$html .= '<tr>
	<td colspan="9" style="text-align:left;padding: 0px 2px 1px 2px;"> No Service is selected</td>
		</tr>';
	}
	
		$last_remaining_amount = ($grand_service_total_amount + $grand_bed_charges) - ($adv_received_amount + $grand_service_received_amount + $whole_grand_discount_amount - $grand_refund_amount + $grand_zakaat_amount);
		
	$html .= '<tr style="background:#3A6EA5; height:20px;color:white;font-weight:bold;border 1px solid;">
	<td colspan="6" style="text-align:left;padding: 0px 2px 1px 2px;border 1px solid;">Grand Total:</td>
	<td  style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;">'.number_format($grand_service_discount_per).'</td>
	<td  style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;">'.number_format($grand_service_discount_amount).'</td>
	<td  style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;">'.number_format($grand_bed_charges + $grand_service_total_amount).'</td>
	<td  style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;">'.number_format($adv_received_amount + $grand_service_received_amount).'</td>
	<!--<td  style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;">'.number_format($grand_service_due_amount).'</td>-->
	<td  style="text-align:right;padding: 0px 2px 1px 2px;border 1px solid;" colspan="3">'.number_format($last_remaining_amount).'</td>
		</tr>';

   $html .=	'</body></table>';
    
	echo $html;

	$dompdf = new DOMPDF();
	$dompdf->set_paper("A4","portrait");
	$dompdf->load_html($html);

	$dompdf->render();

	// The next call will store the entire PDF as a string in $pdf
	$pdf = $dompdf->output();
  
	file_put_contents("../../reports/patient_payment_history-".$pno.".pdf", $pdf);

 ?>

 <br/>

<form target="_blank" action="print_ipd.php" method="post">
	<input type="hidden" id="invoice_no" name="invoice_no" value=<?php echo $pno; ?> style="margin-left:250px;" />
  <textarea style="display:none" name="txtprint"><?php echo $html; ?> </textarea>
  &nbsp;
 <input  type="submit" name="print" value="Print Receipt" class="btn btn-blue" style="margin-left:250px;"/>
</form>
</div>
