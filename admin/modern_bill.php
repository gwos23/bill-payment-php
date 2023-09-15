<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
class Bill{
	function get_bill($id)
	{
		$DB = new Database();
		$query = "SELECT * FROM tenants WHERE tenant_id = 'tenant_id' limit 1";
		return $DB->read($query);
	}
}
		$bill = new Bill();
		$bill_data = $bill->get_bill($_GET['tenant_id']);

	if(isset($_GET['del']) && isset($_GET['name']))
	{
	$id=$_GET['del'];
	$name=$_GET['name'];
	
	$sql = "delete from tenant WHERE id=:id";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':id',$id, PDO::PARAM_STR);
	$query -> execute();
	
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
		$sql = "UPDATE tenant SET status=:status WHERE  id=:aeid";
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
		$sql = "UPDATE tenant SET status=:status WHERE  id=:aeid";
		$query = $dbh->prepare($sql);
		$query -> bindParam(':status',$memstatus, PDO::PARAM_STR);
		$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
		$query -> execute();
		$msg="Changes Sucessfully";
		}
	
if(isset($_POST['btn']))
{

    $Newindex = $_POST['Newindex'];
    $Oldindex = $_POST['Oldindex'];
    $to_pay_before = $_POST['date'];
    $total= 0;

    if($Newindex>0)
    {
        $u = $Newindex - $Oldindex;

    }

    $klw = $_POST['KW'];
        // $total=0;
        
        if($klw>100)
        {
            echo "<script>alert('The price per klw most not exceed 100 FCFA')</script>";

        }
        else{
            $u1 = $u * $klw;
   
            $rentalbill= 20000;

            $total2= $rentalbill + $u1;

             
        }


$notitype='Create Account';
$reciver='Admin';

$sqlnoti="insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
$querynoti = $dbh->prepare($sqlnoti);
$querynoti-> bindParam(':notiuser', $sender, PDO::PARAM_STR);
$querynoti-> bindParam(':notireciver',$reciver, PDO::PARAM_STR);
$querynoti-> bindParam(':notitype', $notitype, PDO::PARAM_STR);
$querynoti->execute();    
    
$sql = "INSERT INTO bill (Newindex, Oldindex, KW, klw, rentalbill, total_to_pay, to_pay_before, tenant_id) VALUES (:Newindex, :Oldindex, :KW, :klw, :rentalbill, :total_to_pay, :to_pay_before, {$_GET['tenant_id']})";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':Newindex', $Newindex, PDO::PARAM_STR);
    $query-> bindParam(':Oldindex', $Oldindex, PDO::PARAM_STR);
    $query-> bindParam(':KW', $klw, PDO::PARAM_STR);
    $query-> bindParam(':klw', $u1, PDO::PARAM_STR);
    $query-> bindParam(':rentalbill', $rentalbill, PDO::PARAM_STR);
    $query-> bindParam(':total_to_pay', $total2, PDO::PARAM_STR);
    $query-> bindParam(':to_pay_before', $to_pay_before, PDO::PARAM_STR);
	// $query-> bindParam(':tenant_id', $bill_data, PDO::PARAM_STR);
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

	.form-grop{
		padding: 10px;
		margin: 0 0 10px 0;
		margin-bottom: 20px;
	}
	.form-control{
		width: 600px;
	}
	input{
    width: 200%;
    padding: 10px;
	}
	body{
		display: grid;
		grid-template-columns: 20% 80% 20%;
	}
	.row{
    display: flex;
    min-height: 45vh;
    position: relative;
	}
	h1{
		text-decoration: underline;
	}
	h4{
		text-decoration: underline;
	}
	.rent{
		text-decoration: underline;
	}
	.btn-primary{
    width: fit-content;
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
	}
	b{
		text-decoration: underline;
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
		margin-right: 20px;
	}

</style>
    <script type="text/javascript">
        
</script>
</head>

<body>
<?php include('includes/header.php');?>

<div class="ts-main-content">
<?php include('includes/leftbar.php');?>
	<div class="content-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-md-12">
	<div class="login-page bk-img">
		<div class="form-content">
			<div class="container">
				
                             
                             <div class="panel panel-default">
							<div class="panel-heading">Bill of Tenants</div>
							<div class="panel-body">
							<div class="container">
								<div class="con">
                                <h1>Bill calculation</h1>
            
                            <form method="POST" action="">
                                <div class="row"><div class="col-8 offset-2">
                                
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
                                <div class="form-grop">
                                    <label for="">to pay before</label><br>
                                    <input type="date" class="form-control" id="date" name="date" require>
                                </div>
                                <div class="rent">
                                    <b><label for="Rentbill">Rent Bill = 20000 FCFA</label></b>
                                </div>

                                <button type="submit" class="btn-primary" name="btn">Send </button>
                                </div></div>
                            </form>

                            <?php
                                if(isset($_POST['btn'])){
                                    $Newindex = $_POST['Newindex'];
                                    $Oldindex = $_POST['Oldindex'];
                                    $to_pay_before = $_POST['date'];
                                    $total= 0;
                                    if($Newindex>0)
                                        {
                                            $u = $Newindex - $Oldindex;

                                        }
                                        $klw = $_POST['KW'];
                                        // $total=0;
                                        
                                        if($klw>100)
                                        {
                                            echo "<script>alert('The price per klw most not exceed 100 FCFA')</script>";
                                
                                        }
                                        else{
                                            $u1 = $u * $klw;
                                   
                                            $rentalbill= 20000;
                                
                                            $total2= $rentalbill + $u1;
                                
                                             
                                        }
                                    echo "<b><h4>Difference</h4> </b>";
                                    if($Newindex>0)
                                    {
                                        echo "Killowatt = $Newindex KW - $Oldindex KW = $u KW";
										echo "<b><h4>Bill Details</h4></b>";
                                        echo "$u * $klw = $u1<br>";

                                        echo "<b><br>Electrical Bill = $u1<br></b>";
                                        
                                        echo "<b><h4>TOTAL TO PAY = $total2 FCFA</h4><br><br><br></b>";
										
                                    }
                                    // if($klw<100){
                                        
                                    // }
                                    
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
	<script src="js/main.js">
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