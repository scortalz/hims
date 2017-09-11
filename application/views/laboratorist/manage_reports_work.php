
<div class="box">
    <div class="box-header">
    
        <!--CONTROL TABS START-->
        <ul class="nav nav-tabs nav-tabs-left">
            <?php if(isset($reports_add_data)):?>
            <li class="active">
                <a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
                    <?php echo get_phrase('add_reports_data');?>
                        </a></li>
            <?php endif;?>
            <li class="<?php if(!isset($reports_add_data))echo 'active';?>">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo get_phrase('incomplete_reports_list');?>
                        </a></li>
           <!--  <li>
               <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                   <?php echo get_phrase('completed_reports_result');?>
                       </a></li> -->
        </ul>
        <!--CONTROL TABS END-->
        
    </div>
    <div class="box-content padded">
        <div class="tab-content">
            <!----EDITING FORM STARTS---->
            <?php if(isset($reports_add_data)):?>
            <div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                    <?php if($reports_add_data->num_rows()>0){?>
                    <?php foreach($reports_add_data->result() as $row):?>
                    <?php echo form_open('laboratorist/manage_reports_work/create/'.$row->service_id , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <!-- <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="name" value="<?php echo $row->patient_name;?>"/>
                                </div>
                            </div> -->
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('invoice_no');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="invoice_no" value="<?php echo $row->invoice_no;?>"/>
                                   <input type="hidden" name="doc_name" value="<?php echo $row->doctor_name?>">
                                   <input type="hidden" name="phone" value="<?php echo $row->phone?>">
                                </div>
                           </div>
                           <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient_name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="patient_name" value="<?php echo $row->patient_name;?>"/>
                                </div>
                           </div>
                           <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('nic_no');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="nic_no" value="<?php echo $row->nic_no?>"/>
                                </div>
                           </div>
                           <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('age');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="age" value="<?php echo $row->age?>"/>
                                </div>
                           </div>
                           <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('sex');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="sex" value="<?php echo $row->sex?>"/>
                                </div>
                           </div>
                           <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('service_name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="service_name" value="<?php echo $row->name;?>"/>
                                </div>
                           </div>

                           <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('service_amount');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="service_amount" value="<?php echo $row->service_amount;?>"/>
                                </div>
                           </div>
                           <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('creation_date');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="creation_date" value="<?php echo $row->creation_time?>"/>
                                </div>
                           </div>
                           <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('report_type');?></label>
                                <div class="controls">
                                    <select name="report_type" id="report_type" onchange="my_function(this)" class="uniform" style="width:100%;">
                                        <option value="report_type">report type</option>
                                        <option value="heamatology">Heamatology Report</option>
                                        <option value="heamatology_1">Heamatolog1 Report</option>
                                        <option value="biochemistry">Biochemistry Report</option>
                                        <option value="paracytology">Paracytology Report</option>
                                        <option value="immunology">Immunology Report</option>
                                    </select>
                                </div>
                            </div>
                          
                           <!-- heamatology report data start from here -->

                        <div class="report" id="heamatology" style="display:none;">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('leucocytes total');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="leucocytes" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('neutrophills');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="neutrophills" value="" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('lymphocytes');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="lymphocytes" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('eosinophills');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="eosinophills" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('monocytes');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="monocytes" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('basophills');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="basophills" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('premature w . b . c');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="premature" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('blasts');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="blasts" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('normoblasts');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="normoblasts" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('haemoglobin');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="haemoglobin" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('red cells');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="redcells" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                
                                <div class="controls">
                                    <input type="hidden" class="" name="pcv" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('p . c . v');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="pcv" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('m . c . v');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mcv" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('m . c . h');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mch" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('m . c . h .c');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mchc" value=""/>
                                </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('e. s . r');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="esr" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('platelets');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="platelets" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('morphology of r . b . c');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="morphology" value=""/>
                                </div>
                            </div>
                        </div>
                          
                           <!-- end of heamatology fields--> 
                         
                         <div class="report" id="paracytology" style="display:none;">
                           <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('volume');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="volume" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('colour');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="color" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('appearance');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="appearance" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('specific_gravity');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="specific_gravity" value=""/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('ph');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="ph" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('glucose');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="glucose1" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('albumin');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="albumin" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('bile');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="bile" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('urobilinogen');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="urobilinogen" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('ketone');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="ketone" value=""/>
                                </div>
                            </div>
                        
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('nitrite');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="nitrite" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('blood');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="blood" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('pus_cell');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="pus_cell" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('red_cell');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="red_cell" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('epithelial_cell');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="epithelial_cell" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('bacteria');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="bacteria" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('yeast_cell');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="yeast_cell" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('crystal');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="crystal" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('amorphose_urates');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="amorphose_urates" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('granular_cast');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="granular_cast" value=""/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('calcium_oxalate');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="calcium_oxalate" value=""/>
                                </div>
                            </div>
                        </div>
                      
                        <!-- end of paracytology report -->
                


                <div class="report" id="biochemistry" style="display:none;">
                           <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('glucose');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="glucose" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('calcium');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="calcium" value=""/>
                                </div>
                            </div>
                
                </div>
               
                  <!-- end of biochemistry work -->
                   <div class="report" id="immunology" style="display:none;">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('blood_hcg');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="blood_hcg"/>
                                </div>
                            </div>
                   </div>
                   <!-- end of immunology report -->

                <div class="report" id="heamatology_1" style="display:none;">
                <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('haemoglobin');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="haemoglobin"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('red cells');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="redcells"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('p . c . v');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="pcv"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('m . c . v');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mcv"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('m . c . h');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mch"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('m . c . h .c');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mchc"/>
                                </div>
                            </div>
                            <!--  <div class="control-group">
                               <label class="control-label"><?php echo get_phrase('e. s . r');?></label>
                               <div class="controls">
                                   <input type="text" class="" name="esr"/>
                               </div>
                                                        </div>
                                                        <div class="control-group">
                               <label class="control-label"><?php echo get_phrase('platelets');?></label>
                               <div class="controls">
                                   <input type="text" class="" name="platelets"/>
                               </div>
                                                        </div> -->
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('morphology of r . b . c');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="morphology"/>
                                </div>
                            </div>

                </div>
                      </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_report_result');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;}?>
                </div>
            </div>
            <?php endif;?>
            <!--EDITING FORM ENDS-->
            
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($reports_add_data))echo 'active';?>" id="list">
                
                 <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><div><?php echo get_phrase('invoice_no');?></div></th>
                            <th><div><?php echo get_phrase('patient_name');?></div></th>
                            <th><div><?php echo get_phrase('service_name');?></div></th>
                            <th><div><?php echo get_phrase('service_amount');?></div></th>
                            
                            <th><div><?php echo get_phrase('creatin_time');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($reports_data->num_rows()>0) { ?>
                        <?php $count = 1; foreach($reports_data->result() as $row):?>
                        <?php if($row->diagnostictype_id != 1)
                         continue ;
                        ?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row->invoice_no;?></td>
                            <td><?php echo $row->patient_name;?></td>
                            <td><?php echo $row->name;?></td>
                            <td><?php echo $row->service_amount;?></td>
                            <td><?php echo $row->creation_time;?></td>
                            <td align="center">
                                <a href="<?php echo base_url();?>index.php?laboratorist/manage_reports_work/edit/<?php echo $row->service_id;?>"
                                    rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('add');?>" class="btn btn-blue">
                                        <i class="icon-plus"></i>                                </a>
                                <!-- <a href="<?php echo base_url();?>index.php?laboratorist/manage_reports_work/delete/<?php echo $row->id;?>" onclick="return confirm('delete?')"
                                    rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete');?>" class="btn btn-red">
                                        <i class="icon-trash"></i>
                                </a> -->
                              <!--  <?php $image="uploads/report_logo.png"?>
                                                           <a href="<?php echo base_url();?>index.php?laboratorist/mannage_Heamatology/<?php echo $row->id?>" target="blank"
                                                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('print');?>" class="btn btn-blue">
                                                                   <i><img src="<?php echo base_url($image)?>"/></i>
                                                           </a>
                                                           -->                            </td>
                        </tr>
                        <?php endforeach; } ?>
                    </tbody>
                </table>



            </div>
            <!----TABLE LISTING ENDS--->
            
            
            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('laboratorist/manage_immunology_work/create/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                                                        <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="name"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('age');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="age"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('sex');?></label>
                                <div class="controls">
                                    <select name="sex" class="uniform" style="width:100%;">
                                        <option value="male"><?php echo get_phrase('male');?></option>
                                        <option value="female"><?php echo get_phrase('female');?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('cons . phy / clinic');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="doc_name"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('mobile no');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mobile_no"/>
                                </div>
                            </div>
                            
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('blood_group');?></label>
                                <div class="controls">
                                    <select name="blood_group" class="uniform" style="width:100%;">
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
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('leucocytes total');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="leucocytes"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('neutrophills');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="neutrophills"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('lymphocytes');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="lymphocytes"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('eosinophills');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="eosinophills"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('monocytes');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="monocytes"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('basophills');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="basophills"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('premature w . b . c');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="premature"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('blasts');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="blasts"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('normoblasts');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="normoblasts"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('haemoglobin');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="haemoglobin"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('red cells');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="redcells"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('p . c . v');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="pcv"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('m . c . v');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mcv"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('m . c . h');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mch"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('m . c . h .c');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mchc"/>
                                </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('e. s . r');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="esr"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('platelets');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="platelets"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('morphology of r . b . c');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="morphology"/>
                                </div>
                            </div>


                    </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_immunology_report');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
            </div>
            <!--CREATION FORM ENDS-->
            
        </div>
    </div>
</div>

<script type="text/javascript">
   // $(document).ready(function(){ 
 function my_function(para){
    $('#heamatology').hide();
    $('#heamatology1').hide();
    $('#paracytology').hide();
    $('#biochemistry').hide();
    $('#immunology').hide();
    $('.report').hide();
    var ans = $(para).val();
    $('#'+ans).show();
    console.log(ans);
  }
     /*console.log(111);
     $('#report_type').on('change',function(){
        console.log(1212121);
       /*$('.report').hide();
        $('#' + $(this).val()).show();*/
    // });
      
       
  
   
     // });
</script>