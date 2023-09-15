<?php
include('includes/config.php');
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
   
            $rentalbill= 12000;

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
    
$sql = "INSERT INTO bill (Newindex, Oldindex, KW, klw, rentalbill, total_to_pay, to_pay_before) VALUES (:Newindex, :Oldindex, :KW, :klw, :rentalbill, :total_to_pay, :to_pay_before)";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':Newindex', $Newindex, PDO::PARAM_STR);
    $query-> bindParam(':Oldindex', $Oldindex, PDO::PARAM_STR);
    $query-> bindParam(':KW', $klw, PDO::PARAM_STR);
    $query-> bindParam(':klw', $u1, PDO::PARAM_STR);
    $query-> bindParam(':rentalbill', $rentalbill, PDO::PARAM_STR);
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
    <title>Manage Tenant</title>
    <script type="text/javascript">
        
</script>
</head>

<body>
	<div class="login-page bk-img">
		<div class="form-content">
			<div class="container">
				
                             <h2 class="page-title">Manage Tenants</h2>
                             <div class="panel panel-default">
							<div class="panel-heading">List Tenants</div>
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
                                    <b><label for="Rentbill">Rent Bill = 12000 FCFA</label></b>
                                </div>

                                <button type="submit" class="btn-primary" name="btn">Difference </button>
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
                                   
                                            $rentalbill= 12000;
                                
                                            $total2= $rentalbill + $u1;
                                
                                             
                                        }
                                    echo "<h4>Difference</h4>";
                                    if($Newindex>0)
                                    {
                                        echo "Killowatt = $Newindex KW - $Oldindex KW = $u KW";
                                    }
                                    if($klw<100){
                                        echo "<h4>Bill Details</h4>";
                                        echo "$u * $klw = $u1<br>";

                                        echo "<br><b>Electrical Bill = $u1<br></b>";
                                        
                                        echo "<h4>TOTAL TO PAY = $total2 FCFA</h4><br><br><br>";


                                        // echo ':Newindex '.$Newindex.'<br>';
                                        // echo':Oldindex '.$Oldindex.'<br>';
                                        // echo':KW '.$klw.'<br>';
                                        // echo':klw '.$u1.'<br>';
                                        // echo':rentalbill '.$rentalbill.'<br>';
                                        // echo':total_to_pay '.$total2.'<br>';
                                        // echo':to_pay_before '.$to_pay_before.'<br>';
                                    }
                                    
                                }             
                                ?>
								
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