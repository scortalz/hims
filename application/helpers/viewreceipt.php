<?php 
error_reporting(0);
include realpath(".") . "/mydb.php";
include realpath(".") .  "/currencyconvertor.php";
include realpath(".") .  "/../dompdf/dompdf_config.inc.php";
 //include realpath(".") .  "/../dompdf/dompdf_config.inc.php";


// Include Required Classes

$Db = new Db();

//$Email = new Email();
$rno = $_GET['r'];

$Rs = $Db->getReceiptInformation($rno);

/*echo "<pre>";
print_r($Rs);
echo "</pre>";*/
//exit;

$invoice_id = $Rs[0]['invoice_id'];
$invoice_no = $Rs[0]['invoice_number'];
$salute = $Rs[0]['salutation'];
//echo $Rs[0]['refferedby'];
$today = date('Y-m-d', time());
$arrToken = $Db->getTodayToken ($Rs[0]['doctor_id'], $today);
if (count($arrToken) > 0 )
{
	$TokenNumber = $arrToken[0]['token'];	
}

// Get Token OPD Room
$arrTokenRoom = $Db->getTokenOPDRoom ($Rs[0]['doctor_id']);
if (count($arrTokenRoom) > 0 )
{
	$Room = $arrTokenRoom[0]['room_name'];	
}
else
{
	$Room = "ER";
}


$AmountInWords="";
$AmountInWords = convert_number($Rs[0]['recievedamount']);
$rdate = date('D M d h:i:s Y', time());
$lessdiscount = ( ( $Rs[0]['totalamount'] * $Rs[0]['discount'] ) / 100 ); 

$selected_service = "GENERAL OPD ";

if ($Rs[0]['selected_services'] > 0 )
{
	$arr_ss_map = $Db->getInvoiceMappingService($invoice_no);
}

if ($Rs[0]['selected_services'] > 0 )
{
	$arr_ss = $Db->getInvoiceSelectedService($Rs[0]['selected_services']);	
	$selected_service = $arr_ss[0]['name'];
	$amount = $arr_ss[0]['corporatecharges'];
}
else
{
	$amount = number_format($Rs[0]['totalamount'], 2);	
}
$html='<body  style=" font-size: 14px;width:100%;margin-right:0;margin-left:0">
<table  width="100%">

<tr style="vertical-align:top;">
    <td><img class="hidedata" style="margin-left:100px;" src="../helpers/img/logo_only.PNG"></td><td><h2>INCISIVESOFT &nbsp;</h2></td>
  </tr>

	<tr>
		<td style="text-align:left;" ><b>Token: '.$TokenNumber.'</b></td>
		<td style="text-align:right;">Printed On:'.date('d-m-Y H:i:s', time()).'</td>
	</tr>
	<tr>
		<td style="text-align:left;" ><b>OPD Room # '.$Room.'</b></td>
	</tr>
    </table>
   <table width="100%" style="border: 1px solid; border-color: #0000;border-radius:20px;">
   <tr>		
    <td style="text-align:left;" >RECEIPT # : '.$invoice_no.'</td>
	<td  colspan="3" style="text-align:right;">Date: '.date('d-m-Y', strtotime($Rs[0]['creation_time'])).'</td>
	</tr>
	<tr>
	<td style="text-align:left;">REGISTRATION # : '.$Rs[0]['patient_reg_no'].'</td>
    
   <td colspan="3" style="text-align:right;">Time: '.date('H:i', strtotime($Rs[0]['creation_time'])).'</td>
   		</tr>
		  <tr>		
    <td style="text-align:left;">Patient : '.$salute. ' '. $Rs[0]['patient_name'].'</td> 
	<td colspan="3" style="text-align:right;padding: 0px 2px 1px 2px; ">Sex : '.$Rs[0]['sex'].' </td>	 
   		</tr>
		 <tr>		
		<td style="text-align:left;padding: 0px 2px 1px 2px; "> F / H: '. $Rs[0]['father_husbandname'].'</td> 
	<td colspan="4" style="text-align:right;padding: 0px 2px 1px 2px; ">Age : '.$Rs[0]['age'].' Y </td> 
   		</tr>
		<tr>		
    <td style="text-align:left;padding: 0px 2px 1px 2px; ">OPD DOCTOR : '.$Rs[0]['dr_name'].'</td> 
	<td colspan="3" style="text-align:right;padding: 0px 2px 1px 2px;"> Cell#: '.$Rs[0]['p_phone'].' </td> 
   		</tr>
	
   </table>
   
 <table width="100%" style="text-align:center;padding: 0px 2px 1px 2px;border: 1px solid; border-color: #0000;border-radius:20px;">
   <tr>		
    <td style="text-align:left;padding: 0px 2px 1px 2px;">S.No </td>
	<td style="text-align:left;padding: 0px 2px 1px 2px; "> CHARGES DESCRIPTION</td>
    <td colspan="2" style="text-align:left;padding: 0px 2px 1px 2px; ">AMOUNT</td>
  
   		</tr>';
		$counter = 1;
		$html .= '<tr> 		
 					<td style="text-align:left;padding: 0px 2px 1px 24px;">'.$counter.'</td> 
					<td style="text-align:left;padding: 0px 2px 1px 2px;"> '.$selected_service.'</td>
 					<td colspan="2" style="text-align:left;padding: 0px 2px 1px 25px;">'.number_format($amount).'</td>
   				  </tr>';
		$counter = 2;
		for($i=0; $i<count($arr_ss_map); $i++)
		{
			
			$service = $arr_ss_map[$i]['name'];
			$amount = $arr_ss_map[$i]['service_amount'];
			$html .= '<tr> 		
 					   	<td style="text-align:left;padding: 0px 2px 1px 24px;">'.$counter.'</td> 
						<td style="text-align:left;padding: 0px 2px 1px 2px;"> '.$service.'</td>
 						<td colspan="2" style="text-align:left;padding: 0px 2px 1px 25px;">'.number_format($amount).'</td>
   						</tr>';
			$counter++;
		}

	$html .= '	
		 <tr>		
    <td colspan="4" style="text-align:left;padding: 0px 2px 1px 2px;"><hr></td> 
	
   		</tr>
		
		<tr>		
    <td style="text-align:left;padding: 0px 2px 1px 2px; ">Total Bill </td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;"> Discount Amount</td>
    <td style="text-align:left;padding: 0px 2px 1px 2px; ">Recieved</td>
   <td style="text-align:left;padding: 0px 2px 1px 2px; ">Due Amount</td>
   		</tr>
		
		
		<tr>		
    <td style="text-align:left;padding: 0px 2px 1px 10px; ">'.number_format($Rs[0]['totalamount'], 2).' </td>
	<td style="text-align:left;padding: 0px 2px 1px 21px; ">'.number_format($lessdiscount, 2).'</td>
    <td style="text-align:left;padding: 0px 2px 1px 16px; ">'.number_format($Rs[0]['recievedamount'], 2).'</td>
   <td style="text-align:left;padding: 0px 2px 1px 25px; ">'.number_format($Rs[0]['dueamount'],2).'</td>
   		</tr>
		
		<tr>		
    <td style="text-align:left;padding: 0px 2px 1px 2px; "><br/> </td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;"> <br/></td>
    <td style="text-align:left;padding: 0px 2px 1px 2px; "><br/></td>
   <td style="text-align:left;padding: 0px 2px 1px 2px; "> <br/></td>
   		</tr>
		
		<tr>
		<td colspan="2" style="text-align:center;padding: 0px 2px 1px 2px; ">** This is computer generated slip, No signature required **</td>
		<td colspan="2" style="text-align:center;padding: 0px 2px 1px 2px; ">Created By: '.$Rs[0]['careof'].'</td>
		</tr>
			
   </table>
	<b>Note:</b> Service charges will be taken separately.
   <table width="100%">
   <tr>
   <td colspan="4" style="text-align:left;padding: 0px 2px 1px 2px;border-bottom:2px dotted #000000;-moz-border-bottom: #000; -webkit-border-bottom: #000;width:100%;float:left;"></td>
   </tr>
   </table>
   
</body>';
	echo $html;

	$dompdf = new DOMPDF();
	$dompdf->load_html($html);

	$dompdf->render();

	// The next call will store the entire PDF as a string in $pdf
	$pdf = $dompdf->output();

	// write $pdf to disk, store it in a database or stream it
	// to the client.

	file_put_contents("invoice-".$invoice_no.".pdf", $pdf);
	
	//$Cn = $Client_Id. " / ". $EmailUserName; 
	// Now Finally Send Email Generated receipt to User
	//$TEU=$Email->ThankyouEmailToUser($email, $Gross_Amount, $Cn, $rdate, "pdf/Receipt-".$ReceiptId.".pdf");
	//$TEU=$Email->ThankyouEmailToUser($email, $DollarAmount, $Cn, $EmailUserName, $rdate, "pdf/Receipt-".$invoice_id.".pdf");
?>
<br />

<form  target="_blank" action="print.php" method="post">
	<input type="hidden" id="invoice_no" name="invoice_no" value=<?php echo $invoice_no; ?> style="margin-left:250px;" />
  <textarea style="display:none" name="txtprint"><?php echo $html; ?> </textarea>
  &nbsp;
 <input  type="submit" name="print" value="Print Receipt" class="btn btn-blue" style="margin-left:250px;"/>
</form>
</div>
