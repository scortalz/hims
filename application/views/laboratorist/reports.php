<?php if($tab_add == 1){

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

<?php } else { ?>

<?php include   realpath(".") . "/application/helpers/mydb.php"; 
$db = NULL;
$db = new DB();
?>

<div class="box">
	<div class="box-header">
			<div class="tab-pane box" id="tablast" >
        <div class="box-content">
         <table cellpadding="0" style="color: grey !important;" cellspacing="0" border="0" class="dTable responsive">
                  <thead>
 
                    <tr>
                            <th><div>Serial No.</div></th>
                            <th><div><?php echo get_phrase('invoice number');?></div></th>
                            <th><div><?php echo get_phrase('mr-number');?></div></th>
                            <th><div><?php echo get_phrase('amount');?></div></th>
                            <th><div><?php echo get_phrase('patient');?></div></th>
                            <th><div><?php echo get_phrase('phone number');?></div></th>
                            <th><div><?php echo get_phrase('doctor');?></div></th>
                            <th><div><?php echo get_phrase('date');?></div></th>
                            <th><div><?php echo get_phrase('test');?></div></th>
            </tr>
          </thead>
                    <tbody>
                    
                        
                     <?php
           
           $invoices = $db->managereportpatient();
           
             $count = 1;foreach($invoices as $row):?>
                        <tr>
                           <td><?php echo  $count++;?></td>
                           <td><?php echo  $row['invoice_number'];?></td>
                           <td><?php echo  $row['patient_reg_no'];?></td>
                           <td><?php echo  $row['totalamount'];?></td>
                           <td><?php echo  $row['patname'];?></td>
                           <td><?php echo  $row['phone'];?></td>
                           <td><?php echo $row['doctorname'];?></td>
                           <td><?php echo date('m/d/Y', $row['creation_timestamp']);?></td>
                           <td>
                            <?php $ans = $row['invoice_number']; ?>
                             <a href="<?php echo base_url().'index.php?laboratorist/manage_invoice_report/'.$ans ?>" target="_blank"
                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('test');?>" class="btn btn-red" >
                               Test </a>
                               
                          
         
                                </td>
                        </tr>
                        <?php endforeach;?>
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