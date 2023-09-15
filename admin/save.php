<?php
include('includes/config.php');


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

            
                $sql = "INSERT INTO bill (Newindex, Oldindex, KW, klw, rentalbill, total_to_pay, to_pay_before) 
                VALUES (:Newindex, :Oldindex, :KW, :klw, :rentalbill, :total_to_pay, :to_pay_before)";
                    $query= $dbh -> prepare($sql);
                    $query-> bindParam(':Newindex', $Newindex, PDO::PARAM_STR);
                    $query-> bindParam(':Oldindex', $Oldindex, PDO::PARAM_STR);
                    $query-> bindParam(':KW', $klw, PDO::PARAM_STR);
                    $query-> bindParam(':klw', $u11, PDO::PARAM_STR);
                    $query-> bindParam(':rentalbill', $rentalbill, PDO::PARAM_STR);
                    $query-> bindParam(':total_to_pay', $total2, PDO::PARAM_STR);
                    $query-> bindParam(':to_pay_before', $to_pay_before, PDO::PARAM_STR);
                    $query->execute();
                    // echo "<script>alert('good price')</script>";
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


