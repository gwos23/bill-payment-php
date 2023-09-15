<?php session_start();
    error_reporting(0);
    include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENANT</title>
    <link rel="stylesheet" href="styletenant.css">
</head>
<body>
    <div class="container">
        <a href="register_tenant.php" class="Btn_add"> Add Tenant</a>

        <table>
            <tr id="items">
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roomname</th>
                <th>Roomtype</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
            <?php $sql = "SELECT * from  tenants";
                $query = $dbh -> prepare($sql);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                $cnt=1;
                if($query->rowCount() > 0){
                    foreach($results as $result){
                        ?>	
			            <tr>
				            <td><?php echo htmlentities($cnt);?></td>
                            <td><?php echo htmlentities($result->name);?></td>
                            <td><?php echo htmlentities($result->email);?></td>
                            <td><?php echo htmlentities($result->roomtype);?>
                            <td><?php echo htmlentities($result->gender);?></td>
                            <td><?php echo htmlentities($result->mobile);?></td>
                            <?php 
                            
                            if($result->roomtype == Modern){
                                echo'<td><a href="modern_bill.php" class="Btn_add"> Bill</a></td>';
                                echo'<td><button class="Btn_danger" style="width: fit-content; margin-bottom: 20px; background-color: rgb(238, 31, 31);
                                padding: 5px 20px; color: #fff; display: flex; align-items: center; text-align: 0;	border-radius: 6px;	text-decoration: none; border: none;"><a href="deletedtenant.php"> Delete</a></button></td>';
                            }else{
                                echo'<td><a href="simple_bill.php" class="Btn_add"> Bill</a></td>';
                                echo'<td><button class="Btn_danger" style="width: fit-content; margin-bottom: 20px; background-color: rgb(238, 31, 31);
                                padding: 5px 20px; color: #fff; display: flex; align-items: center; text-align: 0;	border-radius: 6px;	text-decoration: none; border: none;"><a href="deletedtenant.php"> Delete</a></button></td>';
                            }?>
                            
              

                        <?php if($result->status == 1)
                        {?>
                             
                            <?php } else {?>
                                
                            <?php } ?>
											
                        
						</tr>
						<?php $cnt=$cnt+1; }} ?>
                
                    
                    
                    <?php
                // $email = $_SESSION['alogin'];
                // $sql = "SELECT * from tenants;";
                // $query = $dbh -> prepare($sql);
                // $query-> bindParam(':email', $email, PDO::PARAM_STR);
                // $query->execute();
                // $result=$query->fetch(PDO::FETCH_OBJ);
                // $cnt=1;	

                // // $sql="select * from tenants";
                // // $result=mysqli_query($dbh,$sql);
                // if($cnt){
                //     while ($row=mysqli_fetch_assoc($cnt)) {
                //         $name=$row['name'];
                //         $email=$row['email'];
                //         $roomtype=$row['roomtype'];
                //         $gender=$row['gender'];
                //         $phone=$row['mobile'];
                //         echo'
                //         <tr>
                //             <td>',$name,'</td>
                //             <td>',$email,'</td>
                //             <td>',$roomtype,'</td>
                //             <td>',$gender,'</td>
                //             <td>',$phone,'</td>
                //             <td><a href="#" class="Btn_add"> Bill</a></td>
                //         </tr>
                //         ';
                //     }
                // }else{
                //     echo 'nothing to show';
                // }
            ?>
            
        </table>

    </div>
    
</body>
</html>