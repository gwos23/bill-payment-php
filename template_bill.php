<?php
session_start();
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="bill.css">
    <title>BILL</title>
</head>
<body>
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
    <div class="t"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.5/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>




