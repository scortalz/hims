<?php if($tab_add == 1){
$selectedservice = $this->db->get_where('patient_services', array(
				'id' => $this->uri->segment(4)
			))->result_array();
 
$check  = abs(crc32(uniqid()));
 ?>

<style>
.rdelete {
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
</style>

<div class="box">
	<div class="box-header">
			<div class="tab-pane box" id="tab1" >
                <div class="box-content pagination-centered">
					<div class="jumbotron">

					 
                     <?php foreach ($selectedservice as $selectedrow) { ?>
						
					
				<h1><?php $dptname = $this->db->get_where('diagnosticservice',array('diagnosticservice_id' => $selectedrow['service_id']))->result_array(); echo get_phrase($dptname[0]['dept_name']) ;?></h1>

				<h3><?php $sername = $this->db->get_where('diagnosticservice',array('diagnosticservice_id' => $selectedrow['service_id']))->result_array(); echo get_phrase($sername[0]['name']) ;?></h3>

					</div>

					<h3></h3>
              <?php echo form_open('', array('class' => 'form-dhorizontal validatable','id' => 'testform'));?>
                        <div class="padded">
                            <div class="control-group">

         <?php $patientname = $this->db->get_where('patient',array('patient_reg_no' => $selectedrow['patient_reg_no']))->result_array();

         if(empty($patientname[0]['name'])) {
         ?>
              <label class="control-label"><?php echo get_phrase('not registered'); ?></label>
		<?php } else {  ?>
              <label class="control-label"><?php echo get_phrase($patientname[0]['name']); ?></label>
	                        <div class="controls">
	                        <input type="hidden" readonly name="mrnumber" id="mrnumber" value="<?php echo $selectedrow['patient_reg_no'];?>" />
                            <input type="hidden" name="serviceid" id="serviceid" value="<?php echo $selectedrow['service_id'];?>" />
                            <input type="hidden" name="rep_session" id="rep_session" value="<?php echo $check; ?>" />
	                        </div>

           <?php } ?>         

<?php $reports = $this->db->get_where('diagnosticservice',array('diagnostictype_id' => 1 ))->result_array(); ?>
    <select name="test" id="test">
    <option value="">choose....</option>

    <?php foreach($reports as $report) { ?>
        <option value="<?php echo $report['name'];?>"><?php echo $report['name'];?></option>
<?php } ?>
    </select>
    <input type="text" class="form-control result" name="result" id="result">
    <input type="text" class="form-control interval" name="interval" id="interval">
    <button type="submit" class="btn btn-blue bot"><?php echo get_phrase('add report');?></button>

              </div>
          </div>  
      </div>

 
                        <?php } ?>
                    <?php echo form_close();?>



        <table style="width:100%" border="1" class="testrep">
        <thead>
        <tr style="">
            <th align="center" style="width: 331px;">Test</th>
            <th align="center" style="width: 331px;">Result</th>
            <th align="center" style="width: 331px;">Reference Interval</th>
            <th align="center" style="width: 147px;">Action</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
                </div>                
            </div>
        </div>
       <center> <a type="button" href="<?php echo base_url();?>index.php?laboratorist/getlabreport/<?php echo $check; ?>" class="btn btn-blue"><?php echo get_phrase('generate report');?></a> </center>

<?php } else { ?>
<div class="box">
	<div class="box-header">
			<div class="tab-pane box" id="tablast" >
                <div class="box-content">
                    <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" style="color: grey !important;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo get_phrase('patient mr number'); ?></th>
                            <th><?php echo get_phrase('Service Type');?></th>
                            <th><?php echo get_phrase('service name');?></th>
                            <th><?php echo get_phrase('dept name');?></th>
                            <th><?php echo get_phrase('Quantity');?></th>
                            <th><?php echo get_phrase('service amount');?></th>
                            <th><?php echo get_phrase('Amount received');?></th>
                            <th><?php echo get_phrase('Amount discount');?></th>
                            <th><?php echo get_phrase('Amount Due');?></th>
                            <<th><?php echo get_phrase('Options');?></th>
                        </tr>

                        </thead>
                        <tbody>
                            <?php $count = 1; foreach ($services as $row) { ?>
                            	
                        <tr>
                            <td><?php echo $count++ ?></td>
                            <td><?php echo $row['patient_reg_no']; ?></td>
							
							<td><?php $servicetype = $this->db->get_where('diagnostictype',array('diagnostictype_id' => $row['service_cat_id']))->result_array(); echo get_phrase($servicetype[0]['name']) ;?></td>
                        
                            <td><?php $servicename = $this->db->get_where('diagnosticservice',array('diagnosticservice_id' => $row['service_id']))->result_array();  echo get_phrase($servicename[0]['name']) ;?></td>

                            <td><?php $deptname = $this->db->get_where('diagnosticservice',array('diagnosticservice_id' => $row['service_id']))->result_array();  echo get_phrase($deptname[0]['dept_name']) ;?></td>

                            <td><?php echo $row['service_qty']; ?></td>
                            <td><?php echo $row['service_amount']; ?></td>
                            <td><?php echo $row['service_received_amount']; ?></td>
                            <td><?php echo $row['service_discount_amount']; ?></td>
                            <td><?php echo $row['service_due_amount']; ?></td>
                            <td align="center">
							<a href="<?php echo base_url();?>index.php?laboratorist/labreports/add_report/<?php echo $row['id'];?>" rel="tooltip" data-placement="top" 
							data-original-title="<?php echo get_phrase('add');?>" 
							class="btn btn-info"> <i class="icon-plus"></i>
    						</a>
                       		 </td>
                        </tr>
                           <?php } ?>
                        </tbody>
                    </table>  


                </div>                
			</div>
	</div>
</div>
<?php } ?>
<script src="<?php echo base_url();?>template/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>template/js/additional-methods.min.js"></script>

<script type="text/javascript">


$( '#testform' ).validate({
 

  rules: {
    result: {
      required: true,
      number: true
    },
    interval: {
      required: true,
      number: true
    },
    test: {
      required: true
  }
  }
});

$('#test').select2();

/* $('.bot').click(function(){   


});
*/ $('#testform').submit(function(event){

    event.preventDefault();
    var test        = $('#test').val();
    var result      = $('.result').val();
    var interval    = $('.interval').val();
    var serviceid   = $('#serviceid').val();
    var repsession  = $('#rep_session').val();
    var mrnum       = $('#mrnumber').val();

if (test && result && interval) {

     $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>index.php?laboratorist/insertreport",
      data: $("#testform").serialize(),
      dataType: "json",

      success: function(args) {
       

$('.testrep').append('<tr style="color:#5f5f5f;"><td align="center">'+args.getsess[0]['test']+'</td>'+
    '<td align="center">'+args.getsess[0]['result']+'</td>'+'<td align="center">'+args.getsess[0]['intvl']+'</td>'+ '<td style="width: 8%;" align="center"><a class="rdelete" onclick="delete_rep('+args.getsess[0]['rep_id']+')"></a></td>' +'</tr>');
      /* $.each(args.getsess[0], function(index, el) {
           console.log(el.test);
       });*/
      }
     });

$('.result').val('');
$('.interval').val('');

}

});

$(".testrep").on('click', '.rdelete', function () {
    $(this).closest('tr').remove();
});

function delete_rep(rowid)
    {
      $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>index.php?laboratorist/insertreport/"+rowid,
       data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
      dataType: "html",

      success: function(args) {
       /* alert(args)*/
      }
    });
    }
</script>