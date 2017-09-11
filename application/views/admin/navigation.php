<div class="sidebar-background">
	<div class="primary-sidebar-background">
	</div>
</div>
<div class="primary-sidebar">
	<!-- Main nav -->
    <div style="text-align: center; background: none repeat scroll 0% 0% #fff; padding: 20px 0px;">
    	<a href="<?php echo base_url();?>">
        	<img src="<?php echo base_url();?>uploads/BHI-logo.png" class = "img-responsive" width="90%"  />
        </a>
    </div>
	<ul class="nav nav-collapse collapse nav-collapse-primary">
    
        
        <!------dashboard----->
		<li class="<?php if($page_name == 'dashboard')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/dashboard" >
					<i class="icon-desktop icon-2x"></i>
					<span><?php echo get_phrase('dashboard');?></span>
				</a>
		</li>
        
        <!------department----->
		<!--<li class="<?php if($page_name == 'manage_department')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/manage_department" >
					<i class="icon-sitemap icon-2x"></i>
					<span><?php echo get_phrase('department');?></span>
				</a>
		</li>-->
         <!------Pateint History--->
  
        <!------IPD Add Service--->
		<li class="<?php if($page_name == 'ipdaddservice')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/ipdaddservice" >
					<i class="icon-lock icon-2x"></i>
					<span><?php echo get_phrase('Admitted_Patient');?></span>
				</a>
		</li>
        
          <!------patient----->
		<li class="<?php if($page_name == 'manage_patient')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/manage_patient" >
					<i class="icon-user icon-2x"></i>
					<span><?php echo get_phrase('registered_patient');?></span>
				</a>
		</li>
        
        	<!------discharge patient----->
          <li class="<?php if($page_name == 'dischargepatient')echo 'dark-nav active';?>">
           <span class="glow"></span>
            <a href="<?php echo base_url();?>index.php?admin/dischargepatient" >
             <i class="icon-user icon-2x"></i>
             <span><?php echo get_phrase('discharge patient');?></span>
            </a>
          </li>
        
        <!------nurse----->
	<!--	<li class="<?php if($page_name == 'manage_nurse')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/manage_nurse" >
					<i class="icon-plus-sign-alt icon-2x"></i>
					<span><?php echo get_phrase('nurse');?></span>
				</a>
		</li>-->
         <!-------advance appointment report -------->
          <li class="<?php if($page_name == 'advanceappointmentreport')echo 'dark-nav active';?>">
           <span class="glow"></span>
            <a href="<?php echo base_url();?>index.php?admin/advanceappointmentreport" >
             <i class="icon-hospital icon-2x"></i>
             <span><?php echo get_phrase('appointment_report');?></span>
            </a>
          </li>
       <!--<! ----manage doctor list---->
		<li class="dark-nav <?php if(	$page_name == 'doctor_speciality' 	|| 
										$page_name == 'doctor_schedule' 		||  
										$page_name == 'manage_doctor'  )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#doctor_list" >
                <i class="icon-screenshot icon-2x"></i>
                <span><?php echo get_phrase('manage doctor');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="doctor_list" class="collapse <?php if(	$page_name == 'doctor_speciality' 	|| 
																		$page_name == 'doctor_schedule' 		|| 
																		$page_name == 'manage_doctor'  )echo 'in';?>">
                <li class="<?php if($page_name == 'doctor_speciality')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/doctor_speciality">
                      <i class="icon-exchange"></i> <?php echo get_phrase('doctor speciality');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'doctor_schedule')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/doctor_schedule">
                      <i class="icon-money"></i> <?php echo get_phrase('doctor schedule');?>
                  </a>
                </li>
                 
                <li class="<?php if($page_name == 'manage_department')echo 'dark-nav active';?>">
                    <span class="glow"></span>
                        <a href="<?php echo base_url();?>index.php?admin/manage_department" >
                            <i class="icon-sitemap icon-2x"></i>
                            <span><?php echo get_phrase('department');?></span>
                        </a>
                </li>
                <li class="<?php if($page_name == 'manage_doctor')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/manage_doctor">
                      <i class="icon-hdd"></i> <?php echo get_phrase('manage doctor');?>
                  </a>
                </li>
               
            </ul>
		</li>
        
        
        <!------pharmacist----->
		<!--<li class="<?php if($page_name == 'manage_pharmacist')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/manage_pharmacist" >
					<i class="icon-medkit icon-2x"></i>
					<span><?php echo get_phrase('pharmacist');?></span>
				</a>
		</li>-->
        
        <!------laboratorist----->
		<!--<li class="<?php if($page_name == 'manage_laboratorist')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/manage_laboratorist" >
					<i class="icon-beaker icon-2x"></i>
					<span><?php echo get_phrase('laboratorist');?></span>
				</a>
		</li>-->
        
        <!------reception----->
		<li class="<?php if($page_name == 'manage_reception')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/manage_reception" >
					<i class="icon-money icon-2x"></i>
					<span><?php echo get_phrase('reception');?></span>
				</a>
		</li>
        
        	<!------employee----->
		<li class="<?php if($page_name == 'manage_employee')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/manage_employee" >
					<i class="icon-money icon-2x"></i>
					<span><?php echo get_phrase('employee');?></span>
				</a>
		</li>
        
        	 <!------general complain ----->
		<!--<li class="<?php if($page_name == 'general_complain')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/general_complain" >
					<i class="icon-list-alt icon-2x"></i>
					<span><?php echo get_phrase('general complain');?></span>
				</a>
		</li>-->
		 
		 
		<!------ complain management ----->
		<!--<li class="<?php if($page_name == 'complain_management')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/complain_management" >
					<i class="icon-list-alt icon-2x"></i>
					<span><?php echo get_phrase('complain management');?></span>
				</a>
		</li> -->
        
        <!------ diagnostic type ----->
		<li class="<?php if($page_name == 'diagnostic_type')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/diagnostic_type" >
					<i class="icon-list-alt icon-2x"></i>
					<span><?php echo get_phrase('diagnostic type');?></span>
				</a>
		</li>
        
        	<!------ diagnostic service ----->
		<li class="<?php if($page_name == 'diagnostic_service')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/diagnostic_service" >
					<i class="icon-list-alt icon-2x"></i>
					<span><?php echo get_phrase('diagnostic service');?></span>
				</a>
		</li>
        
        <!------manage all list------>
		<li class="dark-nav <?php if(	$page_name == 'room_charges' 		|| 
										$page_name == 'manage_service' 	|| 
										$page_name == 'manage_rate' 		|| 
										$page_name == 'manage_booked' 		|| 
										$page_name == 'surgery_types' 		||
										$page_name == 'manage_category' 		||
										$page_name == 'surgery' 		||
										$page_name == 'manage_ot'  )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#view_all" >
                <i class="icon-screenshot icon-2x"></i>
                <span><?php echo get_phrase('manage');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="view_all" class="collapse <?php if(	
																		$page_name == 'room_charges' 		|| 
																		$page_name == 'manage_service' 	|| 
																		$page_name == 'manage_rate' 		|| 
																		$page_name == 'manage_booked' 		||
																		$page_name == 'surgery_types' 		||
																		$page_name == 'manage_category' 		||
																		$page_name == 'surgery' 		||
																		$page_name == 'manage_ot'  )echo 'in';?>">
                
               <!-- <li class="<?php if($page_name == 'room_charges')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/room_charges">
                      <i class="icon-money"></i> <?php echo get_phrase('room_charges');?>
                  </a>
                </li>-->
                <li class="<?php if($page_name == 'manage_service')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/manage_service">
                      <i class="icon-tint"></i> <?php echo get_phrase('manage_service');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'manage_rate')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/manage_rate">
                      <i class="icon-medkit"></i> <?php echo get_phrase('manage_rate');?>
                  </a>
                </li>
				<li class="<?php if($page_name == 'manage_booked')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/manage_booked">
                      <i class="icon-medkit"></i> <?php echo get_phrase('manage_booked');?>
                  </a>
                </li>
				<li class="<?php if($page_name == 'surgery_types')echo 'dark-nav active';?>">
		        <span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/surgery_types" >
					<i class="icon-list-alt icon-2x"></i>
					<span><?php echo get_phrase('surgery types');?></span>
				</a>
		     </li>
		      <li class="<?php if($page_name == 'manage_category')echo 'dark-nav active';?>">
		    	<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/manage_category" >
					<i class="icon-list-alt icon-2x"></i>
					<span><?php echo get_phrase('manage_category');?></span>
				</a>
		    </li>
			<li class="<?php if($page_name == 'surgery')echo 'dark-nav active';?>">
				<span class="glow"></span>
					<a href="<?php echo base_url();?>index.php?admin/surgery" >
						<i class="icon-list-alt icon-2x"></i>
						<span><?php echo get_phrase('surgery');?></span>
					</a>
			</li>
                <li class="<?php if($page_name == 'manage_ot')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/manage_ot">
                      <i class="icon-medkit"></i> <?php echo get_phrase('manage_oT');?>
                  </a>
                </li>
           
                
            </ul>
		</li>
        
        			<!------OT Schedule--->
		<li class="dark-nav <?php if(	$page_name == 'manage_email_template' 	|| 
										$page_name == 'manage_noticeboard' 		||
										//$page_name == 'system_settings' 		|| 
										//$page_name == 'manage_language' 		|| 
										$page_name == 'backup_restore' )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#reports_submenu" >
                <i class="icon-wrench icon-2x"></i>
                <span><?php echo get_phrase('reports');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="reports_submenu" class="collapse <?php if(	$page_name == 'ot_schedules1' 	|| 
																$page_name == 'ot_schedules2' 	//	||
																//$page_name == 'system_settings' 		|| 
																//$page_name == 'manage_language' 		|| 
																//$page_name == 'backup_restore' 
																)echo 'in';?>">
                <!--<li class="<?php if($page_name == 'manage_email_template')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/manage_email_template">
                      <i class="icon-envelope"></i> <?php echo get_phrase('manage_email_template');?>
                  </a>
                </li>-->
                <li class="<?php if($page_name == 'ot_schedules1')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/ot_schedules1">
                      <i class="icon-columns"></i> <?php echo get_phrase('ot schedules 1');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'ot_schedules2')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/ot_schedules2">
                      <i class="icon-columns"></i> <?php echo get_phrase('ot schedules 2');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'ot_schedules3')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/ot_schedules3">
                      <i class="icon-columns"></i> <?php echo get_phrase('ot schedules 3');?>
                  </a>
                </li>
            </ul>
		</li>

	    
		<!------manage hospital------>
		<!--<li class="dark-nav <?php if(	$page_name == 'view_appointment' 	|| 
										$page_name == 'view_payment' 		|| 
										$page_name == 'view_bed_status' 	|| 
										$page_name == 'view_blood_bank' 	|| 
										$page_name == 'view_medicine' 		|| 
										$page_name == 'view_report'  )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#view_hospital_submenu" >
                <i class="icon-screenshot icon-2x"></i>
                <span><?php echo get_phrase('complain');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="view_hospital_submenu" class="collapse <?php if(	$page_name == 'view_appointment' 	|| 
																		$page_name == 'view_payment' 		|| 
																		$page_name == 'view_bed_status' 	|| 
																		$page_name == 'view_blood_bank' 	|| 
																		$page_name == 'view_medicine' 		|| 
																		$page_name == 'view_report'  )echo 'in';?>">
                <li class="<?php if($page_name == 'view_appointment')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/view_appointment">
                      <i class="icon-exchange"></i> <?php echo get_phrase('view_appointment');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'view_payment')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/view_payment">
                      <i class="icon-money"></i> <?php echo get_phrase('view_payment');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'view_bed_status')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/view_bed_status">
                      <i class="icon-hdd"></i> <?php echo get_phrase('view_bed_status');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'view_blood_bank')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/view_blood_bank">
                      <i class="icon-tint"></i> <?php echo get_phrase('view_blood_bank');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'view_medicine')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/view_medicine">
                      <i class="icon-medkit"></i> <?php echo get_phrase('view_medicine');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'view_report' && $report_type	==	'operation')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/view_report/operation">
                      <i class="icon-reorder"></i> <?php echo get_phrase('view_operation');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'view_report' && $report_type	==	'birth')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/view_report/birth">
                      <i class="icon-github-alt"></i> <?php echo get_phrase('view_birth_report');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'view_report' && $report_type	==	'death')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/view_report/death">
                      <i class="icon-user"></i> <?php echo get_phrase('view_death_report');?>
                  </a>
                </li>
                
            </ul>
		</li>-->
     	
		<!------manage floor--->
		<li class="<?php if($page_name == 'manage_floor')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/manage_floor" >
					<i class="icon-lock icon-2x"></i>
					<span><?php echo "Manage Floor";?></span>
				</a>
		</li>
        
        <!------manage area--->
		<li class="<?php if($page_name == 'manage_area')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/manage_area" >
					<i class="icon-lock icon-2x"></i>
					<span><?php echo "Manage Area";?></span>
				</a>
		</li>
        
		
		<!------manage room--->
		<li class="<?php if($page_name == 'manage_room')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/manage_room" >
					<i class="icon-lock icon-2x"></i>
					<span><?php echo "Manage Room";?></span>
				</a>
		</li>
        
        <!------assigned room--->
		<li class="<?php if($page_name == 'assigned_room')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/assigned_room" >
					<i class="icon-lock icon-2x"></i>
					<span><?php echo "Assigned Room";?></span>
				</a>
		</li>
                
        	<!------complain------>
		<li class="dark-nav <?php if(    $page_name == 'maintenance_complain' 	|| 
										$page_name == 'manage_complain' 		|| 
										$page_name == 'view_report'  )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#view_hospital_submenu" >
                <i class="icon-screenshot icon-2x"></i>
                <span><?php echo get_phrase('complains');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="view_hospital_submenu" class="collapse <?php if(	$page_name == 'maintenance_complain' 	|| 
																		$page_name == 'manage_complain' 		|| 
																		
																		$page_name == 'view_report'  )echo 'in';?>">
                <li class="<?php if($page_name == 'maintenance_complain')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/maintenance_complain">
                      <i class="icon-exchange"></i> <?php echo get_phrase('maintenance_complain');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'manage_complain')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/manage_complain">
                      <i class="icon-money"></i> <?php echo get_phrase('manage_complain');?>
                  </a>
                </li>
            </ul>
		</li>
        
                <!------bed/ward------>
		<li class="dark-nav <?php if($page_name == 'manage_bed' || $page_name == 'manage_bed_allotment')echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#bed_submenu" >
                <i class="icon-hdd icon-2x"></i>
                <span><?php echo get_phrase('bed_ward');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="bed_submenu" class="collapse <?php if($page_name == 'manage_bed' || $page_name == 'manage_bed_allotment')echo 'in';?>">
                <li class="<?php if($page_name == 'manage_bed')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/manage_bed">
                      <i class="icon-hdd"></i> <?php echo get_phrase('manage_bed');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'manage_bed_allotment')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/manage_bed_allotment">
                      <i class="icon-wrench"></i> <?php echo get_phrase('manage_bed_allotment');?>
                  </a>
                </li>
                   <li class="<?php if($page_name == 'bed_transfer')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/bed_transfer">
                      <i class="icon-wrench"></i> <?php echo get_phrase('bed_transfer');?>
                  </a>
                </li>
            </ul>
		</li>
        
        	<!-------bed schedule -------->
          <li class="<?php if($page_name == 'bed_schedule')echo 'dark-nav active';?>">
           <span class="glow"></span>
            <a href="<?php echo base_url();?>index.php?admin/bed_schedule" >
             <i class="icon-hospital icon-2x"></i>
             <span><?php echo get_phrase('bed_schedule');?></span>
            </a>
          </li>
        
        <!------manage invoice ----->
		<li class="<?php if($page_name == 'manage_invoice')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/manage_invoice" >
					<i class="icon-list-alt icon-2x"></i>
					<span><?php echo get_phrase('invoice / take_payment');?></span>
				</a>
		</li>
        
            <!------doctor payment voucher ----->
      <li class="<?php if($page_name == 'doctor_payment_voucher')echo 'dark-nav active';?>">
       <span class="glow"></span>
        <a href="<?php echo base_url();?>index.php?admin/doctor_payment_voucher" >
         <i class="icon-list-alt icon-2x"></i>
         <span><?php echo get_phrase('doctor_payment_voucher');?></span>
        </a>
      </li>
        
          <!------approved_discount ----->
      <li class="<?php if($page_name == 'approved_discount')echo 'dark-nav active';?>">
       <span class="glow"></span>
        <a href="<?php echo base_url();?>index.php?admin/approved_discount" >
         <i class="icon-list-alt icon-2x"></i>
         <span><?php echo get_phrase('approved_discount');?></span>
        </a>
      </li>
      
       <!------daily doctor sale ----->
      <li class="<?php if($page_name == 'daily_doctorsale')echo 'dark-nav active';?>">
       <span class="glow"></span>
        <a href="<?php echo base_url();?>index.php?admin/daily_doctorsale" >
         <i class="icon-list-alt icon-2x"></i>
         <span><?php echo get_phrase('daily_doctor_sale');?></span>
        </a>
      </li>
      
       <!------daily doctor sale ----->
      <li class="<?php if($page_name == 'sales_report')echo 'dark-nav active';?>">
       <span class="glow"></span>
        <a href="<?php echo base_url();?>index.php?admin/salesreport" >
         <i class="icon-list-alt icon-2x"></i>
         <span><?php echo 'Sales Report';?></span>
        </a>
      </li>
      <!------sales category report ----->
      <li class="<?php if($page_name == 'salescategoryreport')echo 'dark-nav active';?>">
       <span class="glow"></span>
        <a href="<?php echo base_url();?>index.php?admin/salescategoryreport" >
         <i class="icon-list-alt icon-2x"></i>
         <span><?php echo 'Sales Category Report';?></span>
        </a>
      </li>
      <!-------daily_reception sale -------->
          <li class="<?php if($page_name == 'daily_receptionsale')echo 'dark-nav active';?>">
           <span class="glow"></span>
            <a href="<?php echo base_url();?>index.php?admin/daily_receptionsale" >
             <i class="icon-hospital icon-2x"></i>
             <span><?php echo get_phrase('daily_receptionsale');?></span>
            </a>
          </li>
          
		<!------system settings------>
		<li class="dark-nav <?php if(	$page_name == 'manage_email_template' 	|| 
										$page_name == 'manage_noticeboard' 		||
										//$page_name == 'system_settings' 		|| 
										//$page_name == 'manage_language' 		|| 
										$page_name == 'backup_restore' )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle" data-toggle="collapse" href="#settings_submenu" >
                <i class="icon-wrench icon-2x"></i>
                <span><?php echo get_phrase('settings');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="settings_submenu" class="collapse <?php if(	$page_name == 'manage_email_template' 	|| 
																$page_name == 'manage_noticeboard' 		||
																//$page_name == 'system_settings' 		|| 
																//$page_name == 'manage_language' 		|| 
																$page_name == 'backup_restore' )echo 'in';?>">
                <!--<li class="<?php if($page_name == 'manage_email_template')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/manage_email_template">
                      <i class="icon-envelope"></i> <?php echo get_phrase('manage_email_template');?>
                  </a>
                </li>-->
                <li class="<?php if($page_name == 'manage_noticeboard')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/manage_noticeboard">
                      <i class="icon-columns"></i> <?php echo get_phrase('manage_noticeboard');?>
                  </a>
                </li>
               <!-- <li class="<?php if($page_name == 'system_settings')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/system_settings">
                      <i class="icon-h-sign"></i> <?php echo get_phrase('system_settings');?>
                  </a>
                </li>-->
               <!-- <li class="<?php if($page_name == 'manage_language')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/manage_language">
                      <i class="icon-globe"></i> <?php echo get_phrase('manage_language');?>
                  </a>
                </li>-->
                <li class="<?php if($page_name == 'backup_restore')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/backup_restore">
                      <i class="icon-download-alt"></i> <?php echo get_phrase('backup_restore');?>
                  </a>
                </li>
            </ul>
		</li>
        
     
	   
		<!------manage own profile--->
		<li class="<?php if($page_name == 'manage_profile')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/manage_profile" >
					<i class="icon-lock icon-2x"></i>
					<span><?php echo get_phrase('profile');?></span>
				</a>
		</li>
         
	</ul>
	
</div>