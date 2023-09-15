<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	if(isset($_GET['del']) && isset($_GET['name']))
	{
	$id=$_GET['del'];
	$name=$_GET['name'];
	
	$sql = "delete from tenants WHERE tenant_id=:tenant_id";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':tenant_id',$id, PDO::PARAM_STR);
	$query -> execute();
	$msg="Data Deleted successfully";
	}

$sql2 = "insert into deletetenant (email) values (:name)";
$query2 = $dbh->prepare($sql2);
$query2 -> bindParam(':name',$name, PDO::PARAM_STR);
$query2 -> execute();

$msg="Data Deleted successfully";
}

if(isset($_REQUEST['unconfirm']))
	{
	$aeid=intval($_GET['unconfirm']);
	$memstatus=1;
	$sql = "UPDATE tenants SET status=:status WHERE  tenant_id=:aeid";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':status',$memstatus, PDO::PARAM_STR);
	$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
	$query -> execute();
	$msg="Changes Sucessfully";
	}

	if(isset($_REQUEST['confirm']))
	{
	$aeid=intval($_GET['confirm']);
	$memstatus=0;
	$sql = "UPDATE tenants SET status=:status WHERE  id=:aeid";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':status',$memstatus, PDO::PARAM_STR);
	$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
	$query -> execute();
	$msg="Changes Sucessfully";
	}

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
	*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body{
    align-items: center;
    justify-content: center;
}
.Btn_danger{
	width: fit-content; 
	margin-bottom: 20px; 
	margin-top: 15px;
	background-color: rgb(238, 31, 31);
	padding: 5px 10px; 
	color: #fff; 
	display: flex; 
	align-items: center; 
	text-align: 0;	
	border-radius: 6px;	
	text-decoration: none; 
	border: none;
}
.Btn_add{
    width: fit-content;
    margin-bottom: 20px;
	margin-top: 15px;
    background-color:  rgb(41, 40, 40);
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
	#popup{
		position: fixed;
		top: 40%;
		left: 50%;
		transform: translate(-50%,-50%);
		width: 600px;
		padding: 50px;
		box-shadow: 50px;
		box-shadow: 0 5px 30px rgba(0,0,0,0.30);
		background: #fff;
		visibility: hidden;
		opacity: 0;
		transition: 0.5s;

	}
	#popup.active{
		top: 50%;
		visibility: visible;
		opacity: 1;
		transition: 0.5s;
	}
	.btn-box{
		display: flex;
	}
	.btn-box a{
		margin-right: 10px;
	}

</style>

</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content" id="blur">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Manage Tenants</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">List Tenants</div>
							<div class="panel-body">
							<div class="container">
								<div class="d"></div>
								<div class="con">
									<!-- <iframe src="../View_tenant.php" frameborder="0" style="width: 100%; hieght: 100%;"></iframe> -->
								
        							<a href="register_tenant.php" class="Btn_add"> Add Tenant</a>

									<table>
										<tr id="items">
											<th>No</th>
											<th>Name</th>
											<th>Email</th>
											<th>Roomname</th>
											<th>Roomtype</th>
											<th>Phone</th>
											<th> &nbsp;Action</th>
											<th></th>
											</tr>
											<?php $sql = "SELECT * from  tenants WHERE status= 1";
												$query = $dbh -> prepare($sql);
												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												$cnt=1;
												if($query->rowCount() > 0){
													foreach($results as $result){
														$id = $results['id'];
														?>	
														<tr>
															<td><?php echo htmlentities($cnt);?></td>
															<td><?php echo htmlentities($result->name);?></td>
															<td><?php echo htmlentities($result->email);?></td>
															<td><?php echo htmlentities($result->roomname);?></td>
															<td><?php echo htmlentities($result->roomtype);?></td>
															<td><?php echo htmlentities($result->mobile);?></td>
															
															<?php

															if($result->roomtype == Modern){
																echo'<td><a href="modern_bill.php?tenant_id=';?><?php echo $result->tenant_id;?><?php echo'" class="Btn_add"> Bill</a></td>';
																echo'<td><a href="userlist.php?del=';?><?php echo $result->tenant_id;?>&name=<?php echo htmlentities($result->email);?>" onclick="return confirm('Do you want to Delete');"><button class="Btn_danger" style="width: fit-content; margin-bottom: 0; background-color: rgb(238, 31, 31);
																padding: 5px 10px; color: #fff; display: flex; align-items: center; text-align: 0;	border-radius: 6px;	text-decoration: none; border: none;"> Delete</button></a>&nbsp;&nbsp;</td><?php $cnt=$cnt+1;
															}else{
																echo'<td><a href="simple_bill.php?tenant_id=';?><?php echo $result->tenant_id;?><?php echo'" class="Btn_add"> Bill</a></td>';
																echo'<td><a href="userlist.php?del=';?><?php echo $result->tenant_id;?>&name=<?php echo htmlentities($result->email);?>" onclick="return confirm('Do you want to Delete');"><button class="Btn_danger" style="width: fit-content; margin-bottom: 0; background-color: rgb(238, 31, 31);
																padding: 5px 10px; color: #fff; display: flex; align-items: center; text-align: 0;	border-radius: 6px;	text-decoration: none; border: none;"> Delete</button></a>&nbsp;&nbsp;</td><?php $cnt=$cnt+1;
															}
															?>
																							
														<?php if($result->status == 1)
														{?>
															
															<?php } else {?>																
															<?php } ?>																			
														
														</tr>
														<?php $cnt=$cnt+1; }} ?>
												
													
													
													<?php
											
											?>
											
										</table>
								</div>
								<div class="c"></div>
								
    
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
			<form method="post" enctype="multipart/form-data" autocomplete="off">
			<a href="#">
				<button class="Btn_danger" type="submit" name="del" style="width: fit-content; margin-bottom: 20px; background-color: rgb(238, 31, 31);
				padding: 5px 20px; color: #fff; display: flex; align-items: center; text-align: 0;	border-radius: 6px;	text-decoration: none; border: none;"> Yes</button>
			</a>
			</form>			
			<a href="#" onclick="toggle()">
				<button class="Btn_danger" style="width: fit-content; margin-bottom: 20px; background-color: blue;
				padding: 5px 20px; color: #fff; display: flex; align-items: center; text-align: 0;	border-radius: 6px;	text-decoration: none; border: none;"> No</button>
			</a>
			<?php
				if(isset($_POST["del"])){
					$sql= msqli_query($dbh, "UPDATE tenants SET status = 0 WHERE id=$id;");
					echo"<script> alert('Tenant deleted');</script>";
				}			
			?>
			
			
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
<?php  ?>
