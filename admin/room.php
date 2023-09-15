<?php
include('includes/config.php');
if(isset($_POST['submit']))
{
$roomname=$_POST['room_name'];
$roomtype=$_POST['room_type'];
$roomprice=$_POST['room_price'];

// $notitype='Create Account';
// $reciver='Admin';

// $sqlnoti="insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
// $querynoti = $dbh->prepare($sqlnoti);
// $querynoti-> bindParam(':notiuser', $sender, PDO::PARAM_STR);
// $querynoti-> bindParam(':notireciver',$reciver, PDO::PARAM_STR);
// $querynoti-> bindParam(':notitype', $notitype, PDO::PARAM_STR);
// $querynoti->execute();    
    
$sql ="INSERT INTO room (room_name, room_type, room_price, status) VALUES( :roomname,  :roomtype, :roomprice, 1)";
$query= $dbh -> prepare($sql);
$query-> bindParam(':roomname', $roomname, PDO::PARAM_STR);
$query-> bindParam(':roomtype', $roomtype, PDO::PARAM_STR);
$query-> bindParam(':roomprice', $roomprice, PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script type='text/javascript'>alert('Registration Sucessfull!');</script>";
echo "<script type='text/javascript'> document.location = 'roomlist.php'; </script>";
}
else 
{
$error="Something went wrong. Please try again";
}

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

	
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php include('includes/header.php');?>

<div class="ts-main-content" id="blur">
	<?php include('includes/leftbar.php');?>
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">

	<div class="login-page bk-img">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-12" style=" display: center;">
						<h1 class="text-center text-bold mt-2x">Register Room</h1>
                        <div class="hr-dashed"></div>
						<div class="well row pt-2x pb-3x bk-light text-center">
                         <form method="post" action="" class="form-horizontal" enctype="multipart/form-data" name="regform">
                            <div class="form-group">
                            <label class="col-sm-1 control-label">Room Name<span style="color:red">*</span></label>
                            <div class="col-sm-5">
                            <input type="text" name="room_name" class="form-control" required>
                            </div>
                            <label class="col-sm-1 control-label">Room type<span style="color:red">*</span></label>
                            <div class="col-sm-5">
                            <input type="text" name="room_type" class="form-control" required>
                            </div>
                            </div>
                            <label class="col-sm-1 control-label">Room price<span style="color:red">*</span></label>
                            <div class="col-sm-5">
                            <input type="text" name="room_price" class="form-control" required>
                            </div>

								<br>
                                <button class="btn btn-primary" name="submit" type="submit">Register</button>
                                </form>
                                <br>
                               
							</div>
						</div>
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

</body>
</html>