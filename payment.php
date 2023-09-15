<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index_tenant.php');
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
	<link rel="stylesheet" href="styletenant1.css">
	
	<title>BILL</title>

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
	*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body{
    align-items: center;
    justify-content: center;
	min-width: 100vh;
}
.Btn_add{
    width: fit-content;
    margin-bottom: 20px;
	margin-top: 15px;
    background-color:  rgb(11, 141, 228);
    padding: 5px 20px;
    color: #fff;
    display: flex;
    align-items: center;
    text-align: 0;
    border-radius: 6px;
    text-decoration: 0;
}
table{
    color: rgb(41, 40, 40);
}
th{
    font-size: 16px;
    border-bottom: 3px solid rgb(41, 40, 40);
    padding: 5px 20px;
    font-weight: 500;
}
td{
    font-weight: 400;
    padding: 5px 30px;
    font-size: 14px;
}
tr:nth-child(2n){
    background-color: #f6f8f8;
}
tr:nth-child(2n) td{
    border-bottom: 1px solid #e0e0e0;
    border-top: 1px solid #e0e0e0;
}

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

		</style>

</head>

<body>
	<?php include('includes/header_tenant.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar_tenant.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">MODE OF PAYMENT</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
						<div class="panel-heading">Mobile Payment</div>
						
							<div class="panel-body">
							<div class="container">
								<div class="d"></div>
								<div class="con" style="overflow-x: auto; dispaly: inline-block;">
									<div class="OM"><img src="OM.jpeg" alt="" style="margin-bottom: 10px; height: 50px; width: 50px; border-radius: 5px; dispaly: inline-block;"><b> &nbsp; &nbsp;692627868</b></div>
                                    <div class="MOMO"><img src="MOMO.jpeg" alt="" style="margin-bottom: 10px; height: 50px; width: 50px; border-radius: 5px; dispaly: inline-block;"><b> &nbsp; &nbsp;681960949</b></div>
								</div>
                                <div class="warn"><img src="Warn.jpeg" alt="" style="margin-bottom: 10px; height: 150px; width: 150px; border-radius: 5px;"><P><b>AFTER MAKING THE PAYMENT MAKE A SCREENSHOT OF THE MASSAGE WITH THE UNIQUE ID AND THE AMOUNT AND SEND IT TO THE ADMIN AT THE<br> LEVEL OF THE FEEDBACK TO PROVE THAT YOU ARE THE ONE WHO PAID.</b></P></div>
								<div class="c"></div>
								
    
							</div>
						</div>
					</div>
				</div>
						



							
					</div>
				</div>

			</div>
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
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});
		</script>
</body>
</html>
<?php } ?>
