<style>
.error{
	font-weight:bold;
	color:#FF0000;
	margin-top:5px;
	/*padding: 0 0 0 131px;*/
}

.rdeletee {
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
	box-shadow: 2px 2px 1px rgb(55,158,196);
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
  		<p><span class="badge" id="txtHintmain" style="margin-left: 7px; display:none;"></span></p>
  <table class="awTable" style="width:100%">
    <tr>
      <td colspan="4"><!--<img src="images/invoices.png" border="0" >&nbsp;&nbsp;-->
		<div style="float: right;">
          <select  class="chzn-select" name="discharge_type"  tabindex="1" id="SelChng" style="width: 180px!important;" id="discharge_type">
         			 <option value="1">--Select Discharge Type--</option>
                    <option value="death">death</option>
                    <option value="normal">normal</option>
                   <option value="lama">lama</option>
            </select> 
        	<input type="button" name="btndischarge" id="btndischarge" value="Discharge Patient Now" class="btn btn-green" title="Click to discharge patient" style="padding-right:10px;" />
 			<input type="button" name="make_more_invoice" id="make_more_invoice" value="Reset Invoice" class="btn btn-blue" title="Click to reset"/>
            
            <input type="button" name="btnviewpayhistory" id="btnviewpayhistory" value="View Payment History" class="btn btn-blue" title="Click to View Patient Payment History" style="padding-right:10px;" />
            
            
            
            <input type="button" name="btnzakat" id="btnzakat" value="Zakaat" class="btn btn-green" title="Click to give Make Zakaat" style="padding-right:10px;" />
 			<input type="button" name="btndiscount" id="btndiscount" value="Discount" class="btn btn-green" title="Click to Make Discount"/>
            
            <input type="button" name="btnrefund" id="btnrefund" value="Refund" class="btn btn-green" title="Click to Make Refund" style="padding-right:10px;" />
            
 			
		</div>
        <!--disabled="disabled" -->
		</td>
    </tr>
  
    <tr>

          <td>

          
           <label><b><?php echo get_phrase('select_patient');?></b></label>
           <div class="controls">
            <select class="chzn-select" name="patient_id"  tabindex="1" style="width: 350px!important;" id="patiend_id" value=''>
                <option   >-------------------- ----- Select Patient --------------------</option>
                <?php 
                $this->db->order_by('patient_reg_no' , 'asc');
                $patients1	=	$this->db->get('patient')->result_array();

				$c=0;
			    foreach($patients1 as $row):

				 if ($row['patient_type']=='IPD')
				 {
					if (strlen($row['discharge_type']) == 0 ) // != 'death' or $row['discharge_type'] !='lama' or $row['discharge_type'] !='normal')
				  	{
                 
                ?>

                    <option value="<?php echo $row['patient_reg_no'];?>"><?php echo $row['patient_reg_no']. ' - ( ' . $row['name']. ' - ' . $row['phone']. ')';?></option>
               
                 
                   <?php 
                     $c++;

				   } 
				 }
				
				   ?>
                <?php
                endforeach;
                ?>
            </select> 
          </div> 
          
    </td>
     <td>
        <label class="control-label"><b><?php echo get_phrase('registration_number');?></b></label>
        <input type="text"  name="patient_reg_no" id="patient_reg_no" readonly="readonly" value="<?php echo $row['patient_reg_no']; ?>"/>
        
        <?php $my_result=null;?>
        <?php $my_result = $row['patient_reg_no']; ?>
        <input type="hidden" id="patient_id" name="patient_id" value="<?php echo $row['patient_id']?>">
    </td> 
     
   <!-- <td>
    	<label><b><?php echo get_phrase('Referred_By');?></b></label>
           <input type="text"  name="refferedby" id="refferedby" readonly="readonly" value="<?php echo $row['refferedby'].$row['med_card_no']; ?>"/>
    </td>-->
     <td>
    	<label><b><?php echo get_phrase('Date');?></b></label>
           <input type="text"  name="adm_date" id="adm_date" readonly="readonly" value="<?php echo date('d-m-Y H:i', $row['account_opening_timestamp']); ?>"/>
    </td>
      </tr>
      <tr>
      	<!--<td>
        	<div class="control-group">
               <label class="control-label"> <b><?php echo get_phrase('Physician');?></b></label>
                <div class="controls">
                    <select class="chzn-select" name="doctor_id" id="doctor_id" style="width: 310px!important;">
                        <?php 
                        //$this->db->order_by('name' , 'asc');
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
        </td>-->
        <td>
        	<label><b><?php echo get_phrase('Phone');?></b></label>
           <input type="text"  name="phone" id="phone" readonly="readonly" value="<?php echo  $row['phone']; ?>"/>

        </td>
        
        <td>
        <label class="control-label"><b><?php echo get_phrase('Age_/_Sex');?></b></label>
        <input type="text"  name="age_sex" id="age_sex" readonly="readonly" value="<?php echo $row['age']. ' / ' .$row['sex'] ; ?>"/>
    </td> 
  
      <td>
        	<!-- <label><b><?php echo get_phrase('Advance Pay / Deposit');?></b></label>
        	         <input type="text"  name="advance" id="advance"  /> -->
         <label><b><?php echo get_phrase('Room / bed_no');?></b></label>
         <input type="text"  name="bed_id" id="bed_id"  value="<?php echo $row['room_id'];?>"/>
        </td>
        
      </tr>
      <tr>
       <td>
       	 <label class="control-label"><?php echo get_phrase('consultant name');?></label>
                    <div class="controls">
             <select name="doctor_id" id="doctor_id" class="uniform" style="width:100%;">
			 <option value="-1"> ------- Select Doctor -------</option>
        	<?php 
			$doctors = $this->db->get('doctor')->result_array();
			foreach($doctors as $row2):
			?>
       <option value="<?php echo $row2['doctor_id'];?>"
        	<?php if($row['doctor_id'] == $row2['doctor_id'])echo 'selected';?>>
									<?php echo $row2['name'];?>
                                    	</option>
                        <?php
						endforeach;
										?>
                                    </select>
       	<!-- <label><b><?php echo get_phrase('Room / bed_no');?></b></label>
       	        <input type="text"  name="bed_id" id="bed_id"  value="<?php echo $row['room_id'];?>"/> -->
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
   			<th align="center" style="color:#FFF;">Disc.Amount</th>
			<th align="center" style="color:#FFF;">Discount (%)</th>
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
						<select name="categoryname" id="categoryname" style="width: 162px;" class="chzn-select">
                        <option value="-1" />--Select Category--- </option>
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
        	<select name="ServiceName" id="ServiceName" style="width: 154px;" class="chzn-select">
            <option value="-1" />--Select Service--- </option>
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
			<td align="center">
				<input type="text"  class="txtInput" id="serviceprice" name="serviceprice" style="width: 70px; text-align:right;" maxlength="6" readonly="readonly"/>
				<label id="errorserviceprice" style="display:none;" class="error"></label>
			</td>
            <td align="center">
				<input type="text"  class="txtInput" id="qty" name="qty" style="width: 40px; text-align:right;" maxlength="2" value="1"/>
				<label id="errorqty" style="display:none;" class="error"></label>
			</td>
			
            <td align="center">
				
				<input type="text" id="discountamt" name="discountamt" value="0" style="width: 70px;text-align:right;" maxlength="8" class="txtInput" />
				<label id="errordiscount" style="display:none;" class="error"></label>
			</td>
			<td align="center">
				
				<input type="text" id="discountper" name="discountper" value="0" style="width: 70px;text-align:right;" maxlength="2" class="txtInput" readonly="readonly"/>
				<label id="errordiscountper" style="display:none;" class="error"></label>
			</td>
            <td  align="center">
				<input type="text"  class="txtInput" id="totalamount" name="totalamount" style="width: 80px; text-align:right;" maxlength="6" readonly/>
				<label id="errorserviceprice" style="display:none;" class="error"></label>
				
			</td>
            <td  align="center">
				<input type="text"  class="txtInput" id="received" name="received" style="width: 72px; text-align:right;" maxlength="6" value="0"/>
				<label id="errorreceived" style="display:none;" class="error"></label>
			</td>
			<td  align="center">			
				<input type="text" id="dueamount" name="dueamount" value="0" readonly style="width: 70px;text-align:right;" class="txtInput" />
			</td>
            <td align="right" >
				<input type="button" id="addmore" name="addmore" value="Add Invoice" title="Add to Invoice"  class="btn btn-green"/><br><a class="btn btn-green" data-toggle="modal" data-target="#myModal" id="dues">Clear Dues</a>
			</td>
           </tr>
		</tbody>
	</table>
    </div>
</div>

<div class="alert alert-info alert1" style="display:none;">
  <span class="noti"></span>
</div>

	<div id="NoServiceSelected" class="box-header"><b> No Service Selected</b></div>
	<div id="selectedservices" class="box-header">
	<table id="tblservice_catalog_detail" width="100%" onmouseover="dueSum()" class="awTable">
		<thead>
			<tr style="height:20px!important;background-color:rgb(55,158,196) !important;">
					<!--<th align="center" style="border: 1px solid ##B7B7B7; background-color:#CDCDCD;">Sr. #</th>-->
        <th align="center" style="border: 1px solid ##B7B7B7;color:#ffffff !important; width:12%;">Category</th>		       
        <th align="center" style="border: 1px solid ##B7B7B7;color:#ffffff !important;width:20%;">Serivce Name</th>
	   <th align="center" style="border: 1px soli##B7B7B7;color:#ffffff !important;width:10%;">Service Amount </th>
       <th align="center" style="border: 1px soli##B7B7B7;color:#ffffff !important;width:5%;">Qty </th>
      <th align="center" style="border: 1px solid ##B7B7B7;color:#ffffff !important;width:5%;">Disc. Amount</th>
	  <th align="center" style="border: 1px solid ##B7B7B7;color:#ffffff !important;width:5%;">Discount (%)</th>
	  <th align="center" style="border: 1px solid ##B7B7B7;color:#ffffff !important;width:10%;">Total Amount</th>
      <th align="center" style="border: 1px solid ##B7B7B7;color:#ffffff !important;width:10%;">Received Amount</th>
      <th align="center" style="border: 1px solid ##B7B7B7;color:#ffffff !important;width:10%;">Due Amount</th>
	 <!--  <th align="center" style="border: 1px solid ##B7B7B7;color:#ffffff !important;width:10%;">Action</th> -->
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
				<td><input type="text" id="total_paid" name="total_paid" class="total" style="width: 100px;text-align:right; font-weight:bold;font-size:11px;padding-right:10px;" maxlength="8" readonly tabindex="15" value="0"></td>
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
  
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dues</h4>
      </div>
      <div class="modal-body">
                   <label><b><?php echo get_phrase('select_patient');?></b></label>
           <div class="controls">
            <select class="chzn-select" name="patient_id_mod"  tabindex="1" style="width: 350px!important;" id="patient_id_mod" value=''>
                <option value="1"  >-------------------- ----- Select-Patient --------------------</option>
                
                <?php 
               $this->db->order_by('patient_reg_no' , 'asc');
                $patients1 = $this->db->get('patient')->result_array();
				$c=0;
			    foreach($patients1 as $row):

				 if ($row['patient_type']=='IPD')
				 {
					if (strlen($row['discharge_type']) == 0 ) // != 'death' or $row['discharge_type'] !='lama' or $row['discharge_type'] !='normal')
				  	{
                 
                ?>

                    <option value="<?php echo $row['patient_reg_no'];?>"><?php echo $row['patient_reg_no']. ' - ( ' . $row['name']. ' - ' . $row['phone']. ')';?></option>
               
                 
                   <?php 
                     $c++;

				   } 
				 }
				
				   ?>
                <?php
                endforeach;
                ?>
            </select> 

<!-- 
            <p><b>Start typing a name in the input field below:</b></p>
			<form> 
			First name: <input type="text">
			</form> -->
			<br>
			


            <div class="controls">
				<p><b>Dues:</b><span class="badge" id="txtHint" style="margin-left: 7px;"></span></p>
            </div>
			<button type="button" id="clrdues" onclick="clrDues()" class="btn btn-danger" style="display:none;">Click to clear dues</button>
			<span id="hiddenpatienMRN" style="display:none;"></span>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

    <div style="float:left;">
    	<?php echo form_open('reception/generate_ipd_invoice/'.$my_result); ?>

	  	<input type="submit" id="btnGenerateInvoice" name="btnGenerateInvoice" value="Generate Invoice" class="btn btn-blue"/>
	  	<?php echo form_close();?>
	  </div>
	&nbsp;<div id="ajaxLoaderDone" style="display:none;padding-left:420px;"><img src="images/process.gif" alt="loading..."></div>
<script type="text/javascript">

$('#patiend_id').change(function(){
    var patientid = $(this).val();	// taking value after change in selection

    if (patientid == 1) { //patient id is taking from option 1

        $('#txtHintmain').html('No Patient selected');
        //it will insert in any tag having id "txthint" to no patient selected
        
        return;
    } 

    else
   {
   	jQuery.ajax({
		type: "GET",
		url: "<?php echo base_url();?>/application/helpers/getdatatocleardue.php?q=" + patientid,
		success: function(response)	
			{       		 
			if (response > 0) {
				$('#txtHintmain').show(500);
				$('#txtHintmain').html('please clear your dues:' + response);
				$('#SelChng').attr('disabled', true);

				//button to clear dues and it has the function 
			}
			else {
				$('#txtHintmain').show(500);
				$('#txtHintmain').html('If you want to discharge then please select the discharge type');
				$('#SelChng').attr('disabled', false);
                }

			}
   });
   }
}); 
	
$("select[name='discharge_type']").change(function()
	{
		$('#txtHintmain').hide(500);
		$('#btndischarge').attr('disabled', false);
	});

$('#patient_id_mod').change(function(){
    var patientid = $(this).val();	// taking value after change in selection

    if (patientid == 1) { //patient id is taking from option 1

        $('#txtHint').html('No Patient selected');
        //it will insert in any tag having id "txthint" to no patient selected
        
        return;
    } 

    else
   {
   	jQuery.ajax({
		type: "GET",
		url: "<?php echo base_url();?>/application/helpers/getdatatocleardue.php?q=" + patientid,
		success: function(response)	
			{
				$('#txtHint').html(response);
				//response that is comming from getdatatocleardue.php file
				$('#hiddenpatienMRN').html(patientid);
				//created a hidden tag in which the patien mr number is located to use it on other function to cleardues function name is clrDues()
       		 
			if (response > 0) {

				$('#clrdues').show(500);
				//button to clear dues and it has the function 
			}
			else {

				$('#clrdues').hide(); // will remove the button 

                }

			}
   });
   }
}); 
   

    function clrDues() {

    var patientidcls = $('#hiddenpatienMRN').text(); 
    var r = confirm("Are you sure want to clear dues");

    if (patientidcls !== "" && r == true) 
    {
	   	jQuery.ajax({
		type: "GET",
		url: "<?php echo base_url();?>/application/helpers/cleardue.php?q=" + patientidcls,
		success: function(response)	
			{

			$('#txtHint').html(response);
			//response that is comming from cleardue.php file
			window.location = 'index.php?reception/ipdaddservice';	
            $('#clrdues').hide();
			}
  		 });
    }

    else {
    	
    	alert('Seems like problem with patient id');
    }
}



	$(document).ready(function(e) {

	
	$('#btndischarge').attr('disabled', true);
	$('#SelChng').attr('disabled', true);

	
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
	
		$('#patient_reg_no').val('');
		$('#patient_reg_no').val('');
		$('#adm_date').val('');
		$('#phone').val('');
		$('#age_sex').val('');
			
 	
	
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
		window.location = 'index.php?reception/ipdaddservice';	
	});
	$("#btnviewpayhistory").click(function()
	{
		var p = $("#patient_reg_no").val();
		window.open("application/helpers/admittedpatientpaymenthistory.php?r="+p);
		//$(location).attr('href',"application/helpers/admittedpatientpaymenthistory.php?r="+p );
			
	});
	// Add New Row in Service Detail Catalog
	$("#addmore").click(function()
	{
		
		if ($('#serviceprice').val() == '')
		 {
			$('#errorserviceprice').show();
			$('#errorserviceprice').text('Required');
		  	return false;
		}
		else
		{
			$('#errorserviceprice').hide();
			$('#errorserviceprice').text(''); 
		}
		
		if ($('#serviceprice').val() == 0) 
		{
			$('#errorserviceprice').show();
			$('#errorserviceprice').text('Not Allowed');
		  	return false;
		}
		else
		{
			$('#errorserviceprice').hide();
			$('#errorserviceprice').text(''); 
		}
		
		if ($('#qty').val() == '' || $('#qty').val() <= 0 ) 
		{
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
		/*
		if (isNaN(Number( $('#discount').val()) )  )
		{
			$('#errordiscount').show();
			$('#errordiscount').text('Invalid Discount');
			$('#discount').focus();
		  	return false;
		}
		else
		{
			$('#errordiscount').hide();
			$('#errordiscount').text(''); 
		}*/
					
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

	var cpatientid = $('#patient_reg_no').val();
	patientid =	$.trim(cpatientid); //remove space other wise it will not show the data in the table of admitted patient

	if ($('#discountamt').val() == '')
	 {
	 	$('#discountamt').val(0);
	}
	if ($('#received').val() == '')
	 {
	 	$('#received').val(0);
	}

	if (patientid !== "") {

	var selected_service = "";
	var s_service_price;
	var s_service_qty;
	var s_service_discount;
	var s_service_total_charges;
	var appendTxt				= "";
	s_service_type				= $('#ServiceName :selected').text();
	s_service_val				= $('#ServiceName :selected').val(); 
	s_service_qty				= $('#qty').val();
	var totalamtqty				= $('#serviceprice').val() * s_service_qty;
	csp_s_service_price			= parseFloat($('#serviceprice').val() * s_service_qty);
	s_service_dis_per 			= parseFloat($('#discountper').val());
	s_service_dis_amt 			= parseFloat($('#discountamt').val());
	s_service_rec_amt 			= parseFloat($('#received').val());
	s_service_due_amt 			= parseFloat($('#dueamount').val());
	s_service_dis_amt 			= parseFloat($('#discountamt').val());
	s_service_discount 			= parseFloat(($('#discount').val()));
	s_service_total_charges 	= parseFloat($('#totalamount').val()) ;
	act_s_service_price 		= parseFloat($('#serviceprice').val() );//.toFixed(2) ; 
	csp_s_service_total_charges = ((csp_s_service_price) - ($('#discountamt').val()));//.toFixed(2);
	s_service_category 			= $('#categoryname :selected').text();
	s_service_category_id 		= $('#categoryname :selected').val();
	s_service_type 				= $('#ServiceName :selected').text();
	var s_service_type_Index 	= $('#ServiceName :selected').index();
	var totalamtqty				= $('#serviceprice').val() * s_service_qty-s_service_rec_amt;
			// new changes
	var s_service_type_id 		= $('#ServiceName :selected').val();
			// end new changes
	var count 					= $(".mytr-inv-data").index()+1;
				

		$.ajax({
			type:"POST",
			url: "<?php echo base_url();?>/application/helpers/insertnewservice.php",
			data:({
					p_patientid 					: patientid,
					p_service_val					: s_service_val, 
					p_service_category 				: s_service_category_id,
					p_service_qty 					: s_service_qty,
					p_service_dis					: s_service_dis_amt,
					p_service_amt 					: act_s_service_price,
					p_service_price					: totalamtqty,
					p_service_rec_amt 				: s_service_rec_amt,
					p_service_due_amt 				: s_service_due_amt,
				}),
				dataType:"json",
				success:function(args)
				{
				if(args ==  true){

				$('.noti').html('');
				$('.alert1').show();
				$('.noti').append('Service added successfully');


			    setTimeout(function() {
        		$(".alert1").hide('blind', {}, 500)
    			}, 2000);

				}

				else {
				$('.noti').html('');
				$('.alert1').show();
				$('.noti').append('Problem Inserting the service');
					}
				}
			});






var appendTxt 	= "<tr class='mytr-inv-data'><td id='cat_id' style='display:none'>"
				+s_service_category_id
				+"</td><td style='width: 5%;'>"
				+ s_service_category  
				+ "</td><td id='service_id'  style='display:none'>"
				+ s_service_type_id  
				+ "</td>  <td style='width: 12%;'>"
				+ s_service_type  
				+ "</td><td style='width: 5%;' align='right' id='s_service_price' name='s_service_price' class='current_service_price'>" 
				+ parseFloat(act_s_service_price) + "</td><td style='width: 5%;'  align='right' contenteditable='true' onfocusout='myEditFunc(this)' name='s_service_qty' id='s_service_qty' class='editt'>" 
				+ s_service_qty 
				+ "</td><td style='width: 5%;'  align='right' 	 contenteditable='true' class='discount_amount editt' onfocusout='myEditFunc2(this)' name='discount_amount' id='discount_amount'>" 
				+ parseFloat(s_service_dis_amt) 
				+ "</td><td style='width: 5%;'  align='right' name='s_service_dis_per' id='s_service_dis_per' class='editt'>" 
				+ s_service_dis_per 
				+ "</td><td style='width: 6%;' align='right' class='total_charges editt' id='total_charges' name='total_charges'>" 
				+ parseFloat(s_service_total_charges) 
				+ "</td><td style='width: 8%;'  align='right' contenteditable='true' onfocusout='myEditFunc3(this)'class='received_amt' id='received_amt'>" 				+ parseFloat(s_service_rec_amt) 
				+ "</td><td style='width: 8%;'  align='right' class='due_amt' id='due_amount'>" 
				+ parseFloat(s_service_due_amt).toFixed(2) 
				+ "</td></tr>";

	// <td align='center'><a class='rdelete' onclick ='delete_user($(this))'></a></td>

				$("#tblservice_catalog_detail tr:last").after(appendTxt);
				$("#tblservice_catalog_detail tr:last").hide().fadeIn('slow');
			
			}

			else {
				$('.noti').html('');
				$('.alert1').show();
				$('.noti').append('Please select patient');
			}
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
		
		if (isNaN(Number( $('#serviceprice').val()) ) )
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
	/*
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
		
		if (service_price > 0 || service_price != '' )
		{
			$('#discountamt').val(service_discount);
			$('#totalamount').val((service_price * service_qty) - service_discount);
			$('#dueamount').val((service_price * service_qty) - service_discount);
		}
	});
	*/
	
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
		
		//=(B3*B4)/100
		var service_price 	 = $('#serviceprice').val();
		var service_qty 	 = $('#qty').val();
		var service_discount_per = ((($('#discountamt').val() *100) / service_price)).toFixed(2);
		
		if (service_price > 0 || service_price != '' )
		{
			$('#discountper').val(service_discount_per);
			$('#totalamount').val((service_price * service_qty) - $('#discountamt').val());
			$('#dueamount').val((service_price * service_qty) - $('#discountamt').val());
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
			//alert($('#dueamount').val());
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
		
		var dc_type = $("select[name='discharge_type']").val();
		if (dc_type == 1)
		{
			$('#txtHintmain').show(500);
			$('#txtHintmain').html('please select discharge type');
			return false;
		}
		$('#txtHintmain').hide(500);
		var patient_id = $("#patient_reg_no").val();
		patient_id = $.trim(patient_id);
		//alert(patient_id);
		var sure = confirm("Are you sure you want to proceed?");

		if(sure == true){
			   
		jQuery.ajax({
		type: "GET",
		url: "<?php echo base_url();?>/application/helpers/discharge_patient.php?p_id="+patient_id+"&dc_type="+dc_type,
		
			success: function(response)	
			{

			location.reload();

			}
		});

		}

	});
           
	// Generate Invoice Button Click
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
		var bed_no 	= $('#bed_id').val();
		var reg_no 		= $('#patient_reg_no').val();
		reg_no = reg_no.trim();
		var patient_id = $('#patient_id').val();
		console.log(patient_id);
		console.log(122);
		var selectedRecord = $(".mytr-inv-data").length;
		//$('#ajaxLoaderDone').show();
		
		$(".mytr-inv-data").each(function()
		{
				//invoice_service_count 		= $(this).index();
				
				var service_price           = $(this).find('#s_service_price').text();
				var actual_service_price    = $(this).find('.service_price').text();
				var cat_id      		    = $(this).find('#cat_id').text();
				var service_id      		= $(this).find('#service_id').text();
				var service_qty      		= $(this).find('#s_service_qty').text();
				var service_discount 		= $(this).find('#s_service_dis_per').text();
				var service_discount_amt	= $(this).find('#discount_amount').text();
				var service_type_id  		= $(this).find('#s_service_type_id').text();
				var service_total_charges  	= $(this).find('#total_charges').text();
				var received_amt 			= $(this).find('#received_amt').text();
				var due_amt 				= $(this).find('#due_amount').text();
				var s_invoice_service_date 	= $(this).find('.selectedservicedate').val();
				var service_end_date 		= $(this).find('.selectedserviceenddate').val();
				var idd 				 	= $(this).find('.idd').val();


				// Add Service Catalog
			
				$.ajax({
					type:"POST",
					url: "<?php echo base_url();?>/application/helpers/generateinvoice.php",
					data:({
						    post_patient_id             : patient_id,
						    post_bed_no					: bed_no,
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
							post_idd 					: id,
						}),
						dataType:"html",
						cache:false,
						success:function(args)
						{
							alert(idd);
							
							Counter++;
							
							if(selectedRecord == Counter)
							{
								/*
								setTimeout( function()
								{
									// alert('Inovice has been successfully ' + msg_text + 'd');
									$('#ajaxLoaderDone').hide();
									// Print Invoice 
									$(location).attr('href',"createprintinvoice?inv="+invoice_id+"&cid="+client_id);
								}, 2000); // End Time Out	
								*/
								alert('Servies(s) has been successfully added');
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
		$('.alert1').hide();	
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

	jQuery("select[name='patient_id']").change (function()
	{
		var reg_no = jQuery("select[name='patient_id']").val();
		//alert(reg_no);
		$("#tblservice_catalog_detail tr").empty();
		
		jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url();?>/application/helpers/getipdpatientdetails2.php",
		data: ({post_reg_no: reg_no}),
			success: function(response)	
			{
				var as = JSON.parse(response);
					
				for(i=0; i<as.length;i++){
					var appendTxt = "<tr class='mytr-inv-data'><td id='cat_id' style='display:none'>"
					+as[i].service_cat_id
					+"</td><td style='width: 5%;'>"
					+ as[i].name  
					+ "</td><td id='service_id'  style='display:none'>"
					+ as[i].service_id  
					+ "</td>  <td style='width: 12%;'>"
					+ as[i].name1  
					+ "</td><td style='width: 5%;' align='right' id='s_service_price' name='s_service_price' class='current_service_price'>" 
					+ parseFloat(as[i].service_amount) 
					+ "</td><td style='width: 5%;'  align='right' contenteditable='true' onfocusout='myEditFunc(this)' name='s_service_qty' id='s_service_qty' class='editt'>" 
					+ as[i].service_qty 
					+ "</td><td style='width: 5%;'  align='right' 	 contenteditable='true' class='discount_amount editt' onfocusout='myEditFunc2(this)' name='discount_amount' id='discount_amount'>" 
					+ parseFloat(as[i].service_discount_amount) 
					+ "</td><td style='width: 5%;'  align='right' name='s_service_dis_per' id='s_service_dis_per' class='editt'>" 
					+ as[i].service_discount_per 
					+ "</td><td style='width: 6%;' align='right' class='total_charges editt' id='total_charges'  name='total_charges'>" 
					+ parseFloat(as[i].service_total_amount) 
					+ "</td><td style='width: 8%;'  align='right' contenteditable='true' class='received_amt' id='received_amt' onBlur=saveToDatabase(this,'service_received_amount','"
					+parseFloat(as[i].id)
					+"') onClick='showEdit(this);'>" 
					+ parseFloat(as[i].service_received_amount) 
					+ "</td><td style='width: 8%;'  align='right' class='due_amt' id='due_amount' contenteditable='true' onBlur=saveToDatabase(this,'service_due_amount','"
					+parseFloat(as[i].id)
					+"') onClick='showEdit(this);'>" 
					+ parseFloat(as[i].service_due_amount).toFixed(2) 
					+ "</td>" + 
					"<td style='display:None;' align='right' class='iddd' >" + parseFloat(as[i].id) + "</td> </tr>"; //incase you need the unique id
	// <td align='center'><a class='rdelete' onclick ='delete_user($(this))'></a></td>
				$("#tblservice_catalog_detail tr:last").after(appendTxt);
				$("#tblservice_catalog_detail tr:last").hide().fadeIn('slow');
				}
				
			
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
		$('#serviceprice').val('');
		$('#discountper').val('');
		$('#discountamt').val('');
		$('#received').val('');
		$('#totalamount').val('');
		$('#dueamount').val('');
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
		$('#serviceprice').val('');
		$('#discountper').val('');
		$('#discountamt').val('');
		$('#received').val('');
		$('#totalamount').val('');
		$('#dueamount').val('');
		var serv_id = jQuery("select[name='ServiceName']").val();
		
		jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url();?>/application/helpers/getServicePriceDiag.php",
		data: ({post_service_id: serv_id}),
			success: function(response)	
			{
				//alert(response);
				jQuery("#serviceprice").val(response);
				$('#discountamt').focus();
			}
		});	
 	
	}
</script>

<script>

function myEditFunc(temp) {
  
		var mytr = $(temp).closest('tr');
		var inputs = $(mytr).find('td');
		//var nee = $(mytr).find('id="total_charges"');
		var a = parseInt($(inputs[4]).html());
		 
		var b = parseInt($(inputs[5]).html());
	 
		var c = parseInt($(inputs[6]).html());

		var d = (a*b)-c;
	 
		$(inputs[8]).html(d);
		 
} 
</script>

<script>

function myEditFunc2(temp) {
  
		var mytr = $(temp).closest('tr');
		var inputs = $(mytr).find('td');
		 
		var a = parseInt($(inputs[4]).html()); 
		var b = parseInt($(inputs[5]).html()); 
		var c = parseInt($(inputs[6]).html());

		var d = (a*b) - c;
		var e = (c/a) * 100;
		$(inputs[8]).html(d);
		$(inputs[7]).html(e);
} 
</script>


<script>

function myEditFunc3(temp) {
  
		var mytr = $(temp).closest('tr');
		var inputs = $(mytr).find('td');
		 
		var a = parseInt($(inputs[4]).html()); 
		var b = parseInt($(inputs[5]).html()); 
		var c = parseInt($(inputs[6]).html());
		var h = parseInt($(inputs[8]).html());
		var f = parseInt($(inputs[9]).html());
		var d = (a*b) - c;
		var e = (c/a) * 100;
		var g = h-f;
		$(inputs[8]).html(d);
		$(inputs[7]).html(e);
		$(inputs[10]).html(g);
} 
</script>

<script>
	jQuery("select[name='ServiceName']").change (function()
	{
	
	getprice();
 	});

</script>



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
/*	$("select[name='patient_id']").change(function()
	{
		var pat_id = $("select[name='patient_id']").val();
		//alert(pat_id);
		$('#txttotalinvoiceamount').val();
        
		$('#btndischarge').attr('disabled', true);
		jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url();?>/application/helpers/totalinvoiceamount.php",
		data: ({post_pat_id: pat_id}),
			success: function(response)	
			{
				//alert(response);
				jQuery("#txttotalinvoiceamount").val(response);
				//str = str.replace(/\s+/g, '');
				var totalinvoiceamount=$('#txttotalinvoiceamount').val();
				var totalinvoicerec=$('#invoicereceivedamount').val();
				totalinvoicerec=totalinvoicerec.replace(/,/, '')
				totalinvoiceamount=totalinvoiceamount.replace(/,/, '')

				if (parseInt(totalinvoiceamount)  > parseInt(totalinvoicerec)  )
				{
					
					
					//If total invoice amount is greater than total receive amount input then disable the button
					$('#btndischarge').attr('disabled', true);
				}
				else 
				{
					
					//If total invoice amount is equal to total receive amount input then enabled the button
					$('#btndischarge').attr('disabled', false);
				}
				
			}
			
			});	 //jQuery.ajax

 	});*/

</script>

<script>
/*	$("select[name='patient_id']").change(function()
	{
		var pat_id = $("select[name='patient_id']").val();
		//alert(pat_id);
		$('#invoicereceivedamount').val();
		$('#btndischarge').attr('disabled', true);
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url();?>/application/helpers/totalinvoicereceiveamount.php",
			data: ({post_pat_id: pat_id}),
			success: function(response)	
			{
			//	alert(response);
				$("#invoicereceivedamount").val(response);
				
				var totalinvoiceamount=$('#txttotalinvoiceamount').val();
				var totalinvoicerec=$('#invoicereceivedamount').val();
							
				totalinvoicerec=totalinvoicerec.replace(/,/, '')
				totalinvoiceamount=totalinvoiceamount.replace(/,/, '')
				//alert(totalinvoicerec)
				if (parseInt(totalinvoiceamount)  > parseInt(totalinvoicerec)  )

				{
					//If total invoice amount is greater than total receive amount input then disable the button
					$('#btndischarge').attr('disabled', true);
				}
				else 
				{
					//If total invoice amount is equal to total receive amount input then enabled the button
					$('#btndischarge').attr('disabled', false);
				}
			}
		});	
		
 	});
	
	*/
	
	// Discount
	$('#btndiscount').click(function(){  
		
		var patient_id = $("#patient_reg_no").val();
		//alert(patient_id);

		$(location).attr('href',"<?php echo base_url();?>index.php?reception/make_discount");
		
	});
	
	// Refund
	$('#btnrefund').click(function(){  
		
		var patient_id = $("#patient_reg_no").val();
		//alert(patient_id);

		$(location).attr('href',"<?php echo base_url();?>index.php?reception/make_refund");
		
	});
	
	
	// Zakaat
	$('#btnzakat').click(function(){  
		
		var patient_id = $("#patient_reg_no").val();
		//alert(patient_id);

		$(location).attr('href',"<?php echo base_url();?>index.php?reception/make_zakaat");
		
	});

	
</script>


		<script>

		function showEdit(editableObj) {
			$(editableObj).css("background","#3333333");
		} 
		
		function saveToDatabase(editableObj,column,id) {
		

			$(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");

			$.ajax({
				url: "<?php echo base_url();?>/application/helpers/saveit.php",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){

				}        
		   });
		}

		function dueSum(){
			var duetotal = 0; 
		     $('.due_amt').each(
		       function () {       	
			        b = $(this).html(); 
			        duetotal += parseFloat(b);
			     $("#txtdueamount").val(duetotal); 
				   

		     });

		     var rcvamt = 0;

		     $('.received_amt').each(
		       function () {       	
			        c = $(this).html(); 
			        rcvamt += parseFloat(c);
			     $("#total_paid").val(rcvamt); 
				   

		     });


		     var disamt = 0;

		     $('.discount_amount').each(
		       function () {       	
			        d = $(this).html(); 
			        disamt += parseFloat(d);
			     $("#txtdiscount").val(disamt); 
				   

		     });

 		     var totamt = 0;

		     $('.current_service_price').each(
		       function () {       	
			        e = $(this).html(); 
			        totamt += parseFloat(e);
			     $("#txttotalinvoicecharges").val(totamt); 
				   

		     });
		}
		</script>

