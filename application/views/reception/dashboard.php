<div class="container-fluid padded">
	<div class="row-fluid">
        <div class="span30">
            <!-- find me in partials/action_nav_normal -->
            <!--big normal buttons-->
            <div class="action-nav-normal">


                <div class="row-fluid">
                    <div class="span2 action-nav-button" style = "width:800px !iportant;" >
                        <a href="<?php echo base_url();?>index.php?reception/manage_invoice">
                        <i class="icon-tint"></i>
                        <span><?php echo get_phrase('invoice / take_payment');?></span>
                        </a>
                    </div>
                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url();?>index.php?reception/manage_patient">
                        <i class="icon-user"></i>
                        <span><?php echo get_phrase('patient');?></span>
                        </a>
                    </div>
                  <!--  <div class="span2 action-nav-button">
                        <a href="<?php echo base_url();?>index.php?reception/view_payment">
                        <i class="icon-money"></i>
                        <span><?php echo get_phrase('view_payment');?></span>
                        </a>
                    </div>-->
                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url();?>index.php?reception/manage_doctor">
                        <i class="icon-user"></i>
                        <span><?php echo get_phrase('Doctor');?></span>
                        </a>
                    </div>
                     <div class="span2 action-nav-button">
                        <a href="<?php echo base_url();?>index.php?reception/manage_ot">
                        <i class="icon-medkit"></i>
                        <span><?php echo get_phrase('manage ot');?></span>
                        </a>
                    </div>
                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url();?>index.php?reception/Manage_Shift_Closed">
                        <i class="icon icon-lock"></i>
                        <span><?php echo get_phrase('Shift Closed');?></span>
                        </a>
                    </div>
                    <div class="span2 action-nav-button" pad>
                        <a href="<?php echo base_url();?>index.php?reception/manage_daily_expense">
                        <i class="icon-medkit"></i>
                        <span><?php echo get_phrase('expense Voucher');?></span>
                        </a>
                    </div>
                    
            </div>
        </div>
        <!--new-->
        <!-- <div class="modal-body">
                             <div class="box-body"  style="display:none;">
                                <?php echo form_open('purchase/add_purchase_invoice'); ?>
                                   <table class="table table-bordered table-hover table-sortable" style="width: 2000px;" id="tab_logic">
 
                                     <thead>
                                       <tr>
                                         <th class="text-center">Account Holder Name</th>
                                         <th class="text-center">Account Type</th>
                                         <th class="text-center">Address</th>
                                         <th class="text-center">Detail</th>
                                         <th class="text-center">Care off</th>
                                         <th class="text-center">Contact no</th>
                                         <th class="text-center">Account Limit</th>
                                         
                                         <th class="text-center">Amount</th>
                                         <th class="text-center">Actions</th>
                                       </tr>
                                     </thead>
                                       <tbody>
                                        
                                       <tr class = "mytrclass">
                                         <form method = "post">
                                         <td><input class="form-control" name = "edit_empcode" type="text" value="" readonly/></td>
                                         <td><input class="form-control" name = "edit_cnic" type="text" value="" readonly/></td>
                                         <td><input class="form-control" name = "edit_years_of_ser" type="text" value="" readonly/></td>
                                         <td><input class="form-control" name = "edit_pf_loan_limit" type="text" value="" readonly/></td>
                                         <td><input class="form-control" name = "edit_g_sal_loan_limit" type="text" value="" readonly/></td>
                                         <td><input class="form-control" name = "edit_loan_req" type="text" value="" readonly/></td>
                                         <td><input class="form-control" name = "edit_loan_freq" type="text" value="" readonly/></td>
                                         <td><input class="form-control" name = "edit_no_of_ins_month" type="text" value="" readonly/></td>
                                         <td class="text-center">
                                           <a href="" class="btn btn-xs btn-primary tal" >Edit</a> 
                                           <a href="" class="btn btn-xs btn-danger">Delete</a> 
                                           </td>
                                       </form>
                                       </tr>
                                       <tr class = "mytrclass">
                                         
                                         
                                         
                                         
                                         

                                       
                                       </tr>
                                    
                                     </tbody>
                                   </table>
                                 
                                </div>

 -->          <div style="align-left:"30%";>
              <?php echo form_open('reception/get_search_data');?>
              <input   type="text" name="name"> 
                <input  type="submit" name="submit" value="Search"> </p>
                
              <?php echo form_close();?>
      <br></div>        <!---DASHBOARD MENU BAR ENDS HERE-->
    </div>
    <hr />
    <div class="trow-fluid">
    
    	<!-----CALENDAR SCHEDULE STARTS-->
        <div class="span6">
            <div class="box">
                <div class="box-header">
                    <div class="title">
                        <i class="icon-calendar"></i> <?php echo get_phrase('calendar_schedule');?>
                    </div>
                </div>
                <div class="box-content">
                    <div id="schedule_calendar">
                    </div>
                </div>
            </div>
        </div>
    	<!-----CALENDAR SCHEDULE ENDS-->
        
    	<!-----NOTICEBOARD LIST STARTS-->
        <div class="span6">
            <div class="box">
                <div class="box-header">
                    <span class="title">
                        <i class="icon-reorder"></i> <?php echo get_phrase('noticeboard');?>
                    </span>
                </div>
                <div class="box-content scrollable" style="max-height: 500px; overflow-y: auto">
                
                    <?php 
                    $notices	=	$this->db->get('noticeboard')->result_array();
                    foreach($notices as $row):
                    ?>
                    <div class="box-section news with-icons">
                        <div class="avatar blue">
                            <i class="icon-tag icon-2x"></i>
                        </div>
                        <div class="news-time">
                            <span><?php echo date('d',$row['create_timestamp']);?></span> <?php echo date('M',$row['create_timestamp']);?>
                        </div>
                        <div class="news-content">
                            <div class="news-title">
                                <?php echo $row['notice_title'];?>
                            </div>
                            <div class="news-text">
                                 <?php echo $row['notice'];?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    	<!-----NOTICEBOARD LIST ENDS-->
    </div>
</div>

  
  <script>
  $(document).ready(function() {

    // page is now ready, initialize the calendar...

    $("#schedule_calendar").fullCalendar({
            header: {
                left: 	"prev,next",
                center: "title",
                right: 	"month,agendaWeek,agendaDay"
            },
            editable: 0,
            droppable: 0,
            events: [
					<?php 
                    $notices	=	$this->db->get('noticeboard')->result_array();
                    foreach($notices as $row):
                    ?>
					{
						title: "<?php echo $row['notice_title'];?>",
						start: new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>),
						end:	new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>)  
            		},
					<?php
					endforeach;
					?>
					]
        })
		
		jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url();?>/application/helpers/updatebedschedule.php",
			success: function(response)	
			{

			}
		});
});
  </script>