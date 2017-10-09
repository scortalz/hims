<div class="box">
	<div class="box-header">
			<div class="tab-pane box" id="tablast" >
                <div class="box-content">
                    
					         <table cellpadding="0" style="color: grey !important;" cellspacing="0" border="0" class="dTable responsive">
                  <thead>
 
                    <tr>
                            <th><div>Count.</div></th>
                            <th><div><?php echo get_phrase('Sub service name');?></div></th>
                            <th><div><?php echo get_phrase('service name');?></div></th>
                             <th><div><?php echo get_phrase('interval');?></div></th>
                            <th><div><?php echo get_phrase('action');?></div></th>
                            
                       
            		</tr>
          </thead>
                    <tbody>
                    
                        
                     <?php
           
           
             $count = 1;	foreach($service_relations as $row):?>
                        <tr>
                           <td><?php echo $count++;?></td>
    
                           <td><?php echo $row['sub_service_name'];?></td>
<?php $service = $this->db->get_where('diagnosticservice',array('diagnosticservice_id' => $row['service_id']))->row(); ?>


                           <td><?php echo $service->name;?></td>
                            <td><?php echo $row['interval'];?></td>
                           <td>
                            
                             <span onclick="delsubser(<?php echo $row['relation_id']; ?>)" target="_blank"
                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('Delete');?>" class="btn btn-red" >
                               Delete </span>

                                </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>


                </div>                
			</div>
	</div>
</div>
<div class="box text-center">
	<div class="box-header">
			<div class="tab-pane box" id="tablast" >
                <div class="box-content">
                	<div class="jumbotron">
                		<h1>Add Relations</h1> 
                	</div>
					<form action="<?php echo base_url();?>/admin/addservicerelation/save"  class="form-horizontal" id="addservice" method="post" >
						
	                            <div class="control-group"  id="Service" style="">
                                    <select name="diagnostictype_id" id="diagnostictype_id" class="form-control" />
                                     <?php 
                                    //$this->db->order_by('name' , 'asc');
                                    $diagnostictypes  = $this->db->get('diagnosticservice')->result_array();
                                    ?>
                                    <option value="-1">------ Select Category ------ </option>
                                    <?php
                                    foreach($diagnostictypes as $row):
                                    
                                   ?>
                                          <option value="<?php echo $row['diagnosticservice_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
                                   endforeach;
                                   ?>
                                    </select></div>
                                <div class="control-group"  id="subservice" style="">
                                    <input type="text" required class="form-control subserv" placeholder="Enter Sub Service Name" name="subservice" value="">
                                </div>
                                <div class="control-group"  id="interval" style="">
                                    <input type="text" required class="form-control subserv" placeholder="Enter Interval" name="interval" value="">
                                </div>
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                               <div class="control-group" id="submit" style="">
                                    <<button type="submit" class="btn btn-primary">Submit</button>
                                </div>
					</form>
					<div class="alert alert-success" style="display:none;">
  						<strong>Success!</strong>
					</div>
					<div class="alert alert-danger" style="display:none;">
  						<strong>Select service!</strong>
					</div>
                </div>                
			</div>
	</div>
</div>
<script type="text/javascript">
	$('#diagnostictype_id').select2();

	$('#diagnostictype_id').change(function(){
		var diagida = $('#diagnostictype_id').val();
		if (diagida > 0) {
			$('.alert-danger').hide(200);
		}
	});

	$('#addservice').submit(function(e){
		e.preventDefault();

		var diagid = $('#diagnostictype_id').val();
		if (diagid > 0) {
		$.ajax({
		type: "POST",
      	url: "<?php echo base_url();?>index.php?admin/addserviceinfo",
        data: $('#addservice').serialize(),
      	dataType: "json",

      success: function(args) {
      	if (args == true) {

      	$('.alert-danger').hide(200);
      	$('.subserv').val('');
      	$('.alert-success').show(800);
      	$('.alert-success').fadeOut(2000);
     	 }
      }
		});
		}
		else{
		$('.alert-danger').show(400);
		}
	});

	function delsubser(val){

		$.ajax({
		type: "POST",
      	url: "<?php echo base_url();?>index.php?admin/delserviceinfo/"+val,
        data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
      	dataType: "json",

      success: function(args) {
      	location.reload();
      	}
      });
	}

</script>