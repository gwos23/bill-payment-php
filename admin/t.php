<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{


 ?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<link rel="stylesheet" href="styletenant.css">
	
	<title>Manage Tenant</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
	
  <style>

	.errorWrap {
		padding: 10px;
		margin: 0 0 20px 0;
		background: #dd3d36;
		color:#fff;
		-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
	}
	.succWrap{
		padding: 10px;
		margin: 0 0 20px 0;
		background: #5cb85c;
		color:#fff;
		-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
	}
	

	#t h1{
    text-decoration: underline;
	}
	#t h4{
		text-decoration: underline;
	}
	#t .rent b label{
		text-decoration: underline;
	}
	#t b{
		text-decoration: underline;
	}

</style>

</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content" id="blur">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row" id="t">
					<div class="col-md-12">

						<h2 class="page-title">Manage Tenants</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">List Tenants</div>
							<div class="panel-body">
							<div class="container">
							<div class="e"></div>
								<div class="row">
									<div class="col-md-3"></div>
									<div class="col-md-6"> 
										<h1>Bill calculation</h1>
										
										<form method="post" action="">
											<div class="form-grop">
												<label for="Newindex">New index (KW)</label><br>
												<input type="number" class="form-control" id="Newindex" placeholder="111" name="Newindex" require>
												
											</div>
											<div class="form-grop">
												<label for="Oldindex">old index (KW)</label><br>
												<input type="number" class="form-control" id="Oldindex" placeholder="111" name="Oldindex" require>
												
											</div>
											<div class="form-grop">
												<label for="Oldindex">Price per Killowatt (FCFA)</label><br>
												<input type="number" class="form-control" id="klw" placeholder="111" name="KW" require>
												
											</div>
											<div class="rent">
												<b><label for="Rentbill">Rent Bill = 12000 FCFA</label></b>
											</div>

											<button type="submit" class="btn-primary" name="btn" style="width: fit-content;
															margin-bottom: 20px;
															margin-top: 10px;
															background-color: rgba(41, 40, 40);
															padding: 5px 20px;
															color: #fff;
															display: flex;
															align-items: center;
															text-align: 0;
															border-radius: 6px;
															text-decoration: 0;
														">Difference</button>

										</form>

										<?php
											if(isset($_POST["btn"]))
											{
												$Newindex = $_POST['Newindex'];
												$Oldindex = $_POST['Oldindex'];
												$total= 0;
												echo "<h4><b>Difference</h4></b>";
												if($Newindex>0)
												{
													$u = $Newindex - $Oldindex;

													echo "Killowatt = $Newindex KW - $Oldindex KW = $u KW";

												}

												$klw = $_POST['KW'];
												// $total=0;
												echo "<h4><b>Bill Details</b></h4>";
												if($klw>100)
												{
													echo "The price per klw most not exceed 100 FCFA";

												}
												
												else{
													$u1 = $u * $klw;
													echo "$u * $klw = $u1<br>";

													echo "<br><b>Electrical Bill = $u1</b><br>";
														
													$rentbill= 12000;

													$total2= $rentbill + $u1;
													echo "<h4><b>TOTAL TO PAY = $total2 FCFA</b></h4>";

													echo "<h4><b>TO PAY BEFORE</b></h4>
														<form action='' method='POST' enctype='multipart/form-data' autocomplete='off'>
															<div class='form-grop'>
												
																<input type='date' class='form-control' name='to_pay_before'>
												
															</div>
															<button type='submit' class='btn btn-primary' name='submit' style='width: fit-content;
															margin-bottom: 20px;
															margin-top: 10px;
															background-color: rgba(41, 40, 40);
															padding: 5px 20px;
															color: #fff;
															display: flex;
															align-items: center;
															text-align: 0;
															border-radius: 6px;
															text-decoration: 0;
														'>Send</button>
														</form> 
														
													";
													
													// $to_pay_before = $_POST['to_pay_before'];
													if(isset($_POST["submit"])){
														// $sql = "INSERT INTO bill (Newindex, Oldindex, KW, klw, rentbill, total_to_pay, to_pay_before) 
														// VALUES ('$Newindex', '$Oldindex', '$klw', '$u1', '$rentbill', '$total2', '$to_pay_before')";
														// // mysqli_query($dbh, $query);
														// $query= $dbh -> prepare($sql);

														// $sql ="INSERT INTO users(name,email, password, gender, mobile, designation, image, status) VALUES(:name, :email, :password, :gender, :mobileno, :designation, :image, 1)";
														$sql = "INSERT INTO bill (Newindex, Oldindex, KW, klw, rentbill, total_to_pay, to_pay_before) VALUES (:Newindex, :Oldindex, :KW, :klw, :rentbill, :total_to_pay, :to_pay_before)";
															$query= $dbh -> prepare($sql);
															$query-> bindParam(':Newindex', $Newindex, PDO::PARAM_STR);
															$query-> bindParam(':Oldindex', $$Oldindex, PDO::PARAM_STR);
															$query-> bindParam(':KW', $klw, PDO::PARAM_STR);
															$query-> bindParam(':klw', $u1, PDO::PARAM_STR);
															$query-> bindParam(':rentbill', $rentbill, PDO::PARAM_STR);
															$query-> bindParam(':total_to_pay', $total2, PDO::PARAM_STR);
															$query-> bindParam(':to_pay_before', $to_pay_before, PDO::PARAM_STR);
															$query->execute();

															$lastInsertId = $dbh->lastInsertId();
														if($lastInsertId)
														{
															echo "<script type='text/javascript'>alert('Registration Sucessfull!');</script>";

														}
														else 
														{
															$error="Something went wrong. Please try again";
														}

													}

													
												}
												
											}
											

											
										
										?>


									</div>
									
								</div>
								<div class="t"></div>
								
    
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div id="popup">
		<h2>Are you sure?!</h2>
		<div class="btn-box">
			<a href="#">
				<button class="Btn_danger" style="width: fit-content; margin-bottom: 20px; background-color: rgb(238, 31, 31);
				padding: 5px 20px; color: #fff; display: flex; align-items: center; text-align: 0;	border-radius: 6px;	text-decoration: none; border: none;"> Yes</button>
			</a>
			<a href="#" onclick="toggle()">
				<button class="Btn_danger" style="width: fit-content; margin-bottom: 20px; background-color: blue;
				padding: 5px 20px; color: #fff; display: flex; align-items: center; text-align: 0;	border-radius: 6px;	text-decoration: none; border: none;"> No</button>
			</a>
			
			
		</div>
		
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script type="text/javascript">
		function toggle(){
			var blur = document.getElementById('blur');
			blur.classList.toggle('active');
			var popup = document.getElementById('popup');
			popup.classList.toggle('active');
		}
	</script>
	<script type="text/javascript">
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});
		</script>
		
</body>
</html>
<?php } ?>
