<?php include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?>
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_nurse');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('nurse_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_nurse');?>
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
                    <?php echo form_open('admin/manage_nurse/edit/do_update/'.$row['nurse_id'] , array('class' => 'form-horizontal validatable'));?>
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
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_nurse');?></button>
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
                        <td align="center"  colspan="5">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="5">
                      <h1>Manage Nurse</h1></td>
                        </tr>
						<tr><td align="right" colspan="5">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Nurse Name</div></th>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Email</div></th>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Address</div></th>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Phone</div></th>
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
							<th><div><?php echo get_phrase('nurse name');?></div></th>
                    		<th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('address');?></div></th>
                            <th><div><?php echo get_phrase('phone');?></div></th>
                             <th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($nurses as $row):
                  
				        $rep_html .=' <tr>
                            <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.($count++).' </td>
							<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.$row["name"].' </td>
							<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.$row["email"].' </td>
						<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.$row["address"].' </td>
							<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.$row["phone"].' </td>
							
                        </tr>';
						        endforeach;
                        ?>
                        
                     <?php $count = 1;foreach($nurses as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['name'];?></td>
							<td><?php echo $row['email'];?></td>
							<td><?php echo $row['address'];?></td>
							<td><?php echo $row['phone'];?></td>
							<td align="center">
                            	<a href="<?php echo base_url();?>index.php?admin/manage_nurse/edit/<?php echo $row['nurse_id'];?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                                		<i class="icon-wrench"></i>
                                </a>
                            	<a href="<?php echo base_url();?>index.php?admin/manage_nurse/delete/<?php echo $row['nurse_id'];?>" onclick="return confirm('delete?')"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete');?>" class="btn btn-red">
                                		<i class="icon-trash"></i>
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
				
						file_put_contents("reports/registerednurse.pdf", $pdf);
						
				   ?>
             </div> 
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/manage_nurse/create/' , array('class' => 'form-horizontal validatable'));?>
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
                                    <input type="password" class="validate[required]" name="password" id="password" maxlength="15"/>
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
                            
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_nurse');?></button>
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

<script type="text/javascript">
	$("#email").blur(function(){
			var value = $("#email").val();
			//alert(value);
			
			$.post("<?php echo base_url();?>/application/helpers/checkduplicateemail.php", { post_email_id2 : value }, 
			function (data){
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

	$(document).ready(function(e) {
        $('#btnReport').click(function () {
  
		  var v = "reports/registerednurse.pdf";
		  window.location = v;
 });
    });
	
	</script>