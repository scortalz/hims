<style>

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
</style>

<?php 
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
//echo $Rs[0]['refferedby'];


$AmountInWords="";
$AmountInWords = convert_number($Rs[0]['recievedamount']);
$rdate = date('D M d h:i:s Y', time());
$lessdiscount = ( ( $Rs[0]['totalamount'] * $Rs[0]['discount'] ) / 100 ); 

$html='<body  style=" font-size: 14px;width:100%;margin-right:auto;margin-left:auto">
<table  width="100%" style="padding: 0px 2px 1px 2px;"  >
<tr>
<td colspan="2" style="text-align:center;padding: 0px 2px 1px 2px;" ><img src="img/logo.png" width="292" height="80">
<h3>NORTH NAZIMABAD,KARACHI</h3>
</td>
</tr>
<tr>
<td colspan="2" style="text-align:center;padding: 0px 2px 1px 2px;font-weight:bold" >
<u>ADMITTED PATIENT BILL(UNDISCHARGED)</u>
</td>
</tr>
</table>

   <table width="100%" style="text-align:center;padding: 0px 2px 1px 2px;border: 1px solid; border-color: #0000;border-radius:20px;">
   <tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Patient Id: '.$Rs[0]['patient_reg_no'].'</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Admission Date: '.date('d-m-Y', strtotime($Rs[0]['creation_time'])).'&nbsp;&nbsp;'.date('H:i', strtotime($Rs[0]['creation_time'])).'</td>
	</tr>
	<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">Patient Name:'.$Rs[0]['patient_name'].'</td>
    <td style="text-align:left;padding: 0px 2px 1px 2px;">Discharge Date:</td>
   		</tr>
		  <tr>	
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Contact No: '.$Rs[0]['phone'].'</td> 	  	
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Age: '.$Rs[0]['age'].'</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Sex: '.$Rs[0]['sex'].'</td>
   		</tr>
		 <tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Physician:'.$Rs[0]['dr_name'].'</td>
	</tr>
		<tr>		
     <td  style="text-align:left;padding: 0px 2px 1px 2px;" >PVT/Company: Private</td>
   		</tr>
   </table>
     
   <table width="100%">
   <tr>
   <td colspan="4" style="text-align:left;padding: 0px 2px 1px 2px;"><hr></td>
   </tr>
   
   </table>
   
   <br>
   
 <table width="100%" style="text-align:center;padding: 0px 2px 1px 2px;border: 1px solid; border-color: #0000;border-radius:20px;">
   <tr>		
    <td colspan="10" style="text-align:left;padding: 0px 2px 1px 2px;font-weight:bold;">DETAIL OF PAYMENT SCHEDULE </td> 
   		</tr>
		<tr>		
    <td colspan="10" style="text-align:left;padding: 0px 2px 1px 2px;" ><br></td>
   		</tr>
		<tr>		
    <td style="text-align:left;padding: 0px 2px 1px 2px;">S.No.</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">Receipt Id:</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">RecvDDT:</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">Narration:</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">Total Amount</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">Dis Per</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">Dis Amt</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">Grand Total</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">Recvd Amount</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">Billed Amount</td>
		</tr>
		<tr>		
    <td style="text-align:left;padding: 0px 2px 1px 2px;">1</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">'.$invoice_no.'</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">'.date('d-m-Y', strtotime($Rs[0]['creation_time'])).'&nbsp;'.date('H:i', strtotime($Rs[0]['creation_time'])).'</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">Advanced Deposit</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">500</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;"> 0</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">0</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">500 </td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">500 </td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">0</td>
		</tr>
		<tr>		
    <td colspan="10" style="text-align:left;padding: 0px 2px 1px 2px;" ><hr></td>
   		</tr>
		<tr>		
    <td style="text-align:left;padding: 0px 2px 1px 2px;"></td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;"></td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;"></td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;"> </td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">2000</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;"> </td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">0</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;"> </td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">2000 </td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">0</td>
		</tr>
		<tr>		
    <td colspan="10" style="text-align:left;padding: 0px 2px 1px 2px;" ><br></td>
   		</tr>
	<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>	
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>		
    <td colspan="3" style="text-align:left;padding: 0px 2px 1px 2px;">Remaining Balance</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">0</td>
		</tr>	
		<tr>		
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
	<td colspan="8" style="text-align:left;padding: 0px 2px 1px 2px;">Service Description:</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">Total Amount:</td>
		</tr>	
			<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>	
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>		
    <td colspan="3" style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp; </td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
		</tr>
			<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>	
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>		
    <td colspan="3" style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp; </td>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">&nbsp;</td>
		</tr>	
		<tr>		
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
