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
//$rno = $_GET['p'];

$Rs = $Db->getDoctorVoucher($invoice_number);

/*echo "<pre>";
print_r($Rs);
echo "</pre>";*/
//exit;


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
    <td  style="text-align:left;padding: 0px 2px 1px 2px;" >Doctor Name: '.$Rs[0]['dr_name'].'</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Date/Time: '.date('d-m-Y', strtotime($Rs[0]['creation_time'])).'/'.date('H:i', strtotime($Rs[0]['creation_time'])).'</td>
	<td  style="text-align:left;padding: 0px 2px 1px 2px;" >Patient Name: '.$Rs[0]['patient_name'].'</td>
	</tr>
	<tr>
	<td style="text-align:left;padding: 0px 2px 1px 2px;">Amount:'.$Rs[0]['recievedamount'].'</td>
   <td style="text-align:left;padding: 0px 2px 1px 2px;">Share:'.(($Rs[0]['recievedamount']*70)/100).'</td>
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

	file_put_contents("invoice-".".pdf", $pdf);
	
	//$Cn = $Client_Id. " / ". $EmailUserName; 
	// Now Finally Send Email Generated receipt to User
	//$TEU=$Email->ThankyouEmailToUser($email, $Gross_Amount, $Cn, $rdate, "pdf/Receipt-".$ReceiptId.".pdf");
	//$TEU=$Email->ThankyouEmailToUser($email, $DollarAmount, $Cn, $EmailUserName, $rdate, "pdf/Receipt-".$invoice_id.".pdf");
?>
<br />

<form target="_blank" action="print.php" method="post">
	<?php /*?><input type="hidden" id="invoice_no" name="invoice_no" value=<?php echo $invoice_no; ?> style="margin-left:250px;" /><?php */?>
  <textarea style="display:none" name="txtprint"><?php echo $html; ?> </textarea>
  &nbsp;
 <input  type="submit" name="print" value="Print Receipt" class="btn btn-blue" style="margin-left:250px;"/>
</form>

