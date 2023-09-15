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

$sql = "delete from room WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="Data Deleted successfully";
}

if(isset($_REQUEST['unconfirm']))
	{
	$aeid=intval($_GET['unconfirm']);
	$memstatus=1;
	$sql = "UPDATE tenants SET status=:status WHERE  id=:aeid";
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
	<link rel="stylesheet" href="styletenant.css">
	
	<title>Manage Rooms</title>

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
		margin-right: 20px;
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

						<h2 class="page-title">Manage Rooms</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">List of Rooms</div>
							<div class="panel-body">
							<div class="container">
								<div class="d"></div>
								<div class="con">
									<!-- <iframe src="../View_tenant.php" frameborder="0" style="width: 100%; hieght: 100%;"></iframe> -->
								
        							<a href="room.php" class="Btn_add"> Add Room</a>

									<table>
										<tr id="items">
											<th>No</th>
											<th>Room name</th>
											<th>Room type</th>
											<th>Room price</th>
											<th>Action</th>
											</tr>
											<?php $sql = "SELECT * from  room ";
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
															<td><?php echo htmlentities($result->room_name);?></td>
															<td><?php echo htmlentities($result->room_type);?></td>
															<td><?php echo htmlentities($result->room_price);?></td>
															
															<?php 
															
															
															echo'<td><a href="roomlist.php?del=';?><?php echo $result->id;?>&name=<?php echo htmlentities($result->room_name);?>" onclick="return confirm('Do you want to Delete');"><button class="Btn_danger" style="width: fit-content; margin-bottom: 0; background-color: rgb(238, 31, 31);
																padding: 5px 10px; color: #fff; display: flex; align-items: center; text-align: 0;	border-radius: 6px;	text-decoration: none; border: none; margin-top: 10px;"> Delete</button></a>&nbsp;&nbsp;</td><?php $cnt=$cnt+1;
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
