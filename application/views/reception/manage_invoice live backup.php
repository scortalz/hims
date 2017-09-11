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

<?php 
//echo realpath(".");
  include   realpath(".") . "/application/helpers/mydb.php";
  $db = NULL;
  $db = new DB();
  error_reporting(0);

  $arrRegNo = $db->Generate_Patient_Registration_Number();
    
     $id = $arrRegNo[0]['patient_id'] + 1; 
     $gen_reg_no = 'MR-'.date('ym-', time()).str_pad($id, 4, '0', STR_PAD_LEFT);
  // Call db->method to generate patient registration number
  $arrRegNo = $db->Generate_Invoice_Number();

  $id = $arrRegNo[0]['invoice_id'] + 1; 
  $gen_inv_no = 'R-'.date('dmHi-', time()).str_pad($id, 4, '0', STR_PAD_LEFT);

  $current_date = date('m/d/Y H:i', time());
?>
<?php include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?> 
<div class="box">
  <div class="box-header">
    
      <!-CONTROL TABS START-->
    <ul class="nav nav-tabs nav-tabs-left">
          <?php if(isset($edit_profile)):?>
      <li class="active">
              <a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
          <?php echo get_phrase('edit_invoice');?>
                      </a></li>
            <?php endif;?>
      <li class="<?php if(!isset($edit_profile))echo 'active';?>">
              <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
          <?php echo get_phrase('invoice_list');?>
                      </a></li>
      <li>
              <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
          <?php echo get_phrase('add_invoice');?>
                      </a></li>
    </ul>
      <!--CONTROL TABS END-->
        
  </div>
  <div class="box-content padded">
    <div class="tab-content">
          <!----EDITING FORM STARTS---->
          <?php if(isset($edit_profile)):?>
      <div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                  <?php foreach($edit_profile as $row):?>
                    
                    <?php echo form_open('reception/manage_invoice/edit/do_update/'.$row['invoice_id'] , array('class' => 'form-dhorizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient');?></label>
                                <div class="controls">
                                    <select2-drop-maskt class="" id="patient_id" name="patient_id">
                    <?php 
                    $this->db->order_by('account_opening_timestamp' , 'asc');
                    $patients = $this->db->get('patient')->result_array();
                    foreach($patients as $row2):
                    ?>
                                          <option value="<?php echo $row2['patient_id'];?>" <?php if($row2['patient_id']==$row['patient_id'])echo 'selected';?>>
                        <?php echo $row2['name'];?></option>
                                        <?php
                    endforeach;
                    ?>
                  </select>
                                </div>
                            </div>
                <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('doctor');?></label>
                                <div class="controls">
                                    <select class="" name="doctor_id" id="doctor_id">
                    <?php 
                    //$this->db->order_by('account_opening_timestamp' , 'asc');
                    $doctors  = $this->db->get('doctor')->result_array();
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
                      <?php /*?>    <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('reffered by');?></label>
                                <div class="controls">
                <select name="refferedby" id="refferedby" class="chzn-select" >
                                <option value="RMC" <?php if($row['refferedby']=='RMC')echo 'selected';?>><?php echo get_phrase('RMC');?></option>
                               <option value="CardNo" <?php if($row['refferedby']=='CardNo')echo 'selected';?>><?php echo get_phrase('CardNo');?></option>
              <option value="OtherEntry" <?php if($row['refferedby']=='OtherEntry')echo 'selected';?>><?php echo get_phrase('OtherEntry');?></option>
              <option value="sameabove" <?php if($row['refferedby']=='sameabove')echo 'selected';?>><?php echo get_phrase('sameabove');?></option>
                  </select>
      <input type="text"   name="med_card_no" id="med_card_no" value="<?php echo $row['med_card_no'];?>" style="width:13%"  />
      <input type="checkbox" name="sameasabove" id="sameasabove" /><span style="vertical-align:middle">&nbsp;Same as above</span>
                
                                </div>
                            </div><?php */?>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('total amount');?></label>
                                <div class="controls">
                             <input type="text" name="totalamount" id="totalamount" value="<?php echo $row['totalamount'];?>"  />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('discount amount');?></label>
                                <div class="controls">
                                 <input type="text" name="discountamount" id="discountamount" value="<?php echo $row['discountamount'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('discount (%)');?></label>
                                <div class="controls">
                                    <input type="text" name="discount" id="discount" value="<?php echo $row['discount'];?>"/>
                                </div>
                            </div>
                 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('recieved amount');?></label>
                                <div class="controls">
                                    <input type="text" name="recievedamount" id="recievedamount" value="<?php echo $row['recievedamount'];?>"/>
                                </div>
                            </div>
                <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('due amount');?></label>
                                <div class="controls">
                                    <input type="text" name="dueamount" id="dueamount" value="<?php echo $row['dueamount'];?>"/>
                                </div>
                            </div>
              <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('care of');?></label>
                                <div class="controls">
                                    <input type="text" name="careof" id="careof" value="<?php echo $row['careof'];?>"/>
                                </div>
                            </div>

               <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_invoice');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
      </div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!--TABLE LISTING STARTS-->
            
            <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
                        
        
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                  <thead>
 
                    <tr>
                        <th><div>Serial No.</div></th>
                            <th><div><?php echo get_phrase('invoice number');?></div></th>
                            <th><div><?php echo get_phrase('amount');?></div></th>
                            <th><div><?php echo get_phrase('patient');?></div></th>
                            <th><div><?php echo get_phrase('phone number');?></div></th>
                             <th><div><?php echo get_phrase('doctor');?></div></th>
                              <th><div><?php echo get_phrase('date');?></div></th>
                               <th><div><?php echo get_phrase('Print');?></div></th>
            </tr>
          </thead>
                    <tbody>
                    
                        
                     <?php
           
           $invoices = $db->manageinvoicepatient();
           
             $count = 1;foreach($invoices as $row):?>
                        <tr>
                           <td><?php echo  $count++;?></td>
                           <td><?php echo  $row['invoice_number'];?></td>
                           <td><?php echo  $row['totalamount'];?></td>
                           <td><?php echo  $row['patname'];?></td>
                           <td><?php echo   $row['phone'];?></td>
                           <td><?php echo $row['doctorname'];?></td>
                           <td><?php echo date('m/d/Y', $row['creation_timestamp']);?></td>
                           <td>
                            <?php $ans = $row['invoice_number'] ?>
                             <a href="<?php echo base_url().'index.php?reception/manage_invoice_report/'.$ans ?>" target="_blank"
                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('print invoice');?>" class="btn btn-red" >
                               <i class="icon-print"></i> </a>
                               
                          
         
                                </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
               

             </div>  
             
            <!----TABLE LISTING ENDS--->
            
            
      <!----CREATION FORM STARTS---->

      <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                <p><span class="badge" id="error" style="margin-left: 7px; display:none;"></span></p>
                    <?php echo form_open('reception/manage_invoice/create' , array('class' => 'form-horizontal novalidate'));?>
                    
                    <input type="hidden"  name="createdby" id="createdby" readonly="readonly" value="<?php echo $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id) , 'name'); ?>"/>
                        <div class="padded">
                        <input type="hidden" id="conDisc" name="conDisc" value="0" />
                        <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('invoice_no');?></label>
                                <div class="controls">
                                    <input type="text"  name="invoice_no" id="invoice_no" readonly="readonly" value="<?php echo $gen_inv_no; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient');?></label>
                                <div class="controls" style="width:80% !important;">
                                    <select class="" name="patient_id" id="patient_id" tabindex="1" style="width:215px;">
                                    <<option value="-1">--------Select Patient--------</option>}
                                    option
                                  <?php 
                                  $this->db->order_by('account_opening_timestamp' , 'asc');
                                  $patients = $this->db->get('patient')->result_array();
                                  foreach($patients as $row):
                                  ?>
                                  <option value="<?php echo $row['patient_id'];?>" mrnum="<?php echo $row['patient_reg_no'];?>"><?php echo $row['patient_reg_no']. ' - ( ' . $row['name']. ' - ' . $row['phone']. ')';?></option>
                                                      <?php
                                  endforeach;
                                  ?>
                                </select>
                                <input type="checkbox" id="cbox"  name="check_box"> Checked if you Add new patient </input>
                                </div>
                          </div>
               <div class="tab_box"  style="padding: 5px;border:none;"  >
               <div class="box-content" id="add_patient" style="display:none;">
                    <?php //echo form_open('reception/manage_patient/create/' , array('class' => 'form-horizontal validatable'));?>
                   <form method="post" action="<?php echo base_url();?>index.php?" class="form-horizontal validatable">
                       <div class="padded">
                             <div class="control-group">
                               <label class="control-label"><?php echo get_phrase('registration no');?></label>
                               <div class="controls">
                                   <input type="text"  name="patient_reg_no" id="patient_reg_no" readonly="readonly" value="<?php echo $gen_reg_no; ?>"/>
                               </div>
                           </div>
             <div class="control-group">
                               <label class="control-label"><?php echo get_phrase('patient type');?></label>
                               <div class="controls">
                                  <select name="patient_type" id="patient_type" class="uniform" style="width:100%;">
                                     <option value="OPD"><?php echo get_phrase('OPD');?></option>
                                     <option value="IPD"><?php echo get_phrase('IPD');?></option>
                                   </select>
                               </div>
                           </div>
  
             <div class="control-group">
                               <label class="control-label"><?php echo get_phrase('salutation');?></label>
                               <div class="controls">
                                   <select name="salutation" id="salutation" class="uniform" style="width:100%;">
                                     <option value="Mr."><?php echo get_phrase('Mr.');?></option>
                                     <option value="Mrs."><?php echo get_phrase('Mrs.');?></option>
                   <option value="B/O."><?php echo get_phrase('B/O.');?></option>
                   <option value="Miss."><?php echo get_phrase('Miss.');?></option>
                                   </select>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label"><?php echo get_phrase('patient name');?></label>
                               <div class="controls">
                                   <input type="text" novalidate  name="name" id="name"/>
                               </div>
                           </div>
                            <div class="control-group">
                               <label class="control-label"><?php echo get_phrase('F / H. Name');?></label>
                               <div class="controls">
                                   <input type="text" novalidate name="father_husbandname" id="father_husbandname"
                                   />
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label"><?php echo get_phrase('nic no');?></label>
                               <div class="controls">
                               <input type="text" novalidate name="start_5" id="start_5" placeholder="12345"  maxlength="5" style="width:6%"/>
                               <input type="text" novalidate name="mid_7" id="mid_7" placeholder="1234567"  maxlength="7" style="width:7%"/>
                               <input type="text" novalidate name="end_1" id="end_1" placeholder="1"  maxlength="1" style="width:2%"/>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label"><?php echo get_phrase('address');?></label>
                               <div class="controls">
                                   <input type="text"  name="address" />
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label"><?php echo get_phrase('phone');?></label>
                               <div class="controls">
                                   <input type="text" novalidate  name="phone" id="phone" maxlength="12"/>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label"><?php echo get_phrase('sex');?></label>
                               <div class="controls">
                                   <select name="sex" id="sex" class="uniform" style="width:100%;">
                                     <option value="Male"><?php echo get_phrase('Male');?></option>
                                     <option value="Female"><?php echo get_phrase('Female');?></option>
                                   </select>
                               </div>
                           </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('birth_date');?></label>
                                <div class="controls">
                                    <input type="text" novalidate class="datepicker"  name="birth_date" id="birth_date" />
                                </div>
                            </div>
                           <div class="control-group">
                               <label class="control-label"><?php echo get_phrase('age');?></label>
                               <div class="controls">
                                   <input type="text"  name="age" id="age" readonly="readonly"/> 
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label"><?php echo get_phrase('blood_group');?></label>
                               <div class="controls">
                                   <select name="blood_group" id="blood_group" class="uniform" style="width:100%;">
                                   <option value="0">None</option>
                                     <option value="A+">A+</option>
                                       <option value="A-">A-</option>
                                       <option value="B+">B+</option>
                                       <option value="B-">B-</option>
                                       <option value="AB+">AB+</option>
                                       <option value="AB-">AB-</option>
                                       <option value="O+">O+</option>
                                       <option value="O-">O-</option>
                                   </select>
                               </div>
                           </div>
                       
                      <!-- <div class="form-actions">
                                          <button ty0pe="submit" class="btn btn-blue"><?php //echo get_phrase('add_patient');?></button>
                                      </div> -->
                                                          <?php //echo form_close();?>                
                </div>                
             </div>
                         </div> 
            <!-CREATION FORM OF NEW PATIENT  ENDS-->
            
    
                          <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Check Box');?></label>
                                <div class="controls">
                                   <input type="radio" name="radio" id="con" value = "C" checked="checked" tabindex="2"/>&nbsp;Consultation
                                   <input type="radio" name="radio" id="dia" value="D" tabindex="3" />&nbsp;Diagnostic
                                </div>
                          </div>
                         <div class="control-group" id="doctors">
                                <label class="control-label"><span class="doc-sel" style="display:none;"> Your Current: </span><?php echo get_phrase('doctor');?></label>
                                <div class="controls">
                                    <select class="" name="doctor_id" id="doctor_id"  style="" tabindex="4" >
                                  <?php 
                                  //$this->db->order_by('account_opening_timestamp' , 'asc');
                                  $doctors  = $this->db->get('doctor')->result_array();
                                  ?>
                                  <div class="selects1">                               
                                  
                                  </div>
                                  <div class="22">
                                  <option value="-1">------Select Doctor------</option>
                                  </div>
                                  <?php
                                  foreach($doctors as $row):
                                  ?>
                                  <option value="<?php echo $row['doctor_id'];?>"><?php echo $row['name'];?></option>
                                                      <?php
                                  endforeach;
                                  ?>
                                </select>
                                </div>
                          </div>
                            <div class="control-group"  id="category" style="display:none;">
                                <label class="control-label"><?php echo get_phrase('Category');?></label>
                                <div class="controls">
                                    <select name="diagnostictype_id" id="diagnostictype_id" class="" />
                                     <?php 
                                    //$this->db->order_by('name' , 'asc');
                                    $diagnostictypes  = $this->db->get('diagnostictype')->result_array();
                                    ?>
                                    <option value="-1">------ Select Category ------ </option>
                                    <?php
                                    foreach($diagnostictypes as $row):
                                    
                                   ?>
                                          <option value="<?php echo $row['diagnostictype_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
                                   endforeach;
                                   ?>
                                    </select>
                                    <input type="button" id="addmore" name="addmore" value="Add Invoice" title="Add to Invoice" class="btn btn-green"/>
                                   <div id="invoice_services" name="invoice_services">&nbsp;</div>
                                    <label id='total' style="font-size:large;display:none;"> </label>
                                    <input type="text" id="tmp_totalamount" name="tmp_totalamount" style="display:none;" />
                                </div>
                                <br /><br />
                                <div class="span6">
                    <div class="box">
                                    <div class="box-header">
                                        <span class="title">
                                          <i class="icon-reorder"></i> Selected Services </span>
                                    </div>
                                    <div style="max-height: 500px; overflow-y: auto" class="box-content scrollable">
 
                                            <table id="tblservice_catalog_detail" width="40%" class="span6" style="float:right;" border="1">
                                                <thead>
                                                    <tr style="height:20px!important;">
                                                    <th align="center" style="border: 1px solid ##B7B7B7;background-color:#CDCDCD;width:4%;">Serv. #</th>
                                                    <th align="center" style="border: 1px solid ##B7B7B7;background-color:#CDCDCD;width:30%;">Service Name</th>                         <th align="center" style="border: 1px solid ##B7B7B7;background-color:#CDCDCD;width:8%;">Amount</th>
                                                    <th align="center" style="border: 1px solid ##B7B7B7;background-color:#CDCDCD;width:8%;">Action</th>
                                                </tr>
                                                  </thead>
                                                    <tr style="display:block;" class="mytr-inv-data"></tr>
                                            </table>
                                  </div>
                    </div>
                </div>
                            </div>
                           
 
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('total amount');?></label>
                                <div class="controls">
                                <input type="text" name="totalamount" value="" id="totalamount" readonly="readonly" tabindex="7"/>
                                </div>
                                
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('discount amount');?></label>
                                <div class="controls">
                                    <input type="text" required  name="discountamount" id="discountamount" maxlength="3" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('discount (%)');?></label>
                                <div class="controls">
                                    <input type="text"  name="discount" id="discount" tabindex="8" maxlength="3" value="0"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('recieved amount');?></label>
                                <div class="controls">
                                    <input type="text" required  name="recievedamount"  value="" id="recievedamount" tabindex="9"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('due amount');?></label>
                                <div class="controls">
                                    <input type="text" required name="dueamount" readonly="readonly" id="dueamount" />
                                </div>
                            </div>
                           <div class="control-group">
                                 <label class="control-label"><?php echo get_phrase('Care of');?></label>
                                <div class="controls">
                                    <input type="text" name="careof" id="careof"   tabindex="9"/>
                             <input type="checkbox" name="myself" id="myself" /><span style="vertical-align:middle">&nbsp;Myself</span>
                                </div>
                            </div>
              
 
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue" id="save_invoice" name="save_invoice"><?php echo get_phrase('save_invoice');?></button>
                            <input type="hidden" id="rcvhidamt" value="" />
                            <input type="hidden" id="hiddueamt" value="" />

                        </div>
                    <?php echo form_close();?>                
                </div>                
      </div>
      <!--CREATION FORM ENDS-->
            <div id="result"></div> 
    </div>
  </div>
</div>

<script language="javascript">


$('#patient_id').change(function () {

var patientid = $('#patient_id :selected').attr('mrnum');
$.trim(patientid);
 var patientselval = $('#patient_id :selected').val();

 if (patientselval > 0) {


jQuery.ajax({
    type: "GET",
    url: "<?php echo base_url();?>/application/helpers/getdoctorofpatient.php?q=" + patientid,
    dataType:"json",
    success: function(response) 
      {  

      if($.isNumeric(response.doctor_id) == true){
        $('#error').hide();
        $('#error').html('');
        $('#doctor_id').val(response.doctor_id);


        jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url();?>/application/helpers/getdoctorrate.php",
        data: ({post_doctor_id: response.doctor_id}),
        success: function(data) 
        {
          //alert(response);
          if (data > 0)
          {
            jQuery("#totalamount").val(data);
          }
          else
          {
            alert('Selected service rate is set to 0, please assign rate');       
          }
          jQuery("#serviceprice").focus();
        }
    }); 



          }
          else {
          $('#error').show();
          $('#error').html('patient is not appoint to any doctor');
          $('#doctor_id').val('-1');
          jQuery("#totalamount").val('');



          }
        }
            });
          }
      });






/*$('#patient_id').change(function () {

var patientid = $('#patient_id :selected').attr('mrnum');
$.trim(patientid);
 var patientselval = $('#patient_id :selected').val();

 if (patientselval > 0) {


jQuery.ajax({
    type: "GET",
    url: "<?php echo base_url();?>/application/helpers/getdoctorofpatient.php?q=" + patientid,
    dataType:"json",
    success: function(response) 
      {  

  if($.isNumeric(response.doctor_id) == true){

    $('#error').hide();
    $('#doctor_id').find('option[value="-1"]').val(response.doctor_id);
    $('#doctor_id').find('option[value="'+response.doctor_id+'"]').text(response.name);
    $('#doctor_id').find('option[value="'+response.doctor_id+'"]').attr('selected','selected');
    $('.select2-choice').not(':first').find('span').eq(0).remove();
    $('.select2-choice').not(':first').prepend('<span>'+response.name+'</span>');
    $('#doctor_id').find("option").eq(0).remove();
    $('.doc-sel').show();
     }

   else {
    $('#error').show();
    $('#error').append('patient is no appointed to any doctor');
    $('.select2-choice').not(':first').find('span').eq(0).remove();
    $('.select2-choice').not(':first').prepend('<span>Please Select your doctor</span>');

     }

      }

  });

}

else {

      $('#error').hide();
      $('#error').html('');

}

});*/
$(document).ready(function() {
 
    
    $('#birth_date').change(function(){
    
    var today = new Date();
    var dd = Number(today.getDate());
    var mm = Number(today.getMonth()+1);
    
    var yyyy = Number(today.getFullYear()); 
    
    var myBD = $('#birth_date').val();
    var myBDM = Number(myBD.split("/")[0])
    var myBDD = Number(myBD.split("/")[1])
    var myBDY = Number(myBD.split("/")[2])
  
    var age = yyyy - myBDY;
    console.log(myBDY);
    //$('#age input').attr("disabled","disabled")
    
            if(mm < myBDM)
            {
            age = age - 1;      
            }
            else if(mm == myBDM && dd < myBDD)
            {
            age = age - 1
            };
    
            $('#age').val(age);
        });
    
    });

// $('#cbox').click(function(e) {
  
  // console.log(ans);
     $('#sameasabove').hide('slow');
   $('#labelsameabove').hide('slow'); 
  
  $('input').keypress(function(e) {
        if(e.which == 13) 
    {
            jQuery(this).blur();
            //jQuery('#btnSearch').focus().click();
        }
    });
  
  // When-Changed-StorageSize
  jQuery("select[name='service_id']").change(function()
  {     
    jQuery("#totalamount").val('');
  
    var service_id = jQuery("select[name='service_id']").val();
    //alert(service_id);
    //alert("<?php //echo realpath ("."); ?> ");
    
    jQuery.ajax({
    type: "POST",
    url: "<?php echo base_url();?>/application/helpers/getserviceprice.php",
    data: ({post_service_id: service_id}),
      success: function(response) 
      {
        //alert(response);
        if (response > 0)
        {
          jQuery("#totalamount").val(response);
        }
        else
        {
          alert('Selected service rate is set to 0, please assign rate');       
        }
        jQuery("#serviceprice").focus();
      }
    }); 
  });
  
  // Call Doctor Rate
  // When-Changed-StorageSize
  jQuery("select[name='doctor_id']").change(function()
  {     
    jQuery("#totalamount").val('');
    jQuery("#discountamount").val('');
    jQuery("#discount").val('');
    jQuery("#recievedamount").val('');
    jQuery("#dueamount").val('');
    var doctor_id = jQuery("select[name='doctor_id']").val();
    //alert(service_id);
    //alert("<?php //echo realpath ("."); ?> ");
    $('.doc-sel').hide();
    if (doctor_id == "-1")
    {
      return false;
    }
    jQuery.ajax({
    type: "POST",
    url: "<?php echo base_url();?>/application/helpers/getdoctorrate.php",
    data: ({post_doctor_id: doctor_id}),
      success: function(response) 
      {
        //alert(response);
        if (response > 0)
        {
          jQuery("#totalamount").val(response);
        }
        else
        {
          alert('Selected service rate is set to 0, please assign rate');       
        }
        jQuery("#serviceprice").focus();
      }
    }); 
  });
  
  
   $('#dia').click (function () {
    if ($('#dia').is(':checked') && $('#dia').val() == 'D') 
    {
      $('#selectedservices').show();
      $('#category').show('slow');
      $('#services').show('slow');
      $('#doctors').hide('slow');
      $('#totalamount').val('');
      $('#discountamount').val('');
      $('#discount').val('');
      $('#recievedamount').val('');
      $('#dueamount').val('');
    }

  });
  $('#con').click (function () {
    if ($('#con').is(':checked') && $('#con').val() == 'C') 
    {
      $('#selectedservices').hide();
      $('#category').hide('slow');
      $('#services').hide('slow');
      $('#doctors').show('slow');
      $('#totalamount').val('');
      $('#discountamount').val('');
      $('#discount').val('');
      $('#recievedamount').val('');
      $('#dueamount').val('');
      
    } 
  });
  
  $('#cbox').click (function(){
    console.log(1111);
    // if ($('#cbox').is(':checked') && $('#cbox').val() == 'first_checkbox') 
    // {
      console.log(222);
      
      /*$('#selectedservices').hide();
      $('#category').hide('slow');
      */
      /*if($('#add_patient').css('display') == 'none'){ 
         $('#add_patient').toggle('slow'); 
       } else { */
       $('#add_patient').toggle(1500); 
  
      $('#patient_id').toggle(1500);
      // $('#add_patient').slideDown('slow');
      /*$('#totalamount').val('');
      $('#discountamount').val('');
      $('#discount').val('');
      $('#recievedamount').val('');
      $('#dueamount').val('');*/
      
    // } 
  });
  $('#cbox').click (function(){
    var ans = $('#cbox').val();

  console.log(ans);
    if(ans=='on'){
       // $('#name').removeattr('required',true);
      // $("#name").removeAttr("novalidate");

      $('#father_husbandname').attr('required',true);
      $('#start_5').attr('required',true);
      $('#mid_7').attr('required',true);
      $('#end_1').attr('required',true);
      $('#phone').attr('required',true);
      $('#birth_date').attr('required',true);
      }
  });
  
  $('#discount').blur(function(){
    
    var discount = $('#discount').val();
    var totalamount = $('#totalamount').val();
    var invoice_no = $('#invoice_no').val();
    var createdby = "<?php echo $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id) , 'name'); ?>";
    if (discount > 100 )
    {
      alert('You did not post discount above 100%');
      $(this).focus();
      return false;
    }
    
    /*if (discount > 0 && discount <= 10 )
    {
      alert('Please notify discount % to SuperUser');
      
    }*/
    /*if (discount > 10)
    {
      //alert('You have no authority to give discount more than 10%, please get approval from Super Administrator');
      
      var confirmLeave = confirm('You have no authority to give discount more than 10%, please get approval from Super Administrator');
      if (confirmLeave==false)
      {
        $('#ajaxLoaderDone').hide();
        $('#discount').focus();
        return false;
      }
      $('#conDisc').val('1');
      jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url();?>/application/helpers/getApprovalForDiscount.php",
        data: ({post_invoice_no: invoice_no, post_discount_per: discount,  post_createdby : createdby, post_invoice_amount : totalamount}),
        success: function(response) 
        {
          alert(response);
          return false;
          if (response > 0)
          {
            jQuery("#totalamount").val(response);
          }
          else
          {
            alert('Selected service rate is set to 0, please assign rate');       
          }
          jQuery("#serviceprice").focus();
        }
      }); 
    }*/
    
    var lessdiscount = ( ( totalamount * discount ) / 100 );
    $('#discountamount').val(lessdiscount);
    $('#recievedamount').val( totalamount - lessdiscount );
  });
  
  // Discount Amount Calculation
  $('#discountamount').blur(function(){
    
    var discountamount = $('#discountamount').val();
    var totalamount = $('#totalamount').val();
    //var invoice_no = $('#invoice_no').val();
    var createdby = "<?php echo $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id) , 'name'); ?>";
    
    var lessdiscountper = ( ( discountamount / totalamount ) * 100);
    //alert(lessdiscountper);
    $('#discount').val( lessdiscountper );
    
    //$('#recievedamount').val( totalamount - lessdiscount );
  });
  
  $('#recievedamount').blur(function(){
    
    var totalamount = 0;
    var service_val   = $('#selected_services :selected').val();
    if ($('#dia').is(':checked') && $('#dia').val() == 'D' && service_val != 614 ) 
    {
      totalamount = $('#totalamount').val();
    }
    else
    {
      totalamount = $('#totalamount').val();  
    }
    
    var receivedamount = $('#recievedamount').val();
    var discount = $('#discount').val();
    
    var lessdiscount = ( ( totalamount * discount ) / 100 );
    
    var dueamount = (totalamount - lessdiscount) - receivedamount;
    
    $('#dueamount').val(dueamount);
    
  }); 
  
  //$('#myself').click(function(){
  //  var myself = "<?php echo $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id) , 'name'); ?>";
  //  $('#myself').val(myself);
  //}); 
  $("#myself").click(function() {
    if($('#myself').is(":checked"))
    {
      var myself = "<?php echo $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id) , 'name'); ?>";
      $('#careof').val(myself);
    }
    else
    {
      $('input[name=myself]').attr('checked', false);
      $("#careof").val('');
      $("#careof").focus();
    }
  });
  
  $("#sameasabove").click(function() {
    if($('#sameasabove').is(":checked"))
    {
      var referredby = $('#doctor_id :selected').text();
      $('#refferedby').val(referredby);
    }
    else
    {
      $('input[name=sameasabove]').attr('checked', false);
      $("#refferedby").val('');
      $("#refferedby").focus();
    }
  });
  // $("#save_invoice").unbind('click');
  $("#save_invoice").unbind("click").click(function() {
    
    var discount = $('#discount').val();
    var totalamount = $('#totalamount').val();
    //alert(discount);
    if (discount >= 100 )
    {
      alert('You did not post discount 100% or above');
      $('#discount').focus();
      return false;
      
    }
    $(this).attr('disabled', false);
    
    if ($('#dia').is(':checked') && $('#dia').val() == 'D') 
    {
      $('#totalamount').val(parseInt($('#total').text()));
      //return false;
      $('#rcvhidamt').val(1);


      $(".mytr-inv-data").each(function()
      {
        var service_id    = $(this).find('#selected_service_id').text();
        var service_price = $(this).find('#s_service_price').text();
        var invoice_no    = $('#invoice_no').val();
        var patient       = $('#patient_id :selected').attr('mrnum');
                            $.trim(patient);
        var doc_id        = $('#doctor_id :selected').val();
        var tamt          = $('#totalamount').val();
        var disamt        = $('#discountamount').val(); 
        var dueamt        = $('#dueamount').val();
        var rcvamt        = $('#recievedamount').val();
        var hiddueamt     = dueamt;
        var hidramt       = $('#rcvhidamt').val();
        
        if (hidramt == 1){
        
        $('#rcvhidamt').val(rcvamt);
        
        hidramt           =  $('#rcvhidamt').val();
        
        }

        var qty           = 1;
        var sercatid      = $('#diagnostictype_id :selected').val();
        var rowCount      = $('.mytr-inv-data').length - 1;

        if(hidramt > tamt) { 
            
            hidramt = tamt;
            $('#hiddueamt').val(0);
            hiddueamt = 0;

         }

          if (hiddueamt == 0) {
            
            if (disamt > 0) {

              var newdisamt = disamt / rowCount;
              disamt = newdisamt;
              rcvamt = service_price - disamt;

            }

            else {
            
            rcvamt = service_price;
            disamt = disamt / rowCount;
            }

          }

          else {

            rcvamt = rcvamt / rowCount;
            disamt = disamt / rowCount;
            hiddueamt = hiddueamt / rowCount;
          }

      //  $('#dueamount').val($('#recievedamount').val() - service_price);

        $.ajax({
          type:"POST",
          url: "<?php echo base_url();?>/application/helpers/savemultipleservices.php",
          data:({
              post_service_id       : service_id,
              post_service_price    : parseFloat(service_price).toFixed(2),
              post_invoice_no       : invoice_no,
              post_p_id             : patient,
              p_doc_id              : doc_id,
              p_tamt                : parseFloat(service_price).toFixed(2),
              p_dueamt              : hiddueamt,
              p_rcv_amt             : rcvamt,
              p_qty                 : qty,
              p_disamt              : disamt,
              p_sercatid            : sercatid,
            }),

            success:function(args)
            {
              
            }
        }); 
         // return false;
      });
    }
  });
  

   $("#discount").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
      $(this).val($(this).val().replace(/[^0-9\.]/g,''));
    //alert(event.which);
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57) && (event.which < 8 || event.which > 8)) {
      event.preventDefault();
    }
     });

  $("#discount").keydown(function(event) {
    //alert(event.keyCode);
    if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 36 || event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40 || event.keyCode == 110 || event.keyCode == 190) {
            
        }
        else {
            // Ensure that it is a number and stop the keypress
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 ) || event.shiftKey) {
                event.preventDefault(); 
            }   
        }
    });
  
  $("#recievedamount").keydown(function(event) {
    //alert(event.keyCode);
    if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 36 || event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40 || event.keyCode == 110 || event.keyCode == 190) {
            
        }
        else {
            // Ensure that it is a number and stop the keypress
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 ) || event.shiftKey) {
                event.preventDefault(); 
            }   
        }
    });
  
  // Validate only alphabets input on ReferredBy field
  $("#refferedby").keypress(function(e) {
      if((e.which < 97 || e.which > 122) && (e.which < 65 || e.which > 97) && (e.which < 32 || e.which > 32) && (e.which < 8 || e.which > 8) && (e.which < 0 || e.which > 0) )   {
          e.preventDefault();
      }
    if (e.which == 94 || e.which == 95) 
    {
      return false;
    }
  });
  
  // Validate only alphabets input on CareOf field
  $("#careof").keypress(function(e) {
      if((e.which < 97 || e.which > 122) && (e.which < 65 || e.which > 97) && (e.which < 32 || e.which > 32) && (e.which < 8 || e.which > 8) && (e.which < 0 || e.which > 0) )   {
          e.preventDefault();
      }
    if (e.which == 94 || e.which == 95) 
    {
      return false;
    }
  });
  
  
  
  // Only for Integer values
  /*
   $(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
  */





// Reffered by onchange

    $('#refferedby').change (function () {
    
    var s = $('#refferedby').val();
    if (s == 'CardNo')
    {
      $('#med_card_no').val('');
      $('#sameasabove').hide('slow');
      $('#labelsameabove').hide('slow');
      $('#med_card_no').show('slow');
      $("#med_card_no").attr("required", "required");
      $("#med_card_no").focus();
    }
    else if (s == 'OtherEntry')
    {
      $('#med_card_no').val('');
      $('#sameasabove').hide('slow');
      $('#labelsameabove').hide('slow');
      $('#med_card_no').show('slow');
      $("#med_card_no").attr("required", "required");
      $("#med_card_no").focus();
    }
    else if (s == 'sameabove')
    {
      $('#med_card_no').val('');
      $('#sameasabove').show('slow');
      $('#labelsameabove').show('slow');
      $('#med_card_no').show('slow');
      $("#med_card_no").attr("required", "required");
      $("#med_card_no").focus();
    }
    else
    {
      $('#med_card_no').val('');
      $('#sameasabove').hide('slow');
      $('#labelsameabove').hide('slow');
      $('#med_card_no').hide('slow');
    //  $("#med_card_no").attr("required", false);
      $("#med_card_no").focus();
    
    }
    
    $("#sameasabove").click(function() {
    if($('#sameasabove').is(":checked"))
    {
      var referredby = $('#doctor_id :selected').text();
      $('#med_card_no').val(referredby);
    }
    else
    {
      //$("#refferedby").val('');
      //$("#refferedby").focus();
      $('#med_card_no').val('');
    }
  });
      
  });




 
  $(document).ready(function(e) {
      
        // Add Multiple Services
    $('#addmore').click(function () {
      // add new row to table using addTableRow function
      
      var cat = $('#diagnostictype_id').val();
      if (cat == "-1")
      {
        alert("Please select a service category");  
        return false;
      }
      var service = $('#selected_services').val();
      if (service == "-1")
      {
        alert("Please select a service"); 
        return false;
      }
      var flag = 0;
      $(".mytr-inv-data").each(function()
      {
        var service_id    = $(this).find('#selected_service_id').text();
        if (service_id == service)
        {
          flag = 1;
        }
      });
      // Omit for duplicate service - 09 Oct 2014
      //if (flag == 1)
      //{
      //  alert('Duplicate Service Selected, Please select other service'); 
      //  return false; 
      //}
      jQuery("#tblservice_catalog_detail").show();
      $('#NoServiceSelected').html('<b>Selected Service(s)</b>');
      $('#invoicetotal').show();
      addTableRow();
      // prevent button redirecting to new page
      return false;
    });
    // End Multiple Services
    
    function addTableRow() {
      
        var service_val   = $('#selected_services :selected').val();
        var service_txt   = $('#selected_services :selected').text();
        //var s_service_price = $('#totalamount').val();
        var s_service_price = $('#tmp_totalamount').val();
        if (service_val == 614)
        {
          s_service_price = 0;
        }
        var appendTxt = "";
        var tot = "";
        //var count = $(".mytr-inv-data").index()+1;
        
var appendTxt = "<tr class='mytr-inv-data'><td id='selected_service_id' align='center' style='display:block;'>"+service_val+"</td><td style='width: 30%;'>"+ service_txt  + "</td><td style='width: 8%;' align='center' id='s_service_price' name='s_service_price' class='current_service_price'>" + parseFloat(s_service_price) + "</td><td style='width: 8%;' align='center'><a class='rdelete' onclick ='delete_service($(this))'></a></td></tr>";

        $("#tblservice_catalog_detail tr:last").after(appendTxt);
        $("#tblservice_catalog_detail tr:last").hide().fadeIn('slow');
        
        //var tot = "<tr> <td colspan='3'> </td></tr>"
        //$("#tblservice_catalog_detail tr:last").after(tot);
        var sum = 0;
        $('.current_service_price').each(function() 
        {
           sum += parseFloat($(this).text());
        });
        $('#total').text(sum);
        
        var totalamount = 0;
        if ($('#dia').is(':checked') && $('#dia').val() == 'D') 
        {
          $('#totalamount').val(sum);
        }
    }
    
    $('#btnReport').click(function () {
  
      var v = "reports/manageinvoice.pdf";
      window.location = v;
    });
    
    
    $('#diagnostictype_id').change (function () {
            
      var did = $('#diagnostictype_id').val();
      
      jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url();?>/application/helpers/invoice_services_data.php",
      data: ({post_did: did}),
      success: function(response) 
      {
        
        //alert(response);
        $('#invoice_services').html(response);
          // TestTest
          $('#selected_services').change( function()
          {     
            //alert('asdasd');
            jQuery("#totalamount").val('');
          
            var selected_services = $('#selected_services').val();
            if (selected_services == 614 )
            {
              $("#totalamount").removeAttr("readonly");
            }
            else
            {
              $("#totalamount").attr("readonly", "readonly"); 
            }
            jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url();?>/application/helpers/getServicePriceDiag.php",
            data: ({post_service_id: selected_services}),
              success: function(response) 
              {
                //alert(response);
                if (response > 0)
                {
                  jQuery("#totalamount").val(response);
                  jQuery("#tmp_totalamount").val(response);
                }
                else
                {
                  if (selected_services != 614 )
                  {
                    alert('Selected service rate is set to 0, please assign rate'); 
                  }
                }
                jQuery("#serviceprice").focus();
              }
            }); 
          });
  
  
      } // success: function(response)  
     });
    });
});


  
  //$("#print invoice").click(function() 
//  {
  function printinvoce(inv_id)
  {
    //var inv_id = $('#invoice_no').val();
    //alert(inv_id);
    
    jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url();?>/application/helpers/getsingleinvprint.php?r="+inv_id,
      //data: ({inv_idd: inv_id}),
      success: function(response) 
      {
      //  alert(response)
        
         var mywindow = window.open('', 'my div', 'height=1000,width=1000,scrollbars=1');
        mywindow.document.write('<html><head><title>my div</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(response);
        mywindow.document.write('</body></html>');

      //  mywindow.print();
        //mywindow.close();


      }
    }); 
  }
  




  // When-Changed-StorageSize
  jQuery("#invoice_services").change(function()
  {     
    jQuery("#discountamount").val('');
    jQuery("#discount").val('');
    jQuery("#recievedamount").val('');
    jQuery("#dueamount").val('');
  
  });




  function delete_service(row)
    {
       var c = confirm("Are you sure, DELETE this service?");
     if (c == false)
     {
      return false;   
     }
      row.closest('tr').remove();
    
    var sum = 0;
    $('.current_service_price').each(function() 
    {
       sum += parseFloat($(this).text());
    });
    $('#total').text(sum);
    $('#totalamount').val(sum);
    }

    $(document).ready(function(){
  
  function inputsearch(){

    var datacomingfrommp = "<?php echo $this->uri->segment(3); ?>";
    var res = datacomingfrommp.replace(/%20/g, " ");
    $(".dataTables_filter").find('input').val(res);
    $(".dataTables_filter").find('input').focus();
    

      }
     setTimeout(inputsearch, 1000);
  });
</script>



