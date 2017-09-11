<!DOCTYPE html>
<html>


	<head>
	<title>Department of Paracytology</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
    *{
	padding:0;
	margin:0;
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
.header{margin-top: 0px !important; padding-top: 0px !important;}

.line{
	margin-top: 2px;
	margin-bottom: 0px !important;
}

.header .logo-header {
	float: left;
	width: 100%;
	padding: 0px 10px;
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

	font-size:20px;
}

.logo-name h1{
	font-size:25px;
	color: red;
	margin-top: 0px;
	margin-bottom: 0px;
	font-family: sans-serif;

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
	margin-top:0px!important;
}

.mainfooter p{
	font-size:10px;
	color:#fdfdfd;
	letter-spacing: 1px;
	font-family: sans-serif;
	padding-bootom:0px !important;
	text-align: center;
}
  .info_header{margin-bottom: 0px !important;}
/*.info_header>table{ background-color:#FBFCFC;width:100%; }*/
 .info_header > table > tbody > tr > td{font-size: 10px; padding:2px;}
 .contain > table > thead > tr {border:3px solid gray;}
 .contain > table > thead > tr > th{font-size: 18px;background-color:#FBFCFC;padding:0px !important;}
 .contain > table > tbody {background-color:#FBFCFC;}
 .contain{background-color:#FBFCFC;}
 .contain > table > tbody > tr > td {padding:0px;}
 .contain > table {margin-bottom: 0px !important;}
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
						<h1 style="padding-left:30px;">B<span class="batool">ATOOL </span>G<span class="batool">ENERAL </span>H<span class="batool">OSPITAL </span>& D<span class="batool">IAGNOSTIC </span>C<span class="batool">ENTRE</span></h1>
						<hr color="red" class="line">
						<hr color="blue" class="line">
						<p style="padding-top:0px;padding-bottom:0px!important;">
						A-197, BLOCK 5, GULISTAN-E-JAUHAR, KARACHI. PH : 34013732 - 34618249
						</p>
					</div>
				</div>
				<div class="info_header">
                <table class="table" style="background-color:#FBFCFC;" >
                	<?php if($paracytology_data->num_rows()>0 ){ ?>
                        <?php foreach($paracytology_data->result() as $key => $value) : ?>
                	<tbody>
                		<tr>
                			
                			<td><label>Name :</label><label style = "margin-left:2%;"><?php echo $value->patient_name;?></label></td>
                			<td><label>Age :</label><label style = "margin-left:2%;"><?php echo $value->age;?></label></td>
                			<td><label>Sex :</label><label style = "margin-left:2%;"><?php echo $value->sex;?></label></td>
                		    </tr>
                		    <tr>
                			<td><label>Invoice No  :</label><label style = "margin-left:2%;"><?php echo $value->invoice_no;?></label></td>
                			<td><label>Phone # :</label><label style = "margin-left:2%;"><?php echo $value->phone;?></label></td>
                			<td><label>Mobile # :</label><label style = "margin-left:2%;"><?php echo $value->mobile_no;?></label></td>
                		    </tr>
                		    <tr>
                			<td><label>Cons. phy / Clinic :</label><label style = "margin-left:20px;"><?php echo $value->doc_name;?></label></td>
                			<td colspan="2"><label>Specimen Collection Date :</label><label style = "margin-left:20px;"><?php echo $value->report_date;?></label></td>
                			
                		    </tr>
                		
                	</tbody>
                </table>
				
			</div>

			<div class="contain">
				<div class="heading" style="width:100%;font-size:15px;margin-top:0px;"><center>Department Of Paracytology</center></div>
				<table class="table">
					
						<thead>
							<tr>
								<th colspan=""><label>Test</label></th>
								<th><label>Result</label></th>
								<th colspan=""><label>Reference Intervel</label></th>
							</tr>
						</thead>
						<tbody>
						
						<tbody>
						<tr>
							<td></td>
							<td><label style="font-weight:1.5 em;"><U>URINE ANALYSIS</U></label></td>
							<td></td>
						</tr>
						<tr>
							<td><label style="font-weight:1.5 em;"><U>Physical Exam</U></label></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><label>Volume</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->volume;?></label></td>
                            <td><label>0.5-1.5 L/ Day</label></td>
						</tr>
						
						<tr>
							<td><label>Color</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->color;?></label></td>
                            <td><label>Straw - Yellow</label></td>
						</tr>
						<tr>
							<td><label>Appearance</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->appearance;?></label></td>
                            <td><label></label></td>
						</tr>
						<tr>
							<td><label>Specific Gravity</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->specific_gravity;?></label></td>
                            <td><label>1.005 - 1.030</label></td>
						</tr>
						<tr>
							<td><label>pH</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->ph;?></label></td>
                            <td><label>4.5 - 7.5</label></td>
						</tr>
						<tr>
							<td><label style="font-weight:1.5 em;"><U>Chemical Exam</U></label></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><label>Glucose (Sugar)</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->glucose;?></label></td>
                            <td><label>Negitive</label></td>
						</tr>
						<tr>
							<td><label>Albumin</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->albumin;?></label></td>
                            <td><label>Negitive</label></td>
						</tr>
						<tr>
							<td><label>Bile</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->bile;?></label></td>
                            <td><label>Negitive</label></td>
						</tr>
						<tr>
							<td><label>Urobilinogen</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->urobilinogen;?></label></td>
                            <td><label>0.3 mmol / 1</label></td>
						</tr>
						<tr>
							<td><label>Ketone</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->ketone;?></label></td>
                            <td><label>Negitive</label></td>
						</tr>
						<tr>
							<td><label>Nitrite</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->nitrite;?></label></td>
                            <td><label>Negitive</label></td>
							
						</tr>
						<tr>
							<td><label>Blood</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->blood;?></label></td>
                            <td><label>Negitive</label></td>
						</tr>
						<tr>
							<td><label style="font-weight:1.5 em;"><U>Mircoscopic Exam</U></label></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><label>Pus Cells</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->pus_cell;?></label></td>
                            <td><label> < 10 / H . P . F </label></td>
						</tr>
						<tr>
							<td><label>Red Cells</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->red_cell;?></label></td>
                            <td><label>Nill</label></td>
						</tr>
						<tr>
							<td><label>Epithilial Cells</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->epithelial_cell;?></label></td>
                            <td><label> - </label></td>
						</tr>
						<tr>
							<td><label>Bacteria</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->bacteria;?></label></td>
                            <td><label>  Nill </label></td>
						</tr>
						<tr>
							<td><label>Yeast Cells</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->yeast_cell;?></label></td>
                            <td><label>  Nill </label></td>
							
						</tr>
						<tr>
							<td><label>Crystals</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->crystal;?></label></td>
                            <td><label>  - </label></td>
						</tr>
						<tr>
							<td><label>Amorphous Urates</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->amorphose_urates;?></label></td>
                            <td><label>  - </label></td>
						</tr>
						<tr>
							<td><label>Granular Cast</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->granular_cast;?></label></td>
                            <td><label>  Nill </label></td>
						</tr>
						<tr>
							<td><label>Calcium Oxalate</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->calcium_oxalate;?></label></td>
                            <td><label>  - </label></td>
						</tr>
						
						<tr style="border-style:solid;border-bottom:3px;padding-top:200px !important;">
							<td><label >Remarks :</label></td>
                            <td colspan="2"><label></label></td>
                            <td><label><u></u></label></td>
						</tr>
						<tr style=" border-style:solid;border-top:3px;">
							<td><label ></label></td>
                            <td ><label></label></td>
                            <td><label>Pathologist</label></td>
						</tr>
					</tbody>
				</table>
               <?php endforeach; }?>
			</div>

		
	</div>

</div>
	</body>


</html>