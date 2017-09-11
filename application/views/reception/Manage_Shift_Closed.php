<!-- <?php  //include'D:\xampp\htdocs\incisivehims\application\views\admin/myincludefile.php';?>  -->
<div class="box">
	<div class="box-header">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_Shift Closed');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('Shift Closed by');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('Shift Closed');?>
                    	</a></li>
		</ul>
    	<!--CONTROL TABS END-->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	<!--EDITING FORM STARTS-->
        	<?php if(isset($edit_profile)):?>
			<div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                	<?php foreach($edit_profile as $row):?>
                    <?php echo form_open('reception/Manage_Shift_Closed/edit/do_update/'.$row['reception'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Cash_Recieved');?></label>
                                <div class="controls">
                                    <input  required type="text" class="validate[required]" required name="Cash_Recieved" value="<?php echo $row['Cash_Recieved'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Total Bill');?></label>
                                <div class="controls">
                                    <input  required type="text" class="validate[required]" name="Total_bill" value="<?php echo $row['Total_bill'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Total Cash');?></label>
                                <div class="controls">
                                    <input type="number"  class="validate[required]" required name="Total_cash" value="<?php echo $row['Total_cash'];?>" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Available Cash');?></label>
                                <div class="controls">
                                    <input type="number" class="" required  name="Available_Cash" value="<?php echo $row['Available_Cash'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('reason');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="reason"  value="<?php echo $row['reason'];?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_Shift_Closed');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
            <?php endif;?>
            <!--EDITING FORM ENDS--->
            
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box   <?php if(!isset($edit_profile)) echo 'active';?> " id="list"> 
				
                <table cellpadding="20" style = " width: 100%;
    border-collapse: separate;
    border-spacing:  5px;" cellspacing="0" border="2px solid black; width :100%;" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('Person');?></div></th>
                    		<th><div><?php echo get_phrase('Cash InHand');?></div></th>
                            <th><div><?php echo get_phrase('Total Bill');?></div></th>
                            <th><div><?php echo get_phrase('Total Cash ');?></div></th>
                    		<th><div><?php echo get_phrase('Available Cash');?></div></th>
                            <th><div><?php echo get_phrase('Reason');?></div></th>
                    		<th><div><?php echo get_phrase('Date');?></div></th>
                            <th><div><?php echo get_phrase('Actions');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1; foreach($Shift_Closed as $row):?>
                        <tr>
                            <td align = "center"><?php echo $count++;?></td>
							<td align = "center"><?php echo $row['name'];?></td>
							<td align = "center"><?php echo $row['Cash_Recieved'];?></td>
							<td align = "center"><?php echo $row['Total_bill'];?></td>
                            <td align = "center"><?php echo $row['Total_cash'];?></td>
							<td align = "center"><?php echo $row['Cash_Recieved'];?></td>
                            
                            <td align = "center"><?php echo $row['reason'];?></td>
                            <td align = "center"><?php echo $row['Closing_Date'] ?></td>
							<td align="center">
                            	<a href="<?php echo base_url();?>index.php?reception/Manage_Shift_Closed/edit/<?php echo $row['Sh_id'];?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                                		<i class="icon-wrench"></i>
                                </a>
                            	<!--<a href="<?php echo base_url();?>index.php?reception/Manage_Shift_Closed/delete/<?php echo $row['Sh_id'];?>" onclick="return confirm('delete?')"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete');?>" class="btn btn-red">
                                		<i class="icon-trash"></i>
                                </a>-->
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!--TABLE LISTING ENDS->
            
            
			<!--CREATION FORM STARTS-->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('reception/Manage_Shift_Closed/Create_Shift_Closed/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Cash in Hand');?></label>
                                <div class="controls">
                                    <input type="number"  id = "CashInHand" class="validate[required]" name="Cash_Recieved"
                                    required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Total Bill');?></label>
                                <div class="controls">
                                    <input type="number" class="validate[required]" name="Total_bill" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Total Cash');?></label>
                                <div class="controls">
                                    <input type="number"  id = "totalcash" class="validate[required]" name="Total_cash" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" id = "blur" ><?php echo get_phrase('Available Cash ');?></label>
                                <div class="controls">
                                    <input type="number"  id = "availablecash"  class="Available" name="Available_Cash"  readonly="readonly" />
                                    <input type="checkbox" id  = "edit" name="myself" class="myself"  /><span style="vertical-align:middle">&nbsp;Edit me</span>
                                </div>
                            </div>
                            <div class="control-group_1" style = " display: none;">
                                <label class="control-label"><?php echo get_phrase('Reason');?></label>
                                <div class="controls">
                                    <input type="text" class = "reasonclass" name="reason" />
                                </div>
                            </div>
                            
                    </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('Save Shift_Closed');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!--CREATION FORM ENDS-->
            
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function() { 
    $('#totalcash').blur(function() {
     var totalcash = document.getElementById("totalcash").value;
     var CashInHand = document.getElementById("CashInHand").value;

       var total = parseInt(totalcash)+parseInt(CashInHand) ;
    // var cde =  $('#available').val(abc);
    console.log(total);
    $('#availablecash').val(total);
    });

 
$( ".myself ").click(function() {
  $( ".control-group_1" ).slideToggle( "slow" );

    
        $(".reasonclass").attr("required","true");

});

})

</script>
<!--<script type="text/javascript">
$(document).ready(function () {
   var n = $("#totalcash").val();
    var m = $("#availablecash").val();

    if(parseInt(n) === parseInt(m)) 
       {
           alert("You have Entered Unmatch Valuse ,Yu must be give Reason !!");
       }
    else 
       {
            alert("You have enter true values press ok and Go For Chill !!");
        }
});
</script>-->
<script type ="text/javascript">
  /* function changeReadOnly() 
{

    var el = document.getElementById("availablehere");
    el.readOnly =false;
}
*/ 
 document.getElementById('edit').onclick = function() {
    document.getElementById('availablecash').removeAttribute('readonly');
};

</script>