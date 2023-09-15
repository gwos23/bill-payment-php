<?php
include('includes/config.php');
if(isset($_POST['submit']))
{

$name=$_POST['name'];
$roomname=$_POST['roomname'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$gender=$_POST['gender'];
$mobileno=$_POST['mobileno'];
$roomtype=$_POST['roomtype'];


$notitype='Create Account';
$reciver='Admin';
$sender=$email;

$sqlnoti="insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
$querynoti = $dbh->prepare($sqlnoti);
$querynoti-> bindParam(':notiuser', $sender, PDO::PARAM_STR);
$querynoti-> bindParam(':notireciver',$reciver, PDO::PARAM_STR);
$querynoti-> bindParam(':notitype', $notitype, PDO::PARAM_STR);
$querynoti->execute();    
    
$sql ="INSERT INTO tenants(name,roomname,email, password, gender, mobile, roomtype, status) VALUES(:name, :roomname, :email, :password, :gender, :mobileno, :roomtype, 1)";
$query= $dbh -> prepare($sql);
$query-> bindParam(':name', $name, PDO::PARAM_STR);
$query-> bindParam(':roomname', $roomname, PDO::PARAM_STR);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> bindParam(':gender', $gender, PDO::PARAM_STR);
$query-> bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
$query-> bindParam(':roomtype', $roomtype, PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script type='text/javascript'>alert('Registration tenant Sucessfull!');</script>";
echo "<script type='text/javascript'> document.location = 'userlist.php'; </script>";
}
else 
{
$error="Something went wrong. Please try again";
}

}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
    <script type="text/javascript">

	function validate()
        {
            var extensions = new Array("jpg","jpeg");
            var image_file = document.regform.image.value;
            var image_length = document.regform.image.value.length;
            var pos = image_file.lastIndexOf('.') + 1;
            var ext = image_file.substring(pos, image_length);
            var final_ext = ext.toLowerCase();
            for (i = 0; i < extensions.length; i++)
            {
                if(extensions[i] == final_ext)
                {
                return true;
                
                }
            }
            alert("Image Extension Not Valid (Use Jpg,jpeg)");
            return false;
        }
        
</script>
</head>

<body>
<?php include('includes/header.php');?>
	<!-- <div class="login-page bk-img" style="margin-top: 19px;">
    <div class="ts-main-content"> -->

		<!-- <div class="form-content" style="margin-left: 200px;"> -->
        
    <div class="ts-main-content" id="blur">
	    <?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
                    <div class="container">
				
                <h1 class="text-center text-bold mt-2x">Register</h1>
                <div class="well row pt-2x pb-3x bk-light text-center">
                 <form method="post" class="form-horizontal" enctype="multipart/form-data" name="regform" onSubmit="return validate();">
                    <div class="form-group">
                    <label class="col-sm-1 control-label">Name<span style="color:red">*</span></label>
                    <div class="col-sm-5">
                    <input type="text" name="name" class="form-control" required>
                    </div>
                    <label class="col-sm-1 control-label">Email<span style="color:red">*</span></label>
                    <div class="col-sm-5">
                    <input type="text" name="email" class="form-control" required>
                    </div>
                    </div>

                    <label class="col-sm-1 control-label">Room Name<span style="color:red">*</span></label>
                    <div class="col-sm-5">
                    <input type="text" name="roomname" class="form-control" required>
                    </div> <br>

                    <div class="form-group">
                    <label class="col-sm-1 control-label">Password<span style="color:red">*</span></label>
                    <div class="col-sm-5">
                    <input type="password" name="password" class="form-control" id="password" required >
                    </div>

                    <label class="col-sm-1 control-label">roomtype<span style="color:red">*</span></label>
                    <div class="col-sm-5">
                    <select name="roomtype" class="form-control" required>
                    <option value="">Select</option>
                    <option value="Modern">Modern</option>
                    <option value="Simple">Simple</option>
                    </select>
                    <!-- <input type="text" name="roomtype" class="form-control" required> -->
                    </div>
                    </div>

                     <div class="form-group">
                    <label class="col-sm-1 control-label">Gender<span style="color:red">*</span></label>
                    <div class="col-sm-5">
                    <select name="gender" class="form-control" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    </select>
                    </div>

                    <label class="col-sm-1 control-label">Phone<span style="color:red">*</span></label>
                    <div class="col-sm-5">
                    <input type="number" name="mobileno" class="form-control" required>
                    </div>
                    </div>

                     

                        <br>
                        <button class="btn btn-primary" name="submit" type="submit">Register</button>
                        </form>
                        <br>
                        <br>
                        
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