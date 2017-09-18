
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
   	<br />
	<ul class="nav nav-collapse collapse nav-collapse-primary">
    
        
        <!--dashboard-->
		<li class="<?php if($page_name == 'dashboard')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?laboratorist/dashboard" >
					<i class="icon-desktop icon-2x"></i>
					<span><?php echo get_phrase('dashboard');?></span>
				</a>
		</li>
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?laboratorist/labreports" >
					<i class="icon-hospital icon-2x"></i>
				<span><?php echo get_phrase('add laboratorist Reports');?></span>
			</a>
		</li>
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?laboratorist/viewrep" >
					<i class="icon-hospital icon-2x"></i>
				<span><?php echo get_phrase('view laboratorist Reports');?></span>
			</a>
		</li>
        <!--add diagnosis report to prescription-->
		<li class="<?php if($page_name == 'manage_prescription')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?laboratorist/manage_prescription" >
					<i class="icon-stethoscope icon-2x"></i>
					<span><?php echo get_phrase('add_diagnosis_report');?></span>
				</a>
		</li>
        
        <!--manage blood bank-->
		<li class="<?php if($page_name == 'manage_blood_bank')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?laboratorist/manage_blood_bank" >
					<i class="icon-tint icon-2x"></i>
					<span><?php echo get_phrase('manage_blood_bank');?></span>
				</a>
		</li>
        
        <!--medicine blood donor-->
		<li class="<?php if($page_name == 'manage_blood_donor')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?laboratorist/manage_blood_donor" >
					<i class="icon-user icon-2x"></i>
					<span><?php echo get_phrase('manage_blood_donor');?></span>
				</a>
		</li>
        
		<!--manage own profile-->
		<li class="<?php if($page_name == 'manage_profile')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?laboratorist/manage_profile" >
					<i class="icon-lock icon-2x"></i>
					<span><?php echo get_phrase(' profile');?></span>
				</a>
		</li>
		 <!-- <li class="<?php if($page_name == 'manage_hematology_work')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?laboratorist/manage_reports_work" >
					<?php $image="uploads/left_logo.png"?>
					<i><img style="margin_left:5px;" src="<?php echo base_url($image)?>"/></i>
					<span style="font-weight:bold;"><?php echo get_phrase('manage_reports');?></span>
				</a>
		</li>
		 <li class="<?php if($page_name == 'manage_hematology_work')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?laboratorist/manage_hematology_work" >
					<?php $image="uploads/left_logo.png"?>
					<i><img style="margin_left:5px;" src="<?php echo base_url($image)?>"/></i>
					<span style="font-weight:bold;"><?php echo get_phrase('manage_hematology ');?></span>
				</a>
		</li> 
		 <li class="<?php if($page_name == 'manage_Immunology_work')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?laboratorist/manage_Immunology_work">
					<?php $image="uploads/left_logo.png"?>
					<i><img style="margin_left:5px;" src="<?php echo base_url($image)?>"/></i>
					<span style="font-weight:bold;"><?php echo get_phrase('manage_Immunology');?></span>
				</a>
		</li>
		<li class="<?php if($page_name == 'manage_hematology_1_work')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?laboratorist/manage_hematology_1_work">
					<?php $image="uploads/left_logo.png"?>
					<i><img style="margin_left:5px;" src="<?php echo base_url($image)?>"/></i>
					<span style="font-weight:bold;"><?php echo get_phrase('manage_heamatology-1');?></span>
				</a>
		</li>
		<li class="<?php if($page_name == 'manage_biochemistry_work')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?laboratorist/manage_biochemistry_work">
					<?php $image="uploads/left_logo.png"?>
					<i><img style="margin_left:5px;" src="<?php echo base_url($image)?>"/></i>
					<span style="font-weight:bold;"><?php echo get_phrase('manage_biochemistry');?></span>
				</a>
		</li>
		<li class="<?php if($page_name == 'manage_paracytology_work')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?laboratorist/manage_paracytology_work">
					<?php $image="uploads/left_logo.png"?>
					<i><img style="margin_left:5px;" src="<?php echo base_url($image)?>"/></i>
					<span style="font-weight:bold;"><?php echo get_phrase('manage_paracytology');?></span>
				</a>
		</li>  -->
	</ul>
	
</div>