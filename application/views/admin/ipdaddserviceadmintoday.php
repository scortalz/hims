<style>
.error{
	font-weight:bold;
	color:#FF0000;
	margin-top:5px;
	/*padding: 0 0 0 131px;*/
}

.rdelete {
	/*background: url("../images/btn-small.png") no-repeat scroll right top transparent;*/
	background: url("template/images/deletesrv.png") no-repeat scroll center top transparent;
    color: #000000;
    display: block;
    padding: 9px 0;
    text-align: center;
	width:20px;
	cursor: pointer;
	font-family: Arial,Helvetica,sans-serif;
	border: 0px solid #EF7C46;
	font-weight:bold;
	text-decoration:none;
	border-style: none;
}
/* template layout */
.awLayout {
	font-family: Verdana; /* font name */
	font-size: xx-small; /* font size */
	width: 100%;
	height: 100%;
}

.awHeaderRow {
	background-color: #1F1C6B;
} 
.awContentTable {
	font-family: Verdana; /* font name */
	font-size: xx-small; /* font size */	
	width: 100%;
	height: 100%;	
}
.awMenuColumn {
	background-color: #ffffff; /* background color */
	width: 160px;
	vertical-align: top;
	padding: 4px;
	border-right:1px solid #FF7A01;	
	height:100%!important;
}
.awMenuColumn a{ 
	color:#091C44!important;
	padding:2px 10px 2px 10px;
	display:block;
	font-size:11px; 
	text-decoration:none
}
.awMenuColumn a:hover{
	background-color: #F76204; /* background color */
	color:#FFFFFF!important; 
}
.awContentColumn {
	background-color: inherit; /* background color */
	vertical-align: top;
	padding: 10px;
}
.awFooterRow {
	background-color: #ffffff; /* background color */
	color: #FFFFFF; /* footer font color */	
	padding: 2px;
	border-right:1px solid #FF7A01;	
}

.awFooterText {
	font-family: Verdana; /* font name */
	font-size: xx-small; /* font size */
	color:#F65A01; font-weight:bold	
}

/* main table */
.awTable {
	width: inherit; /* table width */	
	color: inherit; /* text color */
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	border: 0px outset; /* border */
	border-collapse: collapse;
	box-shadow: 2px 5px 2px rgb(55,158,196) ;
}

/* main table data cells */
.awTable td {
	padding: 5px; /*8px 5px 8px; /* cell padding */
	border: 1px solid; /* cell spacing */
	border-color: #CCCCCC;  /* table background color */
	vertical-align:middle;
}

/* main table row color */
.awTableRow {
	background-color: #FFFFFF;  /* alt row color 1 */
}

/* main table alternate row color */
.awTableAltRow {
	background-color: #E7E7E5; /* alt row color 2 */	
}

</style>

<?php
	include realpath(".") . "/application/helpers/mydb.php";
	$Db = new Db();
?>
<!--<form method="post" id="frmmanual_invoice" name="frmmanual_invoice">-->
	<input type="hidden" id="is_full_payment" name="is_full_payment" />
  <br>
  <table class="awTable" style="width:100%">
    <tr>
      <td colspan="4"><!--<img src="images/invoices.png" border="0" >&nbsp;&nbsp;-->
		<div style="float: right;">
        	<input type="button" name="btndischarge" id="btndischarge" value="Discharge Patient Now" class="btn btn-green" title="Click to discharge patient" style="padding-right:10px;" />
 			<input type="button" name="make_more_invoice" id="make_more_invoice" value="Reset Invoice" class="btn btn-blue" title="Click to reset"/>
            <input type="button" name="btnviewpayhistory" id="btnviewpayhistory" value="View Payment History" class="btn btn-blue" title="Click to View Patient Payment History" style="padding-right:10px;" />
		</div>
        <!--disabled="disabled" -->
		</td>
    </tr>
    <tr>
          <td>
           <label><b><?php echo get_phrase('select_patient');?></b></label>
           <div class="controls">
            <select class="chzn-select" name="patient_id" tabindex="1" style="width: 350px!important;" id="patiend_id">
                <?php 
                $this->db->order_by('account_opening_timestamp' , 'asc');
                $patients	=	$this->db->get('patient')->result_array();
                foreach($patients as $row):
                ?>
            <option value="<?php echo $row['patient_reg_no'];?>"><?php echo $row['patient_reg_no']. ' - ( ' . $row['name']. ' - ' . $row['phone']. ')';?></option>
                <?php
                endforeach;
                ?>
            </select> 
          </div> 
    </td>
     <td>
        <label class="control-label"><b><?php echo get_phrase('registration_number');?></b></label>
        <input type="text"  name="patient_reg_no" id="patient_reg_no" readonly="readonly" value="<?php echo $row['patient_reg_no']; ?>"/>
    </td>  
    <td>
    	<label><b><?php echo get_phrase('Referred_By');?></b></label>
        <input type="text"  name="refferedby" id="refferedby" readonly="readonly" value="<?php echo $row['refferedby'].$row['med_card_no']; ?>"/>
    </td>
     <td>
    	<label><b><?php echo get_phrase('Date');?></b></label>
        <input type="text"  name="adm_date" id="adm_date" readonly="readonly" value="<?php echo date('d-m-Y H:i', $row['account_opening_timestamp']); ?>"/>
    </td>
      </tr>
      <tr>
      	<td>
        	<div class="control-group">
               <label class="control-label"> <b><?php echo get_phrase('Physician');?></b></label>
                <div class="controls">
                    <select class="chzn-select" name="doctor_id" id="doctor_id" style="width: 310px!important;">
                        <?php 
                        //$this->db->order_by('account_opening_timestamp' , 'asc');
                        $doctors	=	$this->db->get('doctor')->result_array();
                        foreach($doctors as $row2):
                        ?>
                            <option value="<?php echo $row2['doctor_id'];?>" <?php if($row2['doctor_id']==$row['doctor_id'])echo 'selected';?>>
                                <?php echo $row2['name'];?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
        </td>
        <td>
        	<label><b><?php echo get_phrase('Phone');?></b></label>
           <input type="text"  name="phone" id="phone" readonly="readonly" value="<?php echo  $row['phone']; ?>"/>
        </td>
        
        <td>
        <label class="control-label"><b><?php echo get_phrase('Age_/_Sex');?></b></label>
        <input type="text"  name="age_sex" id="age_sex" readonly="readonly" value="<?php echo $row['age']. ' / ' .$row['sex'] ; ?>"/>
    </td> 
      </tr>
  </table>


<br />
<div class="box">
	<div class="box-header">

<table style="width:100%" id="tblservice_catalog" name="tblservice_catalog" border="1" class="awTable">
		<thead>
		<tr style="height:30px!important;">
        	<th align="center" style="color:#FFF;">Category</th>
			<th align="center" style="color:#FFF;">Service Name</th>
			<th align="center" style="color:#FFF;">Service Amount</th>
            <th align="center" style="color:#FFF;">Qty</th>
			<th align="center" style="color:#FFF;">Discount (%)</th>
   			<th align="center" style="color:#FFF;">Disc.Amount</th>
			<th align="center" style="color:#FFF;">Total Amount</th>
            <th align="center" style="color:#FFF;">Received Amount</th>
            <th align="center" style="color:#FFF;">Due Amount</th>
            <th align="center" style="color:#FFF;">Action</th>
		</tr>
		</thead>
		<tbody>
			<tr class="mytr-data">
            <td style="width: 100%;">
                <?php
					$GAS = array();
					$GAS = $Db->GetAllCategory();
					if(count($GAS)>0) 
					{ 
						?>
						<select name="categoryname" id="categoryname" style="width: 204px;" class="chzn-select">
                  		<?php
						foreach ($GAS as $value) 
						{ 
							$diagnosticserviceid= $value['diagnostictype_id'];
							$categoryname = $value['name'];
							if ($named != $value['name'])
										{
				?>
                  			<option id="<?php echo $categoryname; ?>" name="<?php echo $categoryname; ?>" value="<?php echo $diagnosticserviceid; ?>"><?php echo $categoryname; ?>
                            </option>
                            
                  <?php $named = $value['name'];}} ?>
				  			
                		</select>
				<?php
					}
			  ?>			
            </td>
            <td id="div_services">
			<?php $GAS = array();
			$GAS = $Db->GetservicenameForInvoice(2);
			if(count($GAS)>0) 
			{ 
			?>
        	<select name="ServiceName" id="ServiceName" style="width: 200px;" class="chzn-select">
			<?php
				foreach ($GAS as $value) 
				{ 
						$serviceid= $value['diagnosticservice_id'];
						$servicename = $value['name'];
						
			?>
						<option value="<?php echo $serviceid; ?>"><?php echo $servicename; ?></option>
						
			<?php  	} ?>
						
					</select>
			<?php
				}
			?>		</td>
			<td align="center" >
				
				<input type="text"  class="txtInput" id="serviceprice" name="serviceprice" style="width: 70px; text-align:right;" maxlength="6" />
				<label id="errorserviceprice" style="display:none;" class="error"></label>
			</td>
            <td align="center">
				<input type="text"  class="txtInput" id="qty" name="qty" style="width: 40px; text-align:right;" maxlength="2" value="1"/>
				<label id="errorqty" style="display:none;" class="error"></label>
			</td>
			<td align="center">
				
				<input type="text" id="discountper" name="discountper" value="" style="width: 70px;text-align:right;" maxlength="2" class="txtInput" />
				<label id="errordiscountper" style="display:none;" class="error"></label>
			</td>
            <td align="center">
				
				<input type="text" id="discountamt" name="discountamt" value="" style="width: 70px;text-align:right;" maxlength="8" class="txtInput" />
				<label id="errordiscount" style="display:none;" class="error"></label>
			</td>
            
            <td  align="center">
				
				<input type="text"  class="txtInput" id="totalamount" name="totalamount" style="width: 80px; text-align:right;" maxlength="6" readonly/>
				<label id="errorserviceprice" style="display:none;" class="error"></label>
				
				
			</td>
            <td  align="center">
				
				<input type="text"  class="txtInput" id="received" name="received" style="width: 80px; text-align:right;" maxlength="6" value="0"/>
				<label id="errorreceived" style="display:none;" class="error"></label>
			</td>
			<td  align="center">
				
				<input type="text" id="dueamount" name="dueamount" value="" readonly style="width: 100px;text-align:right;" class="txtInput" />
				
			</td>
            <td align="right" >
				<input type="button" id="addmore" name="addmore" value="Add to Invoice" title="Add to Invoice" class="btn btn-green"/> 
			</td>
           </tr>
		</tbody>
	</table>
    </div>
</div>
	<div id="NoServiceSelected" class="box-header"><b> No Service Selected</b></div>
	<div id="selectedservices" class="box-header">
	<table id="tblservice_catalog_detail" width="100%" class="awTable">
		<thead>
			<tr style="height:20px!important;">
					<!--<th align="center" style="border: 1px solid ##B7B7B7; background-color:#CDCDCD;">Sr. #</th>-->
                    <th align="center" style="border: 1px solid ##B7B7B7; background-color:#CDCDCD;width:12%;">Category</th>
					<th align="center" style="border: 1px solid ##B7B7B7; background-color:#CDCDCD;width:20%;">Serivce Name</th>
					<th align="center" style="border: 1px soli##B7B7B7;background-color:#CDCDCD;width:10%;">Service Amount </th>
                    <th align="center" style="border: 1px soli##B7B7B7;background-color:#CDCDCD;width:5%;">Qty </th>
					<th align="center" style="border: 1px solid ##B7B7B7;background-color:#CDCDCD;width:5%;">Discount (%)</th>
                    <th align="center" style="border: 1px solid ##B7B7B7;background-color:#CDCDCD;width:5%;">Disc. Amount</th>
					<th align="center" style="border: 1px solid ##B7B7B7;background-color:#CDCDCD;width:10%;">Total Amount</th>
                     <th align="center" style="border: 1px solid ##B7B7B7;background-color:#CDCDCD;width:10%;">Received Amount</th>
                    <th align="center" style="border: 1px solid ##B7B7B7;background-color:#CDCDCD;width:10%;">Due Amount</th>
					<th align="center" style="border: 1px solid ##B7B7B7;background-color:#CDCDCD;width:10%;">Action</th>
			</tr>
			</thead>
			<!--<tr style="display:block;" class="mytr-inv-data"></tr>-->
	</table>
	</div>
    <br />


	<div id="invoicetotal">
		<table align="right">
			<tr>
				<td><label class="total" style="vertical-align: middle!important;width: 100px;"><b>Total Amount:</b></label></td>
                
				<td><input type="text" style="text-align: right;width: 100px;padding-right:10px;" id="txttotalinvoicecharges" name="txttotalinvoicecharges"  readonly/><b><label id="totalinvoicecharges" class="total" ></label></b></td>
			<!--</tr>
            <tr>-->
				<td><label class="total"><b>Total Discount:</b></label></td>
                
				<td>
                	<input type="text" id="txtdiscount" name="txtdiscount" readonly style="width: 100px;text-align:right;padding-right:10px;"/>
                    <b>
                    	<label id="txtdiscount" class="total" style="text-align: right; border:none!important;"></label>
                    </b></td>
			<!--</tr>
            
			<tr>-->
				<td><label class="total"><b>Received Amount:</b></label></td>
				<td><input type="text" id="total_paid" name="total_paid" class="total" style="width: 100px;text-align:right; font-weight:bold;font-size:11px;padding-right:10px;" maxlength="8" readonly tabindex="999" value="0"></td>
			<!--</tr>
			
			<tr>-->
				<td><label class="total"><b>Due Amount:</b></label></td>
				<td><input type="text" id="txtdueamount" name="txtdueamount"  readonly style="width: 100px;text-align:right;padding-right:10px;"/><!--<b><label id="txtdue" class="total" style="vertical-align: middle;"></label></b>--></td>
			</tr>
		</table>
		</div>
        <br />
        <br />
        <br />
       <!-- Old  Text Boxes of Invoice-->
       
        <table align="right">
			<tr>
		<td><label class="total" style="vertical-align: middle!important;width: 130px;"><b>Total Invoice Amount:</b></label></td>
                
		<td><input type="text" style="text-align: right;width: 100px;padding-right:10px;" id="txttotalinvoiceamount" name="txttotalinvoiceamount"  readonly/><b>
        <label id="totalinvoiceamount" class="total" ></label></b></td>
			<!--</tr>
            
			<tr>-->
				<td><label class="total"><b>Invoice Received Amount:</b></label></td>
				<td><input type="text" id="invoicereceivedamount" name="total_paid" class="total" style="width: 100px;text-align:right; font-weight:bold;font-size:11px;padding-right:10px;" maxlength="8" readonly tabindex="15" value="0"></td>
			<!--</tr>-->

		</table>
	<br />

    <div style="float:left;">
	  	<input type="submit" id="btnGenerateInvoice" name="btnGenerateInvoice" value="Generate Invoice" class="btn btn-blue"/>
	  </div>
	&nbsp;<div id="ajaxLoaderDone" style="display:none;padding-left:420px;"><img src="images/process.gif" alt="loading..."></div>
<script type="text/javascript">
$(document).ready(function(e) {
	
	// On page load
	/*var cat_id = 2;
	
	jQuery.ajax({
	type: "POST",
	url: "<?php echo base_url();?>/application/helpers/selectedservices.php",
	data: ({post_did: cat_id}),
		success: function(response)	
		{
			jQuery("#div_services").html(response);
			
		}
	});	*/
 	
    // When-Changed-Service-Type
	jQuery("select[name='ServiceName']").change(function()
	{
		var service_id = $("#ServiceName").val();
		//alert(service_id);
		$('#serviceprice').val('');
		$('#discountper').val('');
		$('#discountamt').val('');
		$('#received').val('');
		$('#totalamount').val('');
		$('#dueamount').val('');
		jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url();?>/application/helpers/getservicepricediag.php",
		data: ({post_service_id: service_id}),
			success: function(response)	
			{
				//alert(response);
				jQuery("#serviceprice").val(response);
				jQuery("#totalamount").val(response);
				jQuery("#dueamount").val(response);
				jQuery("#serviceprice").focus();
			}
		});	
 	});
	
	$("#make_more_invoice").click(function()
	{
		window.location = 'index.php?admin/ipdaddservice';	
	});
	$("#btnviewpayhistory").click(function()
	{
		var p = $("#patient_reg_no").val();
		$(location).attr('href',"application/helpers/admittedpatientpaymenthistory.php?r="+p);
		//window.location = 'application/helpers/admittedpatientpaymenthistory.php&MR=' + p;	
	});
	// Add New Row in Service Detail Catalog
	$("#addmore").click(function()
	{
		
		if ($('#serviceprice').val() == '') {
			$('#errorserviceprice').show();
			$('#errorserviceprice').text('Required');
		  	return false;
		}
		else
		{
			$('#errorserviceprice').hide();
			$('#errorserviceprice').text(''); 
		}
		
		if ($('#serviceprice').val() == 0) {
			$('#errorserviceprice').show();
			$('#errorserviceprice').text('Not Allowed');
		  	return false;
		}
		else
		{
			$('#errorserviceprice').hide();
			$('#errorserviceprice').text(''); 
		}
		
		if ($('#qty').val() == '' || $('#qty').val() <= 0 ) {
			$('#errorqty').show();
			$('#errorqty').text('Required'); 	
			$('#qty').focus();
		  	return false;
		}
		else
		{
			$('#errorqty').hide();
			$('#errorqty').text(''); 
		}
		
		if (isNaN(Number( $('#serviceprice').val()) )  )
		{
			$('#errorserviceprice').show();
			$('#errorserviceprice').text('Invalid Price');
			$('#serviceprice').focus();
		  	return false;
		}
		else
		{
			$('#errorserviceprice').hide();
			$('#errorserviceprice').text(''); 
		}
					
		var service_price = parseFloat(($('#serviceprice').val() * $('#qty').val() ) );
		var service_discount = $('#discount').val();
		var s_price = $('#serviceprice').val();
		if (service_price < service_discount && s_service_type_id != 99)
		{
			jQuery("#errordiscount").show();
			jQuery('#errordiscount').text('Discount not more than the service price');
			jQuery("#errordiscount").focus();
			return false;
		}
		else
		{
			jQuery("#errordiscount").hide();
			jQuery('#errordiscount').text('');
		}
		
		if (s_price <= 0 && s_service_type_id != 99 )
		{
			jQuery("#errorserviceprice").show();
			jQuery('#errorserviceprice').text('Required');
			jQuery("#serviceprice").focus();
			return false;
		}
		else
		{
			jQuery("#errorserviceprice").hide();
			jQuery('#errorserviceprice').text('');
		}
		
		// add new row to table using addTableRow function
		jQuery("#tblservice_catalog_detail").show();
		$('#NoServiceSelected').html('<b>Selected Service(s)</b>');
		$('#invoicetotal').show();
		addTableRow();
		// prevent button redirecting to new page
		return false;
	});

	function addTableRow() {		
				
				var selected_service = "";
				var s_service_price;
				var s_service_qty;
				var s_service_discount;
				var s_service_total_charges;
				var appendTxt = "";
				s_service_type = $('#ServiceName :selected').text(); 
				s_service_qty = $('#qty').val();
				s_service_price =  parseFloat($('#serviceprice').val() * s_service_qty); 
				s_service_dis_per = parseFloat($('#discountper').val());
				s_service_dis_amt = parseFloat($('#discountamt').val());
				s_service_rec_amt = parseFloat($('#received').val());
				s_service_due_amt = parseFloat($('#dueamount').val());
				s_service_dis_amt = parseFloat($('#discountamt').val());
				s_service_discount = parseFloat(($('#discount').val()));
				s_service_total_charges = parseFloat($('#totalamount').val()) ;
				csp_s_service_price =  parseFloat($('#serviceprice').val() );//.toFixed(2) ; 
				csp_s_service_total_charges = ((csp_s_service_price) - ($('#discountamt').val()));//.toFixed(2);
				s_service_category = $('#categoryname :selected').text();
				s_service_category_id = $('#categoryname :selected').val();
				s_service_type = $('#ServiceName :selected').text();
				
				var s_service_type_Index = $('#ServiceName :selected').index();
				
				// new changes
				var s_service_type_id = $('#ServiceName :selected').val();
				// end new changes
				
				var count = $(".mytr-inv-data").index()+1;
					
var appendTxt = "<tr class='mytr-inv-data'><td id='cat_id' style='display:none'>"+s_service_category_id+"</td><td style='width: 5%;'>"+ s_service_category  + "</td><td id='service_id'  style='display:none'>"+ s_service_type_id  + "</td>  <td style='width: 12%;'>"+ s_service_type  + "</td><td style='width: 5%;' align='right'  id='s_service_price' name='s_service_price' class='current_service_price'>" + parseFloat(s_service_price) + "</td><td style='width: 5%;'  align='right' name='s_service_qty' id='s_service_qty'>" + s_service_qty + "</td><td style='width: 5%;'  align='right' name='s_service_dis_per' id='s_service_dis_per'>" + s_service_dis_per + "</td><td style='width: 5%;' align='right' class='discount_amount' name='discount_amount' id='discount_amount'>" + parseFloat(s_service_dis_amt) + "</td><td style='width: 6%;' align='right' class='total_charges' id='total_charges' name='total_charges'>" + parseFloat(s_service_total_charges) + "</td><td style='width: 8%;' align='right' class='received_amt' id='received_amt'>" + parseFloat(s_service_rec_amt) + "</td><td style='width: 8%;'  align='right' class='due_amt' id='due_amount'>" + parseFloat(s_service_due_amt).toFixed(2) + "</td><td align='center'><a class='rdelete' onclick ='delete_user($(this))'></a></td></tr>";
				$("#tblservice_catalog_detail tr:last").after(appendTxt);
				$("#tblservice_catalog_detail tr:last").hide().fadeIn('slow');
				
				var sum = 0;
				$('.total_charges').each(function() 
				{
					 sum += parseFloat($(this).text());
				});
				
				//$('#totalinvoicecharges').text(sum);
				//$('#nettotalinvoicecharges').text(sum);
				
				$('#txttotalinvoicecharges').val(sum);
				//$('#txtnettotalinvoicecharges').val(sum);
				
				var sum = 0;
				$('.discount_amount').each(function() 
				{
					 sum += parseFloat($(this).text());
				});
				$('#txtdiscount').val(sum);
				
				var sum = 0;
				$('.received_amt').each(function() 
				{
					 sum += parseFloat($(this).text());
				});
				$('#total_paid').val(sum);
				
				var sum = 0;
				$('.due_amt').each(function() 
				{
					 sum += parseFloat($(this).text());
				});
				$('#txtdueamount').val(sum);
				/*
				$('#discountper').val('');
				$('#discountamt').val('');
				$('#received').val('');
				$('#dueamount').val('');
				$('#discountamt').val('');
				$('#discount').val('');
				$('#totalamount').val('') ;
				$('#serviceprice').val('');
				*/
			}
		// End Add New Row...	
	
		// On Change Service Amount
		$('#serviceprice').blur(function(){
		
		//alert ($('#txtdollarrate').val());
		var s_service_type_id = $('#ServiceType :selected').val();
		if ($('#serviceprice').val() == '') {
			$('#errorserviceprice').show();
			$('#errorserviceprice').text('Required'); 	
		  	return false;
		}
		else
		{
			$('#errorserviceprice').hide();
			$('#errorserviceprice').text(''); 
		}
		
		if (isNaN(Number( $('#serviceprice').val()) )  )
		{
			$('#errorserviceprice').show();
			$('#errorserviceprice').text('Invalid Price');
			$('#serviceprice').focus();
		  	return false;
		}
		else
		{
			$('#errorserviceprice').hide();
			$('#errorserviceprice').text(''); 
		}
		
		var service_price 	 = $('#serviceprice').val();
		var service_discount = $('#discount').val();
		var service_qty 	 = $('#qty').val();
		
		if (service_price > 0 || service_price != '' && service_qty > 0 )	 {
			var service_amount = (((service_price * service_qty) ) - service_discount).toFixed(2);
			$('#totalcharges').val(service_amount);
		}
	});
	
	// On Change Service Qty
	$('#qty').blur(function(){
		
		//alert ($('#txtdollarrate').val());
		if ($('#qty').val() == '' || $('#qty').val() <= 0 ) {
			$('#errorqty').show();
			$('#errorqty').text('Required'); 	
			$('#qty').focus();
		  	return false;
		}
		else
		{
			$('#errorqty').hide();
			$('#errorqty').text(''); 
		}
		
		if ($('#serviceprice').val() == '' ) {
			$('#errorserviceprice').show();
			$('#errorserviceprice').text('Required'); 	
		  	return false;
		}
		else
		{
			$('#errorserviceprice').hide();
			$('#errorserviceprice').text(''); 
		}
		
		if (isNaN(Number( $('#serviceprice').val()) )  )
		{
			$('#errorserviceprice').show();
			$('#errorserviceprice').text('Invalid Price');
			$('#serviceprice').focus();
		  	return false;
		}
		else
		{
			$('#errorserviceprice').hide();
			$('#errorserviceprice').text(''); 
		}
	
		var service_price 	 = $('#serviceprice').val();
		var service_discount = $('#discountamt').val();
		var service_qty 	 = $('#qty').val();
	
		if (service_price > 0 || service_price != '' && service_qty > 0 )	 {
			var service_amount = (((service_price * service_qty)) - service_discount);
			$('#totalamount').val(service_amount);
		}
	});
	
	// When-Changed-Discount-Percentage
	    $('#discountper').blur(function(){
		if ($('#serviceprice').val() == '' ) {
			$('#errorserviceprice').show();
			$('#errorserviceprice').text('Required'); 	
		  	return false;
		}
		else
		{
			$('#errorserviceprice').hide();
			$('#errorserviceprice').text(''); 
		}
		//alert($('#discountper').val());
		if (isNaN(Number( $('#discountper').val()) )  )
		{
			$('#errordiscountper').show();
			$('#errordiscountper').text('Invalid %');
			$('#discountper').focus();
		  	return false;
		}
		else
		{
			$('#errordiscountper').hide();
			$('#errordiscountper').text(''); 
		}
		if ( $('#discountper').val() < 0 )
		{
			$('#errordiscountper').show();
			$('#errordiscountper').text('Disount Not allowed less than 0');
			$('#discountper').focus();
		  	return false;
		}
		else
		{
			$('#errordiscountper').hide();
			$('#errordiscountper').text(''); 
		}
		//=(B3*B4)/100
		var service_price 	 = $('#serviceprice').val();
		var service_qty 	 = $('#qty').val();
		var service_discount = (($('#discountper').val() * service_price) / 100).toFixed(2);
		
		if (service_price > 0 || service_price != '' ){
			$('#discountamt').val(service_discount);
			$('#totalamount').val((service_price * service_qty) - service_discount);
			$('#dueamount').val((service_price * service_qty) - service_discount);
		}
	});
	
	// When-Changed-Discount-Percentage
	    $('#discountamt').blur(function(){
		if ($('#serviceprice').val() == '' ) {
			$('#errorserviceprice').show();
			$('#errorserviceprice').text('Required'); 	
		  	return false;
		}
		else
		{
			$('#errorserviceprice').hide();
			$('#errorserviceprice').text(''); 
		}
		//alert($('#discountper').val());
		if (isNaN(Number( $('#discountamt').val()) ) )
		{
			$('#errordiscount').show();
			$('#errordiscount').text('Invalid discount');
			$('#discountamt').focus();
		  	return false;
		}
		else
		{
			$('#errordiscount').hide();
			$('#errordiscount').text(''); 
		}
		if ( $('#discountamt').val() < 0 )
		{
			$('#errordiscount').show();
			$('#errordiscount').text('Disount Not allowed less than 0');
			$('#discountamt').focus();
		  	return false;
		}
		else
		{
			$('#errordiscount').hide();
			$('#errordiscount').text(''); 
		}
		//=(B3*B4)/100
		var service_price 	 = $('#serviceprice').val();
		var discount_amt 	 = $('#discountamt').val();
		var service_qty 	 = $('#qty').val();
		var service_discount = (($('#discountamt').val() / service_price) * 100);
		
		if (service_price > 0 || service_price != '' ){
			$('#discountper').val(service_discount);
			$('#totalamount').val((service_price * service_qty) - discount_amt);
			$('#dueamount').val((service_price * service_qty) - discount_amt);
		}
	});
	
	// When-Changed-Received-Amount
	$('#received').blur(function(){
		var service_price = $('#serviceprice').val();
		
		if ($('#serviceprice').val() == '' ) {
			$('#errorserviceprice').show();
			$('#errorserviceprice').text('Required'); 	
		  	return false;
		}
		else
		{
			$('#errorserviceprice').hide();
			$('#errorserviceprice').text(''); 
		}
		
		if (isNaN(Number( $(this).val()) )  )
		{
			$('#errorreceived').show();
			$('#errorreceived').text('Invalid Amount');
			$(this).focus();
		  	return false;
		}
		else
		{
			$('#errorreceived').hide();
			$('#errorreceived').text(''); 
		}
		//=(B3*B4)/100
		var total_amount 	 = $('#totalamount').val();
		var received_amount 	 = $('#received').val();
		
		if (service_price > 0 || service_price != '' ){
			
			var due = parseFloat(total_amount - received_amount).toFixed(2);
			
			$('#dueamount').val(due);
		}
	});
	
	// Keys Controlling on for Numbers - Dsicount Percentage Key
	$("#discountper").keydown(function(event) {
		//alert(event.keyCode);
		if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 36 || event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40 || event.keyCode == 110 || event.keyCode == 190 || event.keyCode == 109 || event.keyCode == 189 || event.keyCode == 173) {
            
        }
        else {
            // Ensure that it is a number and stop the keypress
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 ) || event.shiftKey) {
                event.preventDefault(); 
            }   
        }
    });
	// Generate Invoice Button Click
	$('#btndischarge').click(function(){  
		
		var patient_id = jQuery("#patient_reg_no").val();
		//alert(patient_id);

		jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url();?>/application/helpers/discharge_patient.php",
		data: ({post_patient_id: patient_id}),
			success: function(response)	
			{
				alert(response);
			}
		});	
	});
	// Generate Invo ice Button Click
	$('#btnGenerateInvoice').click(function(){  	
		//alert ($('#txtdollarrate').val());
		if ($('#qty').val() == '' || $('#qty').val() <= 0 ) {
			$('#errorqty').show();
			$('#errorqty').text('Required'); 	
			$('#ServiceName').focus();
		  	return false;
		}
		else
		{
			$('#errorqty').hide();
			$('#errorqty').text(''); 
		}
		
		if ($('#serviceprice').val() == '' ) {
			$('#errorserviceprice').show();
			$('#errorserviceprice').text('Required'); 	
		  	return false;
		}
		else
		{
			$('#errorserviceprice').hide();
			$('#errorserviceprice').text(''); 
		}
		
		if (isNaN(Number( $('#serviceprice').val()) )  )
		{
			$('#errorserviceprice').show();
			$('#errorserviceprice').text('Invalid Price');
			$('#serviceprice').focus();
		  	return false;
		}
		else
		{
			$('#errorserviceprice').hide();
			$('#errorserviceprice').text(''); 
		}
		if ( $('#discountper').val() < 0 )
		{
			$('#errordiscountper').show();
			$('#errordiscountper').text('Disount Not allowed less than 0');
			$('#discountper').focus();
		  	return false;
		}
		else
		{
			$('#errordiscountper').hide();
			$('#errordiscountper').text(''); 
		}
		var selectedRecordServices = $("#NoServiceSelected").html();
		
		if (selectedRecordServices == '<b> No Service Selected</b>')
		{
			alert('No service seleced, Please add service');
			return false;
		}
		
		// End Validation Contact Information...
		var button_text = $('#btnGenerateInvoice').val().toLowerCase();
		var msg_text 	= button_text.substring(0,8); //substr(button_text, 1, 8);
		msg_text = msg_text.replace(' i', '');
		var confirmLeave = confirm('Are you sure you want to ' + button_text + ' ?');
		var Counter = 0;
		if (confirmLeave==false)
		{
			$('#ajaxLoaderDone').hide();
			return false;
			
		}
		var doctor_id 	= $('#doctor_id').val();
		var reg_no 		= $('#patient_reg_no').val();
		
		var selectedRecord = $(".mytr-inv-data").length;
		//$('#ajaxLoaderDone').show();
		
		$(".mytr-inv-data").each(function()
		{
				//invoice_service_count 		= $(this).index();
				
				var service_price = $(this).find('#s_service_price').text();
				var actual_service_price = $(this).find('.service_price').text();
				
				
				var cat_id      		= $(this).find('#cat_id').text();
				var service_id      		= $(this).find('#service_id').text();
				var service_qty      		= $(this).find('#s_service_qty').text();
				var service_discount 		= $(this).find('#s_service_dis_per').text();
				var service_discount_amt		= $(this).find('#discount_amount').text();
				var service_type_id  		= $(this).find('#s_service_type_id').text();
				var service_total_charges  		= $(this).find('#total_charges').text();
				var received_amt 			= $(this).find('#received_amt').text();
				var due_amt 				= $(this).find('#due_amount').text();
				var s_invoice_service_date 	= $(this).find('.selectedservicedate').val();
				var service_end_date 		= $(this).find('.selectedserviceenddate').val();

				
				// Add Service Catalog
			
				$.ajax({
					type:"POST",
					url: "<?php echo base_url();?>/application/helpers/generateinvoice.php",
					data:({
							post_reg_no					: reg_no,
							post_doctor_id				: doctor_id,
							post_cat_id					: cat_id,
							post_service_id				: service_id,
							post_service_price  		: service_price,
							post_service_qty 			: service_qty,
							post_service_discount 		: parseFloat(service_discount).toFixed(2),
							post_service_discount_amt	: service_discount_amt,
							post_service_total_charges	: service_total_charges,
							post_received_amt			: received_amt,
							post_due_amt				: due_amt,
						}),
						dataType:"html",
						cache:false,
						success:function(args)
						{
							alert(args);
							
							Counter++;
							
							if(selectedRecord == Counter)
							{
								setTimeout( function()
								{
									// alert('Inovice has been successfully ' + msg_text + 'd');
									$('#ajaxLoaderDone').hide();
									// Print Invoice 
									$(location).attr('href',"createprintinvoice?inv="+invoice_id+"&cid="+client_id);
								}, 2000); // End Time Out	
							} 
							
						}
				});
		});
		
		
		
		
		/*
			$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>/application/helpers/generateinvoice.php",
			async:true,
			cache:false,
			data: {id: 50, category: "test" }
			}).done(function(msg){
				alert(msg);
			});
		*/		
	});
	
	// When Patient Search...
	jQuery("select[name='patient_id']").change (function()
	{
		var reg_no = jQuery("select[name='patient_id']").val();
		//alert(reg_no);
		
		$('#patient_reg_no').val('');
		$('#refferedby').val('');
		$('#adm_date').val('');
		$('#phone').val('');
		$('#age_sex').val('');
		$('#doctor_id').val();

		jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url();?>/application/helpers/getipdpatientdetails.php",
		data: ({post_reg_no: reg_no}),
			success: function(response)	
			{
				//$("#patient_reg_no").val(response);
				//$arrPD[0]['patient_reg_no']."|||".$arrPD[0]['refferedby']."|||".$arrPD[0]['phone']."|||".$arrPD[0]['sex']."|||".$arrPD[0]['birth_date']."|||".$arrPD[0]['birth_date'];
				
				var splitResult=response.split("|||");  
				var reg_no =splitResult[0];  
				var refferedby =splitResult[1] + ' ' +  splitResult[6];
				var phone =splitResult[2];  
				var sex =splitResult[3];
				var birth_date =splitResult[4];  
				var admission_date =splitResult[5]; 
				
				$("#patient_reg_no").val(reg_no);
				$("#refferedby").val(refferedby);
				$("#adm_date").val(admission_date);
				$("#phone").val(phone);
				$("#sex").val(sex);

				var age = getAge(new Date(birth_date));
				
				$("#age_sex").val(age + ' / ' + birth_date);
				$("#serviceprice").val('');
				$("#totalamount").val('');
				$("#dueamount").val('');
				
				//jQuery("#serviceprice").focus();
			}
		});	
});
	
	function getAge(birthDate) {
  		var now = new Date();

  function isLeap(year) {
    return year % 4 == 0 && (year % 100 != 0 || year % 400 == 0);
  }

  // days since the birthdate    
  var days = Math.floor((now.getTime() - birthDate.getTime())/1000/60/60/24);
  var age = 0;
  // iterate the years
  for (var y = birthDate.getFullYear(); y <= now.getFullYear(); y++){
    var daysInYear = isLeap(y) ? 366 : 365;
    if (days >= daysInYear){
      days -= daysInYear;
      age++;
      // increment the age only if there are available enough days for the year.
    }
  }
  return age;
}


	jQuery("select[name='categoryname']").change (function()
	{
	
		var cat_id = jQuery("select[name='categoryname']").val();
		//alert(cat_id);
		jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url();?>/application/helpers/selectedservices.php",
		data: ({post_did: cat_id}),
			success: function(response)	
			{
				//alert(response);
				jQuery("#div_services").html(response);
		getprice();
		jQuery("select[name='ServiceName']").change (function()
	{
	
	getprice();
 	});
			}
		});	
 	});
	
});


function getprice () {
	
	
		var serv_id = jQuery("select[name='ServiceName']").val();
		
		jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url();?>/application/helpers/getServicePriceDiag.php",
		data: ({post_service_id: serv_id}),
			success: function(response)	
			{
				//alert(response);
				jQuery("#serviceprice").val(response);
				
			}
		});	
 	
	}
</script>

<!--first time on load-->

<script>

	jQuery("select[name='ServiceName']").change (function()
	{
	
	getprice();
 	});

</script>

<!--first time on load-->


<!--<link rel="stylesheet" href="bayanno.css">
<link rel="stylesheet" href="bayanno.js">-->

<script type="text/javascript">
function delete_user(row)
    {
       var c = confirm("Are you sure, DELETE this row");
	   if (c == false)
	   {
			return false;   
	   }
	    row.closest('tr').remove();
		
		var sum = 0;
		$('.total_charges').each(function() 
		{
			 sum += parseFloat($(this).text());
		});
		
		//$('#totalinvoicecharges').text(sum);
		//$('#nettotalinvoicecharges').text(sum);
		
		$('#txttotalinvoicecharges').val(sum);
		//$('#txtnettotalinvoicecharges').val(sum);
		
		var sum = 0;
		$('.discount_amount').each(function() 
		{
			 sum += parseFloat($(this).text());
		});
		$('#txtdiscount').val(sum);
		
		var sum = 0;
		$('.received_amt').each(function() 
		{
			 sum += parseFloat($(this).text());
		});
		$('#total_paid').val(sum);
		
		var sum = 0;
		$('.due_amt').each(function() 
		{
			 sum += parseFloat($(this).text());
		});
		$('#txtdueamount').val(sum);
    }
</script>

<script>
	jQuery("select[name='patient_id']").change(function()
	{
		var pat_id = jQuery("select[name='patient_id']").val();
		//alert(pat_id);
		$('#txttotalinvoiceamount').val();


		jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url();?>/application/helpers/totalinvoiceamount.php",
		data: ({post_pat_id: pat_id}),
			success: function(response)	
			{
				//alert(response);
				jQuery("#txttotalinvoiceamount").val(response);
				
				var totalinvoiceamount=jQuery('#txttotalinvoiceamount').val();
				var totalinvoicerec=jQuery('#invoicereceivedamount').val();
	
				if ( totalinvoiceamount > totalinvoicerec )
				{
					
					
					$('#btndischarge').prop('disabled', true);

				}
				else
				{
					
					$('#btndischarge').prop('disabled', false);
				}
				
			}
			
			});	 //jQuery.ajax

 	});

</script>

<script>
	jQuery("select[name='patient_id']").change(function()
	{
		var pat_id = jQuery("select[name='patient_id']").val();
		//alert(pat_id);
		$('#invoicereceivedamount').val();

		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url();?>/application/helpers/totalinvoicereceiveamount.php",
			data: ({post_pat_id: pat_id}),
			success: function(response)	
			{
			//	alert(response);
				$("#invoicereceivedamount").val(response);

			}
		});	
		
		/*var totalinvoiceamount=$('#txttotalinvoiceamount').val();
		var totalinvoicerec=$('#invoicereceivedamount').val();
	
		if ( totalinvoiceamount > totalinvoicerec )
		{
			alert(working);
			$('#btndischarge').prop('disabled', true);
		}*/
 	});
</script>