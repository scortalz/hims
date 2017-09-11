    <?php 
     include   realpath(".") . "/application/helpers/mydb.php";
     $db = NULL;
     $db = new DB();
     
     // Call db->method to generate patient registration number
     $arrRegNo = $db->Generate_Patient_Registration_Number();
    
     $id = $arrRegNo[0]['patient_id'] + 1; 
     $gen_reg_no = 'MR-'.date('ym-', time()).str_pad($id, 4, '0', STR_PAD_LEFT);
    
     $current_date = date('m/d/Y H(idea)', time());
    ?> 

    <link rel="stylesheet" href="jquery-ui.css">
    <script src="jquery-ui.js"></script>


     <div class="box" >
    <div class="box-header">
     
        <!--CONTROL TABS START-->
        <ul class="nav nav-tabs nav-tabs-left">
            <?php if(isset($edit_profile)):?>
            <li class="active">
                <a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
                    <?php echo get_phrase('edit_patient');?>
                        </a></li>
            <?php endif;?>
            <li class="<?php if(!isset($edit_profile))echo 'active';?>">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo get_phrase('expense_voucher_list');?>
                        </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo get_phrase('add_expense_voucher');?>
                        </a></li>
        </ul>
        <!------CONTROL TABS END------->
        
    </div>
    <div class="box-content padded" >
        <div class="tab-content" >
            <!--EDITING FORM STARTS-->
            <?php if(isset($edit_profile)):?>
            <div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                    <?php foreach($edit_profile as $row):?>
                    <?php echo form_open('reception/expense_voucher/edit/do_update/'.$row['patient_id'] , array('class' => 'form-horizontal validatable'));?>
                        <!-- <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Registration #');?></label>
                                <div class="controls">
                                  <input type="text" name="Voucher No"  value="<?php echo $row['Voucher no'];?>" readonly="readonly"/> -->
                              <!--   </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient type');?></label>
                                <div class="controls">
                                    <select name="patient_type" id="patient_type" class="chzn-select" >
                                 <option value="OPD" <?php if($row['patient_type']=='OPD')echo 'selected';?>><?php echo get_phrase('OPD');?></option>
                                 <option value="IPD" <?php if($row['patient_type']=='IPD')echo 'selected';?>><?php echo get_phrase('IPD');?></option>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="control-group">
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
                                </div>
                            </div>
                        
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('salutation');?></label>
                                <div class="controls">
                                       <select name="salutation" id="salutation" class="uniform">
                                        <option value="Mr." <?php if($row['salutation']=='Mr.')echo 'selected';?>><?php echo get_phrase('Mr.');?></option>
                                        <option value="Mrs." <?php if($row['salutation']=='Mrs.')echo 'selected';?>><?php echo get_phrase('Mrs.');?></option>
                                        <option value="B/O." <?php if($row['salutation']=='B/O.')echo 'selected';?>><?php echo get_phrase('B/O.');?></option>
                                        <option value="Miss." <?php if($row['salutation']=='Miss.')echo 'selected';?>><?php echo get_phrase('Miss.');?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient_name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="name" id="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('F / H. Name');?></label>
                                <div class="controls">
                                <input type="text" class="validate[required]" name="father_husbandname" id="father_husbandname" value="<?php echo $row['father_husbandname'];?>"/>
                                </div>
                            </div>
                      
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('nic no');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="nic_no" id="nic_no" value="<?php echo $row['nic_no'];?> " />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('address');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="address"  value="<?php echo $row['address'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('phone');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="phone" id="phone" value="<?php echo $row['phone'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('sex');?></label>
                                <div class="controls">
                                    <select name="sex" id="sex" class="uniform" style="width:100%;">
                               <option value="Male" <?php if($row['sex']=='Male')echo 'selected';?>><?php echo get_phrase('male');?></option>
                                <option value="Female" <?php if($row['sex']=='Female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('birth_date');?></label>
                                <div class="controls">
                                    <input type="text"  name="birth_date" id="birth_date" value="<?php echo $row['birth_date'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('age');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="age" id="age" value="<?php echo $row['age'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('blood_group');?></label>
                                <div class="controls">
                                    <select name="blood_group" id="blood_group" class="uniform" style="width:100%;">
                                      <option value="None"  <?php if($row['blood_group']=='None')echo 'selected';?> >None</option>
                                        <option value="A+" <?php if($row['blood_group']=='A+')echo 'selected';?>>A+</option>
                                        <option value="A-" <?php if($row['blood_group']=='A-')echo 'selected';?>>A-</option>
                                        <option value="B+" <?php if($row['blood_group']=='B+')echo 'selected';?>>B+</option>
                                        <option value="B-" <?php if($row['blood_group']=='B-')echo 'selected';?>>B-</option>
                                        <option value="AB+" <?php if($row['blood_group']=='AB+')echo 'selected';?>>AB+</option>
                                        <option value="AB-" <?php if($row['blood_group']=='AB-')echo 'selected';?>>AB-</option>
                                        <option value="O+" <?php if($row['blood_group']=='O+')echo 'selected';?>>O+</option>
                                        <option value="O-" <?php if($row['blood_group']=='O-')echo 'selected';?>>O-</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_patient');?></button>
                           <button type="submit" name="readmit" id="readmit" class="btn btn-blue"><?php echo get_phrase('re_admit');?></button>
                     <input type="button" name="patienthistory" id="patienthistory" value="Patient History" class="btn btn-blue"/>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
            </div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!--TABLE LISTING STARTS-->

             <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
             
                <p id="date_filter">
    <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
    <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="datepicker_to" />
    <button class="btn" id="reset_btn">Reset</button>
</p>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" id="datatable">
                    <thead>
                        <tr>
                            <th><div>Serial No.</div></th>
                            <th><div><?php echo get_phrase('reception_name');?></div></th>
                            <th><div><?php echo get_phrase('date');?></div></th> 
                            <th><div><?php echo get_phrase('expense_amount');?></div></th>
                            <th><div><?php echo get_phrase('reason');?></div></th>
                             
                    </thead>
                    <tbody id="moveit">
                  
                        <?php 
                        
                      
                        $count = 1;foreach($expense_voucher as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['receptionest_name'];?></td>
                            <td class='changedate'><?php echo $row['date'];?></td>
                            <td><?php echo $row['expense_amount'];?></td>
                            <td><?php echo $row['reason'];?></td>    
                            
                        <!-- <?php 
                            $Bed = "";
                            $arrPD = $db->getPatientBed($row['patient_id']);
                            if (count($arrPD) > 0 )
                            {
                                $Bed = $arrPD[0]['bed'];
                            }
                        
                        ?> -->
                            <!-- <td><?php echo $Bed;?></td>   
                            <td><?php echo $row['discharge_type'];?></td> -->
                           <!--  <td align="center">
                            <a href="<?php echo base_url();?>index.php?reception/manage_patient/edit/<?php echo $row['patient_id'];?>"
                                    rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                                        <i class="icon-wrench"></i>
                                </a>
                                <a href="<?php echo base_url();?>index.php?reception/manage_invoice/"
                                rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('sss');?>" class="btn btn-blue">
                                        <i class="iconinvoice"></i> -->
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <?php echo form_open('reception/f_e_v', array('id' => 'targetit'));?>
                <input type="hidden" name="getit" id="getit" value="">
              <input type="submit" name="submitit" id="submitit">
              <?php echo form_close(); ?>
             </div>   
            <!--TABLE LISTING ENDS-->
            
            
            <!--CREATION FORM STARTS-->
            <div class="tab-pane box" id="add" style="padding: 5px" >
                <div class="box-content">
                    <?php echo form_open('reception/manage_daily_expense/create/' , array('class' => 'form-horizontal validatable'));?>
                    <form method="post" action="<?php echo base_url();?>index.php?" class="form-horizontal validatable">
                        <div class="padded">
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Date');?></label>
                                <div class="controls">
                                    <input type="date" name="date"/>
                                </div>
                            </div>
                           <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Reason');?></label>
                                <div class="controls">
                                    <input type="text"  name="Reason" />
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('expense_Amount');?></label>
                                <div class="controls">
                                    <input type="text"  name="expense_Amount" />
                                </div>
                            </div>
                            
                        
                        <div class="form-actions">
                           <a href=""  target="_blank"> <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_expense');?></button></a>

                        </div>
                    <?php echo form_close();?>                
                </div>                
            </div>
            
            <!-CREATION FORM ENDS-->
            
        </div>
    </div>
</div>

    <!-- <script type="text/javascript">
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
    </script>
    
    <script>
        $(function() {
          var currentTime = new Date();
          var year = currentTime.getFullYear()
        //alert(year-1);
        $( "#date" ).datepicker({maxDate: new Date(year-1,8,31)});
        });
</script>

    <script type="text/javascript">
    
        $(document).ready(function(){
    
       $("#patient_type").change(function(){
            var type = $("#patient_type").val();
            if (type == 'OPD')
            {
                $("#rooms").hide();
                $("#roomcharge").hide('slow');
                $("#nodays").hide('slow');
                nodays
            }
            else
            {
                $("#rooms").show('slow');
                $("#roomcharge").show('slow');
                $("#nodays").show('slow');
            }
    
        });
     
    });
        var chargess='';
    $("select[name='bed_id']").change(function()
    {
        var bed_id_id = $("select[name='bed_id']").val();
        //alert(bed_id_id);
        $('#charges').val();
        
        
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url();?>/application/helpers/getbedcharges.php",
            data: ({post_bed_id: bed_id_id}),
            success: function(response) 
            {
            //  alert(response);
            chargess=response;
                $("#charges").val(response);
                $('#days').val('');
            }
        }); 
        
      });-->
      <script type="text/javascript">
      $('Date('Y/m/d');').blur(function(){
        var charges  = chargess;
        var days  = $('Date('Y/m/d');').val();
    //$('#roomcharges').val();
    });
    </script>
   


<script type="text/javascript">
  $(function() {
  var oTable=$('#datatable').DataTable({
    "oLanguage": {
      "sSearch": "Filter Data"
    },
    "iDisplayLength": -1,
    "sPaginationType": "full_numbers",

  });

  $('#datepicker_from').click(function() {

    $("#datepicker_from").datepicker("show");
  });
  $('#datepicker_to').click(function() {
    $("#datepicker_to").datepicker("show");
  });


  $("#datepicker_from").datepicker({
    "onSelect": function(date) {
      minDateFilter = new Date(date).getTime();
      oTable.fnDraw();
    }
  }).keyup(function() {
    minDateFilter = new Date(this.value).getTime();
    oTable.fnDraw();
  });

  $("#datepicker_to").datepicker({
    "onSelect": function(date) {
      maxDateFilter = new Date(date).getTime();
      oTable.fnDraw();
    }
  }).keyup(function() {
    maxDateFilter = new Date(this.value).getTime();
    oTable.fnDraw();
  });

});

// Date range filter
minDateFilter = "";
maxDateFilter = "";

$.fn.dataTableExt.afnFiltering.push(
  function(oSettings, aData, iDataIndex) {
    if (typeof aData._date == 'undefined') {
      aData._date = new Date(aData[2]).getTime();
    }

    if (minDateFilter && !isNaN(minDateFilter)) {
      if (aData._date < minDateFilter) {
        return false;
      }
    }

    if (maxDateFilter && !isNaN(maxDateFilter)) {
      if (aData._date > maxDateFilter) {
        return false;
      }
    }

    return true;
  }
);

$(".changedate").each(function(){
    var a = $(this).html();
    var ab = a.split('-');
    var final = ""+ab[1]+"/"+ab[2]+"/"+ab[0];
    
    $(this).html(final);
});

$("#submitit").click(function(){
    var demo = $("#moveit").html();
    $("#getit").val(demo);
$("#targetit").submit();
//window.location.href = 'index.php?reception/f_e_v/demo='+demo;

});
</script>

    <script type='text/javascript' src='jquery.min.js'></script>
   


    <!-- JavaScript Patient Validation Code Start 
 
<script>
  
    $("#patienthistory").click(function()
    {
        window.open("index.php?reception/patienthistory");
            
    });
    
    </script>