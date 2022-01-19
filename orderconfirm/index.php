<?php
include '../assets/layouts/header.php';

checked_logged_in();
check_verified();

if(isset($_POST['buy'])){
    

    if (isset($_SESSION['zha_address'])) {

        
        $sql  = 'SELECT * FROM zha_products WHERE  zha_product_id=?;';
        $stmt = mysqli_stmt_init($conn);
    
            if (!mysqli_stmt_prepare($stmt, $sql)) {
    
                $_SESSION['ERRORS']['scripterror'] = mysqli_stmt_error($stmt);
                header("Location: ../home");
                exit();
            } 
            else {
    
                mysqli_stmt_bind_param($stmt,"s",$_POST['id']);
                mysqli_stmt_execute($stmt);
    
                $result = mysqli_stmt_get_result($stmt);
               
                
                if ($row = mysqli_fetch_assoc($result)) {
                    
                    $_SESSION['zha_thumb']       = $row['zha_product_thumb'];
                    $_SESSION['zha_productname'] = $row['zha_product_name'];
                    $_SESSION['zha_price']       = $row['zha_price'];
                }
            }
            $_SESSION['zha_productid']  = $_POST['id'];
            $_SESSION['zha_quantity']   = $_POST['quantity'];
            $_SESSION['zha_totalprice'] = $_POST['quantity']* $_SESSION['zha_price'];
    }else{

        header("Location: ../address");
        exit();
    }

}



?>
<div class="container">
    <div class="row">
        <div class="col-xl-6 col-lg-6 ">
            <div class="border">

                <table class="table">
                    <thead>
                        <tr>
                            <H4  class="tbh" >Confirm Product </H4>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td scope="row">Product Name</td>
                            <td><?Php echo $_SESSION['zha_productname']; ?></td>
                        </tr>

                        <tr>
                            <td scope="row">Prodcut Qty</td>
                            <td><?php echo $_SESSION['zha_quantity']; ?></td>
                        </tr>

                        <tr>
                            <td scope="row">Prodct price</td>
                            <td><?php echo $_SESSION['zha_price']; ?></td>
                        </tr>
                        <tr>
                            <td scope="row">Price Total</td>
                            <td><?php echo $_SESSION['zha_totalprice']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <div class="col-xl-6 col-lg-6 ">
            <div class="border">

                <table class="table">
                    <thead>
                        <tr">
                            <H4  class="tbh" >Confirm Address </H4>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td scope="row"> Name:</td>
                            <td><?php echo $_SESSION['zha_fullname']; ?></td>
                        </tr>

                        <tr>
                            <td scope="row"> Email:</td>
                            <td><?php echo $_SESSION['zha_email']; ?></td>
                        </tr>

                        <tr>
                            <td scope="row"> Phone:</td>
                            <td><?php echo $_SESSION['zha_phone']; ?></td>
                        </tr>

                        <tr>
                            <td scope="row"> address:</td>
                            <td><?php echo $_SESSION['zha_address']; ?></td>
                        </tr>

                        <tr>
                            <td scope="row"> city:</td>
                            <td><?php echo $_SESSION['zha_city']; ?></td>
                        </tr>

                        <tr>
                            <td scope="row">State:</td>
                            <td><?php echo $_SESSION['zha_state']; ?></td>
                        </tr>

                        <tr>
                            <td scope="row">Country</td>
                            <td><?php echo $_SESSION['zha_country']; ?></td>
                        </tr>

                        <tr>
                            <td scope="row"> Pincode</td>
                            <td><?php echo $_SESSION['zha_postalcode']; ?></td>
                        </tr>

                    </tbody>
                  
                </table>
            </div>   
        </div>
        <div class="container text-center mt-3 ">
             <form action="includes/order.inc.php" method="post">

               <?php insert_csrf_token() ?>
                <input type="submit" class="btn-buy" name="confirm" value="Confirm Details">
            </form>

        </div>
    </div>
</div>

<?php

include "../assets/layouts/footer.php";
?>