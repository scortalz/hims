<style>

body 
{
	width:80%;
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
 include realpath(".") .  "/currencyconvertor.php";
 include realpath(".") .  "/../dompdf/dompdf_config.inc.php";
 
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
<td colspan="2" style="text-align:center;padding: 0px 2px 1px 2px;" ><img src="img/logo.png" width="312" height="100">
<h3>NORTH NAZIMABAD,KARACHI</h3>
</td>
</tr>
</table>
<br/>

   <table width="100%" style="text-align:center;padding: 0px 2px 1px 2px;border: 1px solid; border-color: #0000;border-radius:20px;">
   <tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Admission No: <u>'.$Rs[0]['patient_reg_no'].'</u></td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Date/Time: <u>'.date('d-m-Y', strtotime($Rs[0]['creation_time'])).'/'.date('H:i', strtotime($Rs[0]['creation_time'])).'</u></td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Bed No: <u>101</u></td>
	</tr>
	<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">Patient Name:<u>'.$Rs[0]['patient_name'].'</u></td>
   
   		</tr>
		
		  <tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Age: <u>'.$Rs[0]['age'].'</u></td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Sex: <u>'.$Rs[0]['sex'].'</u></td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Contact: <u>'.$Rs[0]['phone'].'</u></td> 
   		</tr>
		
		 <tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Organization: <u>Private</u></td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >NIC NO: <u>'.$Rs[0]['nic_no'].'</u></td>
	
   		</tr>
		
		<tr>		
     <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Address: <u>'.$Rs[0]['address'].'</u></td>
	
   		</tr>
		
		<tr>		
     <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Advance Pay: <u>120</u></td>
	
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
    <td colspan="2" style="text-align:left;padding: 0px 2px 1px 2px;">Provisional Diagnosis:________________________________________</td>
		</tr>
		<tr>		
    <td colspan="2" style="text-align:left;padding: 0px 2px 1px 2px;">Provisional Diagnosis:_________________________________________</td>
		</tr>
		<tr>		
    <td colspan="2" style="text-align:left;padding: 0px 2px 1px 2px;">Final Diagosis 1).:_____________________________________________</td>
		</tr>
		 <tr>		
    <td colspan="2"  style="text-align:left;padding: 0px 2px 1px 2px;">Final Diagosis 2).:_____________________________________________</td> 
   		</tr>
		 <tr>		
    <td colspan="2"  style="text-align:left;padding: 0px 2px 1px 2px;">Final Diagosis 2).:_____________________________________________</td> 
   		</tr>
		 <tr>		
    <td colspan="2" style="text-align:left;padding: 0px 2px 1px 2px;">Consultant 1).:__________________________________________________</td> 
   		</tr>
		 <tr>		
    <td colspan="2" style="text-align:left;padding: 0px 2px 1px 2px;">Consultant 2).:___________________________________________________</td> 
   		</tr>
		<tr>		
    <td colspan="4" style="text-align:center;padding: 0px 2px 1px 2px;font-weight:bold;">CONSULTANTS MEMORANDUM</td> 
   		</tr>
	<tr>		
    <td colspan="3" style="text-align:left;padding: 0px 2px 1px 2px;" ><br></td>
	
   		</tr>	
	<tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Surgery Performed:____________________________</td>
	<td colspan="2"  style="text-align:left;padding: 0px 2px 1px 2px;" >Charges:______________</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Sign:______________________</td> 
   		</tr>
	<tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Delivery_NVD/Forceps/Vacc:______________________</td>
	<td colspan="2"  style="text-align:left;padding: 0px 2px 1px 2px;" >Charges:_______________</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Sign:_____________________</td> 
   		</tr>	
				
   </table>
   
   <br>
   
   <table width="100%" style="text-align:center;padding: 0px 2px 1px 2px;border: 1px solid; border-color: #0000;border-radius:20px;">
   <tr>		
    <td colspan="6" style="text-align:center;padding: 0px 2px 1px 2px;font-weight:bold;">DAILY CONSULTATIONS</td> 
   		</tr>
		<tr>		
    <td colspan="6" style="text-align:left;padding: 0px 2px 1px 2px;" ><br></td>
	
   		</tr>
   <tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Date</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Charges</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Sign</td> 
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Date:</td> 
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Charges</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Sign</td> 
   		</tr>	
		
		<tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
   		</tr>	
		
		<tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
   		</tr>
		
		<tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
   		</tr>
		
		<tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
   		</tr>
		
		<tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
   		</tr>
		
		<tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
   		</tr>
		
		<tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >&nbsp;</td> 
   		</tr>	
   </table>
   <br/>
   <table width="100%" style="text-align:center;padding: 0px 2px 1px 2px;">
	<tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Discharge:______________</td>
	<td colspan="2"  style="text-align:left;padding: 0px 2px 1px 2px;" >Date:______________</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Time:__________</td> 
   		</tr>
	<tr>		
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Remarks:________________________________________________</td>
   		</tr>				
   </table>
  
   <table width="100%">
   <tr>
   <td colspan="4" style="text-align:left;padding: 0px 2px 1px 2px;"><hr></td>
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
