<!DOCTYPE html>
<html>


	<head>
	<title>Department of Biochemistry</title>
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
	margin-top:20px!important;
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
                <table class="table" style="background-color:#FBFCFC;" >
                	<?php if($biochemistry_data->num_rows()>0){?>
                	<?php foreach($biochemistry_data->result() as $value):?>
                		
                
                	<tbody>
                		<tr>
                			
                			<td><label>Name :</label><label style = "margin-left:2%;"><?php echo $value->patient_name;?></label></td>
                			<td><label>Age :</label><label style = "margin-left:2%;"><?php echo $value->age;?></label></td>
                			<td><label>Sex :</label><label style = "margin-left:2%;"><?php echo $value->sex;?></label></td>
                		    </tr>
                		    <tr>
                			<td><label>Invoice No  :</label><label style = "margin-left:2%;"><?php echo $value->invoice_no;?></label></td>
                			<td><label>Phone # :</label><label style = "margin-left:2%;"><?php echo $value->phone;?></label></td>
                			<td><label>Mobile # :</label><label style = "margin-left:2%;">mobile_no</label></td>
                		    </tr>
                		    <tr>
                			<td><label>Cons. phy / Clinic :</label><label style = "margin-left:20px;"><?php echo $value->doc_name;?></label></td>
                			<td colspan="2"><label>Specimen Collection Date :</label><label style = "margin-left:20px;"><?php echo $value->report_date;?></label></td>
                			
                		    </tr>
                		
                	</tbody>
                </table>
				
			</div>

			<div class="contain">
				<div class="heading" style="width:100%;font-size:20px;margin-top:0px;"><center>Department Of Biochemistry</center></div>
				<table class="table">
					
						<thead>
							<tr>
								<th colspan=""><label>Test</label></th>
								<th><label>Result</label></th>
								<th colspan=""><label>Reference Intervel</label></th>
							</tr>
						</thead>
						<tbody>
						
						<tr style="height:100px !important;">
							<td><label>Glucose (Random)</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->glucose;?></label></td>
                            <td><label>80-140 mg/dl</label></td>
						</tr>
						<tr>
							<td colspan="3"><label><u>140-199 =impaid Glucose Tolerance</u></label></td>
						</tr>
						<tr style="height:100px !important;">
                            <td colspan="3"><label><u>200$ above = Diabetes</u></label><label ></label></td>
                            
						</tr>
						<tr >
							<td><label>Calcium</label></td>
                            <td colspan=""><label></label><label ><?php echo $value->calcium;?></label></td>
                            <td><label>Adult : 8.6-10.5 mg/dl </label></td>
						</tr>
						<tr >
                            <td colspan="3"><label style="padding-left:550px !important;">10 Days -2 Year :9.0-11.0 mg/dl</label><label ></label></td>
                            
						</tr>
						<tr >
                            <td colspan="3"><label style="padding-left:550px !important;">2 years - 12 year : 8.8-10.8 mg/dl</label><label ></label></td>
                            
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
					<?php endforeach;  }?>
				</table>
                 	
			</div>

		<div class="mainfooter">
			<p>Blood For Transfusion Should Be Ensured Negative For MP. HIV, HBsAg, HCV & VDRL.</p>
		</div>
	</div>


	</body>


</html>