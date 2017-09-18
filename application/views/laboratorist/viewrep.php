
<div class="box">
	<div class="box-header">
			<div class="tab-pane box" id="tablast" >
                <div class="box-content">
                    <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" style="color: grey !important;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo get_phrase('patient'); ?></th>
                            <th><?php echo get_phrase('date');?></th> 
                            <th><?php echo get_phrase('Options');?></th>
                        </tr>

                        </thead>
                        <tbody>
                         
                            	
                        	<?php $count = 1; foreach($reports as $report) {?>
                        <tr>
                            <td><?php echo $count++; ?></td>

	<?php $patientname = $this->db->get_where('patient',array('patient_reg_no' => $report['patient_reg_no']))->result_array(); ?>

                     <?php  $patient = $patientname[0]['name']; ?>

                            <td><?php echo $patient; ?></td>
                            <td><?php echo $report['date']; ?></td>
                            <td align="center">
							<a href="<?php echo base_url();?>index.php?laboratorist/getlabreport/<?php echo $report['rep_session']; ?>" rel="tooltip" data-placement="top" 
							data-original-title="<?php echo get_phrase('print');?>" 
							class="btn btn-info"> <i class="icon-print"></i>
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