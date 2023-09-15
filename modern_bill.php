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

$sql = "delete from users WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();

$sql2 = "insert into deleteduser (email) values (:name)";
$query2 = $dbh->prepare($sql2);
$query2 -> bindParam(':name',$name, PDO::PARAM_STR);
$query2 -> execute();

$msg="Data Deleted successfully";
}

if(isset($_REQUEST['unconfirm']))
	{
	$aeid=intval($_GET['unconfirm']);
	$memstatus=1;
	$sql = "UPDATE users SET status=:status WHERE  id=:aeid";
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
	$sql = "UPDATE users SET status=:status WHERE  id=:aeid";
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
	<link rel="stylesheet" href="../bill.css">
	
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

		</style>

</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
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
								<div class="con">
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
                    <b><label for="Rentbill">Rent Bill = 20000 FCFA</label></b>
                </div>

                <button type="submit" class="btn-primary" name="btn">Difference </button>

            </form>

            <?php
                if(isset($_POST["btn"]))
                {
                    $Newindex = $_POST['Newindex'];
                    $Oldindex = $_POST['Oldindex'];
                    $total= 0;
                    echo "<h4>Difference</h4>";
                    if($Newindex>0)
                    {
                        $u = $Newindex - $Oldindex;

                        echo "Killowatt = $Newindex KW - $Oldindex KW = $u KW";

                    }

                    $klw = $_POST['KW'];
                    // $total=0;
                    echo "<h4>Bill Details</h4>";
                    if($klw>100)
                    {
                        echo "The price per klw most not exceed 100 FCFA";

                    }
                    
                    else{
                        $u1 = $u * $klw;
                        echo "$u * $klw = $u1<br>";

                        echo "<br><b>Electrical Bill = $u1<br></b>";
                            
                        $rentbill= 12000;

                        $total2= $rentbill + $u1;
                        echo "<h4>TOTAL TO PAY = $total2 FCFA</h4>";

                        echo "<h4>TO PAY BEFORE</h4>
                            <form action='' method='POST' enctype='multipart/form-data' autocomplete='off'>
                                <div class='form-grop'>
                    
                                    <input type='date' class='form-control' name='to_pay_before'>
                    
                                </div>
                                <button type='submit' class='btn btn-primary' name='submit'>Send</button>
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
