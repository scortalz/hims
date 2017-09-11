<!DOCTYPE html>
<html>


	<head>
	<title>Department of Heamatology</title>
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
	margin-top: 5px;
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
	height: 120px;
}

.logo-name{
	width:79%;
	
	float: left;
}

.batool{

	font-size:26px;
}

.logo-name h1{
	font-size:30px;
	color: red;
	margin-top: 20px;
	margin-bottom: 0px;
	font-family: sans-serif;

}

.logo-name p{
	font-size:18px;
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

.contain .heading{
	padding: 5px 0px;
	font-family: sans-serif;
	font-size:18px;
	color:#151515;
	text-align: center;
	float:left;
	width: 100%;
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
	font-size: 13px;
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
}

.mainfooter p{
	font-size:12px;
	color:#fdfdfd;
	letter-spacing: 1px;
	font-family: sans-serif;
	padding: 10px 30px;
	text-align: center;
}
	</style>
	</head>

	<body>
		
		<div class="wrapper">
			<div class="header">
				<div class="logo-header">
					<div class="logo">
						<img src="BHI-logo.png" />
					</div>
					<div class="logo-name">
						<h1>B<span class="batool">ATOOL </span>G<span class="batool">ENERAL </span>H<span class="batool">OSPITAL </span>& D<span class="batool">IAGNOSTIC </span>C<span class="batool">ENTRE</span></h1>
						<hr color="red" class="line">
						<hr color="blue" class="line">
						<p>
						A-197, BLOCK 5, GULISTAN-E-JAUHAR, KARACHI. PH : 34013732 - 34618249
						</p>
					</div>
				</div>

				<div class="info-header">
					<div class="name">

						<div class="dep">
							<p><b>Name</b> :</p>
							<p><b>Department no</b> : </p>
							<p>Cons. <b>Phy / Clinic</b> : </p>
						</div>
						<div class="dep2">
							<input type="text" name="name" />
							<input type="number" name="dno" />	
							<input type="number" name="dno" />	
						</div>
					</div>

					<div class="age">
						<div class="dep">
							<p><b>Age</b> :</p>
							<p><b>Phone#</b> : </p>
							<p><b>Specimen Collection Date</b> : </p>
						</div>
						<div class="dep2">
							<input type="text" name="name" />
							<input type="number" name="dno" />	
							<input type="number" name="dno" />	
						</div>
					</div>

					<div class="mob">
						<div class="mob1">
							<p><b>Gender</b> :</p>
							<p><b>Mob#</b> : </p>
							
						</div>
						<div class="mob2">
							<input type="text" name="name" />
							<input type="number" name="dno" />	
							
						</div>
					</div>

				</div>

			</div>

			<div class="contain">
				<div class="heading"><p >Department Of Heamatology</p></div>
				<div class="test">
					<div class="test1">
						&nbspTest
					</div>
					<div class="result">
						Result
					</div>
					<div class="ref">
						Reference Interval&nbsp
					</div>
				</div>

				<div class="maintest">
					<div class="testlist">
						<h5>Leucocytes Total</h5>
					</div>

					<div class="resultlist">
						<p>8,100</p>
					</div>

					<div class="reflist">
						<p>4,000 - 11,000 / cu.mm</p>
					</div>
				</div>


				<div class="maintest">
				
					<div class="testlist">
					<h5>Differential WBC Count</h5>
						<p>Neutrophils</p>
						<p>Lymphocytes</p>
						<p>Eosinophils</p>
						<p>Monocytes</p>
						<p>Basophils</p>
					</div>

					<div class="resultlist">
						<p>--</p>	
						<p>60</p>
						<p>36</p>
						<p>02</p>
						<p>02</p>
						<p>00</p>
					</div>

					<div class="reflist">
					
						<p>40 - 70 %</p>
						<p>20 - 40 %</p>
						<p>1 - 6 %</p>
						<p>2 - 10 %</p>
					</div>
				</div>

				<div class="maintest">
				
					<div class="testlist">
					<h5>Premature W.B.C</h5>
					<p>Blasts</p>
					<p>Normoblasts</p>
					</div>

					<div class="resultlist">
						
						<p>Nil</p>
						<p>Nil</p>
						<p>Nil</p>
						
					</div>

					<div class="reflist">
					
						<p>40 - 70 %</p>
						<p>20 - 40 %</p>
						<p>1 - 6 %</p>
						<p>2 - 10 %</p>
					</div>
				</div>

				<div class="maintest">
				
					<div class="testlist">
					<h5>Haemoglobin</h5>
					<p>Red Cells</p>
					<p>P.C.V</p>
					<p>M.C.V</p>
					<p>M.C.H</p>
					<p>M.C.H.C</p>
					</div>

					<div class="resultlist">
						
						<p>11.0</p>
						<p>3.9</p>
						<p>34.0</p>
						<p>85.0</p>
						<p>28.6</p>
						<p>32.0</p>
						
					</div>

					<div class="reflist">
					
						<p>11.5 - 15.5 g/dl</p>
						<p>3.8 - 5.2 10^12/l</p>
						<p>35 - 47 %</p>
						<p>80 - 100 fl</p>
						<p>27-34 pg</p>
						<p>30 - 35 g/dl</p>
					</div>
				</div>

				<div class="maintest">
				
					<div class="testlist">
					<h5>E.S.R</h5>
					</div>

					<div class="resultlist">
						<p>--</p>
						
					</div>

					<div class="reflist">
					
						<p>0 - 20 mm 1st Hr</p>
						
					</div>
				</div>


				<div class="maintest">
				
					<div class="testlist">
						<h5>Platelets</h5>
					</div>

					<div class="resultlist">
						<p>199,000</p>
						
					</div>

					<div class="reflist">
					
						<p>150,000 - 400,000 10^9/l</p>
						
					</div>
				</div>


				<div class="maintest">
				
					<div class="testlist">
						<h5>Malarial Parasite</h5>
					</div>

					<div class="resultlist">
						<p>--</p>
						
					</div>

					<div class="reflist">
					
						<p>--</p>
						
					</div>
				</div>



				<div class="maintest">
				
					<div class="testlist">
						<h5>Morphology Of R.B.C</h5>
					</div>

					<div class="resultlist">
						<p>Normocytic, Normochromic</p>
						
					</div>

					<div class="reflist">
					
						<p>--</p>
						
					</div>
				</div>
				<hr color="blue">



				


			</div>


		<div class="footer">
			<div class="remarks">
				Remarks : 
			</div>
			<div class="remarkscol">
			
				<div class="path">
					<div class="blankpath">
						--
					</div>
					<div class="pathologist">
						Pathologist
					</div>
				</div>
			</div>

		</div>
			

		<div class="mainfooter">
			<p>Blood For Transfusion Should Be Ensured Negative For MP. HIV, HBsAg, HCV & VDRL.</p>
		</div>
	</div>


	</body>


</html>