<!DOCTYPE html>
<html>


	<head>
	<title>Department of Heamatology</title>
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

	font-size:20px;
}

.logo-name h1{
	font-size:25px;
	color: red;
	margin-top: 10px;
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
/*.info_header>table{ background-color:#FBFCFC;width:100%; }*/
 .info_header > table > tbody > tr > td{font-size: 10px;}
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
						<p style="padding-top:0px;">
						A-197, BLOCK 5, GULISTAN-E-JAUHAR, KARACHI. PH : 34013732 - 34618249
						</p>
					</div>
				</div>
				<div class="info_header">
					<?php if($hematology_data->num_rows()>0){ ?>
					<?php foreach($hematology_data->result() as $row):?>
                <table class="table" style="background-color:#FBFCFC;" >
                	<tbody>
                		<tr>
                			
                			<td><label>Name :</label><label style = "margin-left:2%;"><?php echo $row->patient_name;?></label></td>
                			<td><label>Age :</label><label style = "margin-left:2%;"><?php echo $row->age;?></label></td>
                			<td><label>Sex :</label><label style = "margin-left:2%;"><?php echo $row->sex;?></label></td>
                		    </tr>
                		    <tr>
                			<td><label>Invoice No  :</label><label style = "margin-left:2%;"><?php echo $row->invoice_no?></label></td>
                			<td><label>Phone # :</label><label style = "margin-left:2%;"><?php echo $row->phone;?></label></td>
                			<td><label>Mobile # :</label><label style = "margin-left:2%;"><?php echo $row->phone;?></label></td>
                		    </tr>
                		    <tr>
                			<td><label>Cons. phy / Clinic :</label><label style = "margin-left:20px;"><?php echo $row->doc_name;?></label></td>
                			<td colspan="2"><label>Specimen Collection Date :</label><label style = "margin-left:20px;"><?php echo $row->report_date;?></label></td>
                			
                		    </tr>
                		
                	                	
                		
                	</tbody>
                </table>
				
			</div>

			<div class="contain">
				<div class="heading" style="width:100%;font-size:20px;margin-top:0px;"><center>Department Of Heamatology</center></div>
				<table class="table">
					
						<thead>
							<tr>
								<th colspan=""><label>Test</label></th>
								<th><label>Result</label></th>
								<th colspan=""><label>Reference Intervel</label></th>
							</tr>
						</thead>
						<tbody>
						<tr>
							<td><label>Leucocytes Total</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->leucocytes;?></label></td>
                            <td><label>4000-11000/cu.mm</label></td>
						</tr>
						<tr>
							<td colspan="3" style="font-weight:bold;">Differntial WBC Count</td>
						</tr>
						<tr>
							<td><label>Neutrofills</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->neutrophills;?></label></td>
                            <td><label>40-70%</label></td>
						</tr>
						<tr>
							<td><label>Lymocytes</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->lymphocytes;?></label></td>
                            <td><label>40-70%</label></td>
						</tr>
						<tr>
							<td><label>Eosinophills</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->eosinophills;?></label></td>
                            <td><label>1-6%</label></td>
						</tr>
						<tr>
							<td><label>Monocytes</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->monocytes;?></label></td>
                            <td><label>2-10%</label></td>
						</tr>
						<tr>
							<td><label>Basophils</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->basophills;?></label></td>
                            <td><label></label></td>
						</tr>
						<tr>
							<td colspan="3" style="background-color:#ffe6e6 !important;"></td>
							
						</tr>
						<tr>
							<td><label>Premature W.B.C</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->premature;?></label></td>
                            <td><label></label></td>
						</tr>
						<tr>
							<td><label>Blast</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->blasts;?></label></td>
                            <td><label></label></td>
						</tr>
						<tr>
							<td><label>Normoblast</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->normoblasts;?></label></td>
                            <td><label></label></td>
						</tr>
						<tr>
							<td colspan="3" style="background-color:#ffe6e6 !important;"></td>
							
						</tr>
						<tr>
							<td><label>Haemoglobin</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->haemoglobin;?></label></td>
                            <td><label>11.5-15.5 g/dl</label></td>
						</tr>
						<tr>
							<td><label>Red Cells</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->redcells;?></label></td>
                            <td><label>3.8-5.2 10^12/1</label></td>
						</tr>
						<tr>
							<td><label>P.C.V</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->pcv;?></label></td>
                            <td><label>35-47 %</label></td>
						</tr>
						<tr>
							<td><label>M.C.V</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->mcv;?></label></td>
                            <td><label>80-100 ml</label></td>
						</tr>
						<tr>
							<td><label>M.C.H</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->mch;?></label></td>
                            <td><label>27-34 pg</label></td>
						</tr>
						<tr>
							<td><label>M.C.H.C</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->mchc;?></label></td>
                            <td><label>30-35 g/dl</label></td>
						</tr>
						<tr>
							<td colspan="3" style="background-color:#ffe6e6 !important;"></td>
							
						</tr>
						<tr>
							<td><label>E.S.R</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->esr;?></label></td>
                            <td><label>0-20 mm Ist Hr</label></td>
						</tr>
						<tr>
							<td><label>Platelets</label></td>
                            <td colspan=""><label></label><label ><?php echo $row->platelets;?></label></td>
                            <td><label>150,000-400,000 10^9/l</label></td>
						</tr>
						<tr>
							<td><label style="font-weight:bold !important;"><u>Malarial Parasite</u></label></td>
                            <td colspan=""><label></label><label >--  </label></td>
                            <td><label></label></td>
						</tr>
						<tr>
							<td><label >Morphology of R.B.C :</label></td>
                            <td colspan=""><label><?php echo $row->morphology;?></label></td>
                            <td><label></label></td>
						</tr>
						
						<tr style="border-style:solid;border-bottom:3px;">
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

			</div>
			<?php endforeach; } ?>

		<div class="mainfooter">
			<p>Blood For Transfusion Should Be Ensured Negative For MP. HIV, HBsAg, HCV & VDRL.</p>
		</div>
	</div>


	</body>


</html>