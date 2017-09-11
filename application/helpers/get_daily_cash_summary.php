<style>.hidedata {display:none;}</style>
<?php

// Check Posted Data Has Value In It
	include realpath(".") . "/mydb.php";
	include realpath(".") .  "/../dompdf/dompdf_config.inc.php";
	// Create Objects Of Required Classes
	$Db = NULL;
	$Db = new  DB();
	//if(isset($_POST['post_ownperson']))
	//{
		
		$invoices = $Db->getDailyCashSummaryReport($_POST['post_selected_date']);
		if (count($invoices) <= 0 )
		{
			echo  "<center><span style='color:red;font-size:20px;'>Invoice not found</span></center>";
			return;	
		}
		
?>
				<!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="forpint11new">
          		 <?php $rep_html ='<table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" style="width:100%;" >
                	<thead>
					<tr>
                        <td align="center"  colspan="6">
                      	<img class="hidedata" src="../helpers/img/logo.png" /></td>
                        </tr>
						 <tr>
						 
                        <td align="center"  colspan="6">
                      <h1 class="hidedata">Daily Collection Cash Summary</h1></td>
					 
                        </tr>
						<tr><td class="hidedata" align="right" colspan="6">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
						<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Patient Reg No</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Patient Name</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Doctor / Service Name</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Service Name</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Receptionist Name</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Creation Time</div></th>
							<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Total Invoice</div></th>
							
						</tr>
					
					</thead>
                    <tbody>';
                      $Total_Received_Amount =0;
						$count= 1; foreach($invoices as $row):
						
					$dr_name = $row['dr_name'];
						$service_type = $row['service_type'];
						if (strlen($row['service_type']) <= 0 )
						{
							$service_type = "Consultation";
						}
						
            		     $rep_html .=' <tr>
     	<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
		<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['patient_reg_no'].'</td>
  		<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['name'].'</td>
		<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;width:150px;">'.$dr_name .'</td>
		<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;width:150px;">'.$service_type.'</td>
		
  		<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['createdby'].'</td>
  		<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['creation_time'].'</td>
	 <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;text-align:center;">'.$row['receivedamount'].'</td>
	 </tr>';
	 
	 

	 					
						$Total_Received_Amount = $Total_Received_Amount + $row["receivedamount"];
						endforeach;
						
						
						
					$rep_html .='  <tr><td  colspan="8"> <table  align="right" style="margin-top:10px;">
                		<tr style="background:#3A6EA5; height:40px;"> 
                    	<th style="width:40%; color:#fff;"> Grand Total: </th>
                        <th style="width:40%; color:#fff;text-align:right;;">'. number_format($Total_Received_Amount, 2).'</th>
                    	</tr>
                    	<tr>
                    	<td colspan="3">
                        	<div style="float: right;margin:10px;">
 								<input style="width:220px;height:40px;" type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print"/>
						</div>
                        </td>
                    </tr>';
						
						
					 $rep_html .='	</tbody></table>';
                      ?>	   		
               
                            	   
               	        <?php 
						
				   			echo $rep_html;
						/*
							$dompdf = new DOMPDF();
							$dompdf->load_html($rep_html);

					  	   $dompdf->render();

					      // The next call will store the entire PDF as a string in $pdf
						  $pdf = $dompdf->output();

						  // write $pdf to disk, store it in a database or stream it
						  // to the client.
				        
						 file_put_contents("../../reports/daily_cash_summary.pdf", $pdf);
				   */
    ?>
 	      </div>
          <br />
          <input type="button" class="btn btn-green" name="print" id="print" value="    Print Report   " onClick="forprintdiv()" />

        <script>
    
  function forprintdiv() 
    {
        var data1 = $('#forpint11new').html();
        var mywindow = window.open('', 'my div', 'height=1000,width=1500, overflow=auto');
        mywindow.document.write('<html><head><title>Daily Reception Sale</title>');
        mywindow.document.write('</head><body>');
      
        mywindow.document.write(data1);
        mywindow.document.write('</body></html>');

        mywindow.print();
      

        return true;
    }
    
    </script>
<script>
/*
	$(document).ready(function(e) {
        $('#btnReport').click(function () {
  
		  var v = "reports/daily_cash_summary.pdf";
		  window.location = v;
 });
    });
	*/
	</script>

        