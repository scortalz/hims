<?php
 include realpath(".") . "/mydb.php";
 $Db = new Db();
	//print_r($_POST);
	$pno = $_GET['p_id'];
	$Rs = $Db->getPatientProfile($pno);
	$UDispatdate=$Db->Updatepatientdischargedate($Rs[0]['patient_reg_no'],$_GET['dc_type']);
?>

<!--<style>

body 
{
	width:80%;
	margin:0px auto;
	padding:0;
}


div.life_logo {
text-align: center;
}
th {
border: 1px solid black;
border-collapse: collapse;
}
.tbl tr
{
		border:1px solid #000000;
}
</style>-->

<?php 
// include realpath(".") . "/mydb.php";
 //include realpath(".") .  "/currencyconvertor.php";
  //include realpath(".") .  "/../dompdf/dompdf_config.inc.php";
 //include realpath(".") .  "/../dompdf/dompdf_config.inc.php";

//$Db = new Db();

//$Email = new Email();
//$pno = $_GET['r'];

/*$Rs = $Db->getPatientProfile($pno);
$pid =$Rs[0]['patient_id'];
$dr = $Db->getPatientDoctor($Rs[0]['doctor_id']);

$dr_name = $dr[0]['name'];

$UDispatdate=$Db->Updatepatientdischargedate($Rs[0]['patient_reg_no']);*/
//echo $UDispatdate;
//exit;
 /*$html='<body  style=" font-size: 14px;width:80%;margin-right:auto;margin-left:auto">

<table width="80%" style="padding: 0px 2px 1px 2px; margin:0px auto;"  >
<tr>
<td colspan="2" style="text-align:center;padding: 0px 2px 1px 2px;" ><img src="img/logo.png" width="292" height="80">
<h3>NORTH NAZIMABAD,KARACHI</h3>
</td>
</tr>
<tr>
<td colspan="2" style="text-align:center;padding: 0px 2px 1px 2px;font-weight:bold" >
<u>DISCHARGED PATIENT BILL(IPD)</u>
</td>
</tr>
</table><?php */

  /* <table width="92%" style="text-align:center;margin:0px auto;padding: 0px 2px 1px 2px;border: 1px solid; border-color: #0000;border-radius:20px;">
   <tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Patient Id: '.$Rs[0]['patient_reg_no'].'</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Admission Date: '.$Rs[0]['admission_date'].'</td>
	</tr>
	<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">Patient Name:'.$Rs[0]['name'].'</td>
    <td style="text-align:left;padding: 0px 2px 1px 2px;">Discharge Date:'.$Rs[0]['discharge_date'].'</td>
   		</tr>
		  <tr>	
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Contact No: '.$Rs[0]['phone'].'</td> 	  	
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Age: '.$Rs[0]['age'].'</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Sex: '.$Rs[0]['sex'].'</td>
   		</tr>
		 <tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Physician:'.$dr_name.'</td>
	</tr>
		<tr>		
     <td  style="text-align:left;padding: 0px 2px 1px 2px;" >PVT/Company: Private</td>
   		</tr>
   </table>
   <br>
 <table width="80%" style="margin:0px auto;text-align:center;padding: 0px 2px 1px 2px;border: 1px solid; border-color: #0000;border-radius:20px;">
   <tr>		
    <td colspan="9" style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">DETAIL OF PAYMENT SCHEDULE </td> 
   		</tr>
		<tr>		
    <td colspan="9" style="text-align:left;padding: 0px 2px 1px 2px;" ><br></td>
   		</tr>
		<tr>*/	
	
    /*<td style="text-align:left;padding-left:4px;min-width:53px;">S.No.</td>
	<td style="text-align:left;padding-left:4px;min-width:87px;">Receipt Id:</td>
	<td style="text-align:left;padding-left:4px;min-width:87px;">Recieved DDT:</td>
	<td style="text-align:left;padding-left:4px;min-width:82px;">Total Amount</td>
	<td style="text-align:left;padding-left:4px;min-width:68px;">Discount%</td>
	<td style="text-align:left;padding-left:4px;min-width:110px;">Discount Amount</td>
	<td style="text-align:left;padding-left:4px;min-width:82px;">Grand Total</td>
	<td style="text-align:left;padding-left:4px;min-width:110px;">Recieved Amount</td>
	<td style="text-align:left;padding-left:4px;min-width:90px;">Billed Amount</td>
		</tr>';*/
		
	//$arrPR = $Db->getPatientReceipt($pid);
	/*echo "<pre>";
	print_r($arrPR);
	echo "</pre>";*/
	/*$count = 0;
	$grand_total_amount="";
	$grand_received_amount="";
	$grand_discount_amount="";
	$grand_due_amount="";
	if (count($arrPR) > 0)
	{
		for($i=0;$i<count($arrPR);$i++)
		{
			$count = $i + 1;			
			$grand_total_amount = $grand_total_amount + $arrPR[$i]['totalamount'];
			$grand_received_amount = $grand_received_amount + $arrPR[$i]['recievedamount'];
			$grand_discount_amount = $grand_discount_amount + $arrPR[$i]['discountamount'];
			$grand_due_amount = $grand_due_amount + $arrPR[$i]['dueamount'];
			
	$html .=	'<tr>*/	
			
   /* <td style="text-align:left;padding: 0px 2px 1px 2px;">'.$count.'</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;width:100px;">'.$arrPR[$i]['invoice_number'].'</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;width:100px;">'.date('m/d/Y', strtotime($arrPR[$i]['creation_time'])).'&nbsp;'.date('H:i', strtotime($arrPR[$i]['creation_time'])).'</td>
	<td style="text-align:right;padding: 0px 2px 1px 2px;width:70px;">'.number_format($arrPR[$i]['totalamount'], 2).'</td>
	<td style="text-align:right;padding: 0px 2px 1px 2px;width:70px;">'.number_format($arrPR[$i]['discount'], 2).'</td>
	<td style="text-align:right;padding: 0px 2px 1px 2px;width:70px;">'.number_format($arrPR[$i]['discountamount'], 2).'</td>
	<td style="text-align:center;padding: 0px 2px 1px 2px;width:70px;">'.number_format($arrPR[$i]['totalamount'] - $arrPR[$i]['discountamount'], 2).'</td>
	<td style="text-align:right;padding: 0px 2px 1px 2px;width:70px;">'.number_format($arrPR[$i]['recievedamount'], 2).'</td>
	<td style="text-align:center;padding: 0px 2px 1px 2px;width:70px;">'.number_format($arrPR[$i]['dueamount'], 2).'</td>
	</tr>';
	
		}
	}
	$html .=	'<tr>		
    <td colspan="10" style="text-align:left;padding: 0px 2px 1px 2px;" ><hr></td>
   		</tr>';
		
	$html .= '<tr>		
    <!--<td style="text-align:left;padding: 0px 2px 1px 2px;"></td>-->
	<td style="text-align:left;padding: 0px 2px 1px 2px;"></td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;"></td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;"> </td>
	<td style="text-align:right;padding: 0px 2px 1px 2px;">'.number_format($grand_total_amount, 2).'</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;"> </td>
	<td style="text-align:right;padding: 0px 2px 1px 2px;">'.number_format($grand_discount_amount, 2).'</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;"> </td>
	<td style="text-align:right;padding: 0px 2px 1px 2px;">'.number_format($grand_received_amount,2).' </td>
	<td style="text-align:center;padding: 0px 2px 1px 2px;">'.number_format($grand_due_amount, 2).'</td>
		</tr>';*/
		
/*	$html .= '<tr>
	<!--<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>-->
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>	
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>		
    <td colspan="3" style="text-align:left;padding: 0px 2px 1px 2px;">Remaining Balance</td>
	<td style="text-align:center;padding: 0px 2px 1px 2px;">'.number_format(($grand_total_amount - $grand_discount_amount - $grand_received_amount),2).'</td>
		</tr>';
	$html .= '<tr>		
    <td colspan="10" style="text-align:left;padding: 0px 2px 1px 2px;" ><hr></td>
   		</tr>
		<tr>		
    <td colspan="10" style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">DETAIL OF SERVICE CHARGE</td> 
   		</tr>	
		<tr>		
    <td colspan="10" style="text-align:left;padding: 0px 2px 1px 2px;" ><hr></td>
   		</tr>
		<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">S.No.</td>
	<td style="text-align:left;padding-left:4px;min-width:73px;">Service Category</td>
	<td style="text-align:left;padding-left:4px;min-width:119px;">Service Description</td>
	<td style="text-align:left;padding-left:4px;min-width:98px;">Service Amount</td>
	<td style="text-align:left;padding-left:4px;min-width:70px;">Quantity</td>
	<td style="text-align:left;padding-left:4px;min-width:60px;">Discount%</td>
	<td  style="text-align:left;padding-left:4px;min-width:107px;">Discount Amount</td>
	<td  style="text-align:left;padding-left:4px;">Total Amount</td>
	<td style="text-align:left;padding-left:4px;min-width:111px;">Recieved Amount</td>
	<td style="text-align:left;padding-left:4px;min-width:80px;">Due Amount</td>
		</tr>';*/
	
	/*$arrSV = $Db->getPatientServices($pno);
	//echo "<pre>";
	//print_r($arrSV);
	//echo "</pre>";
	$count = 0;
	if (count($arrSV) > 0)
	{
		for($i=0;$i<count($arrSV);$i++)
		{
			$count = $i + 1;
	$html .= '<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">'.$count.'</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">'.$arrSV[$i]['cat_name'].'</td>	
	<td  style="text-align:left;padding: 0px 2px 1px 2px;">'.$arrSV[$i]['service_name'].'</td>
	<td  style="text-align:right;padding: 0px 2px 1px 2px;">'.$arrSV[$i]['service_amount'].'</td>
	<td  style="text-align:center;padding: 0px 2px 1px 2px;">'.$arrSV[$i]['service_qty'].'</td>	
	<td  style="text-align:center;padding: 0px 2px 1px 2px;">'.$arrSV[$i]['service_discount_per'].'</td>	
	<td  style="text-align:center;padding: 0px 2px 1px 2px;">'.$arrSV[$i]['service_discount_amount'].'</td>	
	<td  style="text-align:center;padding: 0px 2px 1px 2px;">'.$arrSV[$i]['service_total_amount'].'</td>	
	<td style="text-align:center;padding: 0px 2px 1px 2px;">'.$arrSV[$i]['service_received_amount'].'</td>	
	<td style="text-align:center;padding: 0px 2px 1px 2px;">'.$arrSV[$i]['service_due_amount'].'</td>	
		</tr>';
		}
	}
	else
	{
		$html .= '<tr>
	<td colspan="9" style="text-align:left;padding: 0px 2px 1px 2px;"> No Service is selected</td>
		</tr>';
	}	*/
		/*$html .=' <tr>		
    <td colspan="10" style="text-align:left;padding: 0px 2px 1px 2px;" ><hr></td>
   		</tr>	
			<tr>
	<td colspan="10" style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;"><u>CONSULTANT FEE</u></td>

		</tr>
		<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">1</td>
	<td colspan="8" style="text-align:left;padding: 0px 2px 1px 2px;">Dr.Shazia(ipd)</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">500</td>
		</tr>
		<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>	
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>		
    <td colspan="3" style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">Total</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">500</td>
		</tr>
		<tr>		
    <td colspan="10" style="text-align:left;padding: 0px 2px 1px 2px;" ><br></td>
   		</tr>
		<tr>
	<td colspan="10" style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;"><u>DIAGNOSTICS CHARGES</u></td>
		</tr>
		<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">2</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">CBC</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>	
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>		
    <td colspan="3" style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp; </td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">400</td>
		</tr>
		<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">3</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">CREATINE</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>	
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>		
    <td colspan="3" style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp; </td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">240</td>
		</tr>
		<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>	
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>		
    <td colspan="3" style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">Total</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">600</td>
		</tr>
	<tr>
	<td colspan="10" style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;"><u>HOSPITAL CHARGES</u></td>
		</tr>
		<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">4</td>
	<td colspan="8" style="text-align:left;padding: 0px 2px 1px 2px;">room-a/c ward1</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">1000</td>
		</tr>
		<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">5</td>
	<td colspan="8" style="text-align:left;padding: 0px 2px 1px 2px;">service charges</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">240</td>
		</tr>
		<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>	
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>		
    <td colspan="3" style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">Total</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">1300</td>
		</tr>';*/
  /* $html .=	'</body></table>';
	echo $html;

	$dompdf = new DOMPDF();
	$dompdf->set_paper("A4","landscape");
	$dompdf->load_html($html);

	$dompdf->render();*/

	// The next call will store the entire PDF as a string in $pdf
	//$pdf = $dompdf->output();

	// write $pdf to disk, store it in a database or stream it
	// to the client.

	//file_put_contents("../../reports/dischargepatient_history-".$pno.".pdf", $pdf);
	
	//$Cn = $Client_Id. " / ". $EmailUserName; 
	// Now Finally Send Email Generated receipt to User
	//$TEU=$Email->ThankyouEmailToUser($email, $Gross_Amount, $Cn, $rdate, "pdf/Receipt-".$ReceiptId.".pdf");
	//$TEU=$Email->ThankyouEmailToUser($email, $DollarAmount, $Cn, $EmailUserName, $rdate, "pdf/Receipt-".$invoice_id.".pdf");
?>
<!--<br />

<form  target="_blank" action="printipd.php" method="post">
	<input type="hidden" id="invoice_no" name="invoice_no" value=<?php echo $pno; ?> style="margin-left:250px;" />
  <textarea style="display:none" name="txtprint"><?php echo $html; ?> </textarea>
  &nbsp;
 <input  type="submit" name="print" value="Print Receipt" class="btn btn-blue" style="margin-left:250px;"/>
</form>
</div>-->
