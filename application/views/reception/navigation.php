<div class="sidebar-background">
	<div class="primary-sidebar-background">
	</div>
</div>
<div class="primary-sidebar">
	<!-- Main nav -->
   
    <div style="text-align: center; background: none repeat scroll 0% 0% #fff; padding: 35px 0px;">
    	<a href="<?php echo base_url();?>">
        	<img src="<?php echo base_url();?>uploads/logo.png" width="90%"  />
        </a>
    </div>
   	
	<ul class="nav nav-collapse collapse nav-collapse-primary">
    
        
        <!------dashboard----->
		<li class="<?php if($page_name == 'dashboard')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/dashboard" >
					<i class="icon-desktop icon-2x"></i>
					<span><?php echo get_phrase('dashboard');?></span>
				</a>
		</li>
		
		  <!------patient----->
		<!--<li class="<?php if($page_name == 'manage_patient')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/manage_patient" >
					<i class="icon-user icon-2x"></i>
					<span><?php echo get_phrase('patient');?></span>
				</a>
		</li>-->
        
        <!------IPD Add Service--->
		<li class="<?php if($page_name == 'ipdaddservice')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/ipdaddservice" >
					<i class="icon-lock icon-2x"></i>
					<span><?php echo get_phrase('Admitted_Patient');?></span>
				</a>
		</li>
        
        
		<!------patient----->
  <li class="<?php if($page_name == 'manage_patient')echo 'dark-nav active';?>">
   <span class="glow"></span>
    <a href="<?php echo base_url();?>index.php?reception/manage_patient" >
     <i class="icon-user icon-2x"></i>
     <span><?php echo get_phrase('registered_patient');?></span>
    </a>
  </li>
  
  	
  <!------advance apointment----->
  <li class="<?php if($page_name == 'advanceappointment')echo 'dark-nav active';?>">
   <span class="glow"></span>
    <a href="<?php echo base_url();?>index.php?reception/advanceappointment" >
     <i class="icon-user icon-2x"></i>
     <span><?php echo get_phrase('advance_appointment');?></span>
    </a>
  </li>
		 	<!------manage doctor list------>
		<li class="dark-nav <?php if(	$page_name == 'doctor_speciality' 	|| 
										$page_name == 'doctor_schedule' 		||  
										$page_name == 'manage_doctor'  )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#doctor_list" >
                <i class="icon-screenshot icon-2x"></i>
                <span><?php echo get_phrase('Doctor List');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="doctor_list" class="collapse <?php if(	
        		$page_name == 'doctor_speciality'	 	|| 
				$page_name == 'doctor_schedule' 		|| 
				$page_name == 'manage_doctor'  )echo 'in';?>">
                <li class="<?php if($page_name == 'doctor_speciality')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?reception/doctor_speciality">
                      <i class="icon-exchange"></i> <?php echo get_phrase('doctor speciality');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'doctor_schedule')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?reception/doctor_schedule">
                      <i class="icon-money"></i> <?php echo get_phrase('doctor schedule');?>
                  </a>
                </li>
                 <li class="<?php if($page_name == 'manage_department')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?reception/manage_department">
                      <i class="icon-hdd"></i> <?php echo get_phrase('manage department');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'manage_doctor')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?reception/manage_doctor">
                      <i class="icon-hdd"></i> <?php echo get_phrase('manage doctor');?>
                  </a>
                </li>
               
            </ul>
		</li>
        
        	<!------manage floor----->
		<li style="display:none;" class="<?php if($page_name == 'manage_loor')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/manage_floor" >
					<i class="icon-user icon-2x"></i>
					<span><?php echo get_phrase('manage floor');?></span>
				</a>
		</li>
        
         <!------manage area ----->
		<li style="display:none;"class="<?php if($page_name == 'manage_area')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/manage_area" >
					<i class="icon-list-alt icon-2x"></i>
					<span><?php echo get_phrase('manage area');?></span>
				</a>
		</li>
        
        <!------manage room----->
		<li style="display:none;" class="<?php if($page_name == 'manage_room')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/manage_room" >
					<i class="icon-user icon-2x"></i>
					<span><?php echo get_phrase('manage room');?></span>
				</a>
		</li>
		
	   <!------assigned room--->
		<li class="<?php if($page_name == 'assigned_room')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/assigned_room" >
					<i class="icon-lock icon-2x"></i>
					<span><?php echo "Assigned Room";?></span>
				</a>
		</li>
                
		
		 <!------complain------>
		<li class="dark-nav <?php if(	
		$page_name == 'maintenance_complain' 	|| 
		$page_name == 'manage_complain' 		|| 
		$page_name == 'view_report'  )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#view_complain" >
                <i class="icon-screenshot icon-2x"></i>
                <span><?php echo get_phrase('complains');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="view_complain" class="collapse <?php if(	
            $page_name == 'maintenance_complain' 	|| 
			$page_name == 'manage_complain' 		|| 
			$page_name == 'view_report'  )echo 'in';?>">
                <li class="<?php if($page_name == 'maintenance_complain')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?reception/maintenance_complain">
                      <i class="icon-exchange"></i> <?php echo get_phrase('maintenance_complain');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'manage_complain')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?reception/manage_complain">
                      <i class="icon-money"></i> <?php echo get_phrase('manage_complain');?>
                  </a>
                </li>
            </ul>
		</li>
		
		<!------employee----->
		<li class="<?php if($page_name == 'manage_employee')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/manage_employee" >
					<i class="icon-money icon-2x"></i>
					<span><?php echo get_phrase('employee');?></span>
				</a>
		</li>


	 <!------general complain ----->
	<!--	<li class="<?php if($page_name == 'general_complain')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/general_complain" >
					<i class="icon-list-alt icon-2x"></i>
					<span><?php echo get_phrase('general complain');?></span>
				</a>
		</li>-->
		 
		 
		  <!------ complain management ----->
		<!--<li class="<?php if($page_name == 'complain_management')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/complain_management" >
					<i class="icon-list-alt icon-2x"></i>
					<span><?php echo get_phrase('complain management');?></span>
				</a>
		</li> -->
        
         <!------ diagnostic type ----->
		<li style="display:none;" class="<?php if($page_name == 'diagnostic_type')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/diagnostic_type" >
					<i class="icon-list-alt icon-2x"></i>
					<span><?php echo get_phrase('diagnostic type');?></span>
				</a>
		</li> 
        
          <!------ diagnostic service ----->
		<li class="<?php if($page_name == 'diagnostic_service')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/diagnostic_service" >
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
				$page_name == 'manage_service' 		|| 
				$page_name == 'manage_rate' 		|| 
				$page_name == 'manage_booked' 		||
				$page_name == 'surgery_types' 		||
				$page_name == 'manage_category' 	||
				$page_name == 'surgery' 			||
				$page_name == 'manage_ot'  )echo 'in';?>">
                
              <!--  <li class="<?php if($page_name == 'room_charges')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?reception/room_charges">
                      <i class="icon-money"></i> <?php echo get_phrase('room_charges');?>
                  </a>
                </li>-->
                <li class="<?php if($page_name == 'manage_service')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?reception/manage_service">
                      <i class="icon-tint"></i> <?php echo get_phrase('manage_service');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'manage_rate')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?reception/manage_rate">
                      <i class="icon-medkit"></i> <?php echo get_phrase('manage_rate');?>
                  </a>
                </li>
				<li style="display: none;" class="<?php if($page_name == 'manage_booked')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?reception/manage_booked">
                      <i class="icon-medkit"></i> <?php echo get_phrase('manage_booked');?>
                  </a>
                </li>
				<li class="<?php if($page_name == 'surgery_types')echo 'dark-nav active';?>">
		        <span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/surgery_types" >
					<i class="icon-list-alt icon-2x"></i>
					<span><?php echo get_phrase('surgery types');?></span>
				</a>
		     </li>
		      <li class="<?php if($page_name == 'manage_category')echo 'dark-nav active';?>">
		    	<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/manage_category" >
					<i class="icon-list-alt icon-2x"></i>
					<span><?php echo get_phrase('manage_category');?></span>
				</a>
		    </li>
			<li class="<?php if($page_name == 'surgery')echo 'dark-nav active';?>">
				<span class="glow"></span>
					<a href="<?php echo base_url();?>index.php?reception/surgery" >
						<i class="icon-list-alt icon-2x"></i>
						<span><?php echo get_phrase('surgery');?></span>
					</a>
			</li>
                <li style="display: none;"> class="<?php if($page_name == 'manage_ot')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?reception/manage_ot">
                      <i class="icon-medkit"></i> <?php echo get_phrase('manage_oT');?>
                  </a>
                </li>
           
                
            </ul>
		</li>
		
        
        <!------view_payment----->
		<!--<li class="<?php if($page_name == 'view_payment')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/view_payment" >
					<i class="icon-money icon-2x"></i>
					<span><?php echo get_phrase('view_payment');?></span>
				</a>
		</li>-->
        
        <!------manage invoice ----->
		<!--<li class="<?php if($page_name == 'take_cash_payment')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/take_cash_payment" >
					<i class="icon-list-alt icon-2x"></i>
					<span><?php echo get_phrase('OPD Payment');?></span>
				</a>
		</li>-->
        <li class="dark-nav <?php if(	$page_name == 'manage_email_template' 	|| 
										$page_name == 'manage_noticeboard' 		||
										//$page_name == 'system_settings' 		|| 
										//$page_name == 'manage_language' 		|| 
										$page_name == 'backup_restore' )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#reports_submenu" >
                <i class="icon-wrench icon-2x"></i>
                <span><?php echo get_phrase('OT');?><i class="icon-caret-down"></i></span>
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
                  <a href="<?php echo base_url();?>index.php?reception/ot_schedules1">
                      <i class="icon-columns"></i> <?php echo get_phrase('ot schedules 1');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'ot_schedules2')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?reception/ot_schedules2">
                      <i class="icon-columns"></i> <?php echo get_phrase('ot schedules 2');?>
                  </a>
                </li>      
                <li class="<?php if($page_name == 'ot_schedules3')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?reception/ot_schedules3">
                      <i class="icon-columns"></i> <?php echo get_phrase('ot schedules 3');?>
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
                  <a href="<?php echo base_url();?>index.php?reception/manage_bed">
                      <i class="icon-hdd"></i> <?php echo get_phrase('manage_bed');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'manage_bed_allotment')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?reception/manage_bed_allotment">
                      <i class="icon-wrench"></i> <?php echo get_phrase('manage_bed_allotment');?>
                  </a>
                </li>
                 <li class="<?php if($page_name == 'bed_transfer')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?reception/bed_transfer">
                      <i class="icon-wrench"></i> <?php echo get_phrase('bed_transfer');?>
                  </a>
                </li>
            </ul>
		</li>
        
        	<!-------bed schedule -------->
          <li class="<?php if($page_name == 'bed_schedule')echo 'dark-nav active';?>">
           <span class="glow"></span>
            <a href="<?php echo base_url();?>index.php?reception/bed_schedule" >
             <i class="icon-hospital icon-2x"></i>
             <span><?php echo get_phrase('bed_schedule');?></span>
            </a>
          </li>
          
          <!-------daily_reception sale -------->
          <li class="<?php if($page_name == 'daily_receptionsale')echo 'dark-nav active';?>">
           <span class="glow"></span>
            <a href="<?php echo base_url();?>index.php?reception/daily_receptionsale" >
             <i class="icon-hospital icon-2x"></i>
             <span><?php echo get_phrase('daily_over_cash');?></span>
            </a>
          </li>

		  <!-- doctor share summry report-->

		  <li class="dark-nav <?php if(	$page_name == 'doctor_share_summary'  )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#report" >
                <i class="icon-screenshot icon-2x"></i>
                <span><?php echo get_phrase('Report');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="report" class="collapse <?php if($page_name == 'doctor_share_summary'  )echo 'in';?>">
                <li class="<?php if($page_name == 'doctor_share_summary')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?reception/doctor_share_summary">
                      <i class="icon-exchange"></i>Doctor Share Summary
                  </a>
                </li>
                
               
            </ul>
		</li>

		  <!-- doctor share summry report end -->
		   <!-------daily_reception sale -------->
          <li style="display: none;" class="<?php if($page_name == 'daily_cash_summary')echo 'dark-nav active';?>">
           <span class="glow"></span>
            <a href="<?php echo base_url();?>index.php?reception/daily_cash_summary" >
             <i class="icon-hospital icon-2x"></i>
             <span><?php echo get_phrase('Daily Cash Summary');?></span>
            </a>
          </li>
		  
          
		<!------manage own profile--->
		<li  class="<?php if($page_name == 'manage_profile')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?reception/manage_profile" >
					<i class="icon-lock icon-2x"></i>
					<span><?php echo get_phrase('profile');?></span>
				</a>
		</li>
		
	</ul>
	
</div>