<?php include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?>
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_doctor');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('doctor_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_doctor');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
        	<?php if(isset($edit_profile)):?>
			<div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                	<?php foreach($edit_profile as $row):?>
                    <?php echo form_open('reception/manage_doctor/edit/do_update/'.$row['doctor_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="name" id="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('email');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="email" id="email" value="<?php echo $row['email'];?>"/>
                                    <span id="ErrorContactEmail" style="color:red;"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('password');?></label>
                                <div class="controls">
                                <input type="password" class="validate[required]" name="password" id="password" value="<?php echo $row['password'];?>"/>
                                    <span id="result"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('address');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="address" value="<?php echo $row['address'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('phone');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="phone" id="phone" value="<?php echo $row['phone'];?>"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('joining date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="doj" id="doj" value="<?php echo $row['doj'];?>"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('ratio (%)');?></label>
                                <div class="controls">
                                    <input type="text"  name="ratio" id="ratio" value="<?php echo $row['ratio'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('department');?></label>
                                <div class="controls">
                                    <select name="department_id" class="uniform" style="width:100%;">
                                    	<?php 
										$departments = $this->db->get('department')->result_array();
										foreach($departments as $row2):
										?>
                                    		<option value="<?php echo $row2['department_id'];?>"
                                            	<?php if($row['department_id'] == $row2['department_id'])echo 'selected';?>>
													<?php echo $row2['name'];?>
                                                    	</option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
							 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('create by');?></label>
                                <div class="controls">
                                   <input readonly="readonly" type="text"  name="created_by" id="created_by" value="<?php echo $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id) , 'name'); ?>"/>
                                </div>
                            </div>
                           </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_doctor');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
                          
				<?php $rep_html =' <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" style="width:100%;">
                	<thead>
						<tr>
                        <td align="center" colspan="5">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center" colspan="5">
                      <h1>Manage Doctor</h1></td>
                        </tr>
						<tr><td align="right" colspan="5">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Doctor Name</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Speciality</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Sub Speciality</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Joining Date</div></th>
                    	
						</tr>
					</thead>
                    <tbody>';
				
                ?>
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                      <tr>
                        <td colspan="6" align="right">
                       <input type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print" /></td>
                        </tr>
                		<tr>
                    		<th><div>Serial No.</div></th>
							<th><div><?php echo get_phrase('doctor name');?></div></th>
                    		<th><div><?php echo get_phrase('speciality');?></div></th>
                            <th><div><?php echo get_phrase('sub speciality');?></div></th>
                            <th><div><?php echo get_phrase('joining date');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php  $count = 1;foreach($doctors as $row):
                        
                     $rep_html .='  <tr>
                      <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).' </td>
					  <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['name'].'</td>
					  <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id("speciality",$row["speciality_id"],"speciality_name").'</td>
					  <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id("speciality",$row["speciality_id"],"sub_speciality").'</td>
					  <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.date("m/d/y", strtotime($row["doj"])).'</td>
                     </tr>';
					  endforeach;
                        ?>
                        
                        <?php  $count = 1;foreach($doctors as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['name'];?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id("speciality",$row["speciality_id"],"speciality_name");?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id("speciality",$row["speciality_id"],"sub_speciality");?></td>
							<td><?php echo date("m/d/y", strtotime($row["doj"]));?></td>
							<td align="center">
                            	<a href="<?php echo base_url();?>index.php?reception/doctor_schedule/"
                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('schedule');?>" class="btn btn-blue">
                                		<i class="icon-wrench"></i>
                                </a>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
               
            <?php 
					
                  		$rep_html .= '</tbody></table></div>';
				   		//echo $rep_html;
						
						$dompdf = new DOMPDF();
						$dompdf->load_html($rep_html);

					    $dompdf->render();

					    // The next call will store the entire PDF as a string in $pdf
						$pdf = $dompdf->output();

						// write $pdf to disk, store it in a database or stream it
						// to the client.
				
						file_put_contents("reports/doctorregistration.pdf", $pdf);
						
				   ?>
             </div>   
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('reception/manage_doctor/create/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="name" id="name"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('email');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="email" id="email"/>
                                     <span id="ErrorContactEmail" style="color:red;"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('password');?></label>
                                <div class="controls">
                                    <input type="password" class="validate[required]" name="password" id="password"/>
                                    <span id="result"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('address');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="address"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('phone');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="phone" id="phone"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('joining date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="doj"/>
                                </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('ratio (%)');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="ratio" id="ratio"/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('department');?></label>
                                <div class="controls">
                                    <select name="department_id" class="uniform" style="width:100%;">
									
                                    	<?php 
										$departments = $this->db->get('department')->result_array();
										foreach($departments as $row):
										?>
                                    		<option value="<?php echo $row['department_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
							 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('speciality');?></label>
                                <div class="controls">
                                    <select name="speciality_id" class="uniform" style="width:100%;" >
									
                                    	<?php 
										$specialitys = $this->db->get('speciality')->result_array();
										foreach($specialitys as $row):
										?>
                                    		<option value="<?php echo $row['speciality_id'];?>"><?php echo $row['speciality_name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('sub speciality');?></label>
                                <div class="controls">
                                    <select name="speciality_id" class="uniform" style="width:90%;" >
									
                                    	<?php 
										$specialitys = $this->db->get('speciality')->result_array();
										foreach($specialitys as $row):
											if (strlen($row['sub_speciality']) > 0 )
											{
										?>
										    
                                    		<option value="<?php echo $row['speciality_id'];?>"><?php echo $row['sub_speciality'];?></option>
                                        <?php
											}
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
							 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('create by');?></label>
                                <div class="controls">
                         <input readonly="readonly" type="text" class="validate[required]"  name="created_by" id="created_by" placeholder="Enter Name"  value="<?php echo $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id) , 'name'); ?>"/>
                                </div>
                            </div>
                            <!--<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('profile');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="profile"/>
                                </div>
                            </div>-->

                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_doctor');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>

<script>

// Email Validation
   $('#email').blur(function(){
   
   var e=document.getElementById('email').value;
      var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{3,5})$/;
   if(reg.test(e) == false) {
    $('#ErrorContactEmail').show();
    $('#ErrorContactEmail').text('Invalid Email Address');
	$('#email').focus();
    return false;
   }
   else
   {
    $('#ErrorContactEmail').hide();
    $('#ErrorContactEmail').text('');
   }
    
});


</script>

<script type="text/javascript">
	$("#email").blur(function(){
			var value = $("#email").val();
			//alert(value);
			
			$.post("<?php echo base_url();?>/application/helpers/checkduplicateemail.php", { post_email_id1 : value }, 
			function (data){
					//alert(data);
					if( data == 1)
					{
						if (value.length != 0 )
						{
							$("#ErrorContactEmail").show();
							$("#ErrorContactEmail").text('Duplicate EmailID.');
							return false;
						}
					}
					else
					{
						$("#ErrorContactEmail").hide();
						$("#ErrorContactEmail").text('');
					}
			});
		});

</script>

<script type='text/javascript' src='jquery.min.js'></script>
<!-- JavaScript Patient Validation Code Start -->
	<script language="javascript">
	$(document).ready(function () {
		$("#name").bind("keypress", function (event) {
		if (event.charCode!=0) {
			var regex = new RegExp("^[a-zA-Z ]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				event.preventDefault();
				return false;
			}
		}
	});
	
	$("#created_by").bind("keypress", function (event) {
		if (event.charCode!=0) {
			var regex = new RegExp("^[a-zA-Z ]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				event.preventDefault();
				return false;
			}
		}
	});
	
		
	$("#phone").bind("keypress", function (event) {
		if (event.charCode!=0) {
			var regex = new RegExp("^[0-9-]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				event.preventDefault();
				return false;
			}
		}
	}); 
		
});
	</script>	
	
<script>

$(document).ready(function() {
 
    $('#password').keyup(function(){
        $('#result').html(checkStrength($('#password').val()))
    })  
 
    function checkStrength(password){
 
	 //password should not be null or empty, return message.
    if (password=="" || password=="null") {
        $('#result').removeClass()
        $('#result').addClass('password field should not be empty')
           return '<span style="color:red">password field should not be empty </span>' 
    }
	
    //if the password length is less than 6, return message.
    if (password.length < 6) {
        $('#result').removeClass()
        $('#result').addClass('short')
        return '<span style="color:red">Too short </span>'
    }
  	
	 //if the password length is greater than 6, return message.
    if (password.length > 6) {
        $('#result').removeClass()
        $('#result').addClass('Password is Strong')
        return '<span style="color:green"> Password is Strong </span> '
    }
   
}
     	
});

</script>

<script>

$("#ratio").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
      $(this).val($(this).val().replace(/[^0-9\.]/g,''));
  //alert(event.which);
  if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57) && (event.which < 8 || event.which > 8)) {
   event.preventDefault();
  }
     });
</script>

<script>

	$(document).ready(function(e) {
        $('#btnReport').click(function () {
  
		  var v = "reports/doctorregistration.pdf";
		  window.location = v;
 });
    });
	
	</script>