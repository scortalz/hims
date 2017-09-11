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
	box-shadow: 2px 5px 2px #222222;
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
	//include realpath(".") . "\application\helpers\mydb.php";
	//$Db = new Db();
?>
<!--<form method="post" id="frmmanual_invoice" name="frmmanual_invoice">-->
	<input type="hidden" id="is_full_payment" name="is_full_payment" />
  <br>
  <table class="awTable" style="width:100%">
    
  
    <tr>

          <td>
          
           <label><b><?php echo get_phrase('select_patient');?></b></label>
           <div class="controls">
            <select class="chzn-select" name="patient_id"  tabindex="1" style="width: 350px!important;" id="patiend_id" >
                <option   >-------------------- ----- Select Patient --------------------</option>
                <?php 
                $this->db->order_by('patient_reg_no' , 'asc');
                $patients1	=	$this->db->get('patient')->result_array();
				
			    foreach($patients1 as $row):

				 if ($row['patient_type']=='IPD')
				 {
					if (strlen($row['discharge_type']) == 0 ) // != 'death' or $row['discharge_type'] !='lama' or $row['discharge_type'] !='normal')
				  	{
                ?>
                    <option value="<?php echo $row['patient_reg_no'];?>"><?php echo $row['patient_reg_no']. ' - ( ' . $row['name']. ' - ' . $row['phone']. ')';?></option>
                    
                   <?php 
				   } 
				 }
				
				   ?>
                <?php
                endforeach;
                ?>
            </select> 
          </div> 
          
    </td>
  	<tr>
        
  
     <td>
    	<label><b><?php echo get_phrase('Date');?></b></label>
           <input type="text"  name="discount_date" id="discount_date" class="datepicker fill-up" />
       </td>
       </tr>
    
    	<tr>
	
				<td><label class="total"><b>Total Discount:</b></label>         
				
            <input type="text" id="txtdiscount" name="txtdiscount"  style="width: 100px;text-align:right;padding-right:10px;"/>
                 </td>   
			</tr>
      
   
  </table>


<br />

	
	
    <div style="float:left;">
	  	<input type="submit" id="btnSaveDiscount" name="btnSaveDiscount" value="   Save  " class="btn btn-green"/>
	  </div>
	&nbsp;<div id="ajaxLoaderDone" style="display:none;padding-left:420px;"><img src="images/process.gif" alt="loading..."></div>
	<script type="text/javascript">
	$(document).ready(function(e) {
	
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
	$('#btnSaveDiscount').click(function(){  	
		//alert ($('#txtdollarrate').val());
		
		if ( $('#txtdiscount').val() < 0 )
		{
			
			alert('Disount Not allowed less than 0');
			$('#txtdiscount').focus();
		  	return false;
		}
		
		// End Validation Contact Information..
		var confirmLeave = confirm('Are you sure you want to save discount ?');
		if (confirmLeave==false)
		{

			return false;
			
		}
		
		var reg_no 				= $('#patiend_id').val();
		var discount_date 		= $('#discount_date').val();
		var discount_amount		= $('#txtdiscount').val();
		
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url();?>application/helpers/postdiscount.php",
			data: ({ 
				post_reg_no 			: reg_no,  
				post_discount_date 		: discount_date,
				post_discount_amount 	: discount_amount,
			}),
			success: function(response)	
			{
				alert('Discount has been successfully posted');
			}
		});	
	});
	
});	
</script>

