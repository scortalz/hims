<!DOCTYPE html>
<html>


	<head>
	<title>Patient Slip (OPD)</title>
	<link rel="stylesheet" href="<?php echo base_url();?>template/css/bootstrap.min.css">
 <script
  src="<?php echo base_url();?>template/js/jquery-3.2.1.min.js"
  ></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
    *{
	padding:0;
	margin:0;
}
.borderstyletd{
	 display: block;
    width: 170px;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
.wrapper {
	width: 90%;
	float: left;
	margin-left:5%;
	background-color: #fdfdfd;
	overflow: hidden;
}

.wrapper .header {
	width: 100%;
	float: left;
	background: blue; /* For browsers that do not support gradients */    
    background: -webkit-radial-gradient(#fdfdff,lightblue, powderblue); /* Safari 5.1 to 6.0 */
    background: -o-radial-gradient(#fdfdff,lightblue, powderblue); /* For Opera 11.6 to 12.0 */
    background: -moz-radial-gradient(#fdfdff,lightblue, powderblue); /* For Firefox 3.6 to 15 */
    background: radial-gradient(#fdfdff,lightblue, powderblue); /* Standard syntax (must be last) */

}

.line{
	margin-top: 2px;
	margin-bottom: 0px !important;
}

.header .logo-header {
	float: left;
	width: 100%;
	padding: 0px 30px;
	border-bottom: 2px solid #0000da; 
	float: left;
}

.logo{
	float: left;
	width: 15%;
}

.logo img{
	width: 120px;
	height: 100px;
}

.logo-name{
	width:100%;
	
	/*float: left;*/
}

.batool{

	font-size:26px;
}

.logo-name h1{
	font-size:44px;
	color: red;
	margin-top: 30px;
	margin-bottom: 0px;
	font-family: sans-serif;
	text-align: center;

}

.logo-name p{
	font-size:15px;
	color:#0000da;
	margin-top: 10px;
	font-weight: bold;
	font-family: sans-serif;
}

.info-header{
	width:100%;
	float:left;
	background-color: yellow;
}

.info-header .name{
	width: 32%;
	float: left;

	font-size:1vw;
	font-family: sans-serif;
	padding: 4px;

}


.info-header .dep{
	width:32%;
	float: left;
	line-height: 23px;
}
.info-header .dep2{
	width:44%;
	float: left;
	
}

.info-header .dep2 input{
	padding: 2px 10%;
	margin-bottom: 2px;
	border-radius:5px; 
}

.age{
	width:45%;
	float: left;
	
	font-size:1vw;
	font-family: sans-serif;
	padding: 4px;

}

.info-header .age input{
	padding:2px;
	margin-bottom: 2px;
	border-radius:5px; 
}
.mob{
	margin-top: 5px;
	width:20%;
	float: left;
	font-size:1vw;
	font-family: sans-serif;
	padding: 4px;
	
}

.mob .mob1{
	width: 20%;
	float:left;
}

.mob .mob2{
	width: 20%;
	float:left;
}

.mob .mob2 input{
	padding:2px;
	margin-bottom: 2px;
	border-radius:5px; 
}

.contain{
	width:100%;
	float: left;
	
}


.test{
	float: left
	width:100%;
	font-family: sans-serif;

}

.test1{
	float: left;
	width: 33.2%;
	border:1px solid black; 
	border-right: transparent;
	padding: 5px 0px;
}

.result{
	float: left;
	width: 33.2%;
	text-align: center;
	border:1px solid black; 
	border-left: transparent;
	border-right: transparent;
	padding: 5px 0px;
}

.ref{
	float: left;
	width: 33.3%;
	text-align: right;
	border:1px solid black; 
	border-left: transparent;
	padding: 5px 0px;
}

.maintest{
	width: 100%;
	float: left;
	margin-bottom: 8px;
	font-family: sans-serif;

}


.testlist{
	float: left;
	width: 33%;

}

.testlist p{
	font-size: 13px;
}

.resultlist{
	float: left;
	width: 33%;
	text-align: center;
}

.resultlist p{
	font-size: 13px;
}

.reflist{
	float: left;
	width: 33%;
	text-align: right;
}

.reflist p{
	font-size: 15px;
}

.footer{
	width: 100%;
	float: left;
}

.remarks{
	width:8%;
	float: left;
	
}

.remarkcol{
	width: 90%;
	float: left;
	border:1px solid black;
	
}

.path{
	float: right;
	width: 7%;
}

.blankpath .pathologist{
	width: 100%;
	float: left;
	border: 1px solid black; 
}

.mainfooter{
	width: 100%;
	float: left;
	background-color: #663399;
	margin-top:20px!important;
}

.mainfooter h6{
	font-size:15px;
	color:#fdfdfd;
	letter-spacing: 1px;
	font-family: sans-serif;
	padding-bootom:0px !important;
	text-align: center;
}
.cen td {
	text-align:right;"
}
}
/*.info_header>table{ background-color:#FBFCFC;width:100%; }*/
 .info_header > table > tbody > tr > td{font-size: 10px;}
 /*.contain > table > thead > tr {border:3px solid gray;}
 .contain > table > thead > tr > th{font-size: 18px;background-color:#FBFCFC;padding:0px !important;}*/
 .contain > table > tbody {background-color:#FBFCFC;}
 .contain{background-color:#FBFCFC;}
 .contain > table > tbody > tr > td {padding:5px;}
 .contain > table {margin-bottom: 0px !important;}
 .a { 
 	border-radius: 4px;
 	padding: 5px 10px;
 	background-color: #5555df;
 	color:white;
 }
.b { 
 	border-radius: 4px;
 	padding: 5px 10px;
 	border :2px solid white;
 	
 }
 tr.border_top {
  border-bottom:3px  solid black;
}



	</style>
	</head>

	<body>
		
		<div class="wrapper">
			<div class="header">
				<div class="logo-header">
					<div class="logo">
						<img src="<?php echo base_url('uploads/BHI-logo.png'); ?>" alt="batool_logo">
					</div>
					<div class="logo-name">
						<h1 style="padding-left:30px;">B<span class="batool">ATOOL </span>G<span class="batool">ENERAL </span>H<span class="batool">OSPITAL </span></h1>
						<hr color="red" class="line">
						<hr color="blue" class="line">
						
					</div>
				</div>
				<div class="info_header">
                <table class="table" style="background-color:#FBFCFC;" >
                	
                		
                
                	
                </table>
				
			</div>
				<?php if($invoice_data->num_rows()>0) {?>
				<?php foreach($invoice_data->result() as $data ):?>
			<div class="contain">
				<div class="heading" style="width:100%;font-size:20px;font-weight:bold;margin-top:0px;"><center>Patient Slip (<?php echo $data->patient_type; ?>)</center></div>
				<br />
				<table class="table">

					
						<tbody style="padding:5px !imported;">
                		<tr >
                			
                			<td style="padding:5px;"><label>Slip No :</label><label style = "margin-left:2%;"><?php echo $data->invoice_number;?></label></td>
                			<td><label>Date :</label><label style = "margin-left:2%;"><?php echo $data->creation_time;?></label></td>
                		</tr>
                		<tr>
                			<td><label>Patient Name :</label><label style = "margin-left:2%;"><?php echo $data->patient_name;?></label></td>
                			<td><label>Age :</label><label style = "margin-left:2%;"><?php echo $data->age;?></label></td>
                		    </tr>
                		    <tr>
                			<td><label>User :</label><label style = "margin-left:2%;"><?php  echo $name = $this->session->userdata('reception_name');?></label></td>
                			<td><label>RMO/Consultant :</label><label style = "margin-left:2%;"><?php echo $data->doctor_name?></label></td>
                		</tr>
                		<tr>
                			<td><label>Shift :</label><label style = "margin-left:2%;"><?php if(date("G") < 18 && date("G") > 6)  { echo "Morning"; } else { echo "Night"; }?></label></td>
                		    <td><label>Corporate :</label><label style = "margin-left:20px;">Hospital Patient</label></td>
                		    </tr>

                		
                	</tbody>
				</table >
					
				
                 	
			</div>
					
			 <table class="table tab">
					
						<thead>
							<tr class ="border_top">
								<th ><label style="font-size:20px ; font-weight:bold;color:black;">Sno</label></th>
								<th colspan="8"><label  style="font-size:20px ; font-weight:bold;color:black;">Discription</label></th>
								
							
							</tr>
						</thead>
						<tbody>
							<?php $count=1;?>
							<?php if($service_name->num_rows()>0){ ?>
							<?php foreach($service_name->result() as $service_name):?>
						    <?php if($service_name->service_name !=null){ ?>

						
						            <tr>
							            <td><label><?php echo $count++;?></label></td>
						            	<td><button data-toggle="modal" onclick="getsubservice(<?php echo $service_name->service_id;?>)" data-target="#subservice" class="btn btn-primary sername" type="button"><?php echo $service_name->service_name;?></button></td>
			                            
			                         </tr>
			                     <?php } endforeach; 
			                           } ?>
			                           

			                   			                                         
			                    
			                        <?php endforeach; } ?>
			                       </tbody>
			                       </table >
			 
                       <table class="table tab" frame="hsides" >
                       <tbody>
                        <tr>

							<td><label>Printed By: <?php  echo $name = $this->session->userdata('reception_name');?> Print Date-Time :<?php 
								echo date('Y-m-d H:i', time());
							?></label></td>
                            <td colspan="2"><label></label></td>
                            <td><label><u></u></label></td>
						</tr>
						<tr >
							<td><label ></label></td>
                            <td ><label></label></td>
                            <td ><label>Signature Of</label></td>
						</tr>	

						
					</tbody>
					</table>
				

			
		<div class="mainfooter">
			<h6>A-197,BLOCK 5,GULISTAN-E-JOHAR,KARACHI. PHONE:34618249,34633942, CELL:0321-2437003,0322-2437003 </h6>
		</div>
	</div>


	</body>

<!-- Modal -->
<div id="subservice" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Test</h4>
      </div>
      <div class="modal-body">
      	<form action="<?php echo base_url();?>index.php?laboratorist/submittest" id="saveresultform" method="post">
      		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      		<?php
      		if ($invoice_data) {
      			foreach ($invoice_data->result() as $value) {
      				echo "<input type='hidden' name='invoiceno' value='".$data->invoice_number. "'>";
      				echo "<input type='hidden' name='mrnum' value='".$data->patient_reg_no. "'>";
      			}
      		}
      		?>

      		

				  <div class="reportdata">

				 </div>
				</tbody>
			</table>
			

      			
      		
      		
      	</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
	function getsubservice(val){
		/*alert(val);*/
  $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>index.php?laboratorist/getreport/"+val,
       data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
      dataType: "json",

      success: function(args) {
        var data = jQuery.parseJSON(JSON.stringify(args));
    	var objstatus = jQuery.isEmptyObject(data);
        if (objstatus == false) {
        $('.reportdata').empty();
        $('#saveresultform').find('.table-bordered').remove();
        $('#saveresultform').find('.btn-info').remove();
        $('.reportdata').before('<table class="table-bordered inputfromdb"  style="width:100%"><tr><th class="text-center">Test</th><th class="text-center">Result</th><th class="text-center">Interval</th></tr>');
     	$('.reportdata').after('<input type="hidden" class="form-control" name="servicename" value="'+val+'"><br>');
      
      var x = 0;
      $.each(data[0], function(index,el) {

      	var inputs = '<tr><td class="borderstyletd">'+el+'</td><td><input required type="text" class="form-control" name="'+el+'"></td><td><input type="text" required class="form-control" readonly name="'+ x +'" value="'+data[1][x++]+'"></td></tr>';

       	$('.inputfromdb').append(inputs);
       });

      $('.inputfromdb').after('<br><center><button type="submit" style="margin-top: 9px;width: 181px;margin-left:-23px;" class="btn btn-info">Save</button></center>');
       }
       else {
       	$('.reportdata').empty();
       	$('#saveresultform').find('.table-bordered').remove();
        $('#saveresultform').find('.btn-info').remove();
       	$('.reportdata').html('<h1>No Sub service is associated</h1>');
       }    
    }  
    });
	}
</script>
</html>